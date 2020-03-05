@extends('layouts.app')
@section('content')

<section class="section-home">
	@include('layouts.partials._navigationBar')
	<div class="container-home">

		<div class="testimotionals co">
			<div class="card">
				<div class="layer">

				</div>
				<div class="content">
					<p>Tableros TPCYM, Servicio de pruebas en fábrica para TPCYM´S, Elaboración de ingeniería para TPCYM´S.</p>
					<div class="image">
						<img width="80px" src="https://intrigosys.com/wp-content/uploads/2018/07/own-application-3.png" alt="">

					</div>
					<div class="details">
						<h2> <br><span><h6>©Integracion De Energia</h6></span></h2>
						<br>
						<div class="col"><a href="{{url('/supplies')}}" class="btn btn-secondary btn-lg boton1">Suministros</a></div>
					</div>
				</div>
			</div>
		</div>

		<div class="testimotionals col-md-4">
			<div class="card">
				<div class="layer">

				</div>
				<div class="content">
					<p>Servicio de integración al sistema existente, Actualización de esquemas, Instalación de redes de comunicación..</p>
					<div class="image">
						<img width="80px" src="https://intrigosys.com/wp-content/uploads/2018/07/decreased-order.png" alt="">

					</div>
					<div class="details">
						<h2> <br><span><h6>©Integracion De Energia</h6></span></h2>
						<br>
						<div class="col"><a href="{{url('/services')}}" class="btn btn-secondary btn-lg boton1">Servicios</a></div>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="text-xs-center col-md-4 div-home">
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
		</div> -->
	</div>
</section>
@endsection