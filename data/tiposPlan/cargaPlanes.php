<?php 
	if(!isset($_SESSION)){
        session_start();        
    }
	include '../../admin/conex.php';
	//error_reporting(0);			
	$conexion = conectarse_server();		

	$resultado = "SELECT id, nombre FROM planes order by id asc";		
	$resultado = mysql_query($resultado,$conexion);
	$response ='<select >';
	while ($row = mysql_fetch_object($resultado))   {
    	$response .= '<option value="'.$row->id.'">'.$row->nombre.'</option>';
	}
	$response .= '</select>';	
	echo $response;	
?>