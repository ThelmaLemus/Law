<?php

    $fecha_emision = $_POST['fecha_emision'];
    $nombre_notario = $_POST['nombre_notario'];
    $direccion = $_POST['direccion'];
    $nombre_solicitante = $_POST['nombre_solicitante'];
    $dpi_solicitante = $_POST['dpi_solicitante'];
    $institucion = $_POST['institucion'];
    $solicitud = $_POST['solicitud'];
    $usuario = $_POST['usuario'];
    $pid = $_POST['pid'];
    $nombre_archivo = $_POST['nombre_archivo'];

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
    
    if($pid == 0)
    {
        $query = "INSERT INTO acta_de_declaracion(fecha, nombre_notario, direccion, nombre_solicitante, dpi_solicitante, institucion, solicitud, usuario, nombre_plantilla) 
                VALUES ('$fecha_emision', '$nombre_notario', '$direccion', '$nombre_solicitante', '$dpi_solicitante', '$institucion', '$solicitud', $usuario, '$nombre_archivo')";
    }
    else
    {
        $query = "UPDATE acta_de_declaracion SET
                    fecha = '$fecha_emision',
                    nombre_notario = '$nombre_notario',
                    direccion = '$direccion',
                    nombre_solicitante = '$nombre_solicitante',
                    dpi_solicitante = '$dpi_solicitante',
                    institucion = '$institucion',
                    solicitud = '$solicitud',
                    usuario = $usuario,
                    nombre_plantilla = '$nombre_archivo'
                WHERE pid = $pid";
    }

    $result = pg_query($link, $query);

    if($result){   
        echo 1;  
    }
    else
        echo $result;

?>