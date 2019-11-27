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
    $pid = $_POST['pid'];

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");

    if($pid == 0)
    {
        $query = "INSERT INTO extravio_patente(fecha_emision, notario_name, direccion, affected_name, affected_dpi, nombre_entidad, fecha_emision_actanotarial, nombre_notario_actanotarial, empresa_afectada, usuario, nombre_documento) 
                VALUES ('$fecha_emision', '$notario_name', '$direccion', '$affected_name', '$affected_DPI', '$nombre_entidad', '$fecha_emision_actanotarial', '$nombre_notario_actanotarial', '$empresa_afectada', $usuario, '$nombre_archivo')";
    }
    else
    {
        $query = "UPDATE extravio_patente SET
                    fecha_emision = '$fecha_emision',
                    notario_name = '$notario_name',
                    direccion = '$direccion',
                    affected_name = '$affected_name',
                    affected_dpi = '$affected_DPI',
                    nombre_entidad = '$nombre_entidad',
                    fecha_emision_actanotarial = '$fecha_emision_actanotarial',
                    nombre_notario_actanotarial = '$nombre_notario_actanotarial',
                    empresa_afectada = '$empresa_afectada',
                    nombre_documento = '$nombre_archivo'
                WHERE pid = $pid";
    }
    
    $result = pg_query($link, $query);

    $query1 = "SELECT pid FROM extravio_patente WHERE
    fecha_emision = '$fecha_emision',
    notario_name = '$notario_name',
    direccion = '$direccion',
    affected_name = '$affected_name',
    affected_dpi = '$affected_DPI',
    nombre_entidad = '$nombre_entidad',
    fecha_emision_actanotarial = '$fecha_emision_actanotarial',
    nombre_notario_actanotarial = '$nombre_notario_actanotarial',
    empresa_afectada = '$empresa_afectada',
    nombre_documento = '$nombre_archivo'";

    $result1 = pg_query($link, $query1);
    $fila = pg_fetch_row($result1);
    $pid_resultante = $fila[0];

    if($result && $result1){   
        echo $pid_resultante;
    }
    
?>