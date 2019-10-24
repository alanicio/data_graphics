<div class="container-fluid bg-danger p-2 mb-2" id="formulario{{$id}}">
	<div class="mb-3 ml-3">
		<div class="text-right">
			<div class="ml-3"><button class="btn btn-light" onclick="closeNav()">X</button></div>
		</div>
		<div class=""><h4 class="text-light">Opciones</h4></div>
		<div class="ml-3">
			<button class="btn btn-primary icono-plus mb-2" id="agregar" onclick="agregarFormulario()"></button>
		</div>
	</div>
  	<div class="input-group input-group-sm mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text">Tipo de calibración</label>
		</div>
		<select class="custom-select" id="medicion_type{{$id}}" onchange="mostrarDatosGrafica('{{$id}}')">
		  	<option selected="" value="">Seleccione que calibración quiere ver</option>
		  	<option value="1">Dinamometro</option>
		  	<option value="2">Fisico mecanicas</option>
	  </select>
	</div>
	<div class="input-group input-group-sm mb-3" id="datos{{$id}}">
		<div class="input-group-prepend">
			<label class="input-group-text">Seleccione dato a graficar</label>
		</div>
		<select class="custom-select" id="datos_type{{$id}}" onchange="obtenerDatos('{{$id}}')">
		</select>
	</div>
	<div class="input-group input-group-sm mb-3" id="div_graphic_type{{$id}}">
	  <div class="input-group-prepend">
	    <label class="input-group-text" for="graphic_type{{$id}}">Tipos de graficas</label>
	  </div>
	  <select class="custom-select" id="graphic_type{{$id}}" onchange="dibujarGrafica('{{$id}}')">
	  	<option selected="" value="">Seleccion tipo de grafica...</option>
	    <option value="1">Barras</option>
	    <option value="2">linea</option>
	    <option value="3">circular</option>
	  </select>
	</div>
	<div class="input-group input-group-sm text-center" id="dates{{$id}}">
	  <div class="input-group-prepend text-center">
	    <label class="input-group-text" for="dates{{$id}}">Intervalo de la informacion</label>
	  </div>
	  <div class="form-row align-items-center p-3 input-group-sm">
	  	<input type="date" class="form-control" id="dateI{{$id}}" name="date_menor" style="width: 49%; margin-right: 2%;" onchange="dateMenor('{{$id}}')">
	  	<input type="date" class="form-control" id="dateF{{$id}}" name="date_mayor" style="width: 49%;" onchange="dateMayor('{{$id}}')">	  	
	  </div>
	</div>
</div>