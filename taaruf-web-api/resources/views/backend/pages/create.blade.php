@extends('layouts.app', ['title' => 'Create Page'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Create Page</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Create Page</h4></div>
                <div class="card-body">
                    <div class="row">
                        {!! Form::open(['route' => 'backend.pages.store']) !!}

                            @include('backend.pages.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
