@extends('layouts.app', ['title' => 'Show Kota Taaruf'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Show Kota Taaruf</div>
        </h1>

        <div class="section-body">
            <div class="card">
                <div class="card-header"><h4>Show Kota Taaruf</h4></div>
                <div class="card-body">
                    <div class="row">
                        @include('backend.kota_taarufs.show_fields')
                        <a href="{!! route('backend.kotaTaarufs.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
