<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Nuevo documento</title>
	<?php include "../style/navbar.php" ?>
<body>
	<form action="upload_file.php" method="post" enctype="multipart/form-data">
    <div class="hey">
      <div class="form-group  col-lg-8">
        <label for="Nombre">Nombre</label>
        <input type="text" name="nombre" class="form-control" placeholder="Nombre del documento">
        <label for="Categoria">Categoría</label>
        <select name="categoria" class="custom-select" required>
          <option value="Ninguna" selected>Ninguna</option>
          <option value="Administrativa">Administrativa</option>
          <option value="Ambiental">Ambiental</option>
          <option value="Civil">Civil</option>
          <option value="Constitucional">Constitucional</option>
          <option value="Laboral">Laboral</option>
          <option value="Mercantil">Mercantil</option>
          <option value="Notarial">Notarial</option>
          <option value="Penal">Penal</option>
          <option value="Tributaria">Tributaria</option>
        </select>
        <label for="Archivo">Archivo</label>
        <div class="custom-file ">
          <input type="file" name="file" class="custom-file-input" required>
          <label class="custom-file-label">Seleccione archivo</label>
        </div>
        <label for="Tipo">Tipo</label>
        <select name="tipo" class="custom-select" required>
          <option value='' disabled selected>Seleccione qué tipo es</option>
          <option value="L">Ley</option>
          <option value="A">Acuerdo</option>
          <option value="C">Convenio</option>
        </select>
        <br> <br>
        <input type="submit" value="Subir" class="btn btn-secondary col-lg-2" style="padding: 10px;">
      </div>
    </div>  
  </form>
</body>
</html>