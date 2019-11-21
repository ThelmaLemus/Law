
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.943/build/pdf.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<link href="../assets/js/plugins/nucleo/css/nucleo.css rel=stylesheet />
      <link href=../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css rel=stylesheet />
      <link href=../assets/css/argon-dashboard.css?v=1.1.0 rel=stylesheet />
      <link href=../assets/css/nvbr.css rel=stylesheet />
      <link href=../assets/css/main.css rel=stylesheet />


	<script
	src="https://code.jquery.com/jquery-3.4.1.js"
	integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/pdf_view.css">
	<!--<script src="pdf.js"></script>
	<script src="pdf.worker.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
	<script src="../assets/js/templates_func.js"></script>
	<script src="../assets/js/moments.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<meta charset="utf-8">
		<title>Declaración jurada</title>
		<?php 
			$uid = $_GET['uid'];
			 include "navbar.php";
			 include "../assets/php/upload_dpi.php"; 
		?>
		<script>
			localStorage.setItem('busco', false);

			function converttoPDF()
			{
				console.log('hola');

				//GUARDAR
				var fecha_inicio = document.getElementById("inputdate").value;
				var nombre_a_dar = document.getElementById("nombre_a_dar").value;
				var nombre_a_recibir = document.getElementById("nombre_a_recibir").value;
				var responsabilidades = document.getElementById("responsabilidades").value;
				var DPI_otorgante = document.getElementById("DPI_otorgante").value;
				var DPI_apoderado = document.getElementById("DPI_apoderado").value;
				var DPI_testigo1 = document.getElementById("DPI_testigo1").value;
				var DPI_testigo2 = document.getElementById("DPI_testigo2").value;
				var fecha_final = document.getElementById("fecha_final").value;
				var usuario = "<?php echo $uid ?>";
				console.log(usuario);

				$.ajax({
					type: "POST",
					url: "guardartemplates/guardar_cartadepoder.php",
					data:
					{
						fecha_emision : fecha_inicio,
						nombre_otorgante : nombre_a_dar,
						nombre_apoderado : nombre_a_recibir,
						responsabilidades : responsabilidades,
						DPI_otorgante : DPI_otorgante,
						DPI_apoderado : DPI_apoderado,
						DPI_testigo1 : DPI_testigo1,
						DPI_testigo2 : DPI_testigo2,
						fecha_caducidad : fecha_final,
						usuario : usuario
					},
					success: function(r){
						//si el retorno al llamar el archivo es 1 lo guardo de lo contrario no lo guardo
						if(r == 1){
							alert("Agregado");
							
							//DESCARGAR
							var doc = new jsPDF();
							console.log("creo doc");
							var specialElementHandlers = {
								'#profile': function (element, renderer) 
								{
									return true;
								}
							};

							//15, 105
							doc.fromHTML($('#profile').html(), 15, 15, {
								'width': 170,
								'align': "justify",
								'elementHandlers': specialElementHandlers
							});
							console.log(doc);
							doc.save('carta_de_poder.pdf');
						}
					},
				});
			};

			function genPDF()
			{
			html2canvas(document.getElementById("profile"),{
			onrendered:function(canvas){

			var img=canvas.toDataURL("image/png");
			var doc = new jsPDF();
			doc.addImage(img,'JPEG',20,20);
			doc.save('test.pdf');
			}

			});

			}

/* 			function genPDF()
			{
			html2canvas(document.getElementById("profile"),{
			onrendered:function(canvas){

			var img=canvas.toDataURL("image/png");
			var doc = new jsPDF();
			doc.addImage(img,'JPEG',20,20);
			doc.save('test.pdf');
			}

			});

			} */
		</script>
</head>
<body class="fondon">
	<div class="container container_form">

		<div class="letter">
			<div class="editop list-group" id="myList" role="tablist">
				<a class="list-group-item list-group-item-action active" data-toggle="list" href="#home" role="tab">Edición</a>
				<a class="list-group-item list-group-item-action" data-toggle="list" href="#profile" role="tab" onclick="setValues_cartadepoder('inputdate','nombre_a_dar', 'nombre_a_recibir', 'responsabilidades', 'DPI_otorgante', 'DPI_apoderado', 'DPI_testigo1', 'DPI_testigo2', 'fecha_final');">Vista previa</a>
			</div>
			<h2 class="docname">Carta de poder</h2>
			<div class="tab-content Lcontent">
				<form method='post' class="tab-pane active" id="home" role="tabpanel" enctype="multipart/form-data">
					<div class="form-row">
						<div class="form-group col-md-6">
                            <!-- fecha_emision -->
							<label for="inputdate">Fecha</label>
							<input type="date" class="form-control" id="inputdate" placeholder="Fecha de emisión">
						</div>
						<div class="form-group col-md-6">
                        <!-- nombre_a_dar -->
							<label for="nombre_a_dar">Nombre</label>
							<input type="text" class="form-control" id="nombre_a_dar" placeholder="Nombre del otorgante">
						</div>
					</div>
					<div class="form-row">
                        <div class="form-group col-md-6" id="templ">
                        <!-- nombre_a_recibir -->
							<label for="nombre_a_recibir">Nombre</label>
							<input type="text" class="form-control" id="nombre_a_recibir" placeholder="Nombre del apoderado">
						</div>
                        <!-- responsabilidades -->
                        <div class="form-group col-md-6" id="templ">
							<label for="responsabilidades">Responsabilidades</label>
							<textarea class="form-control" id="responsabilidades" placeholder="Responsabilidades">
                            </textarea>
						</div>
                        <!-- DPIs -->
						<div class="form-group col-md-6">
							<label for="DPI_otorgante">DPI del otorgante</label>
							<input type="text" class="form-control" id="DPI_otorgante" placeholder="Número de DPI">
						</div>
                        <div class="form-group col-md-6">
							<label for="DPI_apoderado">DPI del apoderado</label>
							<input type="text" class="form-control" id="DPI_apoderado" placeholder="Número de DPI">
						</div>
                        <div class="form-group col-md-6">
							<label for="DPI_testigo1">DPI del Testigo 1</label>
							<input type="text" class="form-control" id="DPI_testigo1" placeholder="Número de DPI">
						</div>
                        <div class="form-group col-md-6">
							<label for="DPI_testigo2">DPI del Testigo 2</label>
							<input type="text" class="form-control" id="DPI_testigo2" placeholder="Número de DPI">
						</div>
                        <!-- SETEAR CANTIDAD DE DÍAS CON JS -->
                        <!-- fecha_final -->
                        <div class="form-group col-md-6">
							<label for="fecha_final">Fecha de caducidad</label>
							<input type="date" class="form-control" id="fecha_final" placeholder="Fecha de caducidad">
						</div>
					</div>
					<div type="" id="imprimir" onclick="converttoPDF()" class="btn btn-primary">Descargar y guardar</div>
				</form>
				<script>
					 function imprimir(){
						//send the div to PDF
						html2canvas($("#templ"), { // DIV ID HERE
							onrendered: function(canvas) {
								var imgData = canvas.toDataURL('image/png'); 
								var doc = new jsPDF('landscape');
								doc.addImage(imgData, 'PDF', 10, 10);
								doc.save('sample-file.pdf'); //SAVE PDF FILE
							}
						});

					}

					setTodaysDate('inputdate');

 
				</script>
				<div class="tab-pane" id="profile" role="tabpanel" style="text-align: justify;" allign="justify">
					<div class="ntext" id="ntext">
                    En la Ciudad de Guatemala, el <mark id="fecha_emisionm"></mark>. Yo, <mark id="nombre_notariom"></mark>, Notario, 
                    constituido en mi oficina profesional ubicada en <mark id="direccionm"></mark> de esta ciudad capital. Soy 
                    requerido por <mark id="nombre_solicitantem"></mark>, quien se identifica con el Documento Personal de Identificación 
                    (DPI) con Código Único de Identificación (CUI) <mark id="dpi_solicitantem"></mark>, emitido por el Registro Nacional 
                    de las Personas de la República de Guatemala, quien actúa en su calidad de Administrador Único y Representante Legal de la 
                    entidad CORPORACIÓN INTEGRAL DE ADMINISTRACIÓN CORPORATIVA, SOCIEDAD ANÓNIMA, calidad que acredita con el acta notarial de su 
                    nombramiento, autorizada en esta ciudad, el ocho de agosto del año dos mil diecisiete, por la Notaria María Isabel Salazar Urrutia, 
                    inscrita en el Registro Mercantil General de la República bajo el número quinientos quince mil setenta y nueve (515079), 
                    folio quinientos noventa y cinco (595) del libro cuatrocientos cuarenta y siete (447) de Auxiliares de Comercio, con el objeto de 
                    hacer constar notarialmente una DECLARACIÓN JURADA, por lo que se procede de la manera siguiente: PRIMERO: La requirente en la calidad 
                    con que actúa, bajo juramento de ley prestado con las formalidades del caso ante el Infrascrito Notario, y enterada de las penas 
                    relativas al delito de perjurio, manifiesta: a) Que su representada, la entidad CORPORACIÓN INTEGRAL DE ADMINISTRACIÓN CORPORATIVA, 
                    SOCIEDAD ANÓNIMA, es propietaria de la Empresa Mercantil “CIAC” inscrita en el Registro Mercantil General de la República bajo el 
                    número SETECIENTOS SETENTA MIL CIENTO DIECIOCHO (770118), folio TRESCIENTOS NOVENTA Y DOS (392) del libro SETECIENTOS CINCUENTA (750) 
                    DE EMPRESAS MERCANTILES; y, b) Que se ha extraviado la Patente de Comercio de Empresa de “CIAC”, la cual fue emitida con fecha cuatro 
                    de octubre de dos mil diecisiete. SEGUNDO: No habiendo más que hacer constar se finaliza la presente, veinte minutos después, en el 
                    mismo lugar y fecha de su inicio, la que consta en esta única hoja de papel bond útil en su anverso y reverso, la que es leída a la 
                    requirente, quien enterada de su contenido, objeto, validez y efectos legales, en la calidad con que actúa, la acepta, ratifica y firma 
                    con el Notario autorizante. DOY FE
				<div id="elementH"></div>
				<!-- <button onclick="converttoPDF()">Descargar</button> -->
			</div>
		</div>

		<div class="notas anotaciones">
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
									<!-- <?php
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
														echo "<a href='../examples/prueba.php?uid=$uid&lid=$lid&b=11&search=$valuetosearch&p=$pagina&c=$choose'> Artículo " . $articulo."</a>";
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
														echo "<a href='../examples/prueba.php?uid=$uid&lid=$lid&b=11&search=$valuetosearch&p=$pagina&c=$choose'>$articulo</a> <br>";
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
									?> -->
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
	function toPDF(){
		console.log('aqui');
		var doc = new jsPDF();
		debugger
		doc.text(20, 20, document.getElementById('profile').innerText);
		doc.addPage();
		doc.text(20, 20, "end");
		doc.save('Autenticación de firmas');
	}

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
			let ur = "prueba.php?uid="+uid+"&lid="+lid+"&b=5&p="+pagina;
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
			let ur = "prueba.php?uid="+uid+"&lid="+lid+"&b=5&p="+pagina;
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
	};

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

	function save(){
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

		 
	var dat = date();
	echo"<script></script>";
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

<script src="jspdf.js"></script>