// create the controller and inject Angular's $scope
angular.module('scotchApp').controller('interfacesController', function ($scope, $route) {
	$scope.$route = $route;
	
	jQuery(function($) {	
		$.ajax({
			url: 'data/interfaces/app.php',
			type: 'post',
			dataType: 'json',
			data: {
				datos_micro:'datos_micro'
			},
			success: function(data) {
				$('#tabla_interfaces tbody').empty();
				//console.log(data)
				for(var i = 0; i < data.length; i++){
					if(data[i]['disabled'] == "false")
						temp = "<label style='color: green;font-size: 13px;'>Conectada</label>";
					else
						temp = "<label style='color: red;font-size: 13px;'>Desconectada</label>";
					if(data[i]['running'] == "true")
						temp1 = "<label style='color: green;font-size: 13px;'>Activa</label>";
					else
						temp1 = "<label style='color: red;font-size: 13px;'>Inactiva</label>";
					$('#tabla_interfaces').append("<tr><td>"+data[i]['name']+"</td><td>"+temp+"</td><td>"+temp1+"</td><td>"+data[i]['type']+"</td><td>"+data[i]['max-l2mtu']+"</td></tr>");					
				}				
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				console.error("Status: " + textStatus + " request: " + XMLHttpRequest); console.error("Error: " + errorThrown); 
			}    		
		});
	});
});