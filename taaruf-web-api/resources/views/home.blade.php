@extends('layouts.app')

@section('content')
    <section class="section">
        <h1 class="section-header mb-0">
            <div>Dashboard</div>
        </h1>
        <div class="row mt-4">
        	<div class="col-12">
        		<div class="card card-primary">
        			<div class="card-body">
        				<div class="p-4">
	        				<h2>Halo, {{user()->name}}!</h2>
	        				<p class="lead">
	        					Pada halaman admin, Anda dapat mengelola data pengguna, berita, proposal dan lain sebagainya.
	        				</p>
	        				<a href="{{route('backend.users.index')}}" class="btn btn-primary btn-round btn-shadow mt-2">Data Pengguna</a>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    </section>
@endsection
