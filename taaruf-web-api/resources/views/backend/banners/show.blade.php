@extends('layouts.app', ['title' => 'Show Banner'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Show Banner</div>
        </h1>

        <div class="section-body">
            <div class="card">
                <div class="card-header"><h4>Show Banner</h4></div>
                <div class="card-body">
                    <div class="row">
                        @include('backend.banners.show_fields')
                        <a href="{!! route('backend.banners.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
