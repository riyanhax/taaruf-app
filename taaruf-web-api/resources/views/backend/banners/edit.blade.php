@extends('layouts.app', ['title' => 'Edit Banner'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Edit Banner</div>
        </h1>
    
        <div class="section-body">
            @include('adminlte-templates::common.errors')

            <div class="card">
                <div class="card-header"><h4>Edit Banner</h4></div>
                <div class="card-body">
                    <div class="row">
                         {!! Form::model($banner, ['route' => ['backend.banners.update', $banner->id], 'method' => 'patch']) !!}

                            @include('backend.banners.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection