@extends('blueprints.general_graphics')
@section('charts')
<canvas id="myChart" width="400" height="130"></canvas>
<script>
new Chart(document.getElementById("myChart"), {
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

</script>
@endsection