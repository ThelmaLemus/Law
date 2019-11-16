<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link rel="stylesheet" href="../style/foro.css">
	<?php include '../style/navbar.php' ?>
</head>
<body class="fondoI">
	<?php 
		function scanear_string($string)
		{
		 
		    $string = trim($string);
		 
		    $string = str_replace(
		        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
		        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
		        $string
		    );
		 
		    $string = str_replace(
		        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
		        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
		        $string
		    );
		 
		    $string = str_replace(
		        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
		        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
		        $string
		    );
		 
		    $string = str_replace(
		        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
		        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
		        $string
		    );
		 
		    $string = str_replace(
		        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
		        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
		        $string
		    );
		 
		    $string = str_replace(
		        array('ñ', 'Ñ', 'ç', 'Ç'),
		        array('n', 'N', 'c', 'C',),
		        $string
		    );
		 
			return $string;
		}

		// $prueba = "Estación Implícita Práctica Caminé";
		// echo "Antes, $prueba<br><br>";
		// echo scanear_string($prueba);
	?>

	<div class="foro">
		<div class="insideforum">
			<div class="fperse">
				<ul class="list-group list-group-flush posts">
					<li class="list-group-item">
						<div class="post">
							<div class="titlepost">
								<h4>Título del post</h4>
							</div>
							<div class="postcontent">
								Esta puede ser la pregunta.
							</div>
							<div class="postactions">
								<div class="actionsgroup">
									<div class="ashow far fa-comment"  data-toggle="collapse" data-target=".commentID" aria-expanded="true" aria-controls="commentID">
									</div>
									<!-- <div class="watch ashow fab fa-gratipay"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
									</div> -->
								</div>

							</div>
						</div>

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
					</li>
					<li class="list-group-item">
						<div class="post">
							<div class="titlepost">
								<h4>Título del post</h4>
							</div>
							<div class="postcontent">
								Esta puede ser la pregunta.
							</div>
							<div class="postactions">
								<div class="actionsgroup">
									<div class="ashow far fa-comment"  data-toggle="collapse" data-target=".commentID4" aria-expanded="true" aria-controls="commentID4">
									</div>
									<!-- <div class="watch ashow fab fa-gratipay"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
									</div> -->
								</div>

							</div>
						</div>

						<form class="collapse commentID4 card-body" aria-labelledby="headingOne" data-parent="#accordionExample">
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
					</li>
					<li class="list-group-item">
						<div class="post">
							<div class="titlepost">
								<h4>Título del post</h4>
							</div>
							<div class="postcontent">
								Esta puede ser la pregunta.
							</div>
							<div class="postactions">
								<div class="actionsgroup">
									<div class="ashow far fa-comment"  data-toggle="collapse" data-target=".commentID2" aria-expanded="true" aria-controls="commentID2">
									</div>
									<!-- <div class="watch ashow fab fa-gratipay"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
									</div> -->
								</div>

							</div>
						</div>

						<form class="collapse commentID2 card-body" aria-labelledby="headingOne" data-parent="#accordionExample">
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
					</li>
					<li class="list-group-item">
						<div class="post">
							<div class="titlepost">
								<h4>Título del post</h4>
							</div>
							<div class="postcontent">
								Esta puede ser la pregunta.
							</div>
							<div class="postactions">
								<div class="actionsgroup">
									<div class="ashow far fa-comment"  data-toggle="collapse" data-target=".commentID3" aria-expanded="true" aria-controls="commentID3">
									</div>
									<!-- <div class="watch ashow fab fa-gratipay"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
									</div> -->
								</div>

							</div>
						</div>

						<form class="collapse commentID3 card-body" aria-labelledby="headingOne" data-parent="#accordionExample">
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
					</li>
					
				</ul>
			</div>
			<div class="newpost">
				<form class="px-4 py-3 newpostform">
					<div class="form-group">
						<input type="text" name="postTitle" class="form-control" id="exampleDropdownFormEmail1" placeholder="Título de la pregunta">
					</div>
					<div class="form-group">
						<textarea type="text" rows="3" name="postContent" class="form-control textareapcontent" id="exampleDropdownFormPassword1" placeholder="Escribe tu duda."></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Publicar</button>
				</form>
				<!-- <div class="dropdown-divider"></div> -->
			</div>
		</div>
	</div>


</body>
</html>