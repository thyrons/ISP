// create the controller and inject Angular's $scope
angular.module('scotchApp').controller('mainController', function ($scope, $route) {
	$scope.$route = $route;
	
	jQuery(function($) {	
		var chart;		
		function requestDatta(interface) {		
			$.ajax({
				url: 'data/home/app.php',
				type: 'post',
				dataType: 'json',
				data: {
					datos_micro:'datos_micro'
				},
				success: function(data) {
					
					$('#tabla_mikro tbody').empty();
					$('#tabla_mikro').append("<tr><td>Nombre</td><td>"+data[0]['nombre'][0]['name']+"</td></tr>");
					$('#tabla_mikro').append("<tr><td>Version</td><td>"+data[0]['datos'][0]['version']+"</td></tr>");
					$('#tabla_mikro').append("<tr><td>Plataforma</td><td>"+data[0]['datos'][0]['platform']+"</td></tr>");
					$('#tabla_mikro').append("<tr><td>Espacio en el disco</td><td>"+data[0]['datos'][0]['total-hdd-space']+" KiB</td></tr>");
					$('#tabla_mikro').append("<tr><td>Espacio libre</td><td>"+data[0]['datos'][0]['free-hdd-space']+" KiB</td></tr>");
					$('#tabla_mikro').append("<tr><td>Memoria Total</td><td>"+data[0]['datos'][0]['total-memory']+" KiB</td></tr>");
					$('#tabla_mikro').append("<tr><td>Memoria disponible</td><td>"+data[0]['datos'][0]['free-memory']+" KiB</td></tr>");
					$('#tabla_mikro').append("<tr><td>Carga del CPU</td><td>"+data[0]['datos'][0]['cpu-load']+" %</td></tr>");

					//console.log(data)

					var TX=parseFloat(data[0]['resultados'][0].data);
					var RX=parseFloat(data[0]['resultados'][1].data);				
					var x = (new Date()).getTime(); 				
					shift=$('#container').highcharts().series[0].data.length > 19;
					$('#container').highcharts().series[0].addPoint([x, TX], true, shift);
					$('#container').highcharts().series[1].addPoint([x, RX], true, shift);
					document.getElementById("trafico").innerHTML=TX + " / " + RX;
					
					/*}else{
						document.getElementById("trafico").innerHTML="- / -";
					}*/
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
					console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
				}       
			});
		}	
		Highcharts.setOptions({
			global: {
				useUTC: false
			}
		});		
		chart = $('#container').highcharts({
        //chart = new Highcharts.Chart({
			chart: {
	            type: 'line',
	            height: 500,
	            animation: Highcharts.svg,
	            events: {
					load: function () {
						setInterval(function () {
							if(document.getElementById("interface"))
								requestDatta(document.getElementById("interface").value);
						}, 5000);
					}				
				}
	        },
			title: {
	            text: 'Monitor',
	            x: -20 //center
	        },	        
	        xAxis: {
	          	type: 'datetime',
				tickPixelInterval: 150,
				maxZoom: 20 * 1000 
	        },
	        tooltip: {
	            valueSuffix: ' MB'
	        },
	        yAxis: {
	            minPadding: 0.2,
				maxPadding: 0.2,
				title: {
					text: 'Trafico',
					margin: 80
				}
	        },	       	       	        
	        series: [{
                name: 'TX',
                data: []
            }, {
                name: 'RX',
                data: []
            }]
	    });	  	
		
	});
});