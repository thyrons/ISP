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
		$pass = md5($_GET['txt_6']);					
		$resp = "SELECT id FROM user WHERE userName = '".$_GET['txt_2']."'";
		$resp = mysql_query($resp,$conexion);		
		if(mysql_num_rows($resp) > 0){
			echo 2;///User Name Repetido	
		}else{
			$resp_correo = "SELECT id FROM user WHERE correo = '".$_GET['txt_5']."'";			
			$resp_correo = mysql_query($resp_correo,$conexion);
			if(mysql_num_rows($resp_correo) > 0){			
				echo 3;///Email Repetido		
			}else{
				if($file_size == 0)
					$img = 'default.png';
				else{
					$img = $_GET['txt_2'].'.'.$extension;									
				}
				$resp = "INSERT INTO user(userName,nombreUser,apellidoUser,direccionUser,idCargo,clave,correo,genero,image,fecha) VALUES ('".$_GET['txt_2']."','".$_GET['txt_1']."','".$_GET['txt_4']."','".$_GET['txt_7']."','".$_GET['select_nivel']."','".$pass."','".$_GET['txt_5']."','".$_GET['select_genero']."','".$img."','".$fecha_actual."');";				
				if(mysql_query($resp,$conexion)){
					if($file_size > 0)
						move_uploaded_file($file_tmp,"images/".$img);
					echo 1;	//Usuario Guardado				
				}else{
					echo 4; //Error al guardar usuario
				}			
			}			
		}	
	}				
	if (isset($_GET['btn_modificar']) == "btn_modificar") {					
		$resp = "SELECT id FROM user WHERE userName = '".$_GET['txt_2']."' AND NOT id = '".$_GET['txt_id']."'";			
		$resp = mysql_query($resp,$conexion);		
		if(mysql_num_rows($resp) > 0){
			echo 2;///username Repetido
		}else{
			$resp_correo = "SELECT id FROM user WHERE correo = '".$_GET['txt_5']."' AND NOT id = '".$_GET['txt_id']."'";						
			$resp_correo = mysql_query($resp_correo,$conexion);
			if(mysql_num_rows($resp_correo) > 0){			
				echo 3;///correo repetido		
			}else{
				if($file_size == 0){
					$resp = "UPDATE user set userName='".$_GET['txt_2']."',nombreUser='".$_GET['txt_1']."',apellidoUser='".$_GET['txt_4']."',direccionUser='".$_GET['txt_7']."',idCargo='".$_GET['select_nivel']."',correo='".$_GET['txt_5']."',genero='".$_GET['select_genero']."',fecha='".$fecha_actual."' WHERE id = '".$_GET['txt_id']."'"; 					
					if(mysql_query($resp,$conexion)){						
						echo 1;	//Usuario Guardado				
					}else{
						echo 4; //Error al actualziar usuario
					}	
				}
				else{
					$img = $_GET['txt_2'].'.'.$extension;
					$resp = "UPDATE user set userName='".$_GET['txt_2']."',nombreUser='".$_GET['txt_1']."',apellidoUser='".$_GET['txt_4']."',direccionUser='".$_GET['txt_7']."',idCargo='".$_GET['select_nivel']."',correo='".$_GET['txt_5']."',genero='".$_GET['select_genero']."',image='".$img."',fecha='".$fecha_actual."' WHERE id = '".$_GET['txt_id']."'"; 					
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


	
	
	if (isset($_POST['llenar_nivel'])) {		
		$resultado = "SELECT id, nombre FROM cargo order by id asc";		
		$resultado = mysql_query($resultado,$conexion);
		print'<option value="">&nbsp;</option>';
		while ($row = mysql_fetch_object($resultado))   {
			print '<option value="'.$row->id.'">'.$row->nombre.'</option>';
		}
	}
?>