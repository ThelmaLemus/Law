<?php
	session_start();
	error_reporting(0);
	$varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion == ''){
		echo "<body class='fondo'>";
		echo "<script>
               	alert('Debe inciar sesión para entrar');
       			window.location= '../index.php'
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
    include '../Admin/vendor/autoload.php';
     
    // Parse pdf file and build necessary objects.
    $parser = new \Smalot\PdfParser\Parser();

	
?>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="../style/css/bootstrap.css" >
		<!-- <link href="../css/estilo.css" rel="stylesheet" type="text/css"> -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="../style/js/bootstrap.min.js" ></script>
		<link href="../style/estilos.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="../style/fonts.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<link rel="icon" type="imgage/jpeg" href="../style/images/Ticon.png" sizes="32x32">
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="../style/main.js"></script>
		<meta name="viewport" content="width=device-width, user-scalable= no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
		<header>
			<div class="menu_bar">
				<a href="#" class="bt-menu"><span class="icon-menu"></span>Menú</a>
			</div>
				<nav>
					<ul>
						<li>
							<a href="../Inicio/Inicio.php" class="a"><span class="icon-home"></span>Inicio
							</a>
						</li>
						<li class="submenu">
							<a href="../Biblioteca/Biblioteca.php" class="a"><span class="icon-books"></span>Mi biblioteca
							</a>
						</li>
						<li class="submenu">
							<a href="../Busquedas/Busquedas.php" class="a"><span class="icon-search"></span>Búsquedas
							</a>
						</li>
							
						<li>
							<a href="../perfil/Perfil.php" class="a"><span class="icon-user"></span>Mi perfil
							</a>
						</li>
						<?php
							if($varsesion=='admin'){
								echo "<li>
										<a href='../Admin/upload.php' class='a'>Nuevo documento</a>
									</li>";
							}
						?>
						<li>
							<a href="../Inicio/Salir.php" class="a"><span class="icon-exit"></span>Cerrar sesión
							</a>
						</li>
					</ul>
				</nav>
		</header>
</head>
<script type="text/javascript">
    function funcionFavorito(p1,idFile,idUser) {
        if ($('#'+p1).is(':checked')) {
			$('#a'+p1).toggleClass('fas fa-star');
            // alert( "Checked" );
            $.ajax({
            url: '../Categorias/crud.php',
            type: 'POST',
            data: {tipo:'fav',idF:idFile,idU:idUser,is:1},
                success: function(data){
                	if (data == "Repetido"){
                    	alert(data);	
                	}
                    location.reload();
                }
        	});
        }else{
        	$('#a'+p1).toggleClass('far fa-star');
            // alert( "No Checked" );
            $.ajax({
            url: '../Categorias/crud.php',
            type: 'POST',
            data: {tipo:'fav',idF:idFile,idU:idUser,is:0},
                success: function(data){
                    if (data == "No existe"){
                    	alert(data);	
                	}
                    location.reload();
                }
        	});
        }
    }
    function funcionBookmark(p1,idFile,idUser) {
        if ($('#'+p1).is(':checked')) {
                alert( "Checked" );
            }else{
                alert( "No Checked" );
            }
    }
    function funcionVerMasTarde(p1,idFile,idUser) {
        if ($('#'+p1).is(':checked')) {
			$('#a'+p1).toggleClass('fas fa-clock');
            // alert( "Checked" );
            $.ajax({
            url: '../Categorias/crud.php',
            type: 'POST',
            data: {tipo:'ver',idF:idFile,idU:idUser,is:1},
                success: function(data){
                    if (data == "Repetido"){
                    	alert(data);	
                	}
                    location.reload();
                }
        	});
        }else{
        	$('#a'+p1).toggleClass('far fa-clock');
            // alert( "No Checked" );
            $.ajax({
            url: '../Categorias/crud.php',
            type: 'POST',
            data: {tipo:'ver',idF:idFile,idU:idUser,is:0},
                success: function(data){
                    if (data == "No existe"){
                    	alert(data);	
                	}
                    location.reload();
                }
        	});
        }
    }


   
</script>
