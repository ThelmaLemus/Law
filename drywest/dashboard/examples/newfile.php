<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<body class="">
<?php 
  include 'navbar.php'; 
  $admin = $varsesion=="admin";
  echo"<link rel=\"stylesheet\" href=\"../assets/css/library.css\">";


  // Include Composer autoloader if not already done.
  /* $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
  "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
  $_SERVER['REQUEST_URI']; 
  if (strpos($link, 'examples') !== false) {
  }else{
    include '../../Admin/vendor/autoload.php';
  } */
  include '../../../Admin/vendor/autoload.php';
   
  // Parse pdf file and build necessary objects.
  $parser = new \Smalot\PdfParser\Parser();

  $dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
  $user_query = "SELECT * FROM usuarios WHERE '$varsesion'=usuario";
  $user_result = pg_query($dbconn, $user_query) or die('User query failed: '.pg_last_error());
  $user = pg_fetch_row($user_result);
  $UID = $user[0];
  pg_free_result($user_result);
  echo"
    <script>
      // console.log('".$UID."');
    </script>
  "; 
  ?>
  <div class="container-fluid mt--7">
  <!-- Table -->
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header bg-transparent">
          <h3 class="mb-0">Nuevo documento</h3>
        </div>
        <div class="card-body">
          <form action="../Admin/upload_file.php" method="post" enctype="multipart/form-data">
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

        </div>
      </div>
    </div>
  </div>
</div>
<?php
  include 'footer.php'; 
?>
</body>