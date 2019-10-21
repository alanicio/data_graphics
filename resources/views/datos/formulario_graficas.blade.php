<div class="container-fluid bg-danger curvar p-3 mb-1">
  	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text">Tipo de calibración</label>
		</div>
		<select class="custom-select" id="medicion_type{{$id}}">
		  	<option selected="" value="">Seleccione que calibración quiere ver</option>
		  	<option value="1">Dinamometro</option>
		  	<option value="2">Fisico mecanicas</option>
	  </select>
	</div>
	<div class="input-group mb-3" id="datos{{$id}}" style="display: none;">
		<div class="input-group-prepend">
			<label class="input-group-text">Seleccione dato a graficar</label>
		</div>
		<select class="custom-select" id="datos_type{{$id}}">
		</select>
	</div>
	<div class="input-group mb-3" id="div_graphic_type{{$id}}" style="display: none;">
	  <div class="input-group-prepend">
	    <label class="input-group-text" for="graphic_type{{$id}}">Tipos de graficas</label>
	  </div>
	  <select class="custom-select" id="graphic_type{{$id}}">
	  	<option selected="" value="">Seleccion tipo de grafica...</option>
	    <option value="0">Barras</option>
	    <option value="1">linea</option>
	    <option value="2">circular</option>
	  </select>
	</div>
</div>

      <script type="text/javascript">
		var datas;
		var background;
		var border;
		var centros;
		var medicion;

		$('#datos_type'+'{{$id}}').change(function(){
			var selected=$(this).val();
			if(selected)
			{
				$('#div_graphic_type'+'{{$id}}').show();
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
					var option=$('#graphic_type'+'{{$id}}').val();
					if(option==0)
						return barras();
					else if(option==1)
						return lineas();
					else if(option==2)
						return circulo();
				}
			}
		});

		$('#medicion_type'+'{{$id}}').change(function(){
			var selected=$(this).val();
			medicion=selected;
			if(selected>0)
			{
				$.ajax({
					type:'GET',
					url:"{{url('calibracion')}}"+"/"+selected,
					success:function(res){
						$('#datos'+'{{$id}}').show();
						$('#datos_type'+'{{$id}}').html(res);
					}
				});
			}
			else
			{
				$('#div_graphic_type'+'{{$id}}').hide();
				$('#datos').hide();
				myChart.destroy();
			}
		});

		var myChart;
		$('#graphic_type'+'{{$id}}').change(function(){
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
		var ctx = document.getElementById('myChart'+'{{$id}}').getContext('2d');
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
		myChart=new Chart(document.getElementById('myChart'+'{{$id}}'), {
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
		myChart=new Chart(document.getElementById('myChart'+'{{$id}}'), {
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