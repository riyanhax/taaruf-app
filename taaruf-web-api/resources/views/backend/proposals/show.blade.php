@extends('layouts.app', ['title' => 'Show Proposal'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Show Proposal</div>
        </h1>

        <div class="section-body">
            <div class="card">
                <div class="card-header"><h4>Show Proposal</h4></div>
                <div class="card-body">
                    <div class="row">
                        @include('backend.proposals.show_fields')
                        <a href="{!! route('backend.proposals.index') !!}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
