<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <!-- <link rel="stylesheet" href="../assets/css/profile.css"> -->
  <script src="../../layout/scripts/index.js"></script>
<?php 
  include 'navbar.php';

  $admin = $varsesion=="admin";
  // if ($admin) {
    // echo"<link rel=\"stylesheet\" href=\"assets/css/library.css\">";
    // }else{
    // }
  echo"<link rel=\"stylesheet\" href=\"../assets/css/library.css\">";
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
          <h3 class="mb-0">Plantillas</h3>
        </div>
        <div class="card-body">
         <div class="row icon-examples">
          <div class="ley col-lg-3 col-md-6">
          <?php 
            echo"<a class=\"btn-icon-clipboard\" href=\"single_template?uid=$UID\" title=\"Autenticación de firmas\">";
          ?>
              <div class="law_name">
                <i class="ni ni-single-copy-04"></i>
                <span>Autenticación de firmas</span>
              </div>
              <label class="fas fa-star" id= "ki">
              <input type="checkbox" id="on" onClick=""> 
              </label>
            </a>
          </div>
          <div class="ley col-lg-3 col-md-6">
          <?php 
            echo"<a class=\"btn-icon-clipboard\" href=\"Carta_de_poder.php?uid=$UID\" title=\"Carta de poder\">";
          ?>
              <div class="law_name">
                <i class="ni ni-single-copy-04"></i>
                <span>Carta de poder</span>
              </div>
              <label class="fas fa-star" id= "ki">
              <input type="checkbox" id="on" onClick=""> 
              </label>
            </a>
          </div>
          <div class="ley col-lg-3 col-md-6">
          <?php 
            echo"<a class=\"btn-icon-clipboard\" href=\"acta_de_declaracion.php?uid=$UID\" title=\"Solicitud de tesis - Declaracion jurada\">";
          ?>
              <div class="law_name">
                <i class="ni ni-single-copy-04"></i>
                <span>Solicitud de tesis - Declaracion jurada</span>
              </div>
              <label class="fas fa-star" id= "ki">
              <input type="checkbox" id="on" onClick=""> 
              </label>
            </a>
          </div>
          <div class="ley col-lg-3 col-md-6">
          <?php 
            echo"<a class=\"btn-icon-clipboard\" href=\"declaracion_jurada.php?uid=$UID\" title=\"Extravío de patente - Declaración jurada\">";
          ?>
              <div class="law_name">
                <i class="ni ni-single-copy-04"></i>
                <span>Extravío de patente - Declaración jurada</span>
              </div>
              <label class="fas fa-star" id= "ki">
              <input type="checkbox" id="on" onClick=""> 
              </label>
            </a>
          </div>
          <div class="ley col-lg-3 col-md-6">
          <?php 
            echo"<a class=\"btn-icon-clipboard\" href=\"declaracion_jurada_SAT.php?uid=$UID\" title=\"SAT - Declaración jurada\">";
          ?>
              <div class="law_name">
                <i class="ni ni-single-copy-04"></i>
                <span>SAT - Declaración jurada</span>
              </div>
              <label class="fas fa-star" id= "ki">
              <input type="checkbox" id="on" onClick=""> 
              </label>
            </a>
          </div>
          <div class="ley col-lg-3 col-md-6">
          <?php 
            echo"<a class=\"btn-icon-clipboard\" href=\"ampliacion.php?uid=$UID\" title=\"Ampliación\">";
          ?>
              <div class="law_name">
                <i class="ni ni-single-copy-04"></i>
                <span>Ampliación</span>
              </div>
              <label class="fas fa-star" id= "ki">
              <input type="checkbox" id="on" onClick=""> 
              </label>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php' ?>

