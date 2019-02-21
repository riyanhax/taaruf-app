@extends('layouts.app', ['title' => 'Blogs'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Blogs</div>
            <div class="float-right">
               <a class="btn btn-primary btn-sm" href="{!! route('backend.blogs.create') !!}">Add New</a>
           </div>
        </h1>
    
        <div class="section-body">
            @include('flash::message')

            <div class="card">
                <div class="card-header"><h4>Blogs</h4></div>
                <div class="card-body">
                    @include('backend.blogs.table')
                </div>
                <div class="card-footer">
                    <div class="text-center">
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

