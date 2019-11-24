<?php
    $nombre_archivo = $_POST['nombre_archivo'];
    $fecha_emision = $_POST['fecha_emision'];
    $notario_name = $_POST['notario_name'];
    $direccion = $_POST['direccion'];
    $affected_name = $_POST['affected_name'];
    $affected_DPI = $_POST['affected_DPI'];
    $nombre_entidad = $_POST['nombre_entidad'];
    $fecha_emision_actanotarial = $_POST['fecha_emision_actanotarial'];
    $nombre_notario_actanotarial = $_POST['nombre_notario_actanotarial'];
    $empresa_afectada = $_POST['empresa_afectada'];
    $usuario = $_POST['usuario'];

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");

    $query = "INSERT INTO extravio_patente(fecha_emision, notario_name, direccion, affected_name, affected_dpi, nombre_entidad, fecha_emision_actanotarial, nombre_notario_actanotarial, empresa_afectada, usuario, nombre_documento) 
                VALUES ('$fecha_emision', '$notario_name', '$direccion', '$affected_name', '$affected_DPI', '$nombre_entidad', '$fecha_emision_actanotarial', '$nombre_notario_actanotarial', '$empresa_afectada', $usuario, '$nombre_archivo')";
    
    $result = pg_query($link, $query);
    if($result){   
        echo 1;  
    }
    
?>