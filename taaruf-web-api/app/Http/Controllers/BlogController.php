<?php

namespace App\Http\Controllers;

use App\DataTables\BlogDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Repositories\BlogRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\KotaTaaruf;
use \App\Appusers;
use \App\ProfileData;

class BlogController extends AppBaseController
{
    /** @var  BlogRepository */
    private $blogRepository;

    public function __construct(BlogRepository $blogRepo)
    {
        $this->blogRepository = $blogRepo;
    }

    /**
     * Display a listing of the Blog.
     *
     * @param BlogDataTable $blogDataTable
     * @return Response
     */
    public function index(BlogDataTable $blogDataTable)
    {
        return $blogDataTable->render('backend.blogs.index');

       // $app = Appusers::with('profiledata.fieldprofile_data')->get();

        
        //$kotaTaaruf = KotaTaaruf::with('city_data')->get();
        //print_r($kotaTaaruf->toArray());
        //die();
    }

    /**
     * Show the form for creating a new Blog.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.blogs.create');
    }

    /**
     * Store a newly created Blog in storage.
     *
     * @param CreateBlogRequest $request
     *
     * @return Response
     */
    public function store(CreateBlogRequest $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'picture' => 'required',
            'content' => 'required'
        ]);
        $input = $request->all();
        $input['slug'] = slugify($input['title']);

        $blog = $this->blogRepository->create($input);

        Flash::success('Blog saved successfully.');

        return redirect(route('backend.blogs.index'));
    }

    /**
     * Display the specified Blog.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $blog = $this->blogRepository->findWithoutFail($id);

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('backend.blogs.index'));
        }



        return view('backend.blogs.show')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified Blog.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $blog = $this->blogRepository->findWithoutFail($id);

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('backend.blogs.index'));
        }


        return view('backend.blogs.edit')->with('blog', $blog);
    }

    /**
     * Update the specified Blog in storage.
     *
     * @param  int              $id
     * @param UpdateBlogRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBlogRequest $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'picture' => 'required',
            'content' => 'required'
        ]);
        $blog = $this->blogRepository->findWithoutFail($id);

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('backend.blogs.index'));
        }

        $blog = $this->blogRepository->update($request->all(), $id);

        Flash::success('Blog updated successfully.');

        return redirect(route('backend.blogs.index'));
    }

    /**
     * Remove the specified Blog from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $blog = $this->blogRepository->findWithoutFail($id);

        if (empty($blog)) {
            Flash::error('Blog not found');

            return redirect(route('backend.blogs.index'));
        }

        $this->blogRepository->delete($id);

        Flash::success('Blog deleted successfully.');

        return redirect(route('backend.blogs.index'));
    }
}
