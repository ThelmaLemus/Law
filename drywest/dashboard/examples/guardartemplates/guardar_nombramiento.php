<?php
    $nombre_entidad = $_POST['nombre_entidad'];
    $fecha_emision = $_POST['fecha_emision'];
    $nombre_notario = $_POST['nombre_notario'];
    $direccion = $_POST['direccion'];
    $nombre_solicitante = $_POST['nombre_solicitante'];
    $dpi_solicitante = $_POST['dpi_solicitante'];
    $numero_escritura = $_POST['numero_escritura'];
    $notario_escritura = $_POST['notario_escritura'];
    $fecha_autorizacion = $_POST['fecha_autorizacion'];
    $actividades = $_POST['actividades'];
    $numero_acta = $_POST['numero_acta'];
    $fecha_acta = $_POST['fecha_acta'];
    $plazo_enaños = $_POST['plazo_enaños'];
    $usuario = $_POST['usuario'];
    $nombre_archivo = $_POST['nombre_archivo'];
    $pid = $_POST['pid'];

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");

    if($pid == 0)
    {
        $query = "INSERT INTO nombramiento(nombre_entidad, fecha_emision, nombre_notario, direccion, nombre_solicitante, dpi_solicitante, numero_escritura, notario_escritura, fecha_autorizacion, usuario, nombre_archivo, actividades, numero_acta, fecha_acta, plazo_enaños) 
                VALUES ('$nombre_entidad', '$fecha_emision', '$nombre_notario', '$direccion', '$nombre_solicitante', '$dpi_solicitante', '$numero_escritura', '$notario_escritura', '$fecha_autorizacion', $usuario, '$nombre_archivo', '$actividades', '$numero_acta', '$fecha_acta', '$plazo_enaños')";
    }
    else
    {
        $query = "UPDATE nombramiento SET
                    nombre_entidad = '$nombre_entidad',
                    fecha_emision = '$fecha_emision',
                    nombre_notario = '$nombre_notario',
                    direccion = '$direccion',
                    nombre_solicitante = '$nombre_solicitante',
                    dpi_solicitante = '$dpi_solicitante',
                    numero_escritura = '$numero_escritura',
                    notario_escritura = '$notario_escritura',
                    fecha_autorizacion = '$fecha_autorizacion',
                    nombre_archivo = '$nombre_archivo',
                    actividades = '$actividades',
                    numero_acta = '$numero_acta',
                    fecha_acta = '$fecha_acta',
                    plazo_enaños = '$plazo_enaños'
                WHERE pid = $pid";
    }
    
    $result = pg_query($link, $query);
    if($result){   
        echo 1;  
    }
    
?>   