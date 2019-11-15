<?php
	$uid = $_GET['uid'];
	$lid = $_GET['lid'];
	$myURL = $_SERVER['PHP_SELF']."?uid=".$uid."&lid=".$lid;
	$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
	$dbconn = $link or die('Could not connect: ' . pg_last_error());
	if(isset($_POST['nombre']))
	{
		echo "$lid";
		$valuetosearch = $_POST['valuetosearch'];
		$valuetosearch = urlencode($valuetosearch);
		// $valuetosearch=trim($valuetosearch);
		$queryi = "SELECT DISTINCT pagina FROM contenido WHERE lid='$lid' AND contenido ILIKE '%".$valuetosearch."%' ORDER BY pagina";
		$resulti = pg_query($dbconn, $queryi) or die('Query failedd: ' . pg_last_error());
		$rw= pg_fetch_row($resulti);
		$pa= $rw[0];
		header("Location: ../PDF/prueba.php?uid=$uid&lid=$lid&b=11&search=$valuetosearch&p=$pa");
	}else{	
		$f=$_GET['b'];
		if ($f==1) {
			$valuetosearch=$_GET['search'];	
			$val = urlencode($valuetosearch);
			$queryo = "SELECT DISTINCT pagina FROM contenido WHERE lid='$lid' AND contenido ILIKE '%".$valuetosearch."%' ORDER BY pagina";
			$resulto = pg_query($dbconn, $queryo) or die('Query failedd: ' . pg_last_error());	
			$rowo1 = pg_fetch_row($resulto);
			$page=$rowo1[0];
		}elseif ($f==11) {
			$valuetosearch=$_GET['search'];
			$val = urlencode($valuetosearch);
			$queryo = "SELECT DISTINCT pagina FROM contenido WHERE lid='$lid' AND contenido ILIKE '%".$valuetosearch."%' ORDER BY pagina";
			$resulto = pg_query($dbconn, $queryo) or die('Query failedd: ' . pg_last_error());
			$f2=$_GET['p'];
			if ($f2!=0) {
				$page=$_GET['p'];
			}
		}
	}
	$query0 = "SELECT contenido FROM contenido WHERE '$lid'=lid";
	$result0 = pg_query($dbconn, $query0) or die('Query failed: ' . pg_last_error());
	while ($row = pg_fetch_row($result0)){
		echo $row;
	}
	//con estas lineas creare los uid, lid para que js los tenga
	echo "<script>";
	echo "\n";
	echo "var uid=".$uid,";";
	echo "var lid=".$lid,";";
	echo "</script>";
	$query = "SELECT * FROM comentarios WHERE '$uid'=uid AND '$lid'=lid";
	$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
	$si_hay=pg_num_rows($result);
	$valor = pg_fetch_row($result);
	$comentario = $valor[2];
	
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<meta charset="utf-8">
	<title><?php echo $URL ?></title>
	<?php include "../style/navbar.php" ?>
</head>
<body class="fondon">
	<form method="post" class="todo" action="<?php echo $myURL; ?>">
			<div class="container">
				<?php
					if($f==0){
				 			   echo "<embed src=\"../Admin/$URL\" type=\"application/pdf\" width=\"100%\" height=\"100%\"></embed>";
				 	}elseif ($f==1) {
				 		echo "<embed src=\"../Admin/$URL#page=$page\" type=\"application/pdf\" width=\"100%\" height=\"100%\"></embed>";
				 	} elseif($f==11){
				 				echo "<embed src=\"../Admin/$URL#page=$page\" type=\"application/pdf\" width=\"100%\" height=\"100%\"></embed>";
				 	}
				  
				 ?>
			</div>

			<div class="notas">
				<div class="accordion" id="accordionExample">
					<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<div class="buto">
							<input type="submit" class="bus1 btn btn-outline-success my-2 my-sm-2" name="nombre" value="Buscar"><br>
							<input type="text" name="valuetosearch" class="bus form-control my-sm-2" placeholder="Búsqueda" value= <?php echo str_replace('+', '&nbsp;', $val); ?>><br>
						</div>
					</form>
					<?php 
						
					?>
					<div class="bot">
					    <h5 class="mb-0" id="headingOne">
					        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					        	Comentarios
					        </button>
					    </h5>
					    &nbsp;&nbsp;&nbsp;
				      	<h5 class="mb-0" id="headingTwo">
				        	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				          		Sugerencias
				        	</button>
				     	</h5>
				    </div>
				  	<div class="card">
					    <?php 
							if ($f==0) {
								echo '<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">';
							}else{
								echo '<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">';
							}
						?>
				      	<div class="card-body ">
				        	<label>Notas o comentarios:</label>
							<textarea id="inputComentario" class="in" name="coment" value="" cols="40" rows="17"></textarea>
							<!-- le cambie el tipo por que si no hace refresh a la pagina -->
							<input type="button" name="actualizar" value="Actualizar" id="act">
				    	</div>
			    	</div>
				    <div class="card">
					    <?php 
							if (($f==1)||($f==11)) {
								echo '<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">';
							}else{
								echo '<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">';
							}
						?>
				      	<div class="card-body">
					        <?php
						    	// echo "$valuetosearch";
						    	// pg_free_result($result3);
								// $co=0;
							  	if ($f==0) {
							  		echo "No se han encontrado sugerencias.";
							  	} elseif (($f==1)||($f==11)){
							  		$queryo2 = "SELECT DISTINCT pagina FROM contenido WHERE lid='$lid' AND contenido ILIKE '%".$valuetosearch."%' ORDER BY pagina";
									$resulto2 = pg_query($dbconn, $queryo2) or die('Query failedd: ' . pg_last_error());
									$co=pg_num_rows($resulto2);
									if ($co==0) {
										echo "No se han encontrado sugerencias.";
									}elseif($co!=0){
										while($rowo = pg_fetch_row($resulto2)){
											$pagina = $rowo[0];
											echo "<a href='../PDF/prueba.php?uid=$uid&lid=$lid&b=11&search=$valuetosearch&p=$pagina'>Página $pagina :</a> <br>";
											$queryv = "SELECT * FROM contenido WHERE lid='$lid' AND contenido ILIKE '%".$valuetosearch."%' AND pagina='$pagina'";
											$resultv = pg_query($dbconn, $queryv) or die('Query failed: ' . pg_last_error());
											while($rowv = pg_fetch_row($resultv)){
												$articulo = $rowv[1];
												echo "Artículo " . $articulo;
												echo "<br>";
											}
										}
									}
								}
								pg_free_result($result3);
								pg_free_result($result0);
								pg_free_result($result1);
							?>
				      	</div>
				    </div>
				</div>
			</div>
			<div class="coll">

			</div>
	</form>
</body>
</html>


<!-- SCRIPT PARA COMENTARIOS -->
<script>
	var save = function(){
		//le di un id al input y con la siguiente linea obtengo el valor del comentario
		comentario = document.getElementById("inputComentario").value;
		//LAS VARIABLES UID Y LID SON OBTENIDAS CON PHP Y YA ESTAN PARA USAR CON JS
		//lid -> ya los tengo con php
		//uid -> ya los tengo con php
		$.ajax({
			url: "guardar.php?lid=" + lid + "&uid=" + uid + "&comentario=" + comentario,
			type: "POST",
			success: function(r){
				//si el retorno al llamar el archivo es 1 lo guardo de lo contrario no lo guardo
				if(r = 1){
					
				}
			},
		});
	}

	var search = function(){
		//voy a buscar la informacion del comentario ya existente si este la tiene
		$.ajax({
			url: "buscar.php?lid=" + lid + "&uid=" + uid,
			type: "POST",
			success: function(r){
				if(r != -1){ //retorno -1 si el query falla
					document.getElementById("inputComentario").value = r;
				}
			},
		});
	}

	//document.ready espera hasta que la pantalla este lista para actuar por asi decirlo
	$(document).ready(function(){
		//llamo desde el inicio a que busque comentario
		search();
		$("#act").on('click',function(){
			//capturo cuando hacen click en el input
			save();
		});
	 });
</script>