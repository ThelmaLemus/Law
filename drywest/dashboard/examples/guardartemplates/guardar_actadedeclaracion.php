<?php

    $fecha_emision = $_POST['fecha_emision'];
    $nombre_notario = $_POST['nombre_notario'];
    $direccion = $_POST['direccion'];
    $nombre_solicitante = $_POST['nombre_solicitante'];
    $dpi_solicitante = $_POST['dpi_solicitante'];
    $institucion = $_POST['institucion'];
    $solicitud = $_POST['solicitud'];
    $usuario = $_POST['usuario'];

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");

    $query = "INSERT INTO acta_de_declaracion(fecha, nombre_notario, direccion, nombre_solicitante, dpi_solicitante, institucion, solicitud, usuario) 
                VALUES ('$fecha_emision', '$nombre_notario', '$direccion', '$nombre_solicitante', '$dpi_solicitante', '$institucion', '$solicitud', $usuario)";

    $result = pg_query($link, $query);

    if($result){   
        echo 1;  
    }
    else
        echo $result;

?>