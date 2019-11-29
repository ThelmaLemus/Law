
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
<link href="../assets/js/plugins/nucleo/css/nucleo.css" rel=stylesheet/>
      <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel=stylesheet />
      <link href="../assets/css/argon-dashboard.css?v=1.1.0" rel=stylesheet />
      <link href="../assets/css/nvbr.css" rel=stylesheet />
      <link href="../assets/css/main.css" rel=stylesheet />


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
		<title>Carta de poder</title>
		<?php 
			$uid = $_GET['uid'];
			$pid = $_GET['pid'];
			if($pid != 0)
			{
				$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
				$query = "SELECT * FROM carta_de_poder WHERE pid = $pid";
				$result = pg_query($link, $query);
				$row = pg_fetch_row($result);
				$fecha_emision = trim($row[0]);
				$nombre_otorgante = trim($row[1]);
				$nombre_apoderado = trim($row[2]);
				$responsabilidades = trim($row[3]);
				$dpi_otorgante = trim($row[4]);
				$dpi_apoderado = trim($row[5]);
				$dpi_testigo1 = trim($row[6]);
				$dpi_testigo2 = trim($row[7]);
				$fecha_caducidad = trim($row[8]);
				$nombre_archivo = trim($row[11]);

				echo "
					<script>
						var fecha_emision = ".$fecha_emision.";
						var fecha_caducidad = ".$fecha_caducidad.";

						var fecha_emision_seteada = formatDate(fecha_emision);
						var fecha_caducidad_seteada = formatDate(fecha_caducidad);

						document.getElementById('inputdate').value = fecha_emision_seteada;
						document.getElementById('fecha_final').value = fecha_caducidad_seteada;

					</script>
				";
			}
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
				var nombre_archivo = document.getElementById("fname").value;
				var usuario = "<?php echo $uid ?>";
				var pid = "<?php echo $pid ?>";
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
						usuario : usuario,
						pid : pid,
						nombre_archivo : nombre_archivo
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
						window.location.href = 'Carta_de_poder.php?uid=<?php echo $uid ?>&pid=' + r;
					}, 2000);
						}
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
		var tipo = 2;
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
		var tipo = 2;
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
				<a class="list-group-item list-group-item-action" data-toggle="list" href="#profile" role="tab" onclick="setValues_cartadepoder('inputdate','nombre_a_dar', 'nombre_a_recibir', 'responsabilidades', 'DPI_otorgante', 'DPI_apoderado', 'DPI_testigo1', 'DPI_testigo2', 'fecha_final');">Vista previa</a>
			</div>
			<h2 class="docname">Carta de poder</h2>
			<div class="tab-content Lcontent">
				<div class="tab-pane active" id="home" role="tabpanel">
					<form class="form-row" method='post'  enctype="multipart/form-data">
						<div class="form-group col-md-6">
							<input type="text"name="iddpi1" value="DPI_otorgante" style="display:none">
							<input type="text"name="idname1" value="nombre_a_dar" style="display:none">
							<input type="text"name="label_id1" value="dpi1_IN" style="display:none">
							<input type="file" name="dpi1" class="custom-file-input" id="DPI01" aria-describedby="inputGroupFileAddon01"style="display:none"> 
							<label class="btn btn-primary" for="DPI01"><i class="fas fa-id-card" style="color:white" id="dpi1_IN">   DPI del otorgante</i></label>
						</div>
						<div class="form-group col-md-6">
							<input type="text"name="iddpi2" value="DPI_apoderado" style="display:none">
							<input type="text"name="idname2" value="nombre_a_recibir" style="display:none">
							<input type="text"name="label_id2" value="dpi1_IN" style="display:none">
							<input type="file" name="dpi2" class="custom-file-input" id="DPI02" aria-describedby="inputGroupFileAddon01"style="display:none"> 
							<label class="btn btn-primary" for="DPI02"><i class="fas fa-id-card" style="color:white" id="dpi2_IN">   DPI del apoderado</i></label>
						</div>
						<div class="form-group col-md-6">
							<input type="text"name="iddpi3" value="DPI_testigo1" style="display:none">
							<input type="text"name="idname3" value="" style="display:none">
							<input type="text"name="label_id3" value="dpi1_IN" style="display:none">
							<input type="file" name="dpi3" class="custom-file-input" id="DPI03" aria-describedby="inputGroupFileAddon01"style="display:none"> 
							<label class="btn btn-primary" for="DPI03"><i class="fas fa-id-card" style="color:white" id="dpi3_IN">   DPI del testigo1</i></label>
						</div>
						<div class="form-group col-md-6">
							<input type="text"name="iddpi4" value="DPI_testigo2" style="display:none">
							<input type="text"name="idname4" value="" style="display:none">
							<input type="text"name="label_id4" value="dpi1_IN" style="display:none">
							<input type="file" name="dpi4" class="custom-file-input" id="DPI04" aria-describedby="inputGroupFileAddon01"style="display:none"> 
							<label class="btn btn-primary" for="DPI04"><i class="fas fa-id-card" style="color:white" id="dpi4_IN">   DPI del testigo2</i></label>
						</div>
						<input type="submit" name="signAuth" class=" uploadbutton fas fa-upload" value="&#xf093; Cargar archivos">
					</form>
					<form class="form-row"  method='post'>
						<div class="form-group col-md-6">
							<label for="fname">Nombre archivo</label>
							<input type="text" class="form-control" name="fname" id= "fname" placeholder="Nombre archivo pdf" <?php if($pid != 0) {echo "value='$nombre_archivo'";}?>>
						</div>
						<div class="form-group col-md-6">
                            <!-- fecha_emision -->
							<label for="inputdate">Fecha</label>
							<input type="date" class="form-control" id="inputdate" placeholder="Fecha de emisión" <?php if($pid != 0) {echo "value='$fecha_emision'";}?>>
						</div>
						<div class="form-group col-md-6">
                        <!-- nombre_a_dar -->
							<label for="nombre_a_dar">Nombre</label>
							<input type="text" class="form-control" id="nombre_a_dar" placeholder="Nombre del otorgante" <?php if($pid != 0) {echo "value='$nombre_otorgante'";}?>>
						</div>
                        <div class="form-group col-md-6" id="templ">
                        <!-- nombre_a_recibir -->
							<label for="nombre_a_recibir">Nombre</label>
							<input type="text" class="form-control" id="nombre_a_recibir" placeholder="Nombre del apoderado" <?php if($pid != 0) {echo "value='$nombre_apoderado'";}?>>
						</div>
                        <!-- responsabilidades -->
                        <div class="form-group col-md-6" id="templ">
							<label for="responsabilidades">Responsabilidades</label>
							<textarea class="form-control" id="responsabilidades" placeholder="Responsabilidades"><?php if($pid != 0) {echo $responsabilidades;}?></textarea>
						</div>
                        <!-- DPIs -->
						<div class="form-group col-md-6">
							<label for="DPI_otorgante">DPI del otorgante</label>
							<input type="text" class="form-control" id="DPI_otorgante" placeholder="Número de DPI" <?php if($pid != 0) {echo "value='$dpi_otorgante'";}?>>
						</div>
                        <div class="form-group col-md-6">
							<label for="DPI_apoderado">DPI del apoderado</label>
							<input type="text" class="form-control" id="DPI_apoderado" placeholder="Número de DPI" <?php if($pid != 0) {echo "value='$dpi_apoderado'";}?>>
						</div>
                        <div class="form-group col-md-6">
							<label for="DPI_testigo1">DPI del Testigo 1</label>
							<input type="text" class="form-control" id="DPI_testigo1" placeholder="Número de DPI" <?php if($pid != 0) {echo "value='$dpi_testigo1'";}?>>
						</div>
                        <div class="form-group col-md-6">
							<label for="DPI_testigo2">DPI del Testigo 2</label>
							<input type="text" class="form-control" id="DPI_testigo2" placeholder="Número de DPI" <?php if($pid != 0) {echo "value='$dpi_testigo2'";}?>>
						</div>
                        <!-- SETEAR CANTIDAD DE DÍAS CON JS -->
                        <!-- fecha_final -->
                        <div class="form-group col-md-6">
							<label for="fecha_final">Fecha de caducidad</label>
							<input type="date" class="form-control" id="fecha_final" placeholder="Fecha de caducidad" <?php if($pid != 0) {echo "value='$fecha_caducidad'";}?>>
						</div>
					</form>
					<div type="" id="imprimir" onclick="converttoPDF()" class="btn btn-primary">Descargar y guardar</div>
				</div>
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
					<?php
					if($pid == 0)
						echo "setTodaysDate('inputdate');";
					?>

 
				</script>
				<div class="tab-pane" id="profile" role="tabpanel" style="text-align: justify;" allign="justify">
					<div class="ntext" id="ntext">
					<div class="right">
                            En Guatemala, al <mark id= "fecha_emision"></mark>
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
						    Yo <mark id= "nombre_otorgante"></mark> aquí PRESENTE y en plenas facultades mentales, <b>otorgo</b> al Sr(a) 
                            <mark id= "nombre_apoderado"></mark> poder especial amplio y suficiente para que pueda realizar las gestiones 
                            específicas encomendadas en mi nombre y representación. Las cuales son:
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
                            <mark id="responsabilidadesm"></mark>
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>                       
                        <div>
                            Y de la misma manera, pueda contestar y responder a las demandas o circunstancias que se deprendan de dicho encargo, atendiendo al reconocimiento de las firmas y de las personalidades aquí reflejadas, siempre y cuando se protejan mis derechos y se beneficien mis propios intereses.
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
                            A continuación, el otorgante, el apoderado y los dos testigos deben identificarse mediantes sus respectivos documentos de identidad:
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
                            Identificación del otorgante: <mark id= "DPI_otorgantem"></mark>
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
                            Identificación del Apoderado: <mark id= "DPI_apoderadom"></mark>
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
                            Identificación del Testigo 1: <mark id= "DPI_testigo1m"></mark>
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
                            Identificación del Testigo 2: <mark id= "DPI_testigo2m"></mark>
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
                            Esta carta tiene una vigencia de <mark id= "cantidad_diasm"></mark> días, comenzando hoy mismo tras el momento de plasmarse las firmas, y finalizando el próximo día <mark id= "fecha_finalm"></mark>.
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
                            Otorgante      Apoderado
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
                            <mark id="vacio"></mark>
                        </div>
                        <div>
                            Testigo 1      Testigo 2
                        </div>
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
														placeholder="Ingresa un comentario o respuesta."></textarea>
														<?php
										if($pid != 0)
										echo "<button type='button' name='actualizar' value='Actualizar' id='act' onclick='save();' class='btn btn-primary btn-sm publish-button'>Publicar</button>";
										?>
									</div>
									<div id="otroscomentarios">
										<div class="fperse" id="comentsdiv">
											<?php 
												$tipo = 2;
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