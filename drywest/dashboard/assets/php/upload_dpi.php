<?php 
    include 'OCR.php';
	if (isset($_POST["upload"])){
        
        $file = $_FILES['img'];

		//File properties
		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];

		//Work out the file extension
		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));

		print_r($file_ext);

		$allowed = array('jpg', 'jpe','jpeg', 'png');

		//SE GUARDA EL ARCHIVO EN UNA CARPETA LLAMADA DOCUMENTOS
		if(in_array($file_ext, $allowed)){
			if($file_error === 0){
				$file_destination = 'pics/' . $file_name;

				if(move_uploaded_file($file_tmp, $file_destination)){
                    echo "<script>console.log('Ingresado correctamente')</script>";
                    $res = getImageText($file_destination);
                    echo "<script>fillField(\"$res\",)</script>";
                    
				} else {
					echo "<script>console.log('Intentalo de nuevo')</script>";
				}
			} else {
				echo "<script>console.log('Ocurrió un error, intentalo de nuevo')</script>";
			}
		} else {
			echo "<script>console.log('No es del tipo aceptado $file_ext')</script>";
		}

    }

?>