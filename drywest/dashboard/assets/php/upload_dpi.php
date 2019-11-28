<?php 
	include 'OCR.php';
	

	if (isset($_POST["signAuth"])){
		if (isset($_FILES['dpi1'])) {
			echo"<script>console.log('dpi1')</script>";
			getFromFile('dpi1', 'iddpi1', 'idname1', 'label_id1');
		}

		if (isset($_FILES['dpi2'])) {
			echo"<script>console.log('dpi2')</script>";
			getFromFile('dpi2', 'iddpi2', 'idname2', 'label_id2');
		}

		if (isset($_FILES['dpi3'])) {
			echo"<script>console.log('dpi3')</script>";
			getFromFile('dpi3', 'iddpi3', 'idname3', 'label_id3');
		}
		
		if (isset($_FILES['dpi4'])) {
			echo"<script>console.log('dpi4')</script>";
			getFromFile('dpi4', 'iddpi4', 'idname4', 'label_id4');
		}

		if (isset($_FILES['dpi5'])) {
			echo"<script>console.log('dpi5')</script>";
			getFromFile('dpi5', 'iddpi5', 'idname5', 'label_id5');
		}

		if (isset($_FILES['dpi6'])) {
			echo"<script>console.log('dpi6')</script>";
			getFromFile('dpi6', 'iddpi6', 'idname6', 'label_id6');
		}

		if (isset($_FILES['dpi7'])) {
			echo"<script>console.log('dpi7')</script>";
			getFromFile('dpi7', 'iddpi7', 'idname7', 'label_id7');
		}
    }

	function getFromFile($file, $iddpi, $idname, $idlabel){
		$file = $_FILES[$file];
		$dpi_id = $_POST[$iddpi];
		$name_id = $_POST[$idname];
		$label_id = $_POST[$idlabel];

		//File properties

		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];

		//Work out the file extension
		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));

		// print_r($file_ext);

		$allowed = array('jpg', 'jpe','jpeg', 'png');

		//SE GUARDA EL ARCHIVO EN UNA CARPETA LLAMADA DOCUMENTOS
		if(in_array($file_ext, $allowed)){
			if($file_error === 0){
				$file_destination = 'pics/' + $file_name;

				if(move_uploaded_file($file_tmp, $file_destination)){
					echo "<script>console.log('Ingresado correctamente')</script>";
					$res = getImageText($file_destination);
					echo "<script>fillField(\"$file_name\",\"$res\", \"$dpi_id\", \"$name_id\", \"$label_id\")</script>";
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