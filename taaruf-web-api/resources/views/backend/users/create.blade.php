@extends('layouts.app', ['title' => 'Create User'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Create User</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Create User</h4></div>
                <div class="card-body">
                    <div class="row">
                        {!! Form::open(['route' => 'backend.users.store']) !!}

                            @include('backend.users.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
