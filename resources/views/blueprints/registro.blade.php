@extends('layouts.general')
@section('content')
<div class="container-fluid bg-primary">
	<div class="row">
		<div class="col-md-6 text-center">
			<div class="container bg-light sombra">
				<div class="text-center login-sec text-danger">
					<h2>Nuevo Usuario
						<p><small class="text-muted">Genera acceso a plataforma facil e inmediato</small></p>
					</h2>
				</div>
				<div class="btn-group btn-group-toggle col-sm-8" data-toggle="buttons">
				  	<label class="btn btn-outline-danger iconos-botones" id="boton-admin">
				    	<input type="radio" name="options" id="option1" autocomplete="off"><p><b>Administrador</b></p>
				    	<p>acceso completo a caracteristicas</p>
				 	</label>
				  	<label class="btn btn-outline-danger iconos-botones" id="boton-operador">
				   		<input type="radio" name="options" id="option2" autocomplete="off"><p><b>Operador</b></p>
				    	<p>consultas y chat en linea</p>
				  	</label>
				</div>
				<form class="col-sm-8 form-registro">
					<div class="form-group">
						<label for="NombreUsuario">Nombre</label>
						<input type="text" class="form-control" id="NombreUsuario" placeholder="Nombre completo">
					</div>
				  	<div class="form-group">
				    	<label for="exampleInputEmail1">Email</label>
				    	<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo electronico">
				 	</div>
				  	<div class="form-group">
				    	<label for="exampleInputPassword1">Password</label>
				    	<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				    </div>
				    <div class="form-group form-check">
				    	<input type="checkbox" class="form-check-input" id="exampleCheck1">
				    	<label class="form-check-label" for="exampleCheck1">Acepto Terminos</label>
				  </div>
				  	<button type="submit" class="btn btn-danger">Crear nueva cuenta</button>
				</form>
				
			</div>
		</div>
		<div class="col-md-6 text-center bg-dark">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			  	<ol class="carousel-indicators">
			    	<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			    	<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			    	<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			  	</ol>
			<div class="carousel-inner">
			    <div class="carousel-item active">
			      	<img src="{{ asset('images/soyUnCarrito.jpg') }}" class="d-block w-100" alt="...">
			    </div>
			    <div class="carousel-item">
			     	<img src="{{ asset('images/soyUnCarrito.jpg') }}" class="d-block w-100" alt="...">
			    </div>
			    <div class="carousel-item">
			      	<img src="{{ asset('images/soyOtroCarrito.jpg') }}" class="d-block w-100" alt="...">
			    </div>
			</div>
			  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Anterior</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">siguiente</span>
			  </a>
			</div>
		</div>
	</div>
</div>
@endsection