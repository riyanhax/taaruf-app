@extends('layouts.app', ['title' => 'Create Banner'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Create Banner</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Create Banner</h4></div>
                <div class="card-body">
                    <div class="row">
                        {!! Form::open(['route' => 'backend.banners.store']) !!}

                            @include('backend.banners.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
