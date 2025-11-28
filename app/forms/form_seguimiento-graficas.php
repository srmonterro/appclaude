<!-- <script src="../app/js/Chart.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>

<script>


	$(document).ready(function() {


		$.ajax({
			cache: false,
			type: 'POST',
			dataType: 'json',
			url: 'functions/calculaAlumnos.php',
			data: '',
			success: function(datos)
			{
				var ctx = $("#myChart").get(0).getContext("2d");

				var d = new Date();
				var n = d.getFullYear();

				// n = n.getStringValue();
				var j = 0;
				var z = 0.1;


				var datasetValue = [];

				var l = '<ul class="bar-legend" style="list-style:none">';
				for (var i = 2020; i <= parseInt(n); i++) {
					// console.log(i);
					datasetValue[j] = {
						label: i,
						fillColor: "rgba(255,0,0,"+z+")",
						strokeColor: "rgba(255,0,0,"+z+")",
						pointColor: "rgba(255,0,0,"+z+")",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(255,0,0,"+z+")",
						data: datos[i]
					}

					l += '<li style="background-color: '+datasetValue[j].fillColor+'"><span style="color:#fff; margin-left: 1%;">ALUMNOS '+datasetValue[j].label+'</span></li>';

					j++;
					z = z+0.2;
				};

				l += '</ul>';

				$('.legend').html(l);

				console.log(l);

				var data = {
					labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
					datasets: datasetValue
				};

				var myLineChart = new Chart(ctx).Bar(data, {
		        	// Boolean - Whether to show labels on the scale
		        	responsive: true,
		        	scaleOverride : true,
		        	scaleSteps : 10,
		        	scaleStepWidth : 200,
		        	scaleStartValue : 0,
		        	showTooltips : true

		        });


				 var legend = '<ul class="bar-legend" style="list-style:none"><li style="background-color:rgba(204,0,0,0.5)"><span style="color:#fff; margin-left: 1%;">ALUMNOS 2014</span></li><li style="background-color:rgba(92,184,92,0.5)"><span style="color:#fff; margin-left: 1%;">ALUMNOS 2015</span></li><li style="background-color:rgba(91,192,222,0.5)"><span style="color:#fff; margin-left: 1%;">ALUMNOS 2016</span></li></ul>';





				var ctx = $("#myChart2").get(0).getContext("2d");


				var j = 0;
				var z = 0.1;

				var datasetValue = [];
				var l2 = '<ul class="bar-legend" style="list-style:none">';
				for (var i = 2020; i <= parseInt(n); i++) {
					// console.log(i);
					datasetValue[j] = {
						label: i,
						fillColor: "rgba(255,0,0,"+z+")",
						strokeColor: "rgba(255,0,0,"+z+")",
						pointColor: "rgba(255,0,0,"+z+")",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(255,0,0,"+z+")",
						data: datos[i+'1']
					}

					l2 += '<li style="background-color: '+datasetValue[j].fillColor+'"><span style="color:#fff; margin-left: 1%;">MATRÍCULAS '+datasetValue[j].label+'</span></li>';

					j++;
					z = z+0.2;
				};
				l2 += '</ul>';


				var data2 = {
					labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
					datasets: datasetValue
				};

				// console.log(data2);

				var myLineChart = new Chart(ctx).Bar(data2, {
					responsive: true,
					scaleOverride : true,
					scaleSteps : 10,
					scaleStepWidth : 30,
					scaleStartValue : 0
				});

				 var legend2 = '<ul class="bar-legend" style="list-style:none"><li style="background-color:rgba(204,0,0,0.5)"><span style="color:#fff; margin-left: 1%;">MATRICULAS 2014</span></li><li style="background-color:rgba(92,184,92,0.5)"><span style="color:#fff; margin-left: 1%;">MATRICULAS 2015</span></li><li style="background-color:rgba(91,192,222,0.5)"><span style="color:#fff; margin-left: 1%;">MATRICULAS 2016</span></li></ul>';
				$('.legend2').html(l2);




				var ctx = $("#myChart3").get(0).getContext("2d");

				var j = 0;
				var z = 0.1;

				var datasetValue = [];

				var l3 = '<ul class="bar-legend" style="list-style:none">';
				for (var i = 2020; i <= parseInt(n); i++) {
					// console.log(i);
					datasetValue[j] = {
						label: i,
						fillColor: "rgba(255,0,0,"+z+")",
						strokeColor: "rgba(255,0,0,"+z+")",
						pointColor: "rgba(255,0,0,"+z+")",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(255,0,0,"+z+")",
						data: datos[i+'2']
					}

					l3 += '<li style="background-color: '+datasetValue[j].fillColor+'"><span style="color:#fff; margin-left: 1%;">MATRÍCULAS '+datasetValue[j].label+'</span></li>';

					j++;
					z = z+0.2;
				};
				l3 += '</ul>';

				var data3 = {
					labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
					datasets: datasetValue
				};

				var myLineChart = new Chart(ctx).Bar(data3, {
					responsive: true,
					scaleOverride : true,
					scaleSteps : 10,
					scaleStepWidth : 30000,
					scaleStartValue : 0
				});

				 var legend3 = '<ul class="bar-legend" style="list-style:none"><li style="background-color:rgba(204,0,0,0.5)"><span style="color:#fff; margin-left: 1%;">FACTURACION 2014</span></li><li style="background-color:rgba(92,184,92,0.5)"><span style="color:#fff; margin-left: 1%;">FACTURACION 2015</span></li><li style="background-color:rgba(91,192,222,0.5)"><span style="color:#fff; margin-left: 1%;">FACTURACION 2016</span></li></ul>';
				$('.legend3').html(l3);

			}
		}); ajax.abort();

         var ctx = document.getElementById("myChart").getContext("2d");
         var myNewChart = new Chart(ctx).PolarArea(data);



    });

</script>


<style>

	.bar-legend li {
		height: 40px;
	}

	.bar-legend li span {
		padding-left: 5px;
		vertical-align: -webkit-baseline-middle;
		font-weight: bold;
	}

</style>

<div class="container">

	<div class="legend" style="margin-top:5%;"></div>
	<canvas id="myChart" width="auto" height="auto"></canvas>

	<hr style="margin-top: 60px">

	<div class="legend2" style="margin-top:5%;"></div>
	<canvas style="margin-bottom: 50px;" id="myChart2" width="auto" height="auto"></canvas>

	<hr style="margin-top: 60px">

	<div class="legend3" style="margin-top:5%;"></div>
	<canvas style="margin-bottom: 50px;" id="myChart3" width="auto" height="auto"></canvas>

</div>