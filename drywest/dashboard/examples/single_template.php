
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
		<title>Single_Template</title>
		<?php 
			$uid = $_GET['uid'];
			$pid = $_GET['pid'];
			if($pid != 0)
			{
				$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
				$query = "SELECT * FROM autenticacion_de_firma WHERE pid = $pid";
				$result = pg_query($link, $query);
				$row = pg_fetch_row($result);
				$fecha = trim($row[0]);
				$nombre_notario = trim($row[1]);
				$nombre_solicitante = trim($row[2]);
				$dpi = trim($row[3]);
				$nombre_archivo = trim($row[6]);

				echo "
					<script>
						console.log(".$fecha.");
						var fecha_emision = ".$fecha.";
						
						var fecha_emision_seteada = formatDate(fecha_emision);
						
						document.getElementById('inputdate').value = fecha_emision_seteada;

						var tipo = 1;
						
					</script>
				";
			}
			// $pid = $_GET['pid'];
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
				var nombre_notario = document.getElementById("notario_name").value;
				var nombre_solicitante = document.getElementById("affected_name").value;
				var dpi_solicitante = document.getElementById("dpi").value;
				//var pid = $pid;
				var usuario = "<?php echo $uid; ?>";
				var pid = "<?php echo $pid; ?>";
//				console.log(usuario);
				var nombre_archivo = document.getElementById("fname").value;
				if(nombre_archivo == "" || nombre_archivo == null){
					alert("El archivo debe tener un nombre para guardarlo.");
				}else{
					$.ajax({
						type: "POST",
						url: "guardartemplates/guardar_autoirzaciondefirma.php",
						data:
						{
							fecha_emision : fecha_inicio,
							nombre_notario : nombre_notario,
							nombre_solicitante : nombre_solicitante,
							dpi_solicitante : dpi_solicitante,
							usuario : usuario,
							nombre_archivo: nombre_archivo,
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
								doc.save(nombre_archivo + '.pdf');
								
		setTimeout(() => {
						window.location.href = 'single_template.php?uid=<?php echo $uid ?>&pid=' + r;
					}, 2000);
							}
							else
							console.log("error" + r);
						},
					});
				}

			};

		function clearContents(element) {
			element = '';
		}

		function save(){
		//le di un id al input y con la siguiente linea obtengo el valor del comentario
		comentario = document.getElementById("inputComentario").value;
		console.log(comentario);
		var pid = <?php echo $pid ?>;
		var tipo = 1;
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
		var tipo = 1;
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
				<a class="list-group-item list-group-item-action" data-toggle="list" href="#profile" role="tab"
					onclick="setValues('inputdate','notario_name', 'affected_name', 'dpi');"
				>Vista previa</a>
			</div>
			<h2 class="docname">Autenticación de firma</h2>
			<div class="tab-content Lcontent">
				<form method='post' class="tab-pane active" id="home" role="tabpanel" enctype="multipart/form-data">
					<div class="form-row">
						<div class="form-group col-md-6">
							<!-- <div class="row"> -->
								<input type="file" name="img" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
								<label class="btn btn-primary " for="inputGroupFile01"><i class="fas fa-id-card" style="color:white">   DPI del solicitante</i></label>
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
							<label for="inputdate">Fecha</label>
							<input type="date" class="form-control" id="inputdate" placeholder="Fecha de emisión" <?php if($pid != 0) {echo "value='$fecha'";}?>>
						</div>
						<div class="form-group col-md-6">
							<label for="notario_name">Nombre</label>
							<input type="texxt" class="form-control" id="notario_name" value ='<?php if($pid != 0) {echo trim($nombre_notario);} else {echo trim($user_full_name);}?>'>
						</div>
					</div>
					<div class="form-row">
					<div class="form-group col-md-6" id="templ">
							<label for="affected_name">Nombre</label>
							<input type="texxt" class="form-control" id="affected_name" placeholder="Nombre del solicitante" <?php if($pid != 0) {echo "value='$nombre_solicitante'";}?>>
						</div>
						<div class="form-group col-md-6">
							<label for="dpi">DPI</label>
							<input type="text" class="form-control" id="dpi" placeholder="Número de DPI" <?php if($pid != 0) {echo "value='$dpi'";}?>>
						</div>
					</div>
					<div type="" id="imprimir" onclick="setValues('inputdate','notario_name', 'affected_name', 'dpi'); converttoPDF()" class="btn btn-primary">Descargar y guardar</div>
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
					<?php
					if($pid == 0)
						echo "setTodaysDate('inputdate');";
					?>
 
				</script>
				<div class="tab-pane" id="profile" role="tabpanel" style="text-align: justify;" allign="justify">
					<div class="ntext" id="ntext">
						<h2 class="docname" style="display: none;">Autenticación de firma</h2>
						En la ciudad de Guatemala, el <mark id="fecha_emision"></mark>, YO: <mark id="name1"></mark>, que me identifico con el 
						Documento Personal de Identificación con Código Único de Identificación <mark id="DPIN"><?php echo $user_dpi?></mark>, como Notario DOY FE: Que la 
						firma que antecede es AUTENTICA por haber sido reconocida en mi presencia por <mark id="name2"></mark>,
						 quién se identifica con el Documento Personal de Identificación con Código Único de Identificación 
						<mark id= "DPI"></mark>, extendido por el Registro Nacional de las Personas de la República de Guatemala.
						El signatario firma la presente acta de legalización.
					</div>
					<div>&nbsp;</div>
					<div>&nbsp;</div>
					<div>&nbsp;</div>
					<div>&nbsp;</div>
					<br><br><br><br><br>
					<div class="footer-L">
						<div class="left">F. del Notario</div>
						<div class="right">ANTE MÍ: Firma y sello</div>
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
												$tipo = 1;
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

	var search = function(){
		//voy a buscar la informacion del comentario ya existente si este la tiene
		$.ajax({
			url: "buscar_comment.php?pid=" + pid + "&tipo=" + tipo,
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
/* 
	//document.ready espera hasta que la pantalla este lista para actuar por asi decirlo
	$(document).ready(function(){
		//llamo desde el inicio a que busque comentario
		//search(); */
		$("#act").on('click',function(){
			//capturo cuando hacen click en el input
			save();
		//	search();
		});
/* 	 });
 */
		 
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