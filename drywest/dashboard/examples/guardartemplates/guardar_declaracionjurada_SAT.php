<?php
    $fecha_emision = $_POST['fecha_emision'];
    $notario_name = $_POST['notario_name'];
    $direccion = $_POST['direccion'];
    $affected_name = $_POST['affected_name'];
    $affected_DPI = $_POST['affected_DPI'];
    $affected_NIT = $_POST['affected_NIT'];
    $nombre_entidad = $_POST['nombre_entidad'];
    $nit_entidad = $_POST['nit_entidad'];
    $direccion_entidad = $_POST['direccion_entidad'];
    $departament_entidad = $_POST['departament_entidad'];
    $municipio_entidad = $_POST['municipio_entidad'];
    $cantidad_del_pago = $_POST['cantidad_del_pago'];
    $fecha_del_pago = $_POST['fecha_del_pago'];
    $numero_formulario_SAT = $_POST['numero_formulario_SAT'];
    $usuario = $_POST['usuario'];
    $nombre_archivo = $_POST['nombre_archivo'];

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");

    $query = "INSERT INTO declaracionjurada_sat(fecha_emision, notario_name, direccion, affected_name, affected_dpi, affected_nit, nombre_entidad, nit_entidad, direccion_entidad, departament_entidad, municipio_entidad, cantidad_del_pago, fecha_del_pago, numero_formulario_sat, usuario, nombre_archivo) 
                VALUES ('$fecha_emision', '$notario_name', '$direccion', '$affected_name', '$affected_DPI', '$affected_NIT', '$nombre_entidad', '$nit_entidad', '$direccion_entidad', '$departament_entidad', '$municipio_entidad', '$cantidad_del_pago', '$fecha_del_pago', '$numero_formulario_SAT', $usuario, '$nombre_archivo')";
    
    $result = pg_query($link, $query);
    if($result){   
        echo 1;  
    }
    
?>