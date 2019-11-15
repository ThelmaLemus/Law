<?php
    //parametros
    $lid = $_GET["lid"];
    $uid = $_GET["uid"];
    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
    //variables
    $retorno = "";
    //buscamos el comentario
    $query = "SELECT C.comentario FROM Comentarios AS C WHERE C.uid=$uid AND C.lid=$lid";
    $result = pg_query($link, $query);
    if($result){   
        $rows = pg_fetch_assoc($result);
        $retorno = $rows["comentario"];
        $retorno=trim($retorno);
    }else{
        $retorno = -1;
    }
    echo $retorno;
?>