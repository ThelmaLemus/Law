<?php
	//OBTENGO PARÁMETROS DEL URL
	$uid = $_GET['uid'];
	$lid = $_GET['lid'];
	//CREO EL NUEVO URL
	// $myURL = $_SERVER['PHP_SELF']."?uid=".$uid."&lid=".$lid;
	//CONEXIÓN A BASE DE DATOS
	$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
	$dbconn = $link or die('Could not connect: ' . pg_last_error());

	echo "<script> 
			var pagina = 1; 
			var showresults = false;
			// var uid = $uid;
			var lid = $lid;
			var valuetosearch = '';
		</script>";
	//SI EL USUARIO BUSCÓ ALGUNA PALABRA ADENTRO, MUESTRA SUGERENCIAS DE PAGS
	if(isset($_POST['buscar']))
	{
		// echo "<script>
		// 	localStorage.setItem('bcont', document.getElementById('contsearch').checked);
		// 	localStorage.setItem('bcom', document.getElementById('comsearch').checked);
		// 	localStorage.setItem('busco', true);
		// </script>";
		// echo "$lid";
		$valuetosearch = $_POST['valuetosearch'];
		$valuetosearch = urlencode($valuetosearch);
		// $valuetosearch=trim($valuetosearch);
		$queryi = "SELECT DISTINCT C.pagina FROM contenido C, comentarios Com WHERE C.lid = Com.lid AND '$lid'=C.lid AND '$lid' = Com.lid AND
		 (C.contenido ILIKE '%".$valuetosearch."%' OR Com.comentario ILIKE '%".$valuetosearch."%') ORDER BY pagina";
		$resulti = pg_query($dbconn, $queryi) or die('Query failedd: ' . pg_last_error());
		$rw= pg_fetch_row($resulti);
		$pa= $rw[0];
		echo "
			<script>
				var SEARCH_FOR = $valuetosearch;
			</script>
		";
		//B ES MODO DE BÚSQUEDA (11 ADENTRO, 1 AFUERA)
		//P ES EL NUMERO DE LA PRIMER PÁGINA DONDE SE ENCUENTRA LA PALABRA
		//SETEA B COMO 11 Y ENVÍA LA PÁGINA
		//ABRE EL PDF EN LA PÁGINA DE LA PRIMER COINCIDENCIA
		echo"<script>
			let bcont = localStorage.getItem('bcont') == 'true'? true:false;
			let bcom = localStorage.getItem('bcom') == 'true'? true:false;
			debugger
			let cb = bcont && bcom? 3: bcont? 1: bcom? 2:0;
			// window.location = \"pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$lid&b=11&search=$valuetosearch&p=$pa&c=\"+cb+\"\";
		</script>";
		header("Location: ../examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$lid&b=11&search=$valuetosearch&p=$pa");
	}
	else
	{	
		$f=$_GET['b'];
		echo"<script>
			var b = $f;
		</script>";
		if ($f==1) {
			//SE BUSCÓ afuera, Y SE OBTIENE LA PÁGINA DE LA PRIMER COINCIDENCIA
			$valuetosearch=$_GET['search'];
			$val = urlencode($valuetosearch);
			$queryo = "SELECT DISTINCT C.pagina FROM contenido C, comentarios Com WHERE C.lid = Com.lid AND '$lid'=C.lid AND '$lid' = Com.lid AND
			(C.contenido ILIKE '%".$valuetosearch."%' OR Com.comentario ILIKE '%".$valuetosearch."%') ORDER BY pagina";
			$resulto = pg_query($dbconn, $queryo) or die('Query failedd: ' . pg_last_error());	
			$rowo1 = pg_fetch_row($resulto);
			//SETEA PAGE CON EL NUMERO DE PAGINA DE LA PRIMER COINCIDENCIA
			$page=$rowo1[0];
			echo "<script> 
					pagina=".$page.";
					valuetosearch=".$valuetosearch.";
				</script>";
		}elseif ($f==11) {
			// Se buscó dentro
			$valuetosearch=$_GET['search'];
			$val = urlencode($valuetosearch);
			$choose=$_GET['c'];
			if ($choose == 1) {
				$queryo = "SELECT DISTINCT C.pagina FROM contenido C WHERE '$lid'=C.lid AND (C.contenido ILIKE '%".$valuetosearch."%') ORDER BY pagina";
				$resulto = pg_query($dbconn, $queryo) or die('Query failedd: ' . pg_last_error());
			}else if ($choose == 2) {
				$queryo = "SELECT DISTINCT CO.pagina FROM comentarios CO WHERE '$lid'=Co.lid AND (CO.comentario ILIKE '%".$valuetosearch."%') ORDER BY pagina";
				$resulto = pg_query($dbconn, $queryo) or die('Query failedd: ' . pg_last_error());
			}else if ($choose == 3) {
				$queryo = "SELECT DISTINCT C.pagina FROM contenido C, comentarios Com WHERE C.lid = Com.lid AND '$lid'=C.lid AND '$lid' = Com.lid AND
				(C.contenido ILIKE '%".$valuetosearch."%' OR Com.comentario ILIKE '%".$valuetosearch."%') ORDER BY pagina";
			$resulto = pg_query($dbconn, $queryo) or die('Query failedd: ' . pg_last_error());
			}
			$f2=$_GET['p'];
			//SE BUSCÓ AFUERA Y SE COMPRUEBA QUE SEA MAYOR A 0
			if ($f2!=0) {
				//SETEA PAGE CON EL NUMERO DE PAGINA DE LA PRIMER COINCIDENCIA
				$page=$_GET['p'];
				echo "<script> 
						pagina=".$page.";
						valuetosearch = ".$valuetosearch.";
					</script>";
			}
		}elseif ($f==5) {
			$f2=$_GET['p'];
			if ($f2!=0) {
				$page=$_GET['p'];
				echo "<script> pagina=".$page,";</script>";
			}
		}
	}
			
	if(isset($_POST['hijo']))
	{
		$childComment = $_POST['fcomment'];
		$childParent = $_POST['cparent'];
		$childPage = $_POST['cpage'];
		$childlink = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
		$comentario= trim($childComment);
		$querychild = "INSERT INTO Comentarios(lid,uid,comentario,pagina,padre) VALUES ($lid,$uid,'$comentario','$childPage','$childParent')";
		$result = pg_query($childlink, $querychild) or die('Query failed: ' . pg_last_error());
		echo"<script>console.log('entro'+'$childComment'+'$childPage'+'$childParent')</script>";
		// pg_close($childlink);
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
			// var uid=".$uid.";
			var lid=".$lid.";
			var url=\"".$URL."\";
		</script>
	";
	function printComment($p, $l){
		echo"<h1>pag $p y lid $l</h1>";
	}
	
	function printComments($p, $l){
		// echo"<h1>adios$p</h1>";
		$pageprint = $p;
		$lidprint = $l;
		if ($pageprint == null) {
			$pageprint=1;
		}
		$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
		$dbcc = $link or die('Could not connect: ' . pg_last_error());
		$queryo2 = "SELECT DISTINCT * FROM comentarios WHERE lid='$lidprint' AND pagina='$pageprint' AND padre=0 ORDER BY cid DESC";
		$resulto2 = pg_query($dbcc, $queryo2) or die('Query failedd: ' . pg_last_error());
		$rownum=pg_num_rows($resulto2);
		if ($rownum==0)
		{
			echo "";
		}
		elseif($rownum!=0)
		{
			echo"<ul class=\"list-group list-group-flush posts\">";

			while($rowo = pg_fetch_row($resulto2))
			{
				$comment = $rowo[2];
				$cid = $rowo[3];
				$padre = $rowo[9];
				$pageprint2= $rowo[4];
				echo"
				<li class=\"list-group-item\">
					<div class=\"post\">
						<div class=\"postcontent\">
							$comment
						</div>
						<div class=\"postactions\">
							<div class=\"actionsgroup\">
								<div class=\"ashow far fa-comment\"  data-toggle=\"collapse\" data-target=\".commentID".$cid."\" aria-expanded=\"true\" aria-controls=\"commentID".$cid."\">
								</div>
							</div>
						</div>
					</div>
					<form method='post' class=\"collapse commentID".$cid. " post-item card-body\" aria-labelledby=\"headingOne\" data-parent=\"#accordionExample\">
						<div class=\"comment\">
							<div class=\"form-group childcomment\">
								<textarea class=\"form-control answinput\" id=\"textarea".$cid."\" name=\"fcomment\" rows=\"3\" 
								placeholder=\"Ingresa un comentario o respuesta.\"></textarea>
								<input type=\"text\" name=\"cparent\" value=".$cid.">
								<input type=\"text\" name=\"cpage\" value=".$pageprint2.">
								<button type=\"submit\" name=\"hijo\" class=\"btn btn-primary btn-sm publish-button\">Responder</button>
							</div>
						</div>";
						$childquery = "SELECT DISTINCT * FROM comentarios WHERE padre='$cid'";
						$childresults = pg_query($dbcc, $childquery) or die('Query failedd: ' . pg_last_error());
						$childrownum=pg_num_rows($childresults);
						// echo"<script>console.log('$childrownum padre-> $cid')</script>";
						if ($childrownum==0)
						{
							echo "";
						}
						elseif($childrownum!=0)
						{
							echo"<ul class=\"list-group list-group-flush\">";
							while($childrow = pg_fetch_row($childresults))
							{
								$child = $childrow[2];
								$chid = $childrow[3];
								$parent = $childrow[9];
								/* <div class=\"postactions\">
									<div class=\"actionsgroup\">
										<div class=\"ashow far fa-comment\" onclick=\"getChildren(".$parent.",  'childID".$chid."')\"  data-toggle=\"collapse\" data-target=\".childID".$chid."\" aria-expanded=\"true\" aria-controls=\"childID".$chid."\">
										</div>
									</div>
								</div> */
								echo"
									<li class=\"list-group-item\">
										<div class=\"post\">
											<div class=\"postcontent\">
												$child
											</div>
										</div>
										<div class=\"collapse childID".$chid." post-item card-body\" id=\"childID".$chid."\" aria-labelledby=\"headingOne\" data-parent=\"#accordionExample\">
											
										</div>
									</li>";
							}
							echo"</ul>";
						}
				echo"</form>
				</li>";
			}
			echo"</ul>";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.943/build/pdf.min.js"></script>
	<script src="../../node_modules/pdfjs-dist/build/pdf.js"></script>
	<script src="../../node_modules/pdfjs-dist/web/pdf_viewer.js"></script>

	<link rel="stylesheet" type="text/css" href="../../../../assets/css/pdf_view.css">
	<!--<script src="pdf.js"></script>
	<script src="pdf.worker.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<meta charset="utf-8">
		<title><?php echo $URL ?></title>
		<?php include "../../../navbar.php" ?>
		<script>
			localStorage.setItem('busco', false);
		</script>
</head>
<body class="fondon">
	<div class="container">
		<button class="temp" id="pdf-prev"><i class="fas fa-arrow-left"></i></button>
		<div id="my_canvas" class="pdfViewer"></div>
		<button class="temp" id="pdf-next"><i class="fas fa-arrow-right"></i></button>
		<?php
			if($f==0)
			{
				echo
				"
					<script>
						var newurl = \"../Admin/\"+url+\"\";
						</script>
						";
			}
			elseif ($f==1) 
			{
				echo
				"
				<script> 
					var newurl=\"../Admin/\"+url+\"#page=\"+pagina
				";
/* 				if(isset($_POST['buscar']))
				{
					echo "&\#search=\"+$valuetosearch\"\"";
				}; */
				echo 
				"
				console.log(newurl);
				</script>
				";
			}
			elseif($f==11 || $f==5)
			{
				echo
				"
				<script> 
					var newurl=\"../Admin/\"+url+\"#page=\"+pagina
				";
/* 				if(isset($_POST['buscar']))
				{
					echo "&\#search=\"+$valuetosearch\"\"";
				}; */
				echo 
				"
				console.log(newurl);
				</script>
				";
			}		 	
		?>
		<div class="notas">
			<div class="accordion" id="accordionExample">
				<form method="post">
					<div class="buto">
						<input type="text" name="valuetosearch" class="bus form-control my-sm-2" placeholder="Búsqueda" value= <?php echo str_replace('+', '&nbsp;', $val); ?>><br>
						<div class="choose">
							<div class="checklabel">
								<input type="checkbox" id="contsearch" onclick="CheckBoxFunc('contsearch', 'contres')" checked>
								<label for="contsearch">Contenido</label>
							</div>
							<div class="checlabel">
								<input type="checkbox" id="comsearch" onclick="CheckBoxFunc('comsearch', 'comres')" checked>
								<label for="contsearch">Comentarios</label>
							</div>
						</div>
						<input type="submit" class="bus1 btn btn-outline-success my-2 my-sm-2" name="buscar" value="Buscar" onclick="SetVariables()"><br>
					</div>
				</form>
				<div class="bot">
					<div class="list-group notes-buttons" id="list-tab" role="tablist">
						<a class="comment-result-buttons list-group-item list-group-item-action active" id="list-comments-list" data-toggle="list" href="#list-comments" role="tab" aria-controls="comments">Comentarios</a>
						<a class="comment-result-buttons list-group-item list-group-item-action" id="list-results-list" data-toggle="list" href="#list-results" role="tab" aria-controls="results">Resultados</a>
					</div>
				</div>
				<div class="card">
					<div class="col-12">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="list-comments" role="tabpanel" aria-labelledby="list-comments-list">
								<div class="card-body comments-card-body">
									<div class="newcomment">
										<textarea onfocus="clearContents(this);" class="form-control answinput" id="inputComentario" rows="3" 
														placeholder="Ingresa un comentario o respuesta."></textarea>
										<button type="button" name="actualizar" value="Actualizar" id="act" class="btn btn-primary btn-sm publish-button">Publicar</button>
									</div>
									<div id="otroscomentarios">
										<div class="fperse" id="comentsdiv">
											<?php 
												printComments($page,$lid);
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="list-results" role="tabpanel" aria-labelledby="list-results-list">
								<div class="card-body" id= "results">
									<?php
										if ($f==0) 
										{
											echo "Realice una búsqueda para observar resultados o sugerencias";
										}
										elseif (($f==1)||($f==11))
										{
											echo "<div id ='contres'><h5>Documento</h5>";
											if($choose == 1 || $choose ==3){
												echo "<script> showresults = true;
												console.log('entro a cont')</script>";
												$queryo2 = "SELECT DISTINCT pagina, articulo_inicio FROM contenido WHERE lid='$lid' AND contenido ILIKE '%".$valuetosearch."%' ORDER BY pagina";
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
														echo "Página $pagina : <br>";
														$articulo = $rowo[1];
														// echo "<a href='../examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$lid&b=11&search=$valuetosearch&p=$pagina&c=$choose'> Artículo " . $articulo."</a>";
														echo "<br>";
													}
												}
											}else{
												echo"Debe marcar la casilla de contenido y buscar de nuevo para ver resultados";
											}
											echo"</div>
											<div id = 'comres'><h5>Comentarios</h5>";
											if ($choose ==2 || $choose ==3) {
												echo "<script> showresults = true;
												console.log('entro a com')</script>";
												$queryocom = "SELECT DISTINCT  Com.comentario, Com.cid, Com.pagina FROM comentarios Com WHERE '$lid' = Com.lid AND(Com.comentario ILIKE '%".$valuetosearch."%') ORDER BY Com.pagina";
												$resultocom = pg_query($dbconn, $queryocom) or die('Query failedd: ' . pg_last_error());
												$colcom=pg_num_rows($resultocom);
												if ($colcom==0)
												{
													echo "No se han encontrado comentarios.";
												}
												elseif($colcom!=0)
												{
													while($rowo = pg_fetch_row($resultocom))
													{
														$pagina = $rowo[2];
														echo "Página $pagina :";
														$articulo = $rowo[0];
														echo "<br>";
														// echo "<a href='../examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$lid&b=11&search=$valuetosearch&p=$pagina&c=$choose'>$articulo</a> <br>";
													}
												}
											}else{
												echo"Debe marcar la casilla de comentarios y buscar de nuevo para ver resultados";
											}
											echo"</div>";
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
			</div>
		</div>
	</div>
	



</body>
</html>

<script type="text/javascript">


    function SetVariables(){
		localStorage.setItem('bcont', document.getElementById('contsearch').checked);
		localStorage.setItem('bcom', document.getElementById('comsearch').checked);
	}

    function CheckBoxFunc(id, displayid){
		let isChecked =  document.getElementById(id).checked;
		let show = isChecked? "block":"none"
		localStorage.setItem(id,isChecked);
		document.getElementById(displayid).style.display = show;


	}


	function getChildren(parent,child){
		console.log("El padre es: "+ parent+" y este comentario es: "+child);
		let newChild = document.getElementById(child);
		let content = "<form method='post' class=\"comment\"><div class=\"form-group\">";
		content += "<textarea class=\"form-control answinput\" id=\"exampleFormControlTextarea1\" rows=\"3\" placeholder=\"Ingresa un comentario o respuesta.\">";
		content += "</textarea><button type=\"submit\" class=\"btn btn-primary btn-sm publish-button\">Responder</button></div></form>" ;
		newChild.innerText = content;
		
	}

	function getPage()
    {
        return PDFViewerApplication.pdfViewer.currentPageNumber;
	}
	
	function newFunction(newurl, valuetosearch)
    {
        pdfjsLib.GlobalWorkerOptions.workerSrc = '../../node_modules/pdfjs-dist/build/pdf.worker.js';
        
        // Some PDFs need external cmaps.
        //
        var CMAP_URL = '../../node_modules/pdfjs-dist/cmaps/';
        var CMAP_PACKED = true;

        var DEFAULT_URL = newurl;
        var SEARCH_FOR = valuetosearch; // try 'Mozilla';

        var container = document.getElementById('container');

        // (Optionally) enable hyperlinks within PDF files.
        var pdfLinkService = new pdfjsViewer.PDFLinkService();

        // (Optionally) enable find controller.
        var pdfFindController = new pdfjsViewer.PDFFindController({
        linkService: pdfLinkService,
        });

        var pdfViewer = new pdfjsViewer.PDFViewer({
        container: container,
        linkService: pdfLinkService,
        findController: pdfFindController,
        });
        pdfLinkService.setViewer(pdfViewer);

	        document.addEventListener('pagesinit', function () {
	        // We can use pdfViewer now, e.g. let's change default scale.
	        console.log("Pagesinit = "+ pagesinit)
	        pdfViewer.currentScaleValue = 'page-width';

	        if (SEARCH_FOR != null || SEARCH_FOR != undefined) { // We can try search for things
	            pdfFindController.executeCommand('find', { query: SEARCH_FOR, });
	        }
        });

        // Loading document.
        var loadingTask = pdfjsLib.getDocument({
        url: DEFAULT_URL + "#page=pagina",
        cMapUrl: CMAP_URL,
        cMapPacked: CMAP_PACKED,
        });
        loadingTask.promise.then(function(pdfDocument) {
        // Document loaded, specifying document for the viewer and
        // the (optional) linkService.
        pdfViewer.setDocument(pdfDocument);

        pdfLinkService.setDocument(pdfDocument, null);
        });
    }

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
				myCanvas.style = "transform: scale(1.15,1);";
				myCanvas.height = viewport.height;

				page.render({
					canvasContext: context,
					viewport: viewport,

				});
			});
		});
	}

	//myFunction(pagina, newurl);
	newFunction(newurl, valuetosearch);

	// Previous page of the PDF
	$("#pdf-prev").on('click', function() {
		if(pagina != 1){
			myFunction(--pagina, newurl);
			console.log(pagina);
			let ur = "pdf.js-master/examples/components/simpleviewer.php?uid="+uid+"&lid="+lid+"&b=5&p="+pagina;
			window.location= ur;
			let rp = pagina;
			document.cookie = "pchange" + true
			document.cookie = "page = " + rp;
			// print();
			rp = 0;
			document.cookie = "page = " + rp;
		}
	});
	
	// Next page of the PDF
	$("#pdf-next").on('click', function() {
		if(pagina != __TOTAL_PAGES){
			myFunction(++pagina, newurl);
			console.log(pagina);
			let ur = "pdf.js-master/examples/components/simpleviewer.php?uid="+uid+"&lid="+lid+"&b=5&p="+pagina;
			window.location= ur;
			let rp = pagina;
			document.cookie = "pchange" + true
			document.cookie = "page = " + rp;
			// print();
			rp = 0;
			document.cookie = "page = " + rp;
		}
	});

	function print() {
		let commdiv = document.getElementById("comentsdiv");
		commdiv.innerHTML = "<?php 
			$pag = $_COOKIE['page'];
			echo $pag;
			printComment($pag, $lid);
		?>";
	}

	$(document).ready(function(){



		let bcont = localStorage.getItem('bcont');
		let bcom = localStorage.getItem('bcom');
		let ccnt = document.getElementById('contsearch');
		let ccmt = document.getElementById('comsearch');
		
		if (b != 0){
			if (bcom == "false") {
				console.log('no comments');
				
				document.getElementById("comres").style.display = "none";
				ccmt.checked =false;
			}else{
				console.log('si comments');
				document.getElementById("comres").style.display = "block";
				ccmt.checked =true;
			}
			if (bcont == "false") {
				console.log('no contents');
				document.getElementById("contres").style.display = "none";
				ccnt.checked =false;
			} else{
				console.log('si contents');
				document.getElementById("contres").style.display = "block";
				ccnt.checked =true;
			}
		}


		if(showresults && showresults != undefined){
			// console.log('hola');
			
			let lit1 = document.getElementById("list-comments-list");
			let lit2 = document.getElementById("list-results-list");
			let card1 = document.getElementById("list-comments");
			let card2 = document.getElementById("list-results");

			card1.classList.toggle("active");
			card1.classList.toggle("show");
			card2.classList.toggle("active");
			card2.classList.toggle("show");

			lit1.classList.toggle("active");
			lit2.classList.toggle("active");

		}
		var b1 = document.getElementById("pdf-prev");
		var b2 = document.getElementById("pdf-next");
		setTimeout(() => {
			b1.classList.toggle("temp");
			b1.classList.toggle("pdf-buttons");
			b2.classList.toggle("temp");
			b2.classList.toggle("pdf-buttons");
		}, 1000);

	});
	

	function clearContents(element) {
		element = '';
	}

	var save = function(){
		//le di un id al input y con la siguiente linea obtengo el valor del comentario
		comentario = document.getElementById("inputComentario").value;
		//LAS VARIABLES UID Y LID SON OBTENIDAS CON PHP Y YA ESTAN PARA USAR CON JS
		//lid -> ya los tengo con php
		//uid -> ya los tengo con php
		$.ajax({
			url: "guardar.php?lid=" + lid + "&uid=" + uid + "&comentario=" + comentario + "&pagina=" + pagina,
			type: "POST",
			success: function(r){
				//si el retorno al llamar el archivo es 1 lo guardo de lo contrario no lo guardo
				if(r = 1){
					alert("Agregado");
					clearContents(comentario);
					console.log(getPage());
					setTimeout(() => {
						window.location.reload(true);
					}, 2000);
				}
			},
		});
	}

	var search = function(){
		//voy a buscar la informacion del comentario ya existente si este la tiene
		$.ajax({
			url: "buscar.php?lid=" + lid + "&pagina=" + pagina,
			type: "POST",
			async: false,
			success: function(r){
				//alert(r);
				if(r != -1){ //retorno -1 si el query falla
					//var node = document.createElement("DIV");
					//node.appendChild(r.innerHTML); 
					//mostrar = document.getElementById("otroscomentarios");
					//mostrar.value = element.innerHTML(r);
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

	 //document.ready espera hasta que la pantalla este lista para actuar por asi decirlo
	/* $(document).ready(function(){
		//llamo desde el inicio a que busque comentario
		search();
		$("#act").on('click',function(){
			//capturo cuando hacen click en el input
			save();
			search();
		});
	 }); */
</script>