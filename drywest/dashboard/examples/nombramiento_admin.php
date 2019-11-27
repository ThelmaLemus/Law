
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
				$query = "SELECT * FROM nombramiento WHERE pid = $pid";
				$result = pg_query($link, $query);
				$row = pg_fetch_row($result);
				$nombre_entidad = trim($row[0]);
				$fecha_emision = trim($row[1]);
				$nombre_notario = trim($row[2]);
				$direccion = trim($row[3]);
				$nombre_solicitante = trim($row[4]);
				$dpi_solicitante = trim($row[5]);
				$numero_escritura = trim($row[6]);
				$notario_escritura = trim($row[7]);
				$fecha_autorizacion = trim($row[8]);
				$actividades = trim($row[9]);
				$numero_acta = trim($row[10]);
				$fecha_acta = trim($row[11]);
				$plazo_enaños = trim($row[12]);
				$nombre_archivo = trim($row[14]);

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
                var nombre_entidad = document.getElementById("nombre_entidad").value;
				var fecha_emision = document.getElementById("fecha_emision").value;
                var nombre_notario = document.getElementById("nombre_notario").value;
                var direccion = document.getElementById("direccion").value;
                var nombre_solicitante = document.getElementById("nombre_solicitante").value;
                var dpi_solicitante = document.getElementById("dpi_solicitante").value;
                var numero_escritura = document.getElementById("numero_escritura").value;
                var notario_escritura = document.getElementById("notario_escritura").value;
                var fecha_autorizacion = document.getElementById("fecha_autorizacion").value;
                var actividades = document.getElementById("actividades").value;
                var numero_acta = document.getElementById("numero_acta").value;
                var fecha_acta = document.getElementById("fecha_acta").value;
                var plazo_enaños = document.getElementById("plazo_enaños").value;
				var usuario = "<?php echo $uid ?>";
				var pid = "<?php echo $pid ?>";
				var nombre_archivo = document.getElementById("nombre_archivo").value;
				console.log(usuario);

				$.ajax({
					type: "POST",
					url: "guardartemplates/guardar_nombramiento.php",
					data:
					{
						nombre_entidad : nombre_entidad,
                        fecha_emision : fecha_emision,
                        nombre_notario : nombre_notario,
                        direccion : direccion,
                        nombre_solicitante : nombre_solicitante,
                        dpi_solicitante : dpi_solicitante,
                        numero_escritura : numero_escritura,
                        notario_escritura : notario_escritura,
                        fecha_autorizacion : fecha_autorizacion,
                        actividades : actividades,
                        numero_acta : numero_acta,
                        fecha_acta : fecha_acta,
                        plazo_enaños : plazo_enaños,
                        usuario : usuario,
						nombre_archivo : nombre_archivo,
						pid : pid
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
							doc.save(nombre_archivo);
						}
						else
							console.log(r);
					},
				});
            };
            
		</script>
</head>
<body class="fondon">
	<div class="container container_form">

		<div class="letter">

			<div class="editop list-group" id="myList" role="tablist">
				<a class="list-group-item list-group-item-action active" data-toggle="list" href="#home" role="tab">Edición</a>
				<a class="list-group-item list-group-item-action" data-toggle="list" href="#profile" role="tab"
					onclick="setValues_nombramiento('nombre_entidad','fecha_emision', 'nombre_notario', 'direccion', 'nombre_solicitante', 'dpi_solicitante', 'numero_escritura', 'notario_escritura', 'fecha_autorizacion', 'actividades', 'numero_acta', 'fecha_acta', 'plazo_enaños');"
				>Vista previa</a>
			</div>
			<h2 class="docname">Nombramiento de administrador</h2>
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
                    </div>
                    <div class="form-row">
						<div class="form-group col-md-6">
							<label for="notario_name">Nombre del documento</label>
							<input type="text" class="form-control" id="nombre_archivo" placeholder="Nombre para guardar el documento" <?php if($pid != 0) {echo "value='$nombre_archivo'";}?>>
						</div>
                    </div>
                    
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="fecha_emision">Fecha</label>
							<input type="date" class="form-control" id="fecha_emision" placeholder="Fecha de emisión" <?php if($pid != 0) {echo "value='$fecha_emision'";}?>>
						</div>
						<div class="form-group col-md-6">
							<label for="notario_name">Nombre</label>
							<input type="texxt" class="form-control" id="nombre_notario" value ='<?php if($pid == 0) {echo trim($user_full_name);} else {echo $nombre_notario;} ?>'>
						</div>
                    </div>
                    <div class="form-row">
						<div class="form-group col-md-6">
							<label for="direccion">Dirección</label>
							<input type="text" class="form-control" id="direccion" placeholder="Dirección" <?php if($pid != 0) {echo "value='$direccion'";}?>>
						</div>
						<div class="form-group col-md-6">
							<label for="notario_name">Nombre</label>
							<input type="texxt" class="form-control" id="nombre_solicitante" placeholder="Nombre del solicitante" <?php if($pid != 0) {echo "value='$nombre_solicitante'";}?>>
						</div>
					</div>
					<div class="form-row">
					    <div class="form-group col-md-6" id="templ">
							<label for="affected_name">DPI</label>
							<input type="texxt" class="form-control" id="dpi_solicitante" placeholder="Número de DPI del solicitante" <?php if($pid != 0) {echo "value='$dpi_solicitante'";}?>>
						</div>
						<div class="form-group col-md-6">
							<label for="dpi">Entidad</label>
							<input type="text" class="form-control" id="nombre_entidad" placeholder="Nombre de la entidad" <?php if($pid != 0) {echo "value='$nombre_entidad'";}?>>
						</div>
                    </div>
                    <div class="form-row">
					    <div class="form-group col-md-6" id="templ">
							<label for="affected_name">Número de escritura</label>
							<input type="texxt" class="form-control" id="numero_escritura" placeholder="Número de escritura" <?php if($pid != 0) {echo "value='$numero_escritura'";}?>>
						</div>
						<div class="form-group col-md-6">
							<label for="dpi">Notario de la escritura</label>
							<input type="text" class="form-control" id="notario_escritura" placeholder="Notario acreditador de escritura" <?php if($pid != 0) {echo "value='$notario_escritura'";}?>>
						</div>
                    </div>
                    <div class="form-row">
					    <div class="form-group col-md-6" id="templ">
							<label for="affected_name">Fecha de acreditación</label>
							<input type="date" class="form-control" id="fecha_autorizacion" placeholder="Fecha de acreditación de la escritura" <?php if($pid != 0) {echo "value='$fecha_autorizacion'";}?>>
						</div>
						<div class="form-group col-md-6">
							<label for="dpi">Actividades</label>
							<input type="text" class="form-control" id="actividades" placeholder="Actividades de la entidad" <?php if($pid != 0) {echo "value='$actividades'";}?>>
						</div>
                    </div>
                    <div class="form-row">
					    <div class="form-group col-md-6" id="templ">
							<label for="affected_name">Número de acta</label>
							<input type="text" class="form-control" id="numero_acta" placeholder="Número de acta" <?php if($pid != 0) {echo "value='$numero_acta'";}?>>
						</div>
						<div class="form-group col-md-6">
							<label for="dpi">Fecha de acta</label>
							<input type="date" class="form-control" id="fecha_acta" placeholder="Fecha de acreditación de acta" <?php if($pid != 0) {echo "value='$fecha_acta'";}?>>
						</div>
                    </div>
                    <div class="form-row">
					    <div class="form-group col-md-6" id="templ">
							<label for="affected_name">Plazo de posición en el puesto</label>
							<input type="text" class="form-control" id="plazo_enaños" placeholder="Plazo en años" <?php if($pid != 0) {echo "value='$plazo_enaños'";}?>>
                        </div>
                    </div>
					<div type="" id="imprimir" onclick="converttoPDF();" class="btn btn-primary">Descargar y guardar</div>
				</form>
				<script>

				setTodaysDate('fecha_emision');
 
				</script>
				<div class="tab-pane" id="profile" role="tabpanel" style="text-align: justify;" allign="justify">
					<div class="ntext" id="ntext">
                        
						<!-- <h2 class="docname" style="display: none;">Acta de declaración jurada</h2> -->
                        <div>ACTA NOTARIAL QUE DOCUMENTA NOMBRAMIENTO DE ADMINISTRADOR ÚNICO Y REPRESENTANTE LEGAL DE 
                        LA ENTIDAD <mark id="nombre_entidadm"></mark></div>
                        En la ciudad de Guatemala, el <mark id="fecha_emisionm"></mark>, Yo, 
                        <mark id="nombre_notariom"><?php echo $user_full_name ?></mark>, Notario, encontrándome constituido en mi oficina 
                        profesional ubicada en la <mark id="direccionm"></mark>, soy requerido por <mark id="nombre_solicitantem"></mark>, 
                        quien se identifica con el Documento Personal de Identificación -DPI- con código único de 
                        identificación -CUI- <mark id="dpi_solicitantem"></mark> extendido por el Registro Nacional de las Personas 
                        de la República de 
                        Guatemala; a efecto de hacer constar su nombramiento como ADMINISTRADOR ÚNICO Y REPRESENTANTE LEGAL 
                        de la entidad <mark id="nombre_entidad2m"></mark>, para lo cual procedo de la siguiente manera: PRIMERO: 
                        El requirente me pone a la vista el primer testimonio de la escritura constitutiva de la entidad 
                        <mark id="nombre_entidad3m"></mark> que lleva el número <mark id="numero_escrituram"></mark>, autorizada en
                        la Ciudad de Guatemala, por <mark id="notario_escrituram"></mark>, con fecha <mark id="fecha_autorizacionm"></mark>. 
                        La Sociedad 
                        se encuentra debidamente inscrita en el Registro Mercantil General de la República. En la escritura 
                        constitutiva relacionada, aparecen los 
                        pasajes que copiados en su parte conducente literalmente dicen: “QUINTA: DEL OBJETO SOCIAL: El objeto 
                        para el cual se organiza esta sociedad y que se podrá llevar a cabo dentro o fuera de la República de 
                        Guatemala, es el siguiente pero no limitado a: La Sociedad tiene por objeto: <mark id="actividadesm"></mark>  
                        g) Cualquier otra actividad que se considere subsidiaria, conexa o complementaria de las 
                        anteriores o coadyuve directa o indirectamente al logro de las mismas y a la realización de toda clase 
                        de actos o contratos de cualquier índole permitidos por la ley y que sean necesarios, convenientes o 
                        tienda al desarrollo y desenvolvimiento de las operaciones sociales. La anterior descripción del objeto 
                        social debe entenderse en su sentido más amplio y general en beneficio de la sociedad y de ninguna forma 
                        en sentido limitativo. Para el desarrollo de si objeto la sociedad podrá actuar, participar, otorgar en 
                        todo acto, negocio jurídico, operación o contrato que sea propio a las actividades de su giro con plena 
                        capacidad jurídica para ejercer derechos y contraer obligaciones, sin más limitaciones que las establecidas 
                        en las leyes del país. En todo caso para la realización de actividades o servicios ajenos al objeto arriba 
                        indicado, se requerirá de facultad especial otorgada por la asamblea general de accionistas. (…) DECIMA 
                        SEGUNDA: DEL ÓRGANO DE ADMINISTRACIÓN: La Asamblea General de Accionistas, podrá optar entre encargar la 
                        administración, dirección y vigilancia de la sociedad a un Administrador Único o a un Consejo de 
                        Administración, (…) El Administrador Único, o bien los miembros del Consejo, de Administración durarán de 
                        uno a tres años en el ejercicio de sus cargos, según lo determine la Asamblea de Accionistas al efectuar 
                        su elección. En todo caso, continuarán en funciones hasta que sus sucesores sean electos y tomen posesión 
                        de los cargos. Tanto el Administrador Único como los consejeros, pueden o no ser accionistas y podrán ser 
                        reelectos, confirmados o renovados libremente en sus cargos. Los consejeros podrán hacerse representar entre 
                        sí con voz y voto mediante un mandato, carta poder simple, facsímil, telex, etc. (…) DECIMA TERCERA: 
                        FACULTADES DEL ÓRGANO DE ADMINISTRACIÓN: Tanto el Administrador Único como el Consejo de Administración, 
                        según la forma de administración por la que optare la Asamblea General de Accionistas, además de cualesquiera 
                        otras facultades que le confiere el contrato social y las disposiciones legales o reglamentarias aplicables, 
                        tendrá las siguientes facultades y atribuciones: A) Cumplir y ejecutar las disposiciones de la Asamblea 
                        General de Accionistas;  B) Dar a la empresa la organización que convenga y garantice su mejor organización; 
                        C) Dirigir la política administrativa, comercial y financiera de la sociedad; D) Nombrar y remover al Gerente 
                        General y los demás gerentes que consideren necesarios, fijar su remuneración y crear los puestos de trabajo 
                        dentro de la sociedad, E) Acordar el otorgamiento de poderes generales o especiales de la sociedad, sin 
                        perjuicio de la facultad  que esta escritura le confiere al Presidente del Consejo para otorgar dichos poderes; 
                        F) Convocar a las Asambleas Generales de Accionistas y proponer su agenda; G) Tomar las medidas necesarias para 
                        que la contabilidad de la sociedad sea llevada conforme a la ley, que se practique anualmente al finalizar el 
                        ejercicio el Inventario, Balance General de Cuentas, Estado de Pérdidas y Ganancias, así como los demás estados 
                        y documentos financieros de la sociedad: H) Formular en coordinación con el Gerente el informe anual que se 
                        someterá a la Asamblea Anual Ordinaria de Accionistas; I) Preparar el proyecto de distribución de utilidades 
                        para someterlo a la Asamblea de Accionistas oportunamente; J) Encomendar funciones específicas o de supervisión 
                        a cualesquiera de los miembros del Órgano de Administración si lo hubiere, así como nombrar a otros funcionarios 
                        o dignatarios que no necesariamente sean miembros del Consejo de Administración, asignándoles atribuciones y 
                        funciones determinadas; K) Establecer la responsabilidad por el manejo de fondos en la forma que convenga a los 
                        intereses sociales; L)  Llevar libro de actas para asentar las deliberaciones y resoluciones de las Asambleas 
                        de Accionistas y del Administrador Único o del Consejo, así como los demás registros que sean convenientes, 
                        necesarios o dispuestos por la Asamblea de Accionistas, también se podrá hacer constar en acta notarial, el 
                        acta de cualquier Asamblea de Accionistas, del Administrador Único o Del Consejo de Administración; M) Resolver 
                        en forma genérica o específica sobre la contratación de préstamos de cualquier tipo, así como el gravamen de 
                        bienes o derechos y el otorgamiento de fianzas o garantías en nombre de la sociedad; y N) Cuantas otras 
                        facultades les corresponda o les haya sido asignados por los accionistas o convenga a los intereses de la 
                        sociedad de acuerdo con el contrato social y a las leyes o reglamentos aplicables.(…) DECIMA CUARTA: ORGANIZACIÓN 
                        DEL CONSEJO DE ADMINISTRACIÓN: Cuando se hubiere optado por encomendar el gobierno de la sociedad a un Consejo 
                        de Administración, su Presidente tendrá además de las obligaciones y facultades que se deriven de la escritura 
                        social o de la ley la siguiente: A) Cumplir y hacer que se cumpla las resoluciones del Consejo de Administración; 
                        B) Vigilar la marcha de las operaciones sociales; C) Presidir las Asambleas de Accionistas y las sesiones del 
                        Consejo de Administración sobre la marcha de las obligaciones sociales;  D) Ejercer la representación legal de 
                        la sociedad, sin perjuicio de las facultades del gerente, si lo hubiere; E) Constituir mandatarios judiciales 
                        y delegarles la representación legal de la sociedad y en caso que a su juicio sean de urgencia, otorgar 
                        revocaciones de poderes o mandatos generales o especiales de la sociedad, debiendo informar de lo actuado al 
                        Consejo de Administración de su próxima sesión; y F) Las demás que disponga el Consejo de Administración, al 
                        Vicepresidente le corresponderá sustituir en funciones, obligaciones y atribuciones al Presidente sin necesidad 
                        de ninguna declaratoria especifica en cualquier caso de su ausencia o inhabilidad. El secretario redactará las 
                        actas, afirmándolas juntamente con el Presidente y cumplirá las demás funciones que le sean atribuidas por el 
                        Presidente o por el Consejo. (…) DECIMA QUINTA: DEL ADMINISTRADOR UNICO: Cuando se hubiere optado por encomendar 
                        el gobierno de la sociedad a un Administrador, a este le corresponderán todas las funciones obligaciones y 
                        atribuciones especificadas en las dos cláusulas anteriores o en otras cláusulas.”. SEGUNDO: Tengo a la vista 
                        el acta número <mark id="numero_actam"></mark> de Asamblea General Ordinaria y Totalitaria de 
                        Accionistas de la entidad <mark id="nombre_entidad4m"></mark>, celebrada en la ciudad de Guatemala, el día 
                        <mark id="fecha_actam"></mark>, la que en el punto sexto, literalmente estipula: “SEXTO: Acto seguido se 
                        hacen las propuestas y después de una amplia deliberación los accionistas por unanimidad, RESUELVEN: Designar 
                        nuevamente a <mark id="nombre_solicitante2m"></mark>, como ADMINISTRADOR ÚNICO y REPRESENTANTE LEGAL de la entidad 
                        <mark id="nombre_entidad5m"></mark>, por un plazo de <mark id="plazo_enañosm"></mark> años, contado a partir de la 
                        presente fecha, 
                        facultándole para que comparezca a formalizar su nombramiento como legalmente corresponde.”. TERCERO: No 
                        habiendo nada más que hacer constar y para que sirva de legal nombramiento como ADMINISTRADOR ÚNICO Y 
                        REPRESENTANTE LEGAL de la entidad <mark id="nombre_entidad6m"></mark> a <mark id="nombre_solicitante3m"></mark>, 
                        extiendo, 
                        numero, sello y firmo la presente acta en el mismo lugar y fecha; haciendo constar que se le adhieren a la primera 
                        hoja un timbre fiscal del 
                        año en curso. Así también, se 
                        adhieren cuatro timbres fiscales  del año en curso, a cada hoja. Leído lo escrito al requirente y enterado de 
                        su contenido, objeto, validez y 
                        demás efectos legales, así como de la obligación de registro respectiva;  lo acepta, ratifica y firma juntamente 
                        con el Infrascrito Notario que de todo lo relacionado DOY FE.


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