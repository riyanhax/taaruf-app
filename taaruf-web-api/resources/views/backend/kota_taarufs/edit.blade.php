@extends('layouts.app', ['title' => 'Edit Kota Taaruf'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Edit Kota Taaruf</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Edit Kota Taaruf</h4></div>
                <div class="card-body">
                    <div class="row">
                         {!! Form::model($kotaTaaruf, ['route' => ['backend.kotaTaarufs.update', $kotaTaaruf->id], 'method' => 'patch']) !!}

                            @include('backend.kota_taarufs.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection