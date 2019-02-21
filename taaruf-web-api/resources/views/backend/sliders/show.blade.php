@extends('layouts.app', ['title' => 'Show Slider'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Show Slider</div>
        </h1>

        <div class="section-body">
            <div class="card">
                <div class="card-header"><h4>Show Slider</h4></div>
                <div class="card-body">
                    <div class="row">
                        @include('backend.sliders.show_fields')
                        <a href="{!! route('backend.sliders.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
