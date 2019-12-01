<?php
    //parametros
    $tid = $_POST["tid"];
    $comentario = $_POST["comentario"];
    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
    //variables
    $comentario= trim($comentario);
    echo "<script> console.log(EL COMENTARIO : ".$comentario."); </script>";
    $create = -1;
    //creacion del comentario
    //hago un select para ver si existe si no lo guardo 
    $query = "INSERT INTO comentarios_tramites(tid,comentario) VALUES ($tid,'$comentario')";
    $result = pg_query($link, $query);
    if($result){   
        $create = 1;   
    }
    echo $create;
?>