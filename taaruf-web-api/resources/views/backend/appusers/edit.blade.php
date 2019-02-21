@extends('layouts.app', ['title' => 'Edit Appusers'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Edit Appusers</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Edit Appusers</h4></div>
                <div class="card-body">
                    <div class="row">
                         {!! Form::model($appusers, ['route' => ['backend.appusers.update', $appusers->id], 'method' => 'patch']) !!}

                            @include('backend.appusers.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection