@extends('layouts.app', ['title' => 'Create Appusers'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Create Appusers</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Create Appusers</h4></div>
                <div class="card-body">
                    <div class="row">
                        {!! Form::open(['route' => 'backend.appusers.store']) !!}

                            @include('backend.appusers.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
