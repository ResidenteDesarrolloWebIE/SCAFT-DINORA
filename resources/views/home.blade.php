@extends('layouts.app')
@section('content')

<section class="section-home">
	@include('layouts.partials._navigationBar')
	<div class="container-home">
		<div class="text-xs-center col-md-4 div-home">
			<br>
			<p class="h5"><strong>TE DAMOS LA MÁS CORDIAL BIENVENIDO</strong></p>
			<h1 class="display-4 mb-3 text-center">"{{ Auth::user()->name }}"</h1>
			<h1 class="text-center">EXPLORAR</h1>
			@if(Auth::user()->hasRole('admin'))
			<div class="text-center">
				<a href="{{url('projects')}}" class="btn btn-secondary btn-lg">Lista de proyectos</a>
			</div>
			@else
			<div class="row text-center">
				<div class="col"><a href="{{url('/supplies')}}" class="btn btn-secondary btn-lg">Suministros</a></div>
				<div class="col"><a href="{{url('/services')}}" class="btn btn-secondary btn-lg">Servicios</a></div>
			</div>
			@endif
			<br>
		</div>
	</div>
</section>
@endsection