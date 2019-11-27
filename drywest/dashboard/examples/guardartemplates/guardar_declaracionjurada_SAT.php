<?php
    $fecha_emision = $_POST['fecha_emision'];
    $notario_name = $_POST['notario_name'];
    $direccion = $_POST['direccion'];
    $affected_name = $_POST['affected_name'];
    $affected_DPI = $_POST['affected_DPI'];
    $affected_NIT = $_POST['affected_NIT'];
    $nombre_entidad = $_POST['nombre_entidad'];
    $nit_entidad = $_POST['nit_entidad'];
    $direccion_entidad = $_POST['direccion_entidad'];
    $departament_entidad = $_POST['departament_entidad'];
    $municipio_entidad = $_POST['municipio_entidad'];
    $cantidad_del_pago = $_POST['cantidad_del_pago'];
    $fecha_del_pago = $_POST['fecha_del_pago'];
    $numero_formulario_SAT = $_POST['numero_formulario_SAT'];
    $usuario = $_POST['usuario'];
    $nombre_archivo = $_POST['nombre_archivo'];
    $pid = $_POST['pid'];

    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");

    if($pid == 0)
    {
        $query = "INSERT INTO declaracionjurada_sat(fecha_emision, notario_name, direccion, affected_name, affected_dpi, affected_nit, nombre_entidad, nit_entidad, direccion_entidad, departament_entidad, municipio_entidad, cantidad_del_pago, fecha_del_pago, numero_formulario_sat, usuario, nombre_archivo) 
                VALUES ('$fecha_emision', '$notario_name', '$direccion', '$affected_name', '$affected_DPI', '$affected_NIT', '$nombre_entidad', '$nit_entidad', '$direccion_entidad', '$departament_entidad', '$municipio_entidad', '$cantidad_del_pago', '$fecha_del_pago', '$numero_formulario_SAT', $usuario, '$nombre_archivo')";
    }
    else
    {
        $query = "UPDATE declaracionjurada_sat SET
                    fecha_emision = '$fecha_emision',
                    notario_name = '$notario_name',
                    direccion = '$direccion',
                    affected_name = '$affected_name',
                    affected_dpi = '$affected_DPI',
                    affected_nit = '$affected_NIT',
                    nombre_entidad = '$nombre_entidad',
                    nit_entidad = '$nit_entidad',
                    direccion_entidad = '$direccion_entidad',
                    departament_entidad = '$departament_entidad',
                    municipio_entidad = '$municipio_entidad',
                    cantidad_del_pago = '$cantidad_del_pago',
                    fecha_del_pago = '$fecha_del_pago',
                    numero_formulario_sat = '$numero_formulario_SAT',
                    nombre_archivo = '$nombre_archivo'
                WHERE pid = $pid";
    }

    $result = pg_query($link, $query);

    $query1 = "SELECT pid FROM declaracionjurada_sat WHERE
    fecha_emision = '$fecha_emision' AND
    notario_name = '$notario_name' AND
    direccion = '$direccion' AND
    affected_name = '$affected_name' AND
    affected_dpi = '$affected_DPI' AND
    affected_nit = '$affected_NIT' AND
    nombre_entidad = '$nombre_entidad' AND
    nit_entidad = '$nit_entidad' AND
    direccion_entidad = '$direccion_entidad' AND
    departament_entidad = '$departament_entidad' AND
    municipio_entidad = '$municipio_entidad' AND
    cantidad_del_pago = '$cantidad_del_pago' AND
    fecha_del_pago = '$fecha_del_pago' AND
    numero_formulario_sat = '$numero_formulario_SAT' AND
    nombre_archivo = '$nombre_archivo'";

    $result1 = pg_query($link, $query1);
    $fila = pg_fetch_row($result1);
    $pid_resultante = $fila[0];

    if($result && $result1){   
        echo $pid_resultante;
    }
    
?>