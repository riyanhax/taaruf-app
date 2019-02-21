@extends('layouts.app', ['title' => 'Edit Blog'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Edit Blog</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Edit Blog</h4></div>
                <div class="card-body">
                    <div class="row">
                         {!! Form::model($blog, ['route' => ['backend.blogs.update', $blog->id], 'method' => 'patch']) !!}

                            @include('backend.blogs.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection