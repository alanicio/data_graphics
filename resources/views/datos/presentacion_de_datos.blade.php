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
  	var myChart = [];
  	var datas = [];
	var background = [];
	var border = [];
	var centros = [];
	var medicion = [];
  	var formId=0;
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    $("#agregar").click(function(){
    	formId+=1;
    	$.ajax({
        	url: "{{url('formulario')}}"+"/"+formId,
        	success:function(res){
        		$("#formularioDinamico").append(res);
        		$("#canvasGraficas").append("<div class='bg-light curvar mb-3'><canvas id='myChart"+formId+"' width='400' height='130'></canvas></div>");
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

	function mostrarDatosGrafica(numId){
		var selected=$('#medicion_type'+numId).val();
			medicion[numId]=selected;
			if(selected>0)
			{
				$.ajax({
					type:'GET',
					url:"{{url('calibracion')}}"+"/"+selected,
					success:function(res){
						$('#datos_type'+numId).html(res);
					}
				});
			}
			else
			{
				myChart[numid].destroy();
			}
	}

	function obtenerDatos(numId){
		var selected=$('#datos_type'+numId).val();
			if(selected)
			{
				$.ajax({
					type:'POST',
					url:"{{url('graficar')}}",	
					data:{"_token": "{{ csrf_token() }}",tipo:medicion[numId],dato:selected},
					success:function(res){
						datas[numId]=res.data;
						background[numId]=res.background;
						border[numId]=res.border;
						centros[numId]=res.centros;
					}
				});
				if (myChart[numId]) {
					myChart[numId].destroy();
					var option=$('#graphic_type'+numId).val();
					if(option==1)
						barras(numId);
					else if(option==2)
						lineas(numId);
					else if(option==3)
						circulo(numId);
				}
			}
	}
	function dibujarGrafica(id){
		var option=$('#graphic_type'+id).val();
		//elegirGrafica(id,option);
		if(myChart[id])
			myChart[id].destroy();
			if(option==1)
				 barras(id);
			else if(option==2)
				 lineas(id);
			else if(option==3)
				 circulo(id);
	}

	function elegirGrafica(id,opcion){
		alert('hola');
		if(opcion==1)
			barras(id);
		else if(opcion==2)
			lineas(id);
		else id(opcion==3)
			circulo(id);
	}
	function barras(id){
		var ctx = document.getElementById('myChart'+id).getContext('2d');
		myChart[id] = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: centros[id],
		        datasets: [{
		            label: 'lineas',
		            data: datas[id],
		            backgroundColor: background[id],
		            borderColor: border[id],
		            borderWidth: 1
		        }]
		    },
		    options: {
		    	legend: { display: false },
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero: true
		                }
		            }]
		        }
		    }
		});
	}

	function lineas(id){
		myChart[id]=new Chart(document.getElementById('myChart'+id), {
		  type: 'line',
		  data: {
		    labels: centros[id],
		    datasets: [{ 
		        data: datas[id],
		        label: centros[id],
		        borderColor: "#3e95cd",
		        fill: false
		      }
		    ]
		  },
		  options: {
		    title: {
		      display: true,
		      text: 'data'
		    }
		  }
		});

	}

	function circulo(id){
		myChart[id]=new Chart(document.getElementById('myChart'+id), {
	    type: 'pie',
	    data: {
	      labels:centros[id],
	      datasets: [{
	        label: "datas",
	        backgroundColor: background[id],
	        data: datas[id]
	      }]
	    },
	    options: {
	      title: {
	        display: true,
	        text: 'datas'
	      }
	    }
	});


	}
  </script>	
@endsection