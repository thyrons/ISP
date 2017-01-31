<?php 
	if(!isset($_SESSION)){
        session_start();        
    }
	include '../../admin/conex.php';
	include '../../admin/ApiMicro/routeros_api.class.php';

	$conexion = conectarse_server();			
	date_default_timezone_set('America/Guayaquil');
	$fecha_actual = date('Y-m-d H:i:s', time());
	///datos rourter 
	$API = new RouterosAPI();    

	$user = "";
	$ip = "";
	$pass = "";
	$port = "";
	$temp = "";

	$ether = array();
	if (isset($_POST['datos_micro']) == "datos_micro") {			
		$sql = "select * from mikrotic"	;
		$sql = mysql_query($sql,$conexion);			
		while ($row = mysql_fetch_object($sql)) {
			$user = $row->user;
			$ip = $row->ip;
			$pass = $row->password;
			$port = $row->puerto;
		}

		if($API->connect($ip,$user,$pass)){			

	    	$API->write('/interface/print');
	    	$READ = $API->read(false);
	    	$resp1 = $API->parseResponse($READ);	    		    		    	
	    	
	    	
	    	$API->disconnect();	
		}		
		echo json_encode($resp1);
	}			

?>