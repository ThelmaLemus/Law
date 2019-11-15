<?php
	//OBTENGO PARÁMETROS DEL URL
	$uid = $_GET['uid'];
	$lid = $_GET['lid'];
	//CREO EL NUEVO URL
	$myURL = $_SERVER['PHP_SELF']."?uid=".$uid."&lid=".$lid;
	//CONEXIÓN A BASE DE DATOS
	$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
	$dbconn = $link or die('Could not connect: ' . pg_last_error());

	echo "<script> var pagina = 1; </script>";
	//SI EL USUARIO BUSCÓ ALGUNA PALABRA ADENTRO, MUESTRA SUGERENCIAS DE PAGS
	if(isset($_POST['buscar']))
	{
		echo"
			<script>
				console.log('el lid: ".$lid."');
			</script>
		";
		// echo "$lid";
		$valuetosearch = $_POST['valuetosearch'];
		$valuetosearch = urlencode($valuetosearch);
		// $valuetosearch=trim($valuetosearch);
		$queryi = "SELECT DISTINCT pagina FROM contenido WHERE '$lid'=lid AND contenido ILIKE '%".$valuetosearch."%' ORDER BY pagina";
		$resulti = pg_query($dbconn, $queryi) or die('Query failedd: ' . pg_last_error());
		$rw= pg_fetch_row($resulti);
		$pa= $rw[0];
		//B ES MODO DE BÚSQUEDA (11 ADENTRO, 1 AFUERA)
		//P ES EL NUMERO DE LA PRIMER PÁGINA DONDE SE ENCUENTRA LA PALABRA
		//SETEA B COMO 11 Y ENVÍA LA PÁGINA
		//ABRE EL PDF EN LA PÁGINA DE LA PRIMER COINCIDENCIA
		header("Location: ../PDF/prueba.php?uid=$uid&lid=$lid&b=11&search=$valuetosearch&p=$pa");
	}
	else
	{	
		$f=$_GET['b'];
		if ($f==1) {
			//SE BUSCÓ afuera, Y SE OBTIENE LA PÁGINA DE LA PRIMER COINCIDENCIA
			$valuetosearch=$_GET['search'];	
			$val = urlencode($valuetosearch);
			$queryo = "SELECT DISTINCT pagina FROM contenido WHERE '$lid'=lid AND contenido ILIKE '%".$valuetosearch."%' ORDER BY pagina";
			$resulto = pg_query($dbconn, $queryo) or die('Query failedd: ' . pg_last_error());	
			$rowo1 = pg_fetch_row($resulto);
			//SETEA PAGE CON EL NUMERO DE PAGINA DE LA PRIMER COINCIDENCIA
			$page=$rowo1[0];
			echo "<script> pagina=".$page,";</script>";
		}elseif ($f==11) {
			$valuetosearch=$_GET['search'];
			$val = urlencode($valuetosearch);
			$queryo = "SELECT DISTINCT pagina FROM contenido WHERE '$lid'=lid AND contenido ILIKE '%".$valuetosearch."%' ORDER BY pagina";
			$resulto = pg_query($dbconn, $queryo) or die('Query failedd: ' . pg_last_error());
			$f2=$_GET['p'];
			//SE BUSCÓ AFUERA Y SE COMPRUEBA QUE SEA MAYOR A 0
			if ($f2!=0) {
				//SETEA PAGE CON EL NUMERO DE PAGINA DE LA PRIMER COINCIDENCIA
				$page=$_GET['p'];
				echo "<script> pagina=".$page,";</script>";
			}
		}
	}

	
	//OBTENGO LA URL DEL DOCUMENTO
	$query0 = "SELECT url FROM leyes WHERE '$lid'=lid";
	$result0 = pg_query($dbconn, $query0) or die('Query failed: ' . pg_last_error());
	$contenido = pg_fetch_row($result0);
	$URL = $contenido[0];
	$URL= trim($URL);
	//con estas lineas creare los uid, lid para que js los tenga
	echo "
		<script>
			var uid=".$uid.";
			var lid=".$lid.";
			var url=\"".$URL."\";
		</script>
	";
?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.943/build/pdf.min.js"></script>
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<link rel="stylesheet" href="drywest/dashboard/assets/css/pdf_view.css">
	<!--<script src="pdf.js"></script>
	<script src="pdf.worker.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<meta charset="utf-8">
		<title><?php echo $URL ?></title>
		<?php include "../style/navbar.php" ?>
</head>
<body class="fondon">
		<div class="container">
			<button id="pdf-prev">Previous</button>
			<canvas id="my_canvas"></canvas>
			<button id="pdf-next">Next</button>
				<?php
					if($f==0)
					{
					 	echo
					 	"
					 		<script>
					 			var newurl = \"../Admin/\"+url+\"\";
					 		</script>
					 	";
				 	}elseif ($f==1) 
				 	{
						 echo
						 "
						 	<script> 
						 		var newurl=\"../Admin/\"+url+\"#page=\"+pagina+\"\";
						 	</script>
						 ";
					}
					elseif($f==11)
					{
						echo
						"
							<script> 
						 		var newurl=\"../Admin/\"+url+\"#page=\"+pagina+\"\";
						 	</script>
						";
				 	}		 	
				?>
			<div class="notas">
				<div class="accordion" id="accordionExample">
					<form method="post">
						<div class="buto">
							<input type="submit" class="bus1 btn btn-outline-success my-2 my-sm-2" name="buscar" value="Buscar"><br>
							<input type="text" name="valuetosearch" class="bus form-control my-sm-2" placeholder="Búsqueda" value= <?php echo str_replace('+', '&nbsp;', $val); ?>><br>
						</div>
					</form>
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
							if ($f==0) 
							{
								echo '<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">';
							}
							else
							{
								echo '<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">';
							}
						?>
						<div class="card-body ">
						    <label>Notas o comentarios</label><br>
						    <!-- POR CADA COMENTARIO DEL DOCUMENTO, HAY UN HREF -->
						    <form class="collapse commentID card-body" aria-labelledby="headingOne" data-parent="#accordionExample">
							<div class="comment">
								<div class="form-group">
									<textarea class="form-control answinput" id="exampleFormControlTextarea1" rows="3" 
									placeholder="Ingresa un comentario o respuesta."></textarea>
									<button type="submit" class="btn btn-primary btn-sm">Responder</button>
								</div>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item">Vestibulum at eros</li>
								<li class="list-group-item">Cras justo odio</li>
								<li class="list-group-item">Dapibus ac facilisis in</li>
								<li class="list-group-item">Morbi leo risus</li>
								<li class="list-group-item">Porta ac consectetur ac</li>
								<li class="list-group-item">Vestibulum at eros</li>
							</ul>
						</form>
						    <?php
								//OBTENGO LOS COMENTARIOS DE la LEY PRINCIPALES
								$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
								$dbconn = $link or die('Could not connect: ' . pg_last_error());
								$query = "SELECT * FROM comentarios WHERE '$lid'=lid AND 0=padre";
								$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
								$si_hay=pg_num_rows($result);

								if($si_hay > 0)
								{
									echo "<ul class='list-group list-group-flush posts'>";
									while ($row = pg_fetch_row($result))
									{
										echo
										"
										<li class='list-group-item'>
											<div class='post'>
												<div class='titlepost'>
													<h4> Pagina: ";
														echo $row[4];
												echo "</h4>
												</div>
												<div class='postcontent'>";
													echo $row[2];
											echo "</div>
												<div class='postactions'>
													<div class='actionsgroup'>
														<div class='ashow far fa-comment' name=\"bubble\"  data-toggle='collapse' data-target='.commentID' aria-expanded='true' aria-controls='commentID'>
														</div>
														<div class='ashow far fa-bookmark>
														</div>
													</div>
												</div>
											</div>
										</li>
										";
									}
									echo "</ul>";
								} 
								else
								{
									echo "\nNo existen comentarios";
								}

								function buscarhijos($padrecid) 
								{
									echo
									"
										<form class='collapse commentID card-body' aria-labelledby='headingOne' data-parent='#accordionExample'>
											<div class='comment'>
												<div class='form-group'>
													<textarea class='form-control answinput' id='exampleFormControlTextarea1' rows='3' 
															placeholder='Ingresa un comentario o respuesta.'>
													</textarea>
													<button type='submit' class='btn btn-primary btn-sm'>Responder</button>
												</div>
											</div>
											<ul class='list-group list-group-flush'>
										</form>
									";

									$buscohijos = "SELECT * FROM comentarios WHERE '$lid'=lid AND 'padrecid'=padre";
									$result = pg_query($dbconn, $buscohijos) or die('Query failed: ' . pg_last_error());
									$tiene=pg_num_rows($result);

									if($tiene)
									{
										while ($row = pg_fetch_row($result))
										{
											echo "<li class='list-group-item'>".COMENTARIO.";
													<div class='postactions'>
														<div class='actionsgroup'>
															<div class='ashow far fa-comment'  data-toggle='collapse' data-target='.commentID' aria-expanded='true' aria-controls='commentID'>
															</div>
															<div class='ashow far fa-comment'>
															</div>
														</div>
													</div>
												</li>";
										}
										echo "</ul>";
									}
									else
									{
										echo "No existen comentarios";
									}
								}

								$valor = pg_fetch_row($result);
								//COMPRUEBO SI HAY POR LO MENOS UNO
								$comentario = $valor[2];
							    echo
								"
						 			<script>
						 				pagina=".$page.";
						 				var newurl=\"../Admin/\"+url+\"#page=\"+pagina+\"\";
						 			</script>
								";
							?>
						    
						</div>
					</div>
					<div class="card">
					    <?php 
							if (($f==1)||($f==11)) 
							{
								echo '<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">';
							}
							else
							{
								echo '<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">';
							}
						?>
						<div class="card-body">
							<?php
								if ($f==0) 
								{
									echo "No se han encontrado sugerencias.";
								}
								elseif (($f==1)||($f==11))
								{
									$queryo2 = "SELECT DISTINCT pagina FROM contenido WHERE lid='$lid' AND contenido ILIKE '%".$valuetosearch."%' ORDER BY pagina";
									$resulto2 = pg_query($dbconn, $queryo2) or die('Query failedd: ' . pg_last_error());
									$co=pg_num_rows($resulto2);
									if ($co==0)
									{
										echo "No se han encontrado sugerencias.";
									}
									elseif($co!=0)
									{
										while($rowo = pg_fetch_row($resulto2))
										{
											$pagina = $rowo[0];
											echo "<a href='../PDF/prueba.php?uid=$uid&lid=$lid&b=11&search=$valuetosearch&p=$pagina'>Página $pagina :</a> <br>";
											$queryv = "SELECT * FROM contenido WHERE lid='$lid' AND contenido ILIKE '%".$valuetosearch."%' AND pagina='$pagina'";
											$resultv = pg_query($dbconn, $queryv) or die('Query failed: ' . pg_last_error());
											while($rowv = pg_fetch_row($resultv))
											{
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
	</div>
	
	<script type="text/javascript">
		function myFunction(pagina, newurl) 
		{
			pdfjsLib.getDocument(newurl).then(doc => {
				__TOTAL_PAGES = doc._pdfInfo.numPages;
				console.log("tHIS FILE HAS " + __TOTAL_PAGES + " PAGES");
				// console.log(pagina);
				doc.getPage(pagina).then(page => {
					var myCanvas = document.getElementById("my_canvas");
					var context = myCanvas.getContext("2d");

					var viewport = page.getViewport(2);
					myCanvas.width = viewport.width;
	//				myCanvas.style = "transform: scale(0.6,1);";
					myCanvas.height = viewport.height;

					page.render({
						canvasContext: context,
						viewport: viewport
					});
				});
			});
		}

		myFunction(pagina, newurl);

		// Previous page of the PDF
		$("#pdf-prev").on('click', function() {
			if(pagina != 1){
				myFunction(--pagina, newurl);
				console.log(pagina);
			}
		});

		// Next page of the PDF
		$("#pdf-next").on('click', function() {
			if(pagina != __TOTAL_PAGES){
				myFunction(++pagina, newurl);
				console.log(pagina);
			}
		});
	</script>

</body>