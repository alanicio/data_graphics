@extends('layouts.general')
@section('content')
	<div style="margin-right: 4%;margin-left: 4%;margin-bottom: 4%;">
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text">Tipo de calibración</label>
			</div>
			<select class="custom-select" id="medicion_type">
			  	<option selected="" value="">Seleccione que calibración quiere ver</option>
			  	<option value="1">Dinamometro</option>
			  	<option value="2">Fisico mecanicas</option>
		  </select>
		</div>
		<div class="input-group mb-3" id="datos" style="display: none;">
			<div class="input-group-prepend">
				<label class="input-group-text">Selecicone dato a graficar</label>
			</div>
			<select class="custom-select" id="datos_type">
			</select>
		</div>
		<div class="input-group mb-3" id="div_graphic_type" style="display: none;">
		  <div class="input-group-prepend">
		    <label class="input-group-text" for="graphic_type">Tipos de graficas</label>
		  </div>
		  <select class="custom-select" id="graphic_type">
		  	<option selected="" value="">Seleccion tipo de grafica...</option>
		    <option value="0">Barras</option>
		    <option value="1">linea</option>
		    <option value="2">circular</option>
		  </select>
		</div>
		<div class="bg-light"><canvas id="myChart" width="400" height="130"></canvas></div>

		<div>
			<div class="row justify-content-center">
				
				<div class="card" style="width: 45%;margin-right: 8%;margin-top: 2%;">
				  <div class="card-body">
				    <h5 class="card-title">Data</h5>
				    <h6 class="card-subtitle mb-2 text-muted">values</h6>
				    <p class="card-text">numbers</p>
				    {{-- <a href="#" class="card-link">Card link</a>
				    <a href="#" class="card-link">Another link</a> --}}
				  </div>
				</div>
				<div class="card" style="width: 45%;margin-top: 2%;">
				  <div class="card-body">
				    <h5 class="card-title">Data title</h5>
				    <h6 class="card-subtitle mb-2 text-muted">Other Data</h6>
				    <p class="card-text">Some datas or someting here.</p>
			{{-- 	    <a href="#" class="card-link">Card link</a>
				    <a href="#" class="card-link">Another link</a> --}}
				  </div>
				</div>
			</div>
		</div>
			
	</div>
	<script type="text/javascript">
		var datas;
		var background;
		var border;
		var centros;
		var medicion;

		$('#datos_type').change(function(){
			var selected=$(this).val();
			if(selected)
			{
				$('#div_graphic_type').show();
				$.ajax({
					type:'POST',
					url:"{{url('graficar')}}",	
					data:{"_token": "{{ csrf_token() }}",tipo:medicion,dato:selected},
					success:function(res){
						datas=res.data;
						background=res.background;
						border=res.border;
						centros=res.centros;
					}
				});
				if (myChart) {
					myChart.destroy();
					var option=$('#graphic_type').val();
					if(option==0)
						return barras();
					else if(option==1)
						return lineas();
					else if(option==2)
						return circulo();
				}
			}
		});

		$('#medicion_type').change(function(){
			var selected=$(this).val();
			medicion=selected;
			if(selected>0)
			{
				//$('#div_graphic_type').show();
				$.ajax({
					type:'GET',
					url:"{{url('calibracion')}}"+"/"+selected,
					success:function(res){
						$('#datos').show();
						$('#datos_type').html(res);
					}
				});
				// if(myChart)
				// {
				// 	myChart.destroy();
				// 	var option=$('#graphic_type').val();
				// 	if(option==0)
				// 		return barras();
				// 	else if(option==1)
				// 		return lineas();
				// 	else if(option==2)
				// 		return circulo();
				// }
				
			}
			else
			{
				$('#div_graphic_type').hide();
				$('#datos').hide();
				myChart.destroy();
			}
		});

		var myChart;
		$(document).ready(function(){
			$('.nav-link dropdown-toggle active').attr('class','nav-link dropdown-toggle')
			$('.nav-link active').attr('class','nav-link');
			$('#Presentación_de_datos').attr('class','nav-link active');
		});
		$('#graphic_type').change(function(){
			if(myChart)
				myChart.destroy();
			var option=$(this).val();
			if(option==0)
				return barras();
			else if(option==1)
				return lineas();
			else if(option==2)
				return circulo();
		});

	function barras(){
		var ctx = document.getElementById('myChart').getContext('2d');
		myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: centros,
		        datasets: [{
		            label: 'lineas',
		            data: datas,
		            backgroundColor: background,
		            borderColor: border,
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

	function lineas(){
		myChart=new Chart(document.getElementById("myChart"), {
		  type: 'line',
		  data: {
		    labels: centros,
		    datasets: [{ 
		        data: datas,
		        label: centros,
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

	function circulo(){
		myChart=new Chart(document.getElementById("myChart"), {
	    type: 'pie',
	    data: {
	      labels:centros,
	      datasets: [{
	        label: "datas",
	        backgroundColor: background,
	        data: datas
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