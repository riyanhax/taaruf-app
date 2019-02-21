@extends('layouts.app', ['title' => 'Users'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Users</div>
            <div class="float-right">
               <a class="btn btn-primary btn-sm" href="{!! route('register') !!}">Register New User</a>
           </div>
        </h1>
    
        <div class="section-body">
            @include('flash::message')

            <div class="card">
                <div class="card-header"><h4>Users</h4></div>
                <div class="card-body">
                    @include('backend.users.table')
                </div>
                <div class="card-footer">
                    <div class="text-center">
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

