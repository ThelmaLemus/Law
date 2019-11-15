<?php
	session_start();
	error_reporting(0);
	$varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion == ''){
		echo "<body class='fondo'>";
		echo "<script>
               	alert('Debe inciar sesión para entrar');
       			window.location= 'index.php'
   			</script>";
	}
?>

<?php
	$imagen=file_get_contents($_FILES["imagen"]["tmp_name"]);

	$escaped = pg_escape_bytea($imagen);

	$f1=0;
	$f2=0;
	$f3=0;
	$f7=0;
	if(isset($_POST['submit'])){
		if(!empty($imagen)){
			$f2=1;
		}

		$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

		$query2 = "SELECT * FROM usuarios WHERE '$varsesion'=usuario";

		$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());

		if($f2==1){
			$query = "UPDATE usuarios SET foto='$escaped' WHERE '$varsesion'=usuario";
			$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		}

		pg_free_result($result);
		pg_close($dbconn);

		header("location:../perfil/Perfil.php");
		}
?>