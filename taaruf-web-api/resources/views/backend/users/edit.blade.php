@extends('layouts.app', ['title' => 'Edit User'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Edit User</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Edit User</h4></div>
                <div class="card-body">
                    <div class="row">
                         {!! Form::model($user, ['route' => ['backend.users.update', $user->id], 'method' => 'patch']) !!}

                            @include('backend.users.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection