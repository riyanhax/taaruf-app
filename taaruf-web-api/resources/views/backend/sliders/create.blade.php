@extends('layouts.app', ['title' => 'Create Slider'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Create Slider</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Create Slider</h4></div>
                <div class="card-body">
                    <div class="row">
                        {!! Form::open(['route' => 'backend.sliders.store']) !!}

                            @include('backend.sliders.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
