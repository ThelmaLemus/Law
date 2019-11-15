<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!--<link rel="stylesheet" href="estilo.css"> -->
	<!-- <script src="http://code.jquery.com/jquery-latest.js"></script> -->
	<script src="header.js"></script>
</head>
	<body class="fondo">

			<?php

				if (isset($_POST["Ingresar"])){
					$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

					$usuario=$_POST['usuario'];
					$contraseña=$_POST['contraseña'];

					session_start();
					$_SESSION['usuario'] = $usuario;

					$f1=0;
					$f2=0;

					if(!empty($usuario)){
							$f1=1;
					} else {
						pg_close($dbconn);
						echo "<body class='fondo'>";
						echo "<script>
               				alert('Debe llenar el campo de usuario');
               				window.location= 'index.php'
   							</script>";
					}
					if(!empty($contraseña)){
						$f2=1;
					} else {
						pg_close($dbconn);
						echo "<body class='fondo'>";
						echo "<script>
               				alert('Debe llenar el campo de contraseña');
           					window.location= 'index.php'
    						</script>";
					}

					if(($f1==1)&&($f2==1)){
						$query = "SELECT * FROM usuarios WHERE '$usuario'=usuario AND '$contraseña'=contraseña";
						$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());

						$rows = pg_num_rows($result);

						if($rows>0){
							pg_free_result($result);
							pg_close($dbconn);
							header("location:Inicio/Inicio.php");
						} else {
							pg_free_result($result);
							pg_close($dbconn);
							echo "<body class='fondo'>";
							echo "<script>
               					alert('Usuario y/o contraseña incorrecta');
               					window.location= 'index.php'
    							</script>";
					    			
						}
					}
				}
				else if (isset($_POST["Registrar"])){

					$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

					$nombre=$_POST["Nombre"];
					$apellido=$_POST["Apellido"];
					$correo=$_POST["Correo"];
					$contraseña=$_POST["Contra"];
					$usuario=$_POST["Usuario"];

					$f0 = 0;
					$f1 = 0;
					$f2 = 0;
					$f3 = 0;
					$f4 = 0;
					$f5 = 0;
					$f6 = 0;

					if(!empty($nombre)){
						$f0=1;
					} else {
						pg_close($dbconn);
						echo "<body class='fondo'>";
						echo "<script>
                			alert('Debe llenar el campo Nombre');
							window.location= 'index.php'
    						</script>";
					}
					if(!empty($apellido)){
						$f1=1;
					} else {
						pg_close($dbconn);
						echo "<body class='fondo'>";
						echo "<script>
                			alert('Debe llenar el campo apellido');
							window.location= 'index.php'
    						</script>";
					}
					if(!empty($correo)){
						$f2=1;
					} else {
						pg_close($dbconn);
						echo "<body class='fondo'>";
						echo "<script>
                			alert('Debe llenar el campo correo');
							window.location= 'index.php'
    						</script>";
					}
					if(!empty($contraseña)){
						$f3=1;
					} else {
						pg_close($dbconn);
						echo "<body class='fondo'>";
						echo "<script>
                			alert('Debe llenar el campo contraseña');
							window.location= 'index.php'
    						</script>";
					}
					if(!empty($usuario)){
						$f4=1;
					} else {
						pg_close($dbconn);
						echo "<body class='fondo'>";
						echo "<script>
                			alert('Debe llenar el campo usuario');
							window.location= 'index.php'
    						</script>";
					}

					if(($f0==1)&&($f1==1)&&($f2==1)&&($f3==1)&&($f4==1)){
					
						$query1 = "SELECT * FROM usuarios WHERE usuario='$usuario'";
						$result1 = pg_query($dbconn, $query1) or die('Query failed: ' . pg_last_error());

						$rows1 = pg_num_rows($result1);

						if($rows1>0){
							echo "<body class='fondo'>";
							echo "<script>
    	           				alert('Usuario ya existente, intenta con uno diferente');
        	   					window.location= 'index.php'
    							</script>";
						} else {
							$f5=1;
						} 

						$query2 = "SELECT * FROM usuarios WHERE correo='$correo'";
						$result2 = pg_query($dbconn, $query2) or die('Query failed: ' . pg_last_error());

						$rows2 = pg_num_rows($result2);

						if($rows2>0){
							echo "<body class='fondo'>";
							echo "<script>
               					alert('Este correo ya está registrado');
           						window.location= 'index.php'
	    						</script>";
						} else {
							$f6=1;
						}

						if(($f5==1)&&($f6==1)){
							$query = "INSERT INTO usuarios(nombre, apellido, correo, usuario, contraseña) VALUES ( '$nombre', '$apellido','$correo', '$usuario', '$contraseña')";
							$result = pg_query($query) or die('Query failed: ' . pg_last_error());
							pg_free_result($result);
							pg_close($dbconn);
							echo "<body class='fondo'>";
							echo "<script>
               					alert('Ya está registrado. Inicie sesión para empezar.');
           						window.location= 'index.php'
	    						</script>";
						}
					}
				}

			?>

	</body>
</html>