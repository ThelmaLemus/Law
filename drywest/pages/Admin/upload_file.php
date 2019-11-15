<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Nuevo documento</title>
	<?php include "../style/navbar.php" ?>
<body>

<?php
	error_reporting(0);
	function eliminar_tildes($cadena){
 
    //Codificamos la cadena en formato utf8 en caso de que nos de errores
    //$cadena = utf8_encode($cadena);
 
    //Ahora reemplazamos las letras
    $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $cadena
    );
 
    $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $cadena );
 
    $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $cadena );
 
    $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $cadena );
 
    $cadena = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $cadena );
 
    $cadena = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $cadena
    );
 
    return $cadena;
}

	if(isset($_FILES['file'])){
		$file = $_FILES['file'];

		//File properties
		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];

		//Work out the file extension
		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));

		// print_r($file_ext);

		$allowed = array('txt', 'pdf');

		//SE GUARDA EL ARCHIVO EN UNA CARPETA LLAMADA DOCUMENTOS
		if(in_array($file_ext, $allowed)){
			if($file_error === 0){
				$file_destination = 'Documentos/' . $file_name;

				if(move_uploaded_file($file_tmp, $file_destination)){

					$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

 					$nombre=$_POST['nombre'];
					$categoria=$_POST['categoria'];
					$tipo = $_POST['tipo'];
					$clave = eliminar_tildes($nombre);

		 			$query = "INSERT INTO leyes(nombre, categoria, contenido, tipo, clave) VALUES ('$nombre', '$categoria', '$file_destination', '$tipo', '$clave')";
					$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());

					echo "Ingresado correctamente
						<script>
							window.location= '../../../dashboard';
						</script>
					";					

				} else {
					echo "Intentalo de nuevo";
				}
			} else {
				echo "Ocurrió un error, intentalo de nuevo";
			}
		} else {
			echo "No es del tipo aceptado";
		}

		// Include Composer autoloader if not already done.
	include 'vendor/autoload.php';

	//Funcion para buscar sugerencias de artículos
	function buscar($texto, $palabra, $inicio, $final, $i, $pagina, $lid, $dbconn)
    {
    	$articulo = "culo";
    	$articulos = "culos";
		$inicio = (stripos($texto, ($articulo . " " . $i)));
		$c_art = 1;
		
		if($inicio === false) {
			$inicio = stripos($texto, ($articulos . " " . $i));
			$c_art = 2;
			if($inicio === false) {
				return $i;
			}
		}

		if($c_art == 1)
	        $final = stripos($texto, ($articulo . " " . ($i+1)), $inicio);
	    else
	    {
	    	$primer_espacio = strrpos($texto, " ", $inicio);
	    	$segundo_espacio = strrpos($texto, " ", $primer_espacio);
	    	$punto = strrpos($texto, "", $segundo_espacio);

	    	$nuevo_numero = (int)(substr($texto, $segundo_espacio, ($segundo_espacio-$punto)));

	    	$i = $nuevo_numero;

	    	$final = stripos($texto, ($articulo . " " . ($i+1)), $inicio);
	    }

		if($final === false) 
		{
			$final = stripos($texto, ($articulos . " " . ($i+1)), $inicio);
			if($final ===false) 
			{
			    $substring = substr($texto, $inicio);
			} else {
				$substring = substr($texto, $inicio, ($final - $inicio -2));
			}
		} else {
			    $substring = substr($texto, $inicio, ($final - $inicio -2));
		}

        if($substring !== false){
            if((stripos($substring, $palabra)) !== false){
                // echo "ARTÍCULO " . $i . "<br>";
				
            }
			//echo $substring . "<br>" . "<br>" . "<br>";
			
			$query = "INSERT INTO contenido(lid, articulo, contenido, pagina) VALUES ('$lid', '$i', '$substring', '$pagina')";
			$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
			pg_free_result($result);
			$i = ($i+1);
			return buscar($texto, $palabra, $inicio, $final, $i, $pagina, $lid, $dbconn);
        }   
	}

	$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

	$parser = new \Smalot\PdfParser\Parser();
	//$link = "Documentos/sp_gtm-int-text-const.pdf";
	$pdf    = $parser->parseFile($file_destination);
	$total = 0;
	$query1 = "SELECT * FROM leyes WHERE contenido = '$file_destination'";
	$result1 = pg_query($dbconn, $query1) or die('Query failed: ' . pg_last_error());
	$row = pg_fetch_row($result1);
	$lid = $row[0];

	// Retrieve all pages from the pdf file.
	$pages  = $pdf->getPages();
	 
	// Loop over each page to extract text.
	$pagina = 1;
//	$txt_buscar = "civil";
	$i = 1;
//	echo "Buscando $txt_buscar se muestra cantidad de ocurrencias por pagína <br/>";

	foreach ($pages as $page) {
	    $contenido_pagina = $page->getText();
	    $cantidad = substr_count($contenido_pagina, $txt_buscar);
	    $total = $total + $cantidad;
	    $inicio = 0;
	    $final = 0;

	    if(true){
		    //echo "<a href='$link#page=$pagina'>Pagina $pagina :</a> ";
			$i = buscar($contenido_pagina, $txt_buscar, $inicio, $final, $i, $pagina, $lid, $dbconn);
			//echo "<br/>";
	    }
	    $pagina++;
	}
	if($total=0){
	    	//echo "No hay sugerencias";
	}
	}
?>