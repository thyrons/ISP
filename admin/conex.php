<?php    
    function conectarse_server(){
      $conexion = null;
        try{                        
            $usuario= 'root';
            $pass = 'root';            
            $servidor = '172.0.0.1'; 
            $basedatos = 'ISP';                   
            $conexion = mysql_connect("localhost", "root","root");
            mysql_select_db("ISP",$conexion);

            if( $conexion == false )
                throw new Exception( "Error PostgreSQL ". mysql_errors() );                                 
        }
        catch( Exception $e ){
            throw $e;
        }
        return $conexion;
    }        
?>