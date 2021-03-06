@extends('layouts.app', ['title' => 'Banners'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Banners</div>
            <div class="float-right">
               <a class="btn btn-primary btn-sm" href="{!! route('backend.banners.create') !!}">Add New</a>
           </div>
        </h1>
    
        <div class="section-body">
            @include('flash::message')

            <div class="card">
                <div class="card-header"><h4>Banners</h4></div>
                <div class="card-body">
                    @include('backend.banners.table')
                </div>
                <div class="card-footer">
                    <div class="text-center">
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

