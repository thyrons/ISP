<?php  
	if(!isset($_SESSION)){
	    session_start();        
	}
	include '../admin/conex.php';		
	$conexion = conectarse_server();

	date_default_timezone_set('America/Guayaquil');
	$fecha = date('Y-m-d H:i:s', time());			
	
	$lista = array();
	if(isset($_POST['consultar_login_user'])) {		
		$resultado = "SELECT * FROM user WHERE  userName = '".$_POST['txt_1']."' AND clave =MD5('".$_POST['txt_2']."')";		
		//echo $resultado;
		$resultado = mysql_query($resultado,$conexion);
		if(mysql_num_rows($resultado) == 1) {
			$row = mysql_fetch_object($resultado);			
			$_SESSION['userISP'] = array('id'=>$row->id, 'name' => $row->nombreUser.' '.$row->apellidoUser, 'usuario' => $row->userName, 'email' => $row->correo, 'nivel' => $row->idCargo, 'genero' => $row->genero, 'imagen' => $row->image );

			$sql = "insert into log (idUsuario,comentario,fecha) values ('".$row->id."','Login de Usuario', '".$fecha."')";
			//echo $sql;
			mysql_query($sql,$conexion);

			/*$sql_3 = "SELECT * FROM dbo.acceso WHERE idUsuario = '".$row->idEmpleado."'";
			$sql_3 = mysql_query($conexion_2,$sql_3);		
			while ($row_3 = mysql_fetch_object($sql_3)){
				if($row_3->estado == 'false'){				
					$temp = false;
				}else{
					$temp = true;
				}
				$lista[] = array('nivel' => $row_3->nivel, 'estado' => $temp, );
			}
			$_SESSION['accesos'] = $lista;*/
			print_r(json_encode(array('status' => 'ok', 'privilegio' => $row->idCargo, 'imagen' => $row->image)));			
		}
		else {
			print_r(json_encode(array('status' => 'error', 'problem' => 'Usuario no válido')));
		}	
	} 		
?>


