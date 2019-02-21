@extends('layouts.app', ['title' => 'Show Page'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Show Page</div>
        </h1>

        <div class="section-body">
            <div class="card">
                <div class="card-header"><h4>Show Page</h4></div>
                <div class="card-body">
                    <div class="row">
                        @include('backend.pages.show_fields')
                        <a href="{!! route('backend.pages.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
