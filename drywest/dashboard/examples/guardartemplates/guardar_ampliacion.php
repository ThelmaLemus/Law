<?php
    $fecha_emision = $_POST['fecha_emision'];
    $nombre_notario = $_POST['nombre_notario'];
    $numero_escritura = $_POST['numero_escritura'];
    $fecha_autorizacion = $_POST['fecha_autorizacion'];
    $contenido_escritura = $_POST['contenido_escritura'];
    $nombre_solicitante = $_POST['nombre_solicitante'];
    $tipo_documento = $_POST['tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $ampliacion = $_POST['ampliacion'];
    $usuario = $_POST['usuario'];
    $nombre_archivo = $_POST['nombre_archivo'];

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");

    $query = "INSERT INTO ampliacion(fecha_emision, nombre_notario, numero_escritura, fecha_autorizacion, contenido_escritura, nombre_solicitante, tipo_documento, numero_documento, ampliacion, usuario, nombre_archivo) 
                VALUES ('$fecha_emision', '$nombre_notario', '$numero_escritura', '$fecha_autorizacion', '$contenido_escritura', '$nombre_solicitante', '$tipo_documento', '$numero_documento', '$ampliacion', $usuario, '$nombre_archivo')";
    
    $result = pg_query($link, $query);
    if($result){   
        echo 1;  
    }
    
?>    
    
