@extends('layouts.app', ['title' => 'Edit Proposal'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Edit Proposal</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Edit Proposal</h4></div>
                <div class="card-body">
                    <div class="row">
                         {!! Form::model($proposal, ['route' => ['backend.proposals.update', $proposal->id], 'method' => 'patch']) !!}

                            @include('backend.proposals.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection