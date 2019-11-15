<?php
	session_start();
	error_reporting(0);

	$varsesion = $_SESSION['usuario'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="header.js"></script>
</head>
<body class="fondo">
	<form action="validar_index.php" method="post">
		<header class="">
			<div class="wrapper">
				<div class="logo">
					Lawbrary
				</div>
				<nav>
					<input type="text" name="usuario" placeholder="Usuario" class="a">
		 			<input type="password" name="contraseña" placeholder="Contraseña" class="a">
		 			<input type="submit" name="Ingresar" value="Ingresar" class="btn-enviar a">
				</nav>
			</div>

		</header>

		<section class="row container">
			<div class="fc col-xs-12 col-sm-12 col-md-9 col-lg-7">
				<br> <br>
				<!-- <center><img src="download.png" height="350" width="500" class="contenido"></center> -->
			</div>
			<div class="form sc col-xs-12 col-sm-12 col-md-3 col-lg-5">
				<br> <br><br> <br><br> 
				<input type="text" name="Nombre" placeholder="Nombre" class="r"><br>
		 		<input type="text" name="Apellido" placeholder="Apellido" class="r"><br>
		 		<input type="text" name="Correo" placeholder="Correo" class="r"><br>
		 		<input type="text" name="Usuario" placeholder="Usuario" class="r"><br>
		 		<input type="password" name="Contra" placeholder="Contraseña" class="r"><br>
		 		<input type="submit" value="Registrar" name="Registrar" class="btn-enviar r">
			</div>
		</section>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</form>
</body>
<style type="text/css">
	*{margin:0; padding:0;}

	body{
		background: #EEEEEE;
	}
	.fondo{
		background-image: url(style/images/ImagenIndex.png);
		background-size: 100%;

	}
	.wrapper{
		width: 90%;
		max-width: 1000px;
		margin:auto;
		overflow: hidden;
	}
	header{
		width: 100%;
		overflow: hidden;
		background: #3E2723;
		margin-bottom:2px;
	}


	header .logo{
		color:#f2f2f2;
		font-size: 40px;
		line-height: 100px;
		float:left;
	}

	header nav{
		float: right;
		line-height: 100px;
	}

	header nav a{
		position: fixed;
		display: inline-block;
		color: #fff;
		text-decoration: none;
		padding: 10px 20px;
		line-height: normal;
		font-size: 20px;
		font-weight: bold;
	}
	header nav .a{
		display: inline;
		text-decoration: none;
		padding: 5px 5px;
		line-height: normal;
		font-size: 15px;
		font-weight: bold;
	}


	header nav a:hover{
		background: #f56f3a;
		border-radius: 50px;
	}

	.header2 {
		position: fixed;
		height: 100px;
		width: 100%;
		overflow: hidden;
		background: #252932;
	}

	.header2 .logo{
		line-height: 100px;
		font-size:30px;

	}

	.header2 nav{
		line-height: 100px;
	}

	/*.contenido{
		padding-top: 110px;
	}*/
	.contenido p{
		margin-bottom: 1em;
	}

	.form .r{
		padding: 5px 5px;
		line-height: normal;
		font-size: 15px;
		font-weight: bold;
		margin-top: 5px;
		width: 70%;
		border-radius: 7px;
		float: right;
	}
	@media screen and (max-width: 950px){
		header .logo, header nav{
			width: 100%;
			text-align:center;
			line-height: 100px;
		}

		.header2{
			line-height: auto;
		}

		.header2 .logo, .header2 nav{
			line-height: 50px;
		}
	}
</style>
</html>