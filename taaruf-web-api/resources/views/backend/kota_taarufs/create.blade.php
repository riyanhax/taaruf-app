@extends('layouts.app', ['title' => 'Create Kota Taaruf'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Create Kota Taaruf</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Create Kota Taaruf</h4></div>
                <div class="card-body">
                    <div class="row">
                        {!! Form::open(['route' => 'backend.kotaTaarufs.store']) !!}

                            @include('backend.kota_taarufs.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
