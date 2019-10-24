<div class="container-fluid bg-danger p-3 mb-1">
  	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text">Tipo de calibración</label>
		</div>
		<select class="custom-select" id="medicion_type{{$id}}" onchange="mostrarDatosGrafica('{{$id}}')">
		  	<option selected="" value="">Seleccione que calibración quiere ver</option>
		  	<option value="1">Dinamometro</option>
		  	<option value="2">Fisico mecanicas</option>
	  </select>
	</div>
	<div class="input-group mb-3" id="datos{{$id}}">
		<div class="input-group-prepend">
			<label class="input-group-text">Seleccione dato a graficar</label>
		</div>
		<select class="custom-select" id="datos_type{{$id}}" onchange="obtenerDatos('{{$id}}')">
		</select>
	</div>
	<div class="input-group mb-3" id="div_graphic_type{{$id}}">
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
	<div class="input-group mb-3" id="dates{{$id}}">
	  <div class="input-group-prepend">
	    <label class="input-group-text" for="dates{{$id}}">Intervalo de la informacion</label>
	  </div>
	  <div class="form-row align-items-center">
	  	<input type="date" class="form-control mb-2" id="dateI{{$id}}" name="date_menor" style="width: 49%; margin-right: 2%;" onchange="dateMenor({{$id}})">
	  	<input type="date" class="form-control mb-2" id="dateF{{$id}}" name="date_mayor" style="width: 49%;" onchange="dateMayor({{$id}})">	  	
	  </div>
</div>