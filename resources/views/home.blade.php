@extends('layouts.app')
@section('content')

<section class="section-home">
	@include('layouts.partials._navigationBar')
	<div class="container-home">

		<div class="testimotionals">
			<div class="card">
				<div class="layer">

				</div>
				<div class="content">
					<p>
						Tableros TPCYM, Servicio de pruebas en fábrica para TPCYM´S, Elaboración de ingeniería para TPCYM´S.</p>
					<div class="image">
						<img width="100px" src="https://intrigosys.com/wp-content/uploads/2018/07/own-application-3.png" alt="">

					</div>
					<div class="details">
						<h2>
							<br>
							<a href="{{url('/supplies')}}"> <span class="btn">SUMINISTROS</span></a>
						</h2>

					</div>
				</div>
			</div>
		</div>

		<div class="testimotionals col-md-4">
			<div class="card">
				<div class="layer">

				</div>
				<div class="content">
					<p>
						Servicio de integración al sistema existente, Actualización de esquemas, Instalación de redes de comunicación.</p>
					<div class="image">
						<img width="100px" src="https://intrigosys.com/wp-content/uploads/2018/07/improved-coordination-1.png" alt="">

					</div>
					<div class="details">
						<h2>
							<br>
							<a href="{{url('/services')}}"> <span class="btn">SERVICIOS</span></a>
						</h2>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection