<?php 
	if(!isset($_SESSION)){
        session_start();        
    }
	include '../../admin/conex.php';

	$conexion = conectarse_server();			
	date_default_timezone_set('America/Guayaquil');
	$fecha_actual = date('Y-m-d H:i:s', time());
		
	if($_FILES){	
		$file_name = $_FILES['avatar-2']['name'];
	    $file_size = $_FILES['avatar-2']['size'];
	    $file_tmp = $_FILES['avatar-2']['tmp_name'];
	    $file_type = $_FILES['avatar-2']['type'];
	    $file_ext = explode(".", $_FILES['avatar-2']['name']); 
	    $extension = end($file_ext);             
	}

	//error_reporting(0);		

	if (isset($_GET['btn_guardar']) == "btn_guardar") {				
		$resp = "SELECT id FROM clientes WHERE identificacion = '".$_GET['txt_1']."'";		
		$resp = mysql_query($resp,$conexion);		
		if(mysql_num_rows($resp) > 0){
			echo 2;///Identificacion Repetida
		}else{
			$resp_correo = "SELECT id FROM clientes WHERE correo = '".$_GET['txt_7']."'";						
			$resp_correo = mysql_query($resp_correo,$conexion);
			if(mysql_num_rows($resp_correo) > 0){			
				echo 3;///Email Repetido		
			}else{
				if($file_size == 0)
					$img = 'default.png';
				else
					$img = $_GET['txt_1'].'.'.$extension;
				$resp = "INSERT INTO clientes(identificacion,nombres,apellidos,fechaNacimiento,genero,direccion,telefono,celular,referencia,correo,estado,imagen,fechaCreacion) VALUES ('".$_GET['txt_1']."','".$_GET['txt_2']."','".$_GET['txt_3']."','".$_GET['txt_8']."','".$_GET['select_genero']."','".$_GET['txt_4']."','".$_GET['txt_5']."','".$_GET['txt_10']."','".$_GET['txt_6']."','".$_GET['txt_7']."','1','".$img."','".$fecha_actual."');";		
											
				if(mysql_query($resp,$conexion)){
					if($file_size > 0)
						move_uploaded_file($file_tmp,"images/".$img);
					echo 1;	//Cliente Guardado				
				}else{
					echo 4; //Error al guardar cliente
				}					
			}			
		}	
	}				
	if (isset($_GET['btn_modificar']) == "btn_modificar") {					
		$resp = "SELECT id FROM clientes WHERE identificacion = '".$_GET['txt_1']."' AND NOT id = '".$_GET['txt_id']."'";			
		$resp = mysql_query($resp,$conexion);		
		if(mysql_num_rows($resp) > 0){
			echo 2;///username Repetido
		}else{
			$resp_correo = "SELECT id FROM clientes WHERE correo = '".$_GET['txt_7']."' AND NOT id = '".$_GET['txt_id']."'";						
			$resp_correo = mysql_query($resp_correo,$conexion);
			if(mysql_num_rows($resp_correo) > 0){			
				echo 3;///correo repetido		
			}else{
				if($file_size == 0){
					$resp = "UPDATE clientes set identificacion='".$_GET['txt_1']."',nombres='".$_GET['txt_2']."',apellidos='".$_GET['txt_3']."',fechaNacimiento='".$_GET['txt_8']."',genero='".$_GET['select_genero']."',direccion='".$_GET['txt_4']."',telefono='".$_GET['txt_5']."',celular='".$_GET['txt_10']."',referencia='".$_GET['txt_6']."',correo='".$_GET['txt_7']."',fechaCreacion='".$fecha_actual."' WHERE id = '".$_GET['txt_id']."'"; 					
					if(mysql_query($resp,$conexion)){						
						echo 1;	//Usuario Guardado				
					}else{
						echo 4; //Error al actualziar usuario
					}	
				}
				else{
					$img = $_GET['txt_1'].'.'.$extension;
					$resp = "UPDATE clientes set identificacion='".$_GET['txt_1']."',nombres='".$_GET['txt_2']."',apellidos='".$_GET['txt_3']."',fechaNacimiento='".$_GET['txt_8']."',genero='".$_GET['select_genero']."',direccion='".$_GET['txt_4']."',telefono='".$_GET['txt_5']."',celular='".$_GET['txt_10']."',referencia='".$_GET['txt_6']."',correo='".$_GET['txt_7']."',imagen='".$img."',fechaCreacion='".$fecha_actual."' WHERE id = '".$_GET['txt_id']."'"; 			
					if(mysql_query($resp,$conexion)){
						if($file_size > 0)
							move_uploaded_file($file_tmp,"images/".$img);
						echo 1;	//Usuario Guardado				
					}else{
						echo 4; //Error al actualziar usuario
					}							
				}
			}			
		}	
				
	}
?>