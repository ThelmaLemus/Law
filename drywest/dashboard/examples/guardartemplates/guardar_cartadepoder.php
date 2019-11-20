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

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");

    $query = "INSERT INTO carta_de_poder(fecha_emision, nombre_otorgante, nombre_apoderado, responsabilidades, dpi_otorgante, dpi_apoderado, dpi_testigo1, dpi_testigo2, fecha_caducidad, uid) 
                VALUES ('$fecha_emision', '$nombre_otorgante', '$nombre_apoderado', '$responsabilidades', '$DPI_otorgante', '$DPI_apoderado', '$DPI_testigo1', '$DPI_testigo2', '$fecha_caducidad', $usuario)";
    
    $result = pg_query($link, $query);
    if($result){   
        echo 1;  
    }
    
?>