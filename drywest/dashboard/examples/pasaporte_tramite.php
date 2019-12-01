
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

			<h2 class="docname">Emisión de pasaporte</h2>
			<h3 class="docname">Migración</h3>
			<div class="tab-content Lcontent">
				<div id="profile" style="text-align: justify;" allign="justify">
					<div class="ntext" id="ntext">
						<h2>Requisitos para primer pasaporte</h2>
                        <h3>Mayores de edad</h3>
						1) DPI original y copia <br>
                        2) Boleto de Ornato vigente (original y copia) <br>
                        3) Boleta de pago $50 en cualquier agencia BANRURAL (La boleta de pago tiene vigencia de un año) <br>
                        &ensp;&ensp;&ensp;*El pago se realiza en quetzales, el equivalente a $50.<br>
                        &ensp;&ensp;&ensp;*Personas mayores a 60 años no presentan boleto de ornato. <br>
						<br>
						<h3>Menores de edad</h3>
						1) Certificado de nacimiento del menor de edad reciente. <br>
                        2) DPI original y copia de ambos progenitores <br>
                        3) Boleto de Ornato del año en curso, de uno de los padres  (original y copia) <br>
                        &ensp;&ensp;&ensp;*Boleta de pago $50 en cualquier agencia BANRURAL (La boleta de pago tiene<br>
                        &ensp;&ensp;&ensp;&ensp;&nbsp;vigencia de un año)<br>
                        &ensp;&ensp;&ensp;*El pago se realiza en quetzales, el equivalente a $50.<br>
                        &ensp;&ensp;&ensp;*Ambos padres deben acompañar al menor.<br>
                        <br>
                        <h3>Acompañado por un progenitor:</h3>
                        Además de todos los requisitos indicados anteriormente, se debe presentar:<br>
                        1) Autorización por escrito para la emisión de pasaporte, otorgada por el progenitor que no se haga presente, debe ser una carta poder con firmas legalizadas por abogado y notario.<br>
                        2) La carta poder con firmas legalizadas, para realizar el trámite de pasaporte de menores de edad cuando uno de los padres no puede estar presente, se aceptará hasta el 15 de octubre del 2019. Ya que se estará solicitando el original y fotocopia legalizada del testimonio del Mandato Especial con Representación, debidamente inscrito en el Archivo General de Protocolo.<br>
                        <br>
                        <h3>Cuando uno de los progenitores resida o se encuentre en el extranjero:</h3>
                        1) CERTIFICADO DE NACIMIENTO del menor de edad reciente.<br>
                        2) DOCUMENTO PERSONAL DE IDENTIFICACIÓN –DPI- del progenitor que realice el trámite.<br>
                        3) BOLETO DE ORNATO DEL AÑO EN CURSO (solamente del progenitor, original y fotocopia<br>
                        4) BOLETA DE PAGO $50 en cualquier agencia BANRURAL (La boleta de pago tiene vigencia de un año)<br>
                        5) Autorización de emisión de pasaporte, contenida Carta Consular original y certificada por el Ministerio de Relaciones Exteriores,  emitida durante los últimos seis meses acompañada de fotocopia del Pasaporte del progenitor que presento ante el Consulado para emitir la autorización.<br>
                        <br>
                        <h3>Cuando uno de los progenitores ha fallecido:</h3>
                        1) CERTIFICADO DE NACIMIENTO del menor de edad reciente.<br>
                        2) CERTIFICADO DE DEFUNCIÓN del progenitor ausente por fallecimiento (original emitido durante los últimos seis meses).<br>
                        3) DOCUMENTO PERSONAL DE IDENTIFICACIÓN –DPI- del progenitor que comparezca a realizar el trámite. (original y fotocopia)<br>
                        4) BOLETO DE ORNATO DEL AÑO EN CURSO (solamente del progenitor, original y fotocopia)<br>
                        5) BOLETA DE PAGO $50 en cualquier agencia BANRURAL<br>
                        <br>
                        <h3>Guatemalteco de origen (hijos de guatemaltecos nacidos fuera de Guatemala y que hacen su inscripción a través de un consulado)</h3>
                        Adicional a los requisitos mencionados debe presentar certificado de guatemalteco de origen con anotación del articulo 144 en la sección de observaciones y copia de la resolución o acuerdo del MINEX.<br>
                        <br>
                        <h3>Guatemalteco nacionalizado</h3>
                        Adicional a los requisitos mencionados debe presentar certificado de guatemalteco naturalizado y copia de la resolución o acuerdo del MINEX.<br>
                        <br>
                        <h3>Más información</h3>
                        &ensp;&ensp;&ensp;*En caso de pérdida o extravío del DPI, debe presentar copia de una denuncia<br>
                        &ensp;&ensp;&ensp;&ensp;&nbsp;en el Ministerio Público o Policía Nacional Civil y la constancia de trámite de<br>
                        &ensp;&ensp;&ensp;&ensp;&nbsp;reposición del RENAP.<br>
                        &ensp;&ensp;&ensp;*Si es trámite de primer DPI no puede presentar la constancia de RENAP,<br>
                        &ensp;&ensp;&ensp;&ensp;&nbsp;deberá presentar el DPI original.<br>
                        &ensp;&ensp;&ensp;*La boleta de pago debe ser a nombre de la persona que realizará el trámite de<br>
                        &ensp;&ensp;&ensp;&ensp;&nbsp;pasaporte, incluido menores de edad.<br>
						<br>
                        <h2>Requisitos para renovar pasaporte</h2>
                        <h3>Mayores de Edad</h3>
                        1) DPI original y copia<br>
                        2) Boleto de Ornato vigente  (original y copia)<br>
                        3) Último pasaporte emitido<br>
                        4) Boleta de pago $50 en cualquier agencia BANRURAL<br>
                        <br>
                        <h3>Menores de edad</h3>
                        1) Certificado de nacimiento del menor de edad reciente<br>
                        2) DPI original y copia de ambos progenitores<br>
                        3) Boleto de Ornato del año en curso, de uno de los padres  (original y copia)<br>
                        4) Boleta de pago $50 en cualquier agencia BANRURAL (La boleta de pago tiene vigencia de un año)<br>
                        5) Pasaporte vencido<br>
                        &ensp;&ensp;&ensp;*El pago se realiza en quetzales, el equivalente a $50.<br>
                        &ensp;&ensp;&ensp;*Ambos padres deben acompañar al menor.<br>
                        <br>
                        <h3>Acompañado por un progenitor:</h3>
                        Además de todos los requisitos indicados anteriormente, se debe presentar:<br>
                        1) Autorización por escrito para la emisión de pasaporte, otorgada por el progenitor que no se haga presente, debe ser una carta poder con firmas legalizadas por abogado y notario.<br>
                        2) La carta poder con firmas legalizadas, para realizar el trámite de pasaporte de menores de edad cuando uno de los padres no puede estar presente, se aceptará hasta el 15 de octubre del 2019. Ya que se estará solicitando el original y fotocopia legalizada del testimonio del Mandato Especial con Representación, debidamente inscrito en el Archivo General de Protocolo. <br>
                        <br>
                        <h3>Cuando uno de los progenitores resida o se encuentre en el extranjero:</h3>
                        1) CERTIFICADO DE NACIMIENTO del menor de edad reciente.<br>
                        2) DOCUMENTO PERSONAL DE IDENTIFICACIÓN –DPI- del progenitor que realice el trámite.<br>
                        3) BOLETO DE ORNATO DEL AÑO EN CURSO (solamente del progenitor, original y fotocopia<br>
                        4) BOLETA DE PAGO $50 en cualquier agencia BANRURAL (La boleta de pago tiene vigencia de un año)<br>
                        5) Autorización de emisión de pasaporte, contenida Carta Consular original y certificada por el Ministerio de Relaciones Exteriores,  emitida durante los últimos seis meses acompañada de fotocopia del Pasaporte del progenitor que presento ante el Consulado para emitir la autorización.<br>
                        <br>
                        <h3>Cuando uno de los progenitores ha fallecido:</h3>
                        1) CERTIFICADO DE NACIMIENTO del menor de edad reciente.<br>
                        2) CERTIFICADO DE DEFUNCIÓN del progenitor ausente por fallecimiento (original emitido durante los últimos seis meses).<br>
                        3) DOCUMENTO PERSONAL DE IDENTIFICACIÓN –DPI- del progenitor que comparezca a realizar el trámite. (original y fotocopia)<br>
                        4) BOLETO DE ORNATO DEL AÑO EN CURSO (solamente del progenitor, original y fotocopia)<br>
                        5) BOLETA DE PAGO $50 en cualquier agencia BANRURAL<br>
                        <br>
                        <h3>Guatemalteco de origen (hijos de guatemaltecos nacidos fuera de Guatemala y que hacen su inscripción a través de un consulado)</h3>
                        Adicional a los requisitos mencionados debe presentar certificado de guatemalteco de origen con anotación del articulo 144 en la sección de observaciones y copia de la resolución o acuerdo del MINEX.<br>
                        <br>
                        <h3>Guatemalteco nacionalizado</h3>
                        Adicional a los requisitos mencionados debe presentar certificado de guatemalteco naturalizado y copia de la resolución o acuerdo del MINEX.<br>
                        <br>
                        <h3>Más información</h3>
                        &ensp;&ensp;&ensp;*En caso de pérdida o extravío del DPI, debe presentar copia de una denuncia<br>
                        &ensp;&ensp;&ensp;&ensp;&nbsp;en el Ministerio Público o Policía Nacional Civil y la constancia de trámite de<br>
                        &ensp;&ensp;&ensp;&ensp;&nbsp;reposición del RENAP.<br>
                        &ensp;&ensp;&ensp;*La boleta de pago debe ser a nombre de la persona que realizará el trámite de<br>
                        &ensp;&ensp;&ensp;&ensp;&nbsp;pasaporte, incluido menores de edad.<br>
                        &ensp;&ensp;&ensp;*Si perdió o le robaron el pasaporte debe presentar original de la denuncia<br>
                        &ensp;&ensp;&ensp;&ensp;&nbsp;emitida por el Ministerio Público o Policía Nacional Civil.<br>
                        &ensp;&ensp;&ensp;*En caso de pérdida o extravío del DPI, debe presentar:<br>
                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;1) Original de la Denuncia emitida por el Ministerio Público o Policía Nacional<br>
                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&nbsp;Civil,<br>
                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;2) Constancia de trámite de reposición de DPI del Renap y<br>
                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;3) Certificado de Nacimiento emitido por Renap, no más de seis meses de<br>
                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&nbsp;vigencia.<br>
                        &ensp;&ensp;&ensp;*Si el DPI se encuentra deteriorado, debe de presentar:<br>
                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;1) Original y fotocopia del DPI deteriorado<br>
                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;2) Constancia de trámite de reposición de DPI del Renap y<br>
                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;3) Certificado de Nacimiento emitido por Renap, no más de seis meses de<br>
                        &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&nbsp;vigencia.<br>
                        &ensp;&ensp;&ensp;*La boleta de pago debe ser a nombre de la persona que realizará el trámite de<br>
                        &ensp;&ensp;&ensp;pasaporte, incluido menores de edad.<br>
                        &ensp;&ensp;&ensp;*El pago se realiza en quetzales, el equivalente a $50.<br>
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