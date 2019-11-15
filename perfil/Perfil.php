<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mi perfil</title>
	<?php include "../style/navbar.php" ?>
</head>
<body class="fondoII">
	<span class="top">
		<span class="container">
			<span class="photo">
				<?php
					$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
					$query1 = "SELECT * FROM usuarios WHERE '$varsesion'=usuario";
					$resultado = pg_query($query1) or die('Query failed: ' . pg_last_error());
					while ($row = pg_fetch_row($resultado)) {
						if($row[6] == null){
							echo "<img src = '../style/images/default.png' height=200 width=200><br>";
						} else {
							echo '<img src = "data:image/jpg;base64,'.base64_encode(pg_unescape_bytea($row[6])).'" style=\" height= 200; width= 200; transform:rotate(90deg)\"><br>';
						}
					}

				?>
				<a href="../perfil/cambiarfoto.php"><button type="button" class="btn btn-outline-dark">Editar foto de perfil</button></a>
			</span>
			<br>
			<span class="information">
				<?php
					$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
					$query2 = "SELECT * FROM usuarios WHERE '$varsesion'=usuario";
					$resultado = pg_query($query2) or die('Query failed: ' . pg_last_error());
					$row2 = pg_fetch_row($resultado);
					echo "<div class = \"items\">
								<div>
									Nombre: $row2[1] 
								</div>
								<div>
									Apellido: $row2[2]
								</div>
								<div>
									Usuario: $row2[3]
								</div>
								<div>
									Correo: $row2[5]
								</div>
								<div>
									<a href='../perfil/cambiarcontra.php'>Cambiar contraseña</a>
								</div>
						</div>";
				?>
			</span>	
		</span>
	</span>
	<br>
	<span class="mid">
		<span class="biblio">
			<span class="lmnt">
				<a href="../Biblioteca/Favoritos.php" class="a">Favoritos</a>
				<h4 class="cant">
					<?php
						$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

						$query0 = "SELECT uid FROM usuarios WHERE '$varsesion'=usuario";
						$result0 = pg_query($dbconn, $query0) or die('Query failed: ' . pg_last_error());
						$row0 = pg_fetch_row($result0);

						$query = "SELECT * FROM biblioteca WHERE '$row0[0]'=uid";
						$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());

						$row=pg_num_rows($result);

						echo $row;
		
					?>
				</h4>
			</span>
			<span class="lmnt">
				<a href="../Biblioteca/Ver.php" class="a">Ver más tarde</a>
				<h4 class="cant">
					<?php
						$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

						$query0 = "SELECT uid FROM usuarios WHERE '$varsesion'=usuario";
						$result0 = pg_query($dbconn, $query0) or die('Query failed: ' . pg_last_error());
						$row0 = pg_fetch_row($result0);

						$query = "SELECT * FROM ver WHERE '$row0[0]'=uid";
						$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());

						$row=pg_num_rows($result);

						echo $row;
		
					?>
				</h4>
			</span>
		</span> 
	</span>
</body>
</html>
