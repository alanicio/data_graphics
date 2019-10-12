@extends('layouts.general')
@section('content')
	<div style="margin-right: 4%;margin-left: 4%;margin-bottom: 4%;">
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <label class="input-group-text" for="inputGroupSelect01">Tipos de graficas</label>
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
		        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
		        datasets: [{
		            label: 'datas',
		            data: [12, 19, 3, 5, 2, 3],
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255, 99, 132, 1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
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
		    labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
		    datasets: [{ 
		        data: [860,1140,1046,1060,1070,1010,1130,1210,783,2478],
		        label: "data1",
		        borderColor: "#3e95cd",
		        fill: false
		      }, { 
		        data: [2823,350,411,502,635,809,947,1402,3700,5267],
		        label: "data2",
		        borderColor: "#8e5ea2",
		        fill: false
		      }, { 
		        data: [1689,170,178,190,203,276,408,547,675,734],
		        label: "data3",
		        borderColor: "#3cba9f",
		        fill: false
		      }, { 
		        data: [400,200,108,165,24,38,74,167,508,784],
		        label: "data4",
		        borderColor: "#e8c3b9",
		        fill: false
		      }, { 
		        data: [6,3,2,2,7,26,82,172,312,433],
		        label: "data5",
		        borderColor: "#c45850",
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
	      labels: ["data1", "data2", "data3", "data4", "data5"],
	      datasets: [{
	        label: "datas",
	        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
	        data: [2478,5267,734,784,433]
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