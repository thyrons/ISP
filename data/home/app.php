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
			$API->write('/system/resource/print');
	    	$READ = $API->read(false);
	    	$resp = $API->parseResponse($READ);

	    	$API->write('/system/identity/print');
	    	$READ = $API->read(false);
	    	$nombre = $API->parseResponse($READ);


	    	$API->write('/interface/print');
	    	$READ = $API->read(false);
	    	$resp1 = $API->parseResponse($READ);	    		    		    	
	    	
	    	for ($i=0; $i < count($resp1); $i++) { 
	    		$ether[] = $resp1[$i]['name'];
	    		$temp = $temp .','.$resp1[$i]['name'];	    			    		
	    	}

	    	$temp = substr($temp, 1);

	    	$API->write("/interface/monitor-traffic",false);
			$API->write("=interface=".$temp,false);
			$API->write("=once=",true);   		    		    	
			$READ = $API->read(false);
	    	$resp2 = $API->parseResponse($READ);	    		    		    	

	    	$upload = 0;
	    	$donwload = 0;
	    	$rx = 0;
	    	$tx = 0;
	    	for ($i=0; $i < count($resp2) ; $i++) { 
	    		$rx = $rx + $resp2[$i]["rx-bits-per-second"];
				$tx = $tx + $resp2[$i]["tx-bits-per-second"];					    		
	    	}
	    	$rx = number_format($rx / 1024 / 1024, 2, '.', '');	;
	    	$tx = number_format($tx / 1024 / 1024, 2, '.', '');	;
	    	$rows['name'] = 'Tx';
			$rows['data'][] = $tx;
			$rows2['name'] = 'Rx';
			$rows2['data'][] = $rx;
			$result = array();
			array_push($result,$rows);
			array_push($result,$rows2);				    	
	    	$API->disconnect();	
		}
		$lista[] = array('datos' => $resp, 'nombre' => $nombre, 'resultados' => $result);
		echo json_encode($lista);
	}			

?>