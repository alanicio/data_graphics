@extends('layouts.general')
@section('content')
  <div class="d-flex" id="wrapper">

    <div class="bg-light border-right curvar text-center" id="sidebar-wrapper">
      <div class="sidebar-heading">Opciones</div>
      <button class="btn btn-outline-danger icono-plus mb-2" id="agregar"></button>
      <div id="formularioDinamico">
      </div>
    </div>

    <div id="page-content-wrapper">

      <div><button class="btn btn-danger ml-3 mb-1" id="menu-toggle">Menu</button></div>
      <div class="container-fluid" id="canvasGraficas">
      </div>
  	</div>

  <script>
  	var id=0;
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    $("#agregar").click(function(){
    	id+=1;
    	$.ajax({
        	url: "{{url('formulario')}}"+"/"+id,
        	success:function(res){
        		$("#formularioDinamico").append(res);
        		$("#canvasGraficas").append("<div class='bg-light curvar mb-3'><canvas id='myChart"+id+"' width='400' height='130'></canvas></div>");
        	},
        	error:function(res){
        		$("#formularioDinamico").html('algo anda mal');
        	}
        });
    });

    $(document).ready(function(){
		$('.nav-link dropdown-toggle active').attr('class','nav-link dropdown-toggle')
		$('.nav-link active').attr('class','nav-link');
		$('#Presentación_de_datos').attr('class','nav-link active');
	});
  </script>	
@endsection