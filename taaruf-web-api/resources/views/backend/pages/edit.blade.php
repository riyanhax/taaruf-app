@extends('layouts.app', ['title' => 'Edit Page'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Edit Page</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Edit Page</h4></div>
                <div class="card-body">
                    <div class="row">
                         {!! Form::model($page, ['route' => ['backend.pages.update', $page->id], 'method' => 'patch']) !!}

                            @include('backend.pages.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection