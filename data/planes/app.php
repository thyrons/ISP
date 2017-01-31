<?php 
	if(!isset($_SESSION)){
        session_start();        
    }
	include '../../admin/conex.php';

	$conexion = conectarse_server();			
	date_default_timezone_set('America/Guayaquil');
	$fecha_actual = date('Y-m-d H:i:s', time());		
	

	if ($_POST['oper'] == "add") {
		$sql = "SELECT count(*)count FROM planes WHERE nombre = UPPER('".$_POST['nivel']."')";
		$sql = mysql_query($sql,$conexion);		
		while ($row = mysql_fetch_object($sql))   {							
			$data = $row->count;
		}
		if ($data != 0) {
			$data = "3";
		} else {
			$sql = "INSERT INTO planes (nombre,estado) VALUES ('".$_POST['nivel']."','1');";			
			if(mysql_query($sql,$conexion)){
				$data = "1";	
			}else{
				$data = "4";
			}
			
		}
	} else {
	    if ($_POST['oper'] == "edit") {
	    	$sql = "SELECT count(*)count FROM planes WHERE nombre = UPPER('".$_POST['nivel']."') AND id NOT IN ('".$_POST['id']."')";	

	    	$sql = mysql_query($sql,$conexion);		
			while ($row = mysql_fetch_object($sql))   {		
				$data = $row->count;
			}

			if ($data != 0) {
			 	$data = "3";
			} else {		
				$sql = "UPDATE planes SET nombre = '".$_POST['nivel']."' WHERE id = '".$_POST['id']."'";
				if($sql = mysql_query($sql,$conexion)){
					$data = "2";	
				}else{
					$data = "4";
				}	    		
			}
	    }
	}    
	echo $data;
?>