<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Acuerdos</title>
	<?php include "../style/navbar.php" ?>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<?php 
			$valuetosearch = $_POST['valuetosearch'];
			$valuetosearch = urlencode($valuetosearch);
		?>
		<div class="buto">
			<input type="submit" class="bus1 btn btn-outline-success my-2 my-sm-0" name="nombre" value="Buscar"><br>
			<input type="text" name="valuetosearch" class="bus form-control col-sm-3" placeholder="Búsqueda" value= <?php echo str_replace('+', '&nbsp;', $valuetosearch); ?>><br>
		</div>
		<br><br>
	</form>
<center><a href="Acuerdos.php"><button type="button" class="btn btn-outline-info">Acuerdos</button></a></center><br>
	<div class="contenedor"><br>
		<?php
			$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
			$b=0;
			if(isset($_POST['nombre']))
			{
				$count=0;
				$valuetosearch = $_POST['valuetosearch'];
				$query = "SELECT DISTINCT L.lid, L.nombre, L.categoria, L.contenido FROM leyes L, contenido C WHERE L.lid = C.lid AND L.tipo='A' AND (L.nombre ILIKE '%".$valuetosearch."%' OR L.clave ILIKE '%".$valuetosearch."%' OR C.contenido ILIKE '%".$valuetosearch."%')";
				$b=1;
			}
			else
			{
				$count=0;
				$query = "SELECT * FROM leyes WHERE tipo='A'";
				$b=0;
			}

			$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
			$count = pg_num_rows($result);
			$i= 1;
			$busco = pg_num_rows($result);
			if(($busco==0))
			{
				if ($i==1) {
					echo "No se encontró ningún resultado";
					$i=0;
				}
				pg_close($dbconn);
			}
			else
			{
				// echo "$count";
				$varsesion = $_SESSION['usuario'];
				while ($row = pg_fetch_row($result)) {
					$nombre = $row[1];
					$URL = $row[3];
					$lid2 = $row[0];
					if($count >=3){
						echo"<div class=\"item\">";
					}elseif ($count == 2) {
						echo"<div class=\"item2\">";
					}elseif ($count == 1) {
						echo"<div class=\"item3\">";
					}
					echo"<div class=\'itext'>
								<img src=\"../style/images/ico.png\" width=\"75\" height=\"75\">
								$nombre 
							</div>
							<div class=\"btn-group-toggle  botones\" >";
							$query1 = "SELECT * FROM biblioteca WHERE uid = '$uid' AND lid = '$row[0]'";
							$result1 = pg_query($dbconn, $query1) or die('Query failed: ' . pg_last_error());
							$count3 = pg_num_rows($result1);
							if($count3==1){
								echo" <label class=\"btn fas fa-star\" id= \"21amyChecka$i\">
								    <input type=\"checkbox\" id=\"21myChecka$i\" onClick=\"funcionFavorito('21myChecka$i',$row[0],$uid)\"checked> 
								  </label>";
			 					 }
							else { 
									echo" <label class=\"btn far fa-star\" id= \"21amyChecka$i\">
								    <input type=\"checkbox\" id=\"21myChecka$i\" onClick=\"funcionFavorito('21myChecka$i',$row[0],$uid)\"> 
								  </label>";
							}
							$query2 = "SELECT * FROM ver WHERE uid = '$uid' AND lid = '$row[0]'";
							$result2 = pg_query($dbconn, $query2) or die('Query failed: ' . pg_last_error());
							$count2 = pg_num_rows($result2);
							if($count2==1){
							echo" <label class=\"btn fas fa-clock\" id= \"21amyCheckb$i\">
							    <input type=\"checkbox\" id=\"21myCheckb$i\" onClick=\"funcionVerMasTarde('21myCheckb$i',$row[0],$uid)\" checked>
							    </label>";
							}
							else{
								echo" <label class=\"btn far fa-clock\" id= \"21amyCheckb$i\">
							    <input type=\"checkbox\" id=\"21myCheckb$i\" onClick=\"funcionVerMasTarde('21myCheckb$i',$row[0],$uid)\"> 
							  </label>";
							}
							if($b==0){
							  echo "<a href=\"../PDF/prueba.php?uid=$uid&lid=$lid2&b=$b\"' class='a'><label class=\"btn fas fa-book \"></label></a>";
							} else {
								echo "<a href=\"../PDF/prueba.php?uid=$uid&lid=$lid2&b=$b&search=$valuetosearch\"' class='a'><label class=\"btn fas fa-book \"></label></a>";
							}
							echo "</div>
						</div>";
					$i +=1;
				}
			}
			pg_free_result($result0);
			pg_free_result($result);
			pg_free_result($result2);
			pg_close($dbconn);
		?>
	</div>
	<div class="contenedor2"><br>
		<?php
			$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
			$b=0;
			if(isset($_POST['nombre']))
			{
				$count=0;
				$valuetosearch = $_POST['valuetosearch'];
				$query = "SELECT DISTINCT L.lid, L.nombre, L.categoria, L.contenido FROM leyes L, contenido C WHERE L.lid = C.lid AND L.tipo='A' AND (L.nombre ILIKE '%".$valuetosearch."%' OR L.clave ILIKE '%".$valuetosearch."%' OR C.contenido ILIKE '%".$valuetosearch."%')";
				$b=1;
			}
			else
			{
				$count=0;
				$query = "SELECT * FROM leyes WHERE tipo='A'";
				$b=0;
			}

			$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
			$count = pg_num_rows($result);
			$i= 1;
			$busco = pg_num_rows($result);
			if(($busco==0))
			{
				if ($i==1) {
					echo "No se encontró ningún resultado";
					$i=0;
				}
				pg_close($dbconn);
			}
			else
			{
				// echo "$count";
				$varsesion = $_SESSION['usuario'];
				while ($row = pg_fetch_row($result)) {
					$nombre = $row[1];
					$URL = $row[3];
					$lid2 = $row[0];
					if($count >=2){
						echo"<div class=\"item2\">";
					}elseif ($count == 1) {
						echo"<div class=\"item3\">";
					}
					echo"<div class=\'itext'>
								<img src=\"../style/images/ico.png\" width=\"75\" height=\"75\">
								$nombre 
							</div>
							<div class=\"btn-group-toggle  botones\" >";
							$query1 = "SELECT * FROM biblioteca WHERE uid = '$uid' AND lid = '$row[0]'";
							$result1 = pg_query($dbconn, $query1) or die('Query failed: ' . pg_last_error());
							$count3 = pg_num_rows($result1);
							if($count3==1){
								echo" <label class=\"btn fas fa-star\" id= \"22amyChecka$i\">
								    <input type=\"checkbox\" id=\"22myChecka$i\" onClick=\"funcionFavorito('22myChecka$i',$row[0],$uid)\"checked> 
								  </label>";
			 					 }
							else { 
									echo" <label class=\"btn far fa-star\" id= \"22amyChecka$i\">
								    <input type=\"checkbox\" id=\"22myChecka$i\" onClick=\"funcionFavorito('22myChecka$i',$row[0],$uid)\"> 
								  </label>";
							}
							$query2 = "SELECT * FROM ver WHERE uid = '$uid' AND lid = '$row[0]'";
							$result2 = pg_query($dbconn, $query2) or die('Query failed: ' . pg_last_error());
							$count2 = pg_num_rows($result2);
							if($count2==1){
							echo" <label class=\"btn fas fa-clock\" id= \"22amyCheckb$i\">
							    <input type=\"checkbox\" id=\"22myCheckb$i\" onClick=\"funcionVerMasTarde('22myCheckb$i',$row[0],$uid)\" checked>
							    </label>";
							}
							else{
								echo" <label class=\"btn far fa-clock\" id= \"22amyCheckb$i\">
							    <input type=\"checkbox\" id=\"22myCheckb$i\" onClick=\"funcionVerMasTarde('22myCheckb$i',$row[0],$uid)\"> 
							  </label>";
							}
							if($b==0){
							  echo "<a href=\"../PDF/prueba.php?uid=$uid&lid=$lid2&b=$b\"' class='a'><label class=\"btn fas fa-book \"></label></a>";
							} else {
								echo "<a href=\"../PDF/prueba.php?uid=$uid&lid=$lid2&b=$b&search=$valuetosearch\"' class='a'><label class=\"btn fas fa-book \"></label></a>";
							}
							echo "</div>
						</div>";
					$i +=1;
				}
			}
			pg_free_result($result0);
			pg_free_result($result);
			pg_free_result($result2);
			pg_close($dbconn);
		?>
	</div>
	<div class="contenedor3"><br>
		<?php
			$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
			$b=0;
			if(isset($_POST['nombre']))
			{
				$count=0;
				$valuetosearch = $_POST['valuetosearch'];
				$query = "SELECT DISTINCT L.lid, L.nombre, L.categoria, L.contenido FROM leyes L, contenido C WHERE L.lid = C.lid AND L.tipo='A' AND (L.nombre ILIKE '%".$valuetosearch."%' OR L.clave ILIKE '%".$valuetosearch."%' OR C.contenido ILIKE '%".$valuetosearch."%')";
				$b=1;
			}
			else
			{
				$count=0;
				$query = "SELECT * FROM leyes WHERE tipo='A'";
				$b=0;
			}

			$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
			$count = pg_num_rows($result);
			$i= 1;
			$busco = pg_num_rows($result);
			if(($busco==0))
			{
				if ($i==1) {
					echo "No se encontró ningún resultado";
					$i=0;
				}
				pg_close($dbconn);
			}
			else
			{
				// echo "$count";
				$varsesion = $_SESSION['usuario'];
				while ($row = pg_fetch_row($result)) {
					$nombre = $row[1];
					$URL = $row[3];
					$lid2 = $row[0];
					if($count >=1){
						echo"<div class=\"item3\">";
					}
					echo"<div class=\'itext'>
								<img src=\"../style/images/ico.png\" width=\"75\" height=\"75\">
								$nombre 
							</div>
							<div class=\"btn-group-toggle  botones\" >";
							$query1 = "SELECT * FROM biblioteca WHERE uid = '$uid' AND lid = '$row[0]'";
							$result1 = pg_query($dbconn, $query1) or die('Query failed: ' . pg_last_error());
							$count3 = pg_num_rows($result1);
							if($count3==1){
								echo" <label class=\"btn fas fa-star\" id= \"23amyChecka$i\">
								    <input type=\"checkbox\" id=\"23myChecka$i\" onClick=\"funcionFavorito('23myChecka$i',$row[0],$uid)\"checked> 
								  </label>";
			 					 }
							else { 
									echo" <label class=\"btn far fa-star\" id= \"23amyChecka$i\">
								    <input type=\"checkbox\" id=\"23myChecka$i\" onClick=\"funcionFavorito('23myChecka$i',$row[0],$uid)\"> 
								  </label>";
							}
							$query2 = "SELECT * FROM ver WHERE uid = '$uid' AND lid = '$row[0]'";
							$result2 = pg_query($dbconn, $query2) or die('Query failed: ' . pg_last_error());
							$count2 = pg_num_rows($result2);
							if($count2==1){
							echo" <label class=\"btn fas fa-clock\" id= \"23amyCheckb$i\">
							    <input type=\"checkbox\" id=\"23myCheckb$i\" onClick=\"funcionVerMasTarde('23myCheckb$i',$row[0],$uid)\" checked>
							    </label>";
							}
							else{
								echo" <label class=\"btn far fa-clock\" id= \"23amyCheckb$i\">
							    <input type=\"checkbox\" id=\"23myCheckb$i\" onClick=\"funcionVerMasTarde('23myCheckb$i',$row[0],$uid)\"> 
							  </label>";
							}
							if($b==0){
							  echo "<a href=\"../PDF/prueba.php?uid=$uid&lid=$lid2&b=$b\"' class='a'><label class=\"btn fas fa-book \"></label></a>";
							} else {
								echo "<a href=\"../PDF/prueba.php?uid=$uid&lid=$lid2&b=$b&search=$valuetosearch\"' class='a'><label class=\"btn fas fa-book \"></label></a>";
							}
							echo "</div>
						</div>";
					$i +=1;
				}
			}
			pg_free_result($result0);
			pg_free_result($result);
			pg_free_result($result2);
			pg_close($dbconn);
		?>
	</div>
</body>
</html>