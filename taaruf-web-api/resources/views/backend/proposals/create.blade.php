@extends('layouts.app', ['title' => 'Create Proposal'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Create Proposal</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Create Proposal</h4></div>
                <div class="card-body">
                    <div class="row">
                        {!! Form::open(['route' => 'backend.proposals.store']) !!}

                            @include('backend.proposals.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
