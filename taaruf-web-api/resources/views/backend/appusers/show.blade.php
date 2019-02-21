@extends('layouts.app', ['title' => 'Show Appusers'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Show Appusers</div>
        </h1>

        <div class="section-body">
            <div class="card">
                <div class="card-header"><h4>Show Appusers</h4></div>
                <div class="card-body">
                    <div class="row">
                        @include('backend.appusers.show_fields')
                        <a href="{!! route('backend.appusers.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
