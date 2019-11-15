<?php
	$imagen=file_get_contents($_FILES["imagen"]["tmp_name"]);

	$escaped = pg_escape_bytea($imagen);

	$f2=0;
	if(isset($_POST['submit'])){
		if(!empty($imagen)){
			$f2=1;
		}

		$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

		$query2 = "SELECT * FROM usuarios WHERE '$varsesion'=usuario";

		$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
		$row=pg_num_rows($result2);
		if($f2==1){
			$query = "UPDATE usuarios SET foto='$escaped' WHERE '$varsesion'=usuario";
			$result = pg_query($query) or die('Query failed: ' . pg_last_error());
			$profile_image = $row[6] == null? "<img alt=\"Image placeholder\" src=\"$added_url\" class=\"rounded-circle\">":"<img alt=\"Image placeholder\" src = \"data:image/jpg;base64,".base64_encode(pg_unescape_bytea($row[6]))."\" class=\"rounded-circle\">";
			echo "<script>alert(\"Cambio de imagen exitoso\")</script>";
		}else{
			echo "<script>alert(\"Algo salió mal, por favor inténtalo de nuevo\")</script>";
		}

		pg_free_result($result);
		pg_close($dbconn);
		echo "<script> window.location = 'profile.php';</script>";
	}
?>