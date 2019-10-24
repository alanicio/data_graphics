@extends('layouts.general')
@section('content')
  <div class="d-flex" id="wrapper">

    <div class="bg-light border-right curvar text-center" id="sidebar-wrapper">
      <div class="sidebar-heading">Opciones</div>
      <button class="btn btn-outline-danger icono-plus mb-2" id="agregar" onclick="agregarFormulario()"></button>
      <div id="formularioDinamico">
      </div>
    </div>

    <div id="page-content-wrapper">

      <div><button class="btn btn-danger ml-3 mb-1" id="menu-toggle">Menu</button></div>
      <div class="container-fluid" id="canvasGraficas">
      </div>
      <div class="curvar text-center ml-3 mr-3 p-3"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.157716686945!2d-99.20397228597615!3d19.448765745205307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2021212247371%3A0xf7b84691bb722035!2sMAHA%20oficina!5e0!3m2!1ses!2smx!4v1571852112355!5m2!1ses!2smx" class="curvar" width="400" height="300" frameborder="2" style="border:0;" allowfullscreen=""></iframe>
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
  	var dateMen=[];//dateI
  	var dateMay=[];//dateF
  	agregarFormulario();

  	function dateMenor(id){
  		dateMen[id]=$('#dateI'+id).val();
  		if(dateMay[id])
  		{
  			var med=$('#medicion_type'+id).val();
  			var datos=$('#datos_type'+id).val();
  			$.ajax({
  				type:"POST",
  				data:{"_token": "{{ csrf_token() }}",fechaMenor:dateMen[id],fechaMayor:dateMay[id],tipo:med,dato:datos},
  				url:"{{url('filtro/fecha')}}",
  				success: function(res){
  					datas[id]=res.data;
  					if (myChart[id]) {
						myChart[id].destroy();
						var option=$('#graphic_type'+id).val();
						if(option==1)
							barras(id);
						else if(option==2)
							lineas(id);
						else if(option==3)
							circulo(id);
					}
  				},
  			});
  		}
  		// else
  		// 	alert('mayor indefinido');
  	}

  	function dateMayor(id){
  		dateMay[id]=$('#dateF'+id).val();
  		if(dateMay[id])
  			var med=$('#medicion_type'+id).val();
  			var datos=$('#datos_type'+id).val();
  			$.ajax({
  				type:"POST",
  				data:{"_token": "{{ csrf_token() }}",fechaMenor:dateMen[id],fechaMayor:dateMay[id],tipo:med,dato:datos},
  				url:"{{url('filtro/fecha')}}",
  				success: function(res){
  					datas[id]=res.data;
  					if (myChart[id]) {
						myChart[id].destroy();
						var option=$('#graphic_type'+id).val();
						if(option==1)
							barras(id);
						else if(option==2)
							lineas(id);
						else if(option==3)
							circulo(id);
					}
  				},
  			});
  		// else
  		// 	alert('menor indefinido');
  	}

    $("#menu-toggle").click(function(e) {
     	e.preventDefault();
      	$("#wrapper").toggleClass("toggled");
      	setInterval(redimencionar,16);
      	clearInterval(redimencionar);
    });

    function redimencionar(){
    	for(var i in myChart){
    		myChart[i].resize();
    	}
    }

    function agregarFormulario(){
    	formId+=1;
    	$.ajax({
        	url: "{{url('formulario')}}"+"/"+formId,
        	success:function(res){
        		$("#formularioDinamico").append(res);
        		$("#canvasGraficas").append("<div class='bg-light chart-container curvar mb-3' style='min-height=400'><canvas id='myChart"+formId+"' width='400' height='130'></canvas></div>");
        	},
        	error:function(res){
        		$("#formularioDinamico").html('algo anda mal');
        	}
        });
    }

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