<?php
   if(!isset($_SESSION)){
        session_start();        
    }
    include '../../admin/conex.php';

    $conexion = conectarse_server();        

    $page = $_GET['page'];
    $limit = $_GET['rows'];
    $sidx = $_GET['sidx'];
    $sord = $_GET['sord'];
    $search = $_GET['_search'];
    if (!$sidx)
        $sidx = 1;
    
    $count = 0;
    $sql = "SELECT  COUNT(*) AS count from tiposplan"; 
    $sql = mysql_query($sql,$conexion);    
    while ($row = mysql_fetch_object($sql)) {
        $count = $count + $row->count;    
    }    
    if ($count > 0 && $limit > 0) {
        $total_pages = ceil($count / $limit);
    } else {
        $total_pages = 0;
    }
    if ($page > $total_pages)
        $page = $total_pages;
    $start = $limit * $page - $limit;
    if ($start < 0)
        $start = 0;
    
    if ($search == 'false') {
        $SQL = "select P.id, P.nombre,TP.id AS planId,TP.RX,TP.TX,TP.precio,TP.instalacion,TP.adicional,TP.estado from planes P inner join tiposplan TP on P.id = TP.idPlan ORDER BY $sidx $sord limit $limit offset $start";
    } else {
        $campo = $_GET['searchField'];
      
        if ($_GET['searchOper'] == 'eq') {
            $SQL = "select P.id, P.nombre,TP.id AS planId,TP.RX,TP.TX,TP.precio,TP.instalacion,TP.adicional,TP.estado from planes P inner join tiposplan TP on P.id = TP.idPlan WHERE $campo = '$_GET[searchString]' ORDER BY $sidx $sord limit $limit offset $start";
        }         
        if ($_GET['searchOper'] == 'cn') {
            $SQL = "select P.id, P.nombre,TP.id AS planId,TP.RX,TP.TX,TP.precio,TP.instalacion,TP.adicional,TP.estado from planes P inner join tiposplan TP on P.id = TP.idPlan WHERE $campo like '%$_GET[searchString]%' ORDER BY $sidx $sord limit $limit offset $start";
        }
    }  

    //echo $SQL;
    $SQL = mysql_query($SQL,$conexion);            
    $ss ='';
    
    header("Content-Type: text/html;charset=utf-8");   
    $s = "<?xml version='1.0' encoding='utf-8'?>";
    $s .= "<rows>";
        $s .= "<page>" . $page . "</page>";
        $s .= "<total>" . $total_pages . "</total>";
        $s .= "<records>" . $count . "</records>";
        while ($row = mysql_fetch_object($SQL)) {
            $s .= "<row id='" . $row->planId . "'>";
            $s .= "<cell>" . $row->planId . "</cell>";
            $s .= "<cell>" . $row->nombre . "</cell>";
            $s .= "<cell>" . $row->id . "</cell>";                     
            $s .= "<cell>" . $row->RX . "</cell>";                     
            $s .= "<cell>" . $row->TX . "</cell>";                     
            $s .= "<cell>" . $row->precio . "</cell>";                     
            $s .= "<cell>" . $row->instalacion . "</cell>";                     
            $s .= "<cell>" . $row->adicional . "</cell>";                     
            $s .= "<cell>" . $row->estado . "</cell>";
            if($row->estado == '1')
                $s .= "<cell>" . 'Activo' . "</cell>";
            else
                $s .= "<cell>" . 'Desactivado' . "</cell>";
            $s .= "</row>";
        }
    $s .= "</rows>";
    echo $s;    
?>