
<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.943/build/pdf.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/f529d3c7df.js" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>


	<script
	src="https://code.jquery.com/jquery-3.4.1.js"
	integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/pdf_view.css">
	<!--<script src="pdf.js"></script>
	<script src="pdf.worker.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
	<script src="../assets/js/templates_func.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale = 1.0">
	<meta charset="utf-8">
		<title>Trámite - Emisión de pasaporte</title>
		<?php 
			$uid = $_GET['uid'];
			$tid = $_GET['tid'];
			
			include "navbar.php";
		?>
		<script>
			localStorage.setItem('busco', false);

		function save()
		{
		//le di un id al input y con la siguiente linea obtengo el valor del comentario
		comentario = document.getElementById("inputComentario").value;
		console.log(comentario);
		var tid = <?php echo $tid ?>;
		//LAS VARIABLES UID Y LID SON OBTENIDAS CON PHP Y YA ESTAN PARA USAR CON JS
		//lid -> ya los tengo con php
		//uid -> ya los tengo con php
		$.ajax({
			url: "guardar_comment_tramite.php",
			type: "POST",
			data:
			{
				tid : tid,
				comentario : comentario
			},
			success: function(r){
				//si el retorno al llamar el archivo es 1 lo guardo de lo contrario no lo guardo
				if(r == 1){
					alert("Agregado");
//					clearContents(comentario);
				}
				else
				{
					console.log(r);
				}
			},
		});
		setTimeout(() => {
						window.location.reload(true);
					}, 2000);
	}
            
		</script>
</head>
<body class="fondon">
	<div class="container container_form">

		<div class="letter">

			<h2 class="docname">Traspaso de vehiculos</h2>
			<h3 class="docname">SAT</h3>
			<div class="tab-content Lcontent">
				<div id="profile" style="text-align: justify;" allign="justify">
					<div class="ntext" id="ntext">
						<h2>En agencia</h2>
                        1) Contar con el certificado de propiedad del vehículo original, el cual debe estar legalizado por un notario con la firmas del comprador actual y el vendedor. El costo del endoso varía entre Q50 a Q300.<br>
                        2) Presentar el pago de dos formularios del portal web Declaraguate.<br>
                        &ensp;&ensp;&ensp;a) El 8611, trámite de traspaso e impresión de documento, con un valor de<br>
                        &ensp;&ensp;&ensp;&ensp;&nbsp;Q120.<br>
                        &ensp;&ensp;&ensp;b) El formulario 2311, pago del Impuesto al Valor Agregado (IVA), depende de la<br>
                        &ensp;&ensp;&ensp;&ensp;&nbsp;antigüedad del vehículo.<br>
                        3) La Tarjeta de Circulación y el Documento Personal de Identificación (DPI) original del comprador.
                        <br><br>
						<h2>Usuario agencia virutal</h2>
                        <h3>Pasos de apertura:</h3>
						1) Ingresar al sitio web, www.sat.gob.gt.<br>
                        2) Buscar la plataforma Agencia Virtual y solicitar un usuario.<br>
                        3) Completar un formulario con el Número de Identificación Tributaria (NIT), nombre, fecha de nacimiento, número de DPI, correo electrónico y una contraseña que se utilizará luego para ingresar al sitio cuando esté habilitado.<br>
                        4) El sistema enviará un mensaje de confirmación al correo electrónico ingresado. La solicitud debe imprimirse y presentarse a una Oficina Tributaria junto a una fotocopia de DPI. (A excepción de la agencia de Montserrat).<br>
                        5) El usuario estará activado.<br>
                        <br>
                        <h3>Pasos en la página:</h3>
                        <h4>Requisitos</h4>
                        1) Documento Personal de Identificación (DPI) del propietario.<br>
                        2) Pasaporte en caso de ser extranjero.<br>
                        3) Presentar el pago de Q120.00, por Gestión de Traspaso y Certificado de Propiedad a través del formulario  SAT-8611 en Declaraguate.<br>
                        4) Anexo de Declaración Jurada de Traspaso, generado por medio del formulario Declaraguate SAT-8611 con firma del comprador legalizada por Notario activo.<br>
                        5) Presenta el pago correspondiente al Impuesto al Valor Agregado por enajenación de Vehículos a través del formulario SAT-2311 en Declaraguate.<br>
                        6) 	Estar solvente del Impuesto Sobre Circulación de Vehículos hasta el año actual, de no estarlo realizar el pago en el formulario SAT-4091 en Declaraguate.<br>
                        7) Tarjeta de Circulación.<br>
                        8) Certificado de Propiedad<br>
                        9) Previo a presentarte a la Administración Tributaria, debes realizar expertaje o revisión física del vehículo, en las sedes autorizadas  y requisitos del DEIC-PNC y finaliza el trámite en el Registro Fiscal de Vehículos en un plazo de 15 días hábiles contados a partir del día que se realizó.<br>
                        10) Para realizar Traspaso de vehículos de uso alquiler o urbano, presenta autorización de concesión de línea emitida por la Municipalidad donde prestaras el servicio.<br>
                        11) Si el trámite es realizado por un tercero autorizado para gestiones en el Registro Fiscal de Vehículos, debes presentar los  requisitos de terceras personas.<br>
                        <br>
                        <h4>Lista de pasos</h4>
                        1) Ingresa a <a href="https://declaraguate.sat.gob.gt/declaraguate-web/">Declaraguate</a>, llena el formulario SAT-8611 y SAT-2311 genera las Boletas SAT-2000 para realizar los pagos en Bancos autorizados del sistema.<br>
                        2) Una vez pagada la boleta SAT-2000, ingresa nuevamente a <a href="https://declaraguate.sat.gob.gt/declaraguate-web/">Declaraguate</a>,  para generar el Anexo de Declaración Jurada a través del formulario SAT-8611.
                        3) Preséntate a una Agencia u Oficina Tributaria con los Requisitos y pagos realizados.
                        4) Finalizada la gestión ingresa a tu Agencia Virtual para generar tus distintivos electrónicos.
                        <br>
					</div>
				</div>
				<div id="elementH"></div>
				<!-- <button onclick="converttoPDF()">Descargar</button> -->
			</div>
		</div>

		<div class="notas anotaciones">
			<div class="accordion" id="accordionExample">
				<div class="bot">
					<div class="list-group notes-buttons" id="list-tab" role="tablist">
						<a class="comment-result-buttons list-group-item list-group-item-action active" id="list-comments-list" data-toggle="list" href="#list-comments" role="tab" aria-controls="comments">Comentarios</a>
					</div>
				</div>
				<div class="card">
					<div class="col-12">
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="list-comments" role="tabpanel" aria-labelledby="list-comments-list">
								<div class="card-body comments-card-body">
									<div class="newcomment">
										<textarea class="form-control answinput" id="inputComentario" rows="3" 
														placeholder="Ingresa un comentario o experiencia."></textarea>
														<?php
										
										echo "<button type='button' name='actualizar' value='Actualizar' id='act' onclick='save();' class='btn btn-primary btn-sm publish-button'>Publicar</button>";
										?>
									</div>
									<div id="otroscomentarios">
										<div class="fperse" id="comentsdiv">
											<?php 
												printComments($tid);
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php

function printComments($tid){
	// echo"<h1>adios$p</h1>";
	$pid = $pid;
	$tipo = $tipo;
	
	$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
	$dbcc = $link or die('Could not connect: ' . pg_last_error());
	$queryo2 = "SELECT DISTINCT * FROM comentarios_tramites WHERE tid=$tid";
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
			echo"
			<li class=\"list-group-item\">
				<div class=\"post\">
					<div class=\"postcontent\">
						$comment
					</div>
				</div>
			</li>";
		}
		echo"</ul>";
	}
}

	?>


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