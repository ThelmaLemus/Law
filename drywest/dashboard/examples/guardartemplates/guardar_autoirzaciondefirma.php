<?php

    $fecha_emision = $_POST['fecha_emision'];
    $nombre_notario = $_POST['nombre_notario'];
    $nombre_solicitante = $_POST['nombre_solicitante'];
    $dpi_solicitante = $_POST['dpi_solicitante'];
    $usuario = $_POST['usuario'];
    $fname = $_POST['nombre_archivo'];
    $pid = $_POST['pid'];

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");

    if($pid == 0)
    {
        $query = "INSERT INTO autenticacion_de_firma(fecha, nombre_notario, nombre_solicitante, dpi, uid, nombre_archivo) 
                VALUES ('$fecha_emision', '$nombre_notario', '$nombre_solicitante', '$dpi_solicitante', $usuario, '$fname')";
    }
    else
    {
        $query = "UPDATE autenticacion_de_firma SET 
                            fecha = '$fecha_emision',
                            nombre_notario = '$nombre_notario',
                            nombre_solicitante = '$nombre_solicitante',
                            dpi = '$dpi_solicitante',
                            uid = $usuario,
                            nombre_archivo = '$fname'
                        WHERE pid = $pid";
    }

    $result = pg_query($link, $query);

    if($result){   
        echo 1;  
    }
    else
        echo $result;

?>