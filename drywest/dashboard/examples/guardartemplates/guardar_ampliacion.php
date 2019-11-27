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
    $pid = $_POST['pid'];

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
    
    if($pid == 0)
    {
        $query = "INSERT INTO ampliacion(fecha_emision, nombre_notario, numero_escritura, fecha_autorizacion, contenido_escritura, nombre_solicitante, tipo_documento, numero_documento, ampliacion, usuario, nombre_archivo) 
                VALUES ('$fecha_emision', '$nombre_notario', '$numero_escritura', '$fecha_autorizacion', '$contenido_escritura', '$nombre_solicitante', '$tipo_documento', '$numero_documento', '$ampliacion', $usuario, '$nombre_archivo')";
    }
    else
    {
        $query = "UPDATE ampliacion SET
                    fecha_emision = '$fecha_emision',
                    nombre_notario = '$nombre_notario',
                    numero_escritura = '$numero_escritura',
                    fecha_autorizacion = '$fecha_autorizacion',
                    contenido_escritura = '$contenido_escritura',
                    nombre_solicitante = '$nombre_solicitante',
                    tipo_documento = '$tipo_documento',
                    numero_documento = '$numero_documento',
                    ampliacion = '$ampliacion',
                    nombre_archivo = '$nombre_archivo'
                WHERE pid = $pid";
    }

    $result = pg_query($link, $query);

    $query1 = "SELECT pid FROM ampliacion WHERE
    fecha_emision = '$fecha_emision' AND
    nombre_notario = '$nombre_notario' AND
    numero_escritura = '$numero_escritura' AND
    fecha_autorizacion = '$fecha_autorizacion' AND
    contenido_escritura = '$contenido_escritura' AND
    nombre_solicitante = '$nombre_solicitante' AND
    tipo_documento = '$tipo_documento' AND
    numero_documento = '$numero_documento' AND
    ampliacion = '$ampliacion' AND
    nombre_archivo = '$nombre_archivo'";

    $result1 = pg_query($link, $query1);
    $fila = pg_fetch_row($result1);
    $pid_resultante = $fila[0];

    if($result && $result1){   
        echo $pid_resultante;
    }
    
?>    
    
