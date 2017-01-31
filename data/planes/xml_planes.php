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
    $sql = "SELECT  COUNT(*) AS count from planes"; 
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
        $SQL = "SELECT id,nombre FROM planes ORDER BY $sidx $sord limit $limit offset $start";
    } else {
        $campo = $_GET['searchField'];
      
        if ($_GET['searchOper'] == 'eq') {
            $SQL = "SELECT id,nombre FROM planes WHERE $campo = '$_GET[searchString]' ORDER BY $sidx $sord limit $limit offset $start";
        }         
        if ($_GET['searchOper'] == 'cn') {
            $SQL = "SELECT id,nombre FROM planes WHERE $campo like '%$_GET[searchString]%' ORDER BY $sidx $sord limit $limit offset $start";
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
            $s .= "<row id='" . $row->id . "'>";
            $s .= "<cell>" . $row->id . "</cell>";
            $s .= "<cell>" . $row->nombre . "</cell>";                     
            $s .= "</row>";
        }
    $s .= "</rows>";
    echo $s;    
?>