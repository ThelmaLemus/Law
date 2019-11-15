<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Convenios</title>
	<?php include "../style/navbar.php" ?>
</head>
<body>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<?php 
			$valuetosearch = $_POST['valuetosearch'];
			$valuetosearch = urlencode($valuetosearch);
		?>
		<br><br>
	</form>
	<br><br>
	<div class="buto">
		<input type="submit" class="bus1 btn btn-outline-success my-2 my-sm-0" name="search" value="Búsqueda"><br>
		<input type="text" name="valuetosearch" class="bus form-control col-sm-3" placeholder="Búsqueda" value= <?php echo str_replace('+', '&nbsp;', $valuetosearch); ?>><br>
	</div>


	<center>Convenios</center>
	<div class="contenedor"><br>
		<?php
			$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
			$b=0;
			if(isset($_POST['search']))
			{
				$count=0;
				$valuetosearch = $_POST['valuetosearch'];
				$query = "SELECT DISTINCT L.lid, L.nombre, L.categoria, L.contenido FROM leyes L, contenido C WHERE L.lid = C.lid AND L.tipo='C' AND (L.nombre ILIKE '%".$valuetosearch."%' OR L.clave ILIKE '%".$valuetosearch."%' OR C.contenido ILIKE '%".$valuetosearch."%')";
				$b=1;
			}
			else
			{
				$count=0;
				$query = "SELECT * FROM leyes WHERE tipo='C'";
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
				$varsesion = $_SESSION['usuario'];
				while ($row = pg_fetch_row($result)) {
					$nombre = $row[1];
					$URL = $row[3];
					echo"<div class=\"item\">
							<div class=\'itext'>
								<img src=\"../style/images/ico.png\" width=\"75\" height=\"75\">
								$nombre 
							</div>
							<div class=\"btn-group-toggle  botones\" >";
							$query1 = "SELECT * FROM biblioteca WHERE uid = '$uid' AND lid = '$row[0]'";
							$result1 = pg_query($dbconn, $query1) or die('Query failed: ' . pg_last_error());
							$count = pg_num_rows($result1);
							if($count==1){
								echo" <label class=\"btn fas fa-star\" id= \"amyCheck$i\">
								    <input type=\"checkbox\" id=\"myChecka$i\" onClick=\"funcionFavorito('myChecka$i',$row[0],$uid)\"checked> 
								  </label>";
			 					 }
							else { 
									echo" <label class=\"btn far fa-star\" id= \"amyCheck$i\">
								    <input type=\"checkbox\" id=\"myChecka$i\" onClick=\"funcionFavorito('myChecka$i',$row[0],$uid)\"> 
								  </label>";
							}
							$query2 = "SELECT * FROM ver WHERE uid = '$uid' AND lid = '$row[0]'";
							$result2 = pg_query($dbconn, $query2) or die('Query failed: ' . pg_last_error());
							$count2 = pg_num_rows($result2);
							if($count2==1){
							echo" <label class=\"btn fas fa-clock\" id= \"amyCheckc$i\">
							    <input type=\"checkbox\" id=\"myCheckc$i\" onClick=\"funcionVerMasTarde('myCheckc$i',$row[0],$uid)\" checked>
							    </label>";
							}
							else{
								echo" <label class=\"btn far fa-clock\" id= \"amyCheckc$i\">
							    <input type=\"checkbox\" id=\"myCheckc$i\" onClick=\"funcionVerMasTarde('myCheckc$i',$row[0],$uid)\"> 
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
			if(isset($_POST['search']))
			{
				$count=0;
				$valuetosearch = $_POST['valuetosearch'];
				$query = "SELECT DISTINCT L.lid, L.nombre, L.categoria, L.contenido FROM leyes L, contenido C WHERE L.lid = C.lid AND L.tipo='C' AND (L.nombre ILIKE '%".$valuetosearch."%' OR L.clave ILIKE '%".$valuetosearch."%' OR C.contenido ILIKE '%".$valuetosearch."%')";
				$b=1;
			}
			else
			{
				$count=0;
				$query = "SELECT * FROM leyes WHERE tipo='C'";
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
				$varsesion = $_SESSION['usuario'];
				while ($row = pg_fetch_row($result)) {
					$nombre = $row[1];
					$URL = $row[3];
					echo"<div class=\"item2\">
							<div class=\'itext'>
								<img src=\"../style/images/ico.png\" width=\"75\" height=\"75\">
								$nombre 
							</div>
							<div class=\"btn-group-toggle  botones\" >";
							$query1 = "SELECT * FROM biblioteca WHERE uid = '$uid' AND lid = '$row[0]'";
							$result1 = pg_query($dbconn, $query1) or die('Query failed: ' . pg_last_error());
							$count = pg_num_rows($result1);
							if($count==1){
								echo" <label class=\"btn fas fa-star\" id= \"amyCheck$i\">
								    <input type=\"checkbox\" id=\"myChecka$i\" onClick=\"funcionFavorito('myChecka$i',$row[0],$uid)\"checked> 
								  </label>";
			 					 }
							else { 
									echo" <label class=\"btn far fa-star\" id= \"amyCheck$i\">
								    <input type=\"checkbox\" id=\"myChecka$i\" onClick=\"funcionFavorito('myChecka$i',$row[0],$uid)\"> 
								  </label>";
							}
							$query2 = "SELECT * FROM ver WHERE uid = '$uid' AND lid = '$row[0]'";
							$result2 = pg_query($dbconn, $query2) or die('Query failed: ' . pg_last_error());
							$count2 = pg_num_rows($result2);
							if($count2==1){
							echo" <label class=\"btn fas fa-clock\" id= \"amyCheckc$i\">
							    <input type=\"checkbox\" id=\"myCheckc$i\" onClick=\"funcionVerMasTarde('myCheckc$i',$row[0],$uid)\" checked>
							    </label>";
							}
							else{
								echo" <label class=\"btn far fa-clock\" id= \"amyCheckc$i\">
							    <input type=\"checkbox\" id=\"myCheckc$i\" onClick=\"funcionVerMasTarde('myCheckc$i',$row[0],$uid)\"> 
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
			if(isset($_POST['search']))
			{
				$count=0;
				$valuetosearch = $_POST['valuetosearch'];
				$query = "SELECT DISTINCT L.lid, L.nombre, L.categoria, L.contenido FROM leyes L, contenido C WHERE L.lid = C.lid AND L.tipo='C' AND (L.nombre ILIKE '%".$valuetosearch."%' OR L.clave ILIKE '%".$valuetosearch."%' OR C.contenido ILIKE '%".$valuetosearch."%')";
				$b=1;
			}
			else
			{
				$count=0;
				$query = "SELECT * FROM leyes WHERE tipo='C'";
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
				$varsesion = $_SESSION['usuario'];
				while ($row = pg_fetch_row($result)) {
					$nombre = $row[1];
					$URL = $row[3];
					echo"<div class=\"item3\">
							<div class=\'itext'>
								<img src=\"../style/images/ico.png\" width=\"75\" height=\"75\">
								$nombre 
							</div>
							<div class=\"btn-group-toggle  botones\" >";
							$query1 = "SELECT * FROM biblioteca WHERE uid = '$uid' AND lid = '$row[0]'";
							$result1 = pg_query($dbconn, $query1) or die('Query failed: ' . pg_last_error());
							$count = pg_num_rows($result1);
							if($count==1){
								echo" <label class=\"btn fas fa-star\" id= \"amyCheck$i\">
								    <input type=\"checkbox\" id=\"myChecka$i\" onClick=\"funcionFavorito('myChecka$i',$row[0],$uid)\"checked> 
								  </label>";
			 					 }
							else { 
									echo" <label class=\"btn far fa-star\" id= \"amyCheck$i\">
								    <input type=\"checkbox\" id=\"myChecka$i\" onClick=\"funcionFavorito('myChecka$i',$row[0],$uid)\"> 
								  </label>";
							}
							$query2 = "SELECT * FROM ver WHERE uid = '$uid' AND lid = '$row[0]'";
							$result2 = pg_query($dbconn, $query2) or die('Query failed: ' . pg_last_error());
							$count2 = pg_num_rows($result2);
							if($count2==1){
							echo" <label class=\"btn fas fa-clock\" id= \"amyCheckc$i\">
							    <input type=\"checkbox\" id=\"myCheckc$i\" onClick=\"funcionVerMasTarde('myCheckc$i',$row[0],$uid)\" checked>
							    </label>";
							}
							else{
								echo" <label class=\"btn far fa-clock\" id= \"amyCheckc$i\">
							    <input type=\"checkbox\" id=\"myCheckc$i\" onClick=\"funcionVerMasTarde('myCheckc$i',$row[0],$uid)\"> 
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