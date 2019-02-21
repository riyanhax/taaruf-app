@extends('layouts.app', ['title' => 'Media Manager'])

@section('content')
    <section class="section">
        <h1 class="section-header">
            <div>Media Manager</div>
        </h1>
    
        <div class="section-body">
            @include('flash::message')

            <div class="card">
                <div class="card-header"><h4>Media Manager</h4></div>
                <div class="card-body">
                	<div id="media-manager"></div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')
<script>
	$("#media-manager").midia({
		inline: true,
		base_url: '{{url('')}}',
	});
</script>
@stop