@extends('layouts.app', ['title' => 'Edit Slider'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Edit Slider</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Edit Slider</h4></div>
                <div class="card-body">
                    <div class="row">
                         {!! Form::model($slider, ['route' => ['backend.sliders.update', $slider->id], 'method' => 'patch']) !!}

                            @include('backend.sliders.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection