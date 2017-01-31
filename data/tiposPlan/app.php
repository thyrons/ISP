<?php 
	if(!isset($_SESSION)){
        session_start();        
    }
	include '../../admin/conex.php';

	$conexion = conectarse_server();			
	date_default_timezone_set('America/Guayaquil');
	$fecha_actual = date('Y-m-d H:i:s', time());		
	

	if ($_POST['oper'] == "add") {		
		$sql = "INSERT INTO tiposplan (idPlan,RX,TX,precio,instalacion,adicional,estado) VALUES ('".$_POST['nombrePlan']."','".$_POST['rx']."','".$_POST['tx']."','".$_POST['precio']."','".$_POST['instalacion']."','".$_POST['adicional']."','".$_POST['est']."');";	
		
		if(mysql_query($sql,$conexion)){
			$data = "1";	
		}else{
			$data = "4";
		}			
		
	} else {
	    if ($_POST['oper'] == "edit") {	    
			$sql = "UPDATE tiposplan set idPlan='".$_POST['nombrePlan']."',RX='".$_POST['rx']."',TX='".$_POST['tx']."',precio='".$_POST['precio']."',instalacion='".$_POST['instalacion']."',adicional='".$_POST['adicional']."',estado='".$_POST['est']."' WHERE id = '".$_POST['id']."'";			
			if($sql = mysql_query($sql,$conexion)){
				$data = "2";	
			}else{
				$data = "4";
			}	    					
	    }
	}    
	echo $data;
?>