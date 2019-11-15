<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mi perfil</title>
	<?php include "../style/navbar.php" ?>
<body>
	<br><br>
	<center>
		<form class="col-md-7 forma" action="validar_contra.php" method="post">
			<br><br>
			<div class="row">
			    <div class="col-5">
			    	<input type="password" class="form-control" name="actual" placeholder="Contraseña actual" required>
			    </div>
			    <div class="col-5">
			    	<input type="password" class="form-control" name="nueva" placeholder="Contraseña nueva" required>
			    </div>
			</div>
			<br>
			<div class="row">
				<div class="col-6"></div>
				<input type="submit" name="submit" class="btn primary-btn but col-3">
			</div>	
		</form>
	</center>

</body>

</html>