<?php

    $fecha_emision = $_POST['fecha_emision'];
    $nombre_otorgante = $_POST['nombre_otorgante'];
    $nombre_apoderado = $_POST['nombre_apoderado'];
    $responsabilidades = $_POST['responsabilidades'];
    $DPI_otorgante = $_POST['DPI_otorgante'];
    $DPI_apoderado = $_POST['DPI_apoderado'];
    $DPI_testigo1 = $_POST['DPI_testigo1'];
    $DPI_testigo2 = $_POST['DPI_testigo2'];
    $fecha_caducidad = $_POST['fecha_caducidad'];
    $usuario = $_POST['usuario'];
    $pid = $_POST['pid'];
    $nombre_archivo = $_POST['nombre_archivo'];

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");

    if($pid == 0)
    {
        $query = "INSERT INTO carta_de_poder(fecha_emision, nombre_otorgante, nombre_apoderado, responsabilidades, dpi_otorgante, dpi_apoderado, dpi_testigo1, dpi_testigo2, fecha_caducidad, uid, nombre_documento) 
                VALUES ('$fecha_emision', '$nombre_otorgante', '$nombre_apoderado', '$responsabilidades', '$DPI_otorgante', '$DPI_apoderado', '$DPI_testigo1', '$DPI_testigo2', '$fecha_caducidad', $usuario, '$nombre_archivo')";
    }
    else
    {
        $query = "UPDATE carta_de_poder SET
                    fecha_emision = '$fecha_emision',
                    nombre_otorgante = '$nombre_otorgante',
                    nombre_apoderado = '$nombre_apoderado',
                    responsabilidades = '$responsabilidades',
                    dpi_otorgante = '$DPI_otorgante',
                    dpi_apoderado = '$DPI_apoderado',
                    dpi_testigo1 = '$DPI_testigo1',
                    dpi_testigo2 = '$DPI_testigo2',
                    fecha_caducidad = '$fecha_caducidad',
                    uid = $usuario,
                    nombre_documento = '$nombre_archivo'
                WHERE pid = $pid";
    }
    
    $result = pg_query($link, $query);
    if($result){   
        echo 1;  
    }
    
?>