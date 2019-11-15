<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mi perfil</title>
	<?php include "../style/navbar.php" ?>
</head>
<body>
	<br>
	<form action="validar_foto.php" method="post" class="formp" enctype= "multipart/form-data" >
		
		<div class="form-group">
			<h3>Selecciona tu foto de perfil</h3>
	        <div class="custom-file ">
				<input type="file" name="imagen" accept="image/jpeg, image/png" class="custom-file-input" required>
		          <label class="custom-file-label">Selecciona una imagen</label>
	        </div><br><br><br>
			<input type="submit" name="submit" value="Cambiar" class="btn btn-secondary">
			
		</div>
	</form>

</body>

</html>