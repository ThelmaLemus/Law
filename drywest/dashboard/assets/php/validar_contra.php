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

	$actual=$_POST['actual'];
	$nueva = $_POST['Contra'];
	
	$f1=0;
	$f2=0;
	if(isset($_POST['PChange'])){
		if(!empty($actual)){
			$f1=1;
		}

		if(!empty($nueva)){
			$f2=1;
		}

		if(($f1==1) && ($f2==1)){
			$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

			$query2 = "SELECT * FROM usuarios WHERE '$varsesion' = usuario";
			$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
			$row2 = pg_fetch_row($result2);

			if (!($actual == trim($row2[4]))) {
				pg_free_result($result);
				pg_free_result($result2);
				pg_close($dbconn);
				echo "<script>
               			alert('Contraseña actual incorrecta');
			       		window.location= 'profile.php'
   					</script>";
			}elseif ($nueva == trim($row2[4])) {
				pg_free_result($result);
					pg_free_result($result2);
					pg_close($dbconn);
					echo "<script>
               				alert('No se puede cambiar por la misma contraseña');
			       			window.location= 'profile.php'
   						</script>";
			}else{
				// echo "Contraseña actual: $actual, la nueva: $nueva y la de la DB: $row2[4]";
				$query = "UPDATE usuarios SET contraseña='$nueva' WHERE usuario='$varsesion'";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
				pg_free_result($result);
				pg_free_result($result2);
				pg_close($dbconn);
				echo "<script>
               				alert('Contraseña cambiada exitosamente');
			       			window.location= 'profile.php'
   						</script>";
			}
		}

	}
?>