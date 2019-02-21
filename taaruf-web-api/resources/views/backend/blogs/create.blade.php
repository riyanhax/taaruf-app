@extends('layouts.app', ['title' => 'Create Blog'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Create Blog</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Create Blog</h4></div>
                <div class="card-body">
                    <div class="row">
                        {!! Form::open(['route' => 'backend.blogs.store']) !!}

                            @include('backend.blogs.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
