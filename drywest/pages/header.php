<?php
	session_start();
	error_reporting(0);
  $varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion == ''){
    echo "<script>
      alert('Debe inciar sesión para entrar');
      window.location= '../index.php';
    </script>";
	}
	$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error()); 
	$query = "SELECT uid FROM usuarios WHERE usuario ='$varsesion' ";
	$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
	$row = pg_fetch_row($result);
	$uid = $row[0];
	pg_free_result($result);
	pg_close($dbconn);

    // Include Composer autoloader if not already done.
    include 'Admin/vendor/autoload.php';
     
    // Parse pdf file and build necessary objects.
    $parser = new \Smalot\PdfParser\Parser();

	
?>

<!DOCTYPE html>
<!--
Template Name: Drywest
Author: <a href="https://www.os-templates.com/">OS Templates</a>
Author URI: https://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: https://www.os-templates.com/template-terms
-->
<html lang="">
<!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/ownCSS/header.css" rel="stylesheet" type="text/css" media="all">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<body id="top">
</head>
<body id="top">
<div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <div id="logo" class="fl_left">
        <h1><a href="dashboard.php">Lawbrary</a></h1>
      </div>
      <!-- ################################################################################################ -->
    </header>
  </div>
  <div class="wrapper row2">
    <nav id="mainav" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <ul class="clear">
        <li class="active"><a href="dashboard.php">Inicio</a></li>
        <li><a class="drop" href="#">Páginas</a>
          <ul>
            <li><a href="dashboard.php">Inicio</a></li>
            <li><a href="favorite.php">Favoritos</a></li>
            <li><a href="favorite.php">Más tarde</a></li>
            <li><a href="full-width.php">Full Width</a></li>
            <li><a href="sidebar-left.php">Sidebar Left</a></li>
            <li><a href="sidebar-right.php">Sidebar Right</a></li>
            <li><a href="basic-grid.php">Basic Grid</a></li>
          </ul>
        </li>
        <li><a class="drop" href="#">Opciones</a>
          <ul>
            <li><a href="#">Perfil</a></li>
            <li id = "upload"><a href="upload.php">Nuevo documento</a></li>
            <!-- <li><a class="drop" href="#">Level 2 + Drop</a>
              <ul>
                <li><a href="#">Level 3</a></li>
                <li><a href="#">Level 3</a></li>
                <li><a href="#">Level 3</a></li>
              </ul>
            </li> -->
            <li><a href="#">Level 2</a></li>
          </ul>
        </li>
        <li><a href="../layout/PHP/Salir.php">Cerrar sesión</a></li>
      </ul>
      <!-- ################################################################################################ -->
    </nav>
  </div>
  <?php
    if( $varsesion == "admin"){
      echo "<script>console.log('$varsesion');</script>";
      echo "<script>
      document.getElementById('upload').style.display = 'block';
      </script>";
    }else{
      echo "<script>console.log('$varsesion');</script>";
      echo "<script>
          document.getElementById('upload').style.display = 'none';
      </script>";
    }
  ?>
</body>