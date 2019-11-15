<?php
    //parametros
    $lid = $_GET["lid"];
    $uid = $_GET["uid"];
    $comentario = $_GET["comentario"];
    $pagina = $_GET["pagina"];
    $padre = 0;
    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
    //variables
    $comentario= trim($comentario);
    $create = -1;
    //creacion del comentario
    //hago un select para ver si existe si no lo guardo 
    $query = "INSERT INTO Comentarios(lid,uid,comentario,pagina,padre) VALUES ($lid,$uid,'$comentario','$pagina','$padre')";
    $result = pg_query($link, $query);
    if($result){   
        $create = 2;   
    }
    echo $create;
?>