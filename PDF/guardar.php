<?php
    //parametros
    $lid = $_GET["lid"];
    $uid = $_GET["uid"];
    $comentario = $_GET["comentario"];
    $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
    //variables
    $comentario= trim($comentario);
    $create = -1;
    //creacion del comentario
    //hago un select para ver si existe si no lo guardo 
    $query = "SELECT * FROM Comentarios AS C WHERE C.lid=$lid AND C.uid=$uid";
    $result = pg_query($link, $query);
    if(pg_num_rows($result) > 0){
        //ya existe solo actualizamos
        $query = "UPDATE Comentarios SET comentario = '$comentario' WHERE lid='$lid' AND uid='$uid'";
        $result = pg_query($link, $query);
        if($result){   
            $create = 1;
        }
    }else{
        $query = "INSERT INTO Comentarios(lid,uid,comentario) VALUES ($lid,$uid,'$comentario')";
        $result = pg_query($link, $query);
        if($result){   
            $create = 2;   
        }
    }
    echo $create
?>