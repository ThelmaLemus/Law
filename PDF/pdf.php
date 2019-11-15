<?php
	//OBTENGO PARÁMETROS DEL URL
	$uid = $_GET['uid'];
	$lid = $_GET['lid'];
	//CREO EL NUEVO URL
	$myURL = $_SERVER['PHP_SELF']."?uid=".$uid."&lid=".$lid;
	//CONEXIÓN A BASE DE DATOS
	$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
	$dbconn = $link or die('Could not connect: ' . pg_last_error());
	//SI EL USUARIO BUSCÓ ALGUNA PALABRA ANTES, MUESTRA SUGERENCIAS DE PAGS
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
		//B ES MODO DE BÚSQUEDA (11 AFUERA, 1 ADENTRO)
		//P ES EL NUMERO DE LA PRIMER PÁGINA DONDE SE ENCUENTRA LA PALABRA
		//SETEA B COMO 11 Y ENVÍA LA PÁGINA
		header("Location: ../PDF/prueba.php?uid=$uid&lid=$lid&b=11&search=$valuetosearch&p=$pa");
	}else{	
		$f=$_GET['b'];
		if ($f==1) {
			//SE BUSCÓ ADENTRO, Y SE OBTIENE LA PÁGINA DE LA PRIMER COINCIDENCIA
			$valuetosearch=$_GET['search'];	
			$val = urlencode($valuetosearch);
			$queryo = "SELECT DISTINCT pagina FROM contenido WHERE lid='$lid' AND contenido ILIKE '%".$valuetosearch."%' ORDER BY pagina";
			$resulto = pg_query($dbconn, $queryo) or die('Query failedd: ' . pg_last_error());	
			$rowo1 = pg_fetch_row($resulto);
			//SETEA PAGE CON EL NUMERO DE PAGINA DE LA PRIMER COINCIDENCIA
			$page=$rowo1[0];
		}elseif ($f==11) {
			$valuetosearch=$_GET['search'];
			$val = urlencode($valuetosearch);
			$queryo = "SELECT DISTINCT pagina FROM contenido WHERE lid='$lid' AND contenido ILIKE '%".$valuetosearch."%' ORDER BY pagina";
			$resulto = pg_query($dbconn, $queryo) or die('Query failedd: ' . pg_last_error());
			$f2=$_GET['p'];
			//SE BUSCÓ AFUERA Y SE COMPRUEBA QUE SEA MAYOR A 0
			if ($f2!=0) {
				//SETEA PAGE CON EL NUMERO DE PAGINA DE LA PRIMER COINCIDENCIA
				$page=$_GET['p'];
			}
		}
	}
	//OBTENGO LA URL DEL DOCUMENTO
	$query0 = "SELECT contenido FROM leyes WHERE '$lid'=lid";
	$result0 = pg_query($dbconn, $query0) or die('Query failed: ' . pg_last_error());
	$contenido = pg_fetch_row($result0);
	$URL = $contenido[0];
	$URL= trim($URL);
	//con estas lineas creare los uid, lid para que js los tenga
	echo "<script>";
	echo "\n";
	echo "var uid=".$uid,";";
	echo "var lid=".$lid,";";
	echo "var URL =".$URL,";";
	echo "var pagina =".$page,";";
	echo "</script>";
	//OBTENGO LOS COMENTARIOS DEL USUARIO
	$query = "SELECT * FROM comentarios WHERE '$uid'=uid AND '$lid'=lid";
	$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
	$si_hay=pg_num_rows($result);
	$valor = pg_fetch_row($result);
	//COMPRUEBO SI HAY POR LO MENOS UNO
	$comentario = $valor[2];
?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="pdf.js"></script>
	<script src="pdf.worker.js"></script>
	<!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable=no">
	<meta charset="utf-8">
		<title><?php echo $URL ?></title>
		<?php include "../style/navbar.php" ?>
</head>
<body class="fondon">
	<div id="pdf-main-container">
		<div id="pdf-loader">
			Loading document ...
		</div>
		<div id="pdf-contents">
			<div id="pdf-meta">
				<div id="pdf-buttons">
					<button id="pdf-prev">
						Previous
					</button>
					<button id="pdf-next">
						Next
					</button>
				</div>
				<div id="page-count-container">
					Page 
					<div id="pdf-current-page">
						
					</div>
					 of 
					<div id="pdf-total-pages">
						
					</div>
				</div>
			</div>
			<canvas id="pdf-canvas" width="400">
				
			</canvas>
			<div id="page-loader">
				Loading page ...
			</div>
		</div>
	</div>

	<script>

		var __PDF_DOC,
			__CURRENT_PAGE,
			__TOTAL_PAGES,
			__PAGE_RENDERING_IN_PROGRESS = 0,
			__CANVAS = $('#pdf-canvas').get(0),
			__CANVAS_CTX = __CANVAS.getContext('2d');

		function showPDF(pdf_url) {
			$("#pdf-loader").show();

			PDFJS.getDocument({ url: pdf_url }).then(function(pdf_doc) {
				__PDF_DOC = pdf_doc;
				__TOTAL_PAGES = __PDF_DOC.numPages;
				
				// Hide the pdf loader and show pdf container in HTML
				$("#pdf-loader").hide();
				$("#pdf-contents").show();
				$("#pdf-total-pages").text(__TOTAL_PAGES);

				// Show the first page
				showPage(1);
			}).catch(function(error) {
				// If error re-show the upload button
				$("#pdf-loader").hide();
				$("#upload-button").show();
				
				alert(error.message);
			});;
		}

		function showPage(page_no) {
			__PAGE_RENDERING_IN_PROGRESS = 1;
			__CURRENT_PAGE = page_no;

			// Disable Prev & Next buttons while page is being loaded
			$("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

			// While page is being rendered hide the canvas and show a loading message
			$("#pdf-canvas").hide();
			$("#page-loader").show();

			// Update current page in HTML
			$("#pdf-current-page").text(page_no);
			
			// Fetch the page
			__PDF_DOC.getPage(page_no).then(function(page) {
				// As the canvas is of a fixed width we need to set the scale of the viewport accordingly
				var scale_required = __CANVAS.width / page.getViewport(1).width;

				// Get viewport of the page at required scale
				var viewport = page.getViewport(scale_required);

				// Set canvas height
				__CANVAS.height = viewport.height;

				var renderContext = {
					canvasContext: __CANVAS_CTX,
					viewport: viewport
				};
				
				// Render the page contents in the canvas
				page.render(renderContext).then(function() {
					__PAGE_RENDERING_IN_PROGRESS = 0;

					// Re-enable Prev & Next buttons
					$("#pdf-next, #pdf-prev").removeAttr('disabled');

					// Show the canvas and hide the page loader
					$("#pdf-canvas").show();
					$("#page-loader").hide();
				});
			});
		}
		
		// Send the object url of the pdf
		showPDF(URL.createObjectURL($(URL).get(0).files[0]));

		// Previous page of the PDF
		$("#pdf-prev").on('click', function() {
			if(__CURRENT_PAGE != 1)
				showPage(--__CURRENT_PAGE);
		});

		// Next page of the PDF
		$("#pdf-next").on('click', function() {
			if(__CURRENT_PAGE != __TOTAL_PAGES)
				showPage(++__CURRENT_PAGE);
		});

		</script>

</body>