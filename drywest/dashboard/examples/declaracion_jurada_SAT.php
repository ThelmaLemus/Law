
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
		<title>SAT - Declaración jurada</title>
		<?php 
			$uid = $_GET['uid'];
			$pid = $_GET['pid'];
			if($pid != 0)
			{
				$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
				$query = "SELECT * FROM declaracionjurada_sat WHERE pid = $pid";
				$result = pg_query($link, $query);
				$row = pg_fetch_row($result);
				$fecha_emision = trim($row[0]);
				$nombre_notario = trim($row[1]);
				$direccion = trim($row[2]);
				$nombre_solicitante = trim($row[3]);
				$dpi_solicitante = trim($row[4]);
				$nit_solicitante = trim($row[5]);
				$nombre_entidad = trim($row[6]);
				$nit_entidad = trim($row[7]);
				$direccion_entidad = trim($row[8]);
				$departamento_entidad = trim($row[9]);
				$municipio_entidad = trim($row[10]);
				$cantidad_del_pago = trim($row[11]);
				$fecha_del_pago = trim($row[12]);
				$numero_formulario_sat = trim($row[13]);
				$nombre_archivo = trim($row[15]);

				echo "<script> console.log(".$fecha_emision."); </script>";

				/* echo "
					<script>
						var fecha_emision2 = ".$fecha_emision.";
						var fecha_emision_seteada = formatDate(fecha_emision2);
						document.getElementById('fecha_emision').value = fecha_emision_seteada;

						var fecha_del_pago = ".$fecha_del_pago.";
						var fecha_del_pago_seteada = formatDate(fecha_del_pago);
						document.getElementById('fecha_del_pago').value = fecha_del_pago_seteada;
						
					</script>
				"; */
			}
			include "navbar.php";
			include "../assets/php/upload_dpi.php"; 
		?>
		<script>
			localStorage.setItem('busco', false);
 
			function converttoPDF()
			{
                
				//GUARDAR
				var fecha_emision = document.getElementById("fecha_emision").value;
				var notario_name = document.getElementById("notario_name").value;
				var direccion = document.getElementById("direccion").value;
				var affected_name = document.getElementById("affected_name").value;
                var affected_DPI = document.getElementById("affected_DPI").value;
                var affected_NIT = document.getElementById("affected_NIT").value;
                var nombre_entidad = document.getElementById("nombre_entidad").value;
                var nit_entidad = document.getElementById("nit_entidad").value;
                var direccion_entidad = document.getElementById("direccion_entidad").value;
				var departament_entidad = document.getElementById("departamento_entidad").value;
				var municipio_entidad = document.getElementById("municipio_entidad").value;
                var cantidad_del_pago = document.getElementById("cantidad_del_pago").value;
                var fecha_del_pago = document.getElementById("fecha_del_pago").value;
                var numero_formulario_SAT = document.getElementById("numero_formulario_SAT").value;
				var usuario = "<?php echo $uid ?>";
				var pid = "<?php echo $pid ?>";
				var nombre_archivo = document.getElementById("fname").value;
//				console.log(usuario);

				$.ajax({
					type: "POST",
					url: "guardartemplates/guardar_declaracionjurada_SAT.php",
					data:
					{
						fecha_emision : fecha_emision,
                        notario_name : notario_name,
                        direccion : direccion,
                        affected_name : affected_name,
                        affected_DPI : affected_DPI,
                        affected_NIT : affected_NIT,
                        nombre_entidad : nombre_entidad,
                        nit_entidad : nit_entidad,
                        direccion_entidad : direccion_entidad,
                        departament_entidad : departament_entidad,
                        municipio_entidad : municipio_entidad,
                        cantidad_del_pago : cantidad_del_pago,
                        fecha_del_pago : fecha_del_pago,
                        numero_formulario_SAT : numero_formulario_SAT,
                        usuario : usuario,
						nombre_archivo : nombre_archivo,
						pid : pid
					},
					success: function(r){
						//si el retorno al llamar el archivo es 1 lo guardo de lo contrario no lo guardo
						if(r > 0){
							alert("Agregado");

							//GUADAR COMENTARIOS
							<?php
								if($pid == 0)
									echo "savefromcero(r)";
								?>

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
							doc.save(nombre_archivo);

							setTimeout(() => {
						window.location.href = 'declaracion_jurada_SAT.php?uid=<?php echo $uid ?>&pid=' + r;
					}, 2000);
						}
						else
							console.log(r);
					},
				});
			};

			function clearContents(element) {
			element = '';
		}

		function save(){
		//le di un id al input y con la siguiente linea obtengo el valor del comentario
		comentario = document.getElementById("inputComentario").value;
		console.log(comentario);
		var pid = <?php echo $pid ?>;
		var tipo = 5;
		//LAS VARIABLES UID Y LID SON OBTENIDAS CON PHP Y YA ESTAN PARA USAR CON JS
		//lid -> ya los tengo con php
		//uid -> ya los tengo con php
		$.ajax({
			url: "guardar_comment.php",
			type: "POST",
			data:
			{
				pid : pid,
				tipo : tipo,
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

	function savefromcero(pid){
		//le di un id al input y con la siguiente linea obtengo el valor del comentario
		comentario = document.getElementById("inputComentario").value;
		console.log(comentario);
		var pid = pid;
		var tipo = 5;
		//LAS VARIABLES UID Y LID SON OBTENIDAS CON PHP Y YA ESTAN PARA USAR CON JS
		//lid -> ya los tengo con php
		//uid -> ya los tengo con php
		$.ajax({
			url: "guardar_comment.php",
			type: "POST",
			data:
			{
				pid : pid,
				tipo : tipo,
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
	}
		</script>
</head>
<body class="fondon">
	<div class="container container_form">

		<div class="letter">
			<div class="editop list-group" id="myList" role="tablist">
				<a class="list-group-item list-group-item-action active" data-toggle="list" href="#home" role="tab">Edición</a>
				<a class="list-group-item list-group-item-action" data-toggle="list" href="#profile" role="tab" onclick="setValues_declaracionjurada_SAT('fecha_emision','notario_name', 'direccion', 'affected_name', 'affected_DPI', 'affected_NIT', 'nombre_entidad', 'nit_entidad', 'direccion_entidad', 'departamento_entidad', 'municipio_entidad', 'cantidad_del_pago', 'fecha_del_pago', 'numero_formulario_SAT');">Vista previa</a>
			</div>
			<h2 class="docname">SAT - declaración jurada</h2>
			<div class="tab-content Lcontent">
				<form method='post' class="tab-pane active" id="home" >
					<div class="form-row" enctype="multipart/form-data">
						<div class="form-group col-md-6">
							<!-- <div class="row"> -->
								<input type="file" name="sig" class="custom-file-input" id="dpisgin" aria-describedby="inputGroupFileAddon01">
								<label class="btn btn-primary" for="dpisgin"><i class="fas fa-id-card" style="color:white">   DPI del solicitante</i></label>
								<input type="submit" name="signAuth" class=" uploadbutton fas fa-upload" value="&#xf093;">
							<!-- </div> -->
						</div>
						<div class="form-group col-md-6">
							<label for="fname">Nombre archivo</label>
							<input type="text" class="form-control" name="fname" id= "fname" placeholder="Nombre archivo pdf" <?php if($pid != 0) {echo "value='$nombre_archivo'";}?>>
						</div>
                    </div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="fecha_emision">Fecha de emisión</label>
							<input type="date" class="form-control" id="fecha_emision" placeholder="Fecha de emisión" <?php if($pid != 0) {echo "value='$fecha_emision'";}?>>
						</div>
						<div class="form-group col-md-6">
							<label for="notario_name">Nombre del notario</label>
							<input type="text" class="form-control" id="notario_name" value ='<?php if($pid == 0) {echo trim($user_full_name);} else {echo $nombre_notario;} ?>'>
						</div>
                    </div>
                    <div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputdate">Dirección del notario</label>
							<input type="text" class="form-control" id="direccion" placeholder="Dirección de oficina del notario" <?php if($pid != 0) {echo "value='$direccion'";}?>>
						</div>
						<div class="form-group col-md-6">
							<label for="notario_name">Nombre del solicitante</label>
							<input type="text" class="form-control" id="affected_name" placeholder="Nombre del solicitante" <?php if($pid != 0) {echo "value='$nombre_solicitante'";}?>>
						</div>
					</div>
					<div class="form-row">
					    <div class="form-group col-md-6" id="templ">
							<label for="affected_name">DPI del solicitante</label>
							<input type="text" class="form-control" id="affected_DPI" placeholder="Número de DPI del solicitante" <?php if($pid != 0) {echo "value='$dpi_solicitante'";}?>>
                        </div>
                        <div class="form-group col-md-6" id="templ">
							<label for="affected_name">NIT del solicitante</label>
							<input type="text" class="form-control" id="affected_NIT" placeholder="Número de NIT del solicitante" <?php if($pid != 0) {echo "value='$nit_solicitante'";}?>>
                        </div>
                    </div>
                    <div class="form-row">
						<div class="form-group col-md-6">
							<label for="dpi">Nombre de la entidad</label>
							<input type="text" class="form-control" id="nombre_entidad" placeholder="Nombre de la entidad propietaria" <?php if($pid != 0) {echo "value='$nombre_entidad'";}?>>
                        </div>
                        <div class="form-group col-md-6">
							<label for="dpi">NIT de la entidad</label>
							<input type="text" class="form-control" id="nit_entidad" placeholder="NIT de la entidad propietaria" <?php if($pid != 0) {echo "value='$nit_entidad'";}?>>
						</div>
                    </div>
                    <div class="form-row">
						<div class="form-group col-md-6">
							<label for="dpi">Dirección de la entidad</label>
							<input type="text" class="form-control" id="direccion_entidad" placeholder="Dirección de la entidad propietaria" <?php if($pid != 0) {echo "value='$direccion_entidad'";}?>>
                        </div>
                        <div class="form-group col-md-6">
							<label for="dpi">Departamento de la entidad</label>
							<input type="text" class="form-control" id="departamento_entidad" placeholder="Departamento de la entidad propietaria" <?php if($pid != 0) {echo "value='$departamento_entidad'";}?>>
						</div>
                    </div>
                    <div class="form-row">
						<div class="form-group col-md-6">
							<label for="dpi">Municipio de la entidad</label>
							<input type="text" class="form-control" id="municipio_entidad" placeholder="Municipio de la entidad propietaria" <?php if($pid != 0) {echo "value='$municipio_entidad'";}?>>
                        </div>
                        <div class="form-group col-md-6">
							<label for="dpi">Cantidad del pago</label>
							<input type="text" class="form-control" id="cantidad_del_pago" placeholder="Cantidad del pago" <?php if($pid != 0) {echo "value='$cantidad_del_pago'";}?>>
						</div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
							<label for="fecha_emision">Fecha del pago</label>
							<input type="date" class="form-control" id="fecha_del_pago" placeholder="Fecha del pago" <?php if($pid != 0) {echo "value='$fecha_del_pago'";}?>>
						</div>
						<div class="form-group col-md-6">
							<label for="dpi">Número del formulario SAT</label>
							<input type="text" class="form-control" id="numero_formulario_SAT" placeholder="Número del formulario SAT" <?php if($pid != 0) {echo "value='$numero_formulario_sat'";}?>>
						</div>
					</div>
					<div type="" id="imprimir" onclick="converttoPDF()" class="btn btn-primary">Descargar y guardar</div>
				</form>
				<script>

				<?php
				if($pid == 0)
					echo "setTodaysDate('fecha_emision')";
				?>
 
				</script>
				<div class="tab-pane" id="profile" role="tabpanel" style="text-align: justify;" allign="justify">
					<div class="ntext" id="ntext">
						<!-- <h2 class="docname" style="display: none;">Acta de declaración jurada</h2> -->
                        En la Ciudad de Guatemala, el <mark id="fecha_emisionm"></mark>, Yo: <mark id="nombre_notariom"></mark>, Notario, 
                    en ejercicio, constituido en mi oficina profesional ubicada en <mark id="direccionm"></mark>, de la ciudad de Guatemala, 
                    a requerimiento de <mark id="nombre_solicitantem"></mark>, quien se identifica con Documento Personal de 
                    Identificación –DPI- con Código Único de Identificación –CUI- <mark id="dpi_solicitantem"></mark>, extendido por 
                    el Registro Nacional de las Personas, del Departamento de Guatemala, Municipio de Guatemala, con Número de 
                    Identificación Tributaria (NIT) <mark id="NIT_solicitantem"></mark>, quien actúa en su calidad de Administrador 
                    Único y Representante Legal, de la entidad <mark id="nombre_entidadm"></mark>, personería que acredita con el acta 
                    notarial de nombramiento que está inscrito en el Registro Mercantil General de la República de Guatemala. La 
                    entidad <mark id="nombre_entidad2m"></mark>, es titular del número de identificación tributaria (NIT), 
                    <mark id="NIT_entidadm"></mark>, con domicilio fiscal en <mark id="direccion_entidadm"></mark>, Departamento de 
                    <mark id="departamento_entidadm"></mark>, Municipio de <mark id="municipio_entidadm"></mark>. Como Notario doy fe 
                    que tuve a la vista el documento con el cual se acredita la representación que se ejercita, la cual es amplia y 
                    suficiente de conformidad con la ley y a mi juicio para el presente acto; que el compareciente me asegura se de 
                    los datos de identificación personal anteriormente consignados, hallarse en el libre ejercicio de sus derechos 
                    civiles; que la representación que ejercita no le ha sido revocada, restringida o limitada de forma alguna, y que, 
                    en la calidad con que actúa, comparece para hacer constar su DECLARACIÓ JURADA, para lo cual procedo de la 
                    siguiente manera: PRIMERO: Manifiesta el requirente, BAJO SOLEMNE JURAMENTO DE LEY Y BIEN ENTERADO DE LAS PENAS 
                    RELATIVAS AL DELITO DE PERJURIO, si lo aquí declarado no fuera cierto: a) Que no ha recibido devolución en 
                    efectivo, vales fiscales, vales tributarios escalonados, bonos, ni compensación o acreditamiento, del pago 
                    efectuado indebidamente de Impuesto al Valor Agregado de Importación por <mark id="cantidad_del_pagom"></mark>, 
                    el <mark id="fecha_del_pagom"></mark>, con el formulario SAT guion <mark id="numero_formulario_SATm"></mark>, 
                    por parte de la Tesorería Nacional, ni del Ministerio de Finanzas Públicas a la fecha; b) Que no ha utilizado la 
                    cantidad solicitada, en sus declaraciones de impuestos presentadas a la Administración Tributaria, con el 
                    propósito de realizar auto compensación de oficio con cualquier impuesto a la fecha; c) Que no ha solicitado con 
                    anterioridad la devolución del pago indebido de Impuesto al Valor Agregado de Importación mencionado, a la 
                    Superintendencia de Administración Tributaria o cualquier dependencia del Ministerio de Finanzas Públicas a la 
                    fecha; y d) Que solicita la devolución del pago indebido de Impuesto al Valor Agregado de Importación por 
                    <mark id="cantidad_del_pago2m"></mark>. SEGUNDO: Continúa manifestando el 
                    requirente que se responsabiliza de lo manifestado en la presente declaración y de las consecuencias que esto 
                    conlleve y de su conocimiento de las penas relativas al delito de perjurio o falsedad. TERCERO: No habiendo nada 
                    más que hacer constar, se finaliza la presente en el mismo lugar y fecha, a las cuales se les adhieren los timbres 
                    de ley. Leo lo escrito al requirente, quien enterado de su contenido, objeto, validez y efectos legales, la ratifica, 
                    acepta y firma, haciéndolo a continuación el Notario, quien de todo lo actuado DOY FE. 
					</div>
					<div>&nbsp;</div>
					<div>&nbsp;</div>
					<div>&nbsp;</div>
					<div>&nbsp;</div>
					<br><br><br><br><br>
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
														placeholder="Ingresa un comentario o respuesta."></textarea>
														<?php
										if($pid != 0)
										echo "<button type='button' name='actualizar' value='Actualizar' id='act' onclick='save();' class='btn btn-primary btn-sm publish-button'>Publicar</button>";
										?>
									</div>
									<div id="otroscomentarios">
										<div class="fperse" id="comentsdiv">
											<?php 
												$tipo = 5;
												printComments($pid, $tipo);
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

function printComments($pid, $tipo){
	// echo"<h1>adios$p</h1>";
	$pid = $pid;
	$tipo = $tipo;
	
	$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
	$dbcc = $link or die('Could not connect: ' . pg_last_error());
	$queryo2 = "SELECT DISTINCT * FROM comentarios_documentos WHERE pid=$pid AND tipo=$tipo";
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