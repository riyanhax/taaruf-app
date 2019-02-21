@extends('layouts.app', ['title' => 'Show User'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Show User</div>
        </h1>

        <div class="section-body">
            <div class="card">
                <div class="card-header"><h4>Show User</h4></div>
                <div class="card-body">
                    <div class="row">
                        @include('backend.users.show_fields')
                        <a href="{!! route('backend.users.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
