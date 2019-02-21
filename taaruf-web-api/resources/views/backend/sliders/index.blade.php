@extends('layouts.app', ['title' => 'Sliders'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Sliders</div>
            <div class="float-right">
               <a class="btn btn-primary btn-sm" href="{!! route('backend.sliders.create') !!}">Add New</a>
           </div>
        </h1>
    
        <div class="section-body">
            @include('flash::message')

            <div class="card">
                <div class="card-header"><h4>Sliders</h4></div>
                <div class="card-body">
                    @include('backend.sliders.table')
                </div>
                <div class="card-footer">
                    <div class="text-center">
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

