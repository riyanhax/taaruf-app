@extends('layouts.app', ['title' => 'Show Blog'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Show Blog</div>
        </h1>

        <div class="section-body">
            <div class="card">
                <div class="card-header"><h4>Show Blog</h4></div>
                <div class="card-body">
                    <div class="row">
                        @include('backend.blogs.show_fields')
                        <a href="{!! route('backend.blogs.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
