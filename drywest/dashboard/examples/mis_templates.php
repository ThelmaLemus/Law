<!--

    AUTENTICACIÓN DE FIRMA - 1
    CARTA DE PODER - 2
    SOLICITUD DE TESIS - 3
    EXTRAVÍO DE PATENTE - 4
    SAT - 5
    AMPLIACION - 6
    NOMBRAMIENTO - 7

-->
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
        <!-- AUTENTICACIÓN DE FIRMAS -->
        <div class="card-header bg-transparent">
          <h3 class="mb-0">Autenticación de firmas</h3>
        </div>
        <div class="card-body">
          <div class="row icon-examples">
        <?php
      
          $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
          $query = "SELECT * FROM autenticacion_de_firma WHERE uid='$UID'";
          $result = pg_query($link, $query);
          $si_hay=pg_num_rows($result);

          if($si_hay > 0)
          {
            while ($row = pg_fetch_row($result))
            {
              $nombre = $row[6];
              $pid = $row[5];
              echo "
                  <div class=\"ley col-lg-3 col-md-6\">
                    <a class='btn-icon-clipboard' href='single_template.php?uid=$UID&pid=$pid' title='$nombre'>
                      <div class='law_name'>
                        <i class='ni ni-single-copy-04'></i>
                        <span>".$nombre."</span>
                      </div>
                      <label class='fas fa-star' id= 'ki'>
                        <input type='checkbox' id='on'> 
                      </label>
                    </a>
                  </div>
                  ";
          }
        }
          else
          {
            echo "No se encontraron resultados";
          }
        ?>
        </div>
        </div>
        <div class="row">
    <div class="col">
        <!-- Table -->
        <!-- CARTAS DE PODER -->
        <div class="card-header bg-transparent">
          <h3 class="mb-0">Cartas de poder</h3>
        </div>
        <div class="card-body">
         <div class="row icon-examples">

         <?php
      
          $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
          $query = "SELECT * FROM carta_de_poder WHERE uid='$UID'";
          $result = pg_query($link, $query);
          $si_hay=pg_num_rows($result);

          if($si_hay > 0)
          {
            while ($row = pg_fetch_row($result))
            {
              $nombre = $row[11];
              $pid = $row[9];
              echo "
                  <div class=\"ley col-lg-3 col-md-6\">
                    <a class='btn-icon-clipboard' href='Carta_de_poder.php?uid=$UID&pid=$pid' title='$nombre'>
                      <div class='law_name'>
                        <i class='ni ni-single-copy-04'></i>
                        <span>".$nombre."</span>
                      </div>
                      <label class='fas fa-star' id= 'ki'>
                        <input type='checkbox' id='on'> 
                      </label>
                    </a>
                  </div>
                  ";
          }
        }
          else
          {
            echo "No se encontraron resultados";
          }
        ?>
        </div>
        </div>
        <!-- Solicitud de tesis - Declaracion jurada -->
        <div class="card-header bg-transparent">
          <h3 class="mb-0">Solicitud de tesis - Declaracion jurada</h3>
        </div>
        <div class="card-body">
         <div class="row icon-examples">
         <?php
      
      $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
      $query = "SELECT * FROM acta_de_declaracion WHERE usuario='$UID'";
      $result = pg_query($link, $query);
      $si_hay=pg_num_rows($result);

      if($si_hay > 0)
      {
        while ($row = pg_fetch_row($result))
        {
          $nombre = $row[8];
          $pid = $row[9];
          echo "
                  <div class=\"ley col-lg-3 col-md-6\">
                    <a class='btn-icon-clipboard' href='acta_de_declaracion.php?uid=$UID&pid=$pid' title='$nombre'>
                      <div class='law_name'>
                        <i class='ni ni-single-copy-04'></i>
                        <span>".$nombre."</span>
                      </div>
                      <label class='fas fa-star' id= 'ki'>
                        <input type='checkbox' id='on'> 
                      </label>
                    </a>
                  </div>
                  ";
        }
      }
      else
      {
        echo "No se encontraron resultados";
      }
    ?>
          </div>
        </div>
        <!-- Extravío de patente - Declaración jurada -->
        <div class="card-header bg-transparent">
          <h3 class="mb-0">Extravío de patente - Declaración jurada</h3>
        </div>
        <div class="card-body">
         <div class="row icon-examples">
         <?php
      
      $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
      $query = "SELECT * FROM extravio_patente WHERE usuario='$UID'";
      $result = pg_query($link, $query);
      $si_hay=pg_num_rows($result);

      if($si_hay > 0)
      {
        while ($row = pg_fetch_row($result))
        {
          $nombre = $row[0];
          $pid = $row[11];
          echo "
                  <div class=\"ley col-lg-3 col-md-6\">
                    <a class='btn-icon-clipboard' href='declaracion_jurada.php?uid=$UID&pid=$pid' title='$nombre'>
                      <div class='law_name'>
                        <i class='ni ni-single-copy-04'></i>
                        <span>".$nombre."</span>
                      </div>
                      <label class='fas fa-star' id= 'ki'>
                        <input type='checkbox' id='on'> 
                      </label>
                    </a>
                  </div>
                  ";
        }
      }
      else
      {
        echo "No se encontraron resultados";
      }
    ?>
          </div>
        </div>
        <!-- SAT - Declaración jurada -->
        <div class="card-header bg-transparent">
          <h3 class="mb-0">SAT - Declaración jurada</h3>
        </div>
        <div class="card-body">
         <div class="row icon-examples">
         <?php
      
      $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
      $query = "SELECT * FROM declaracionjurada_sat WHERE usuario='$UID'";
      $result = pg_query($link, $query);
      $si_hay=pg_num_rows($result);

      if($si_hay > 0)
      {
        while ($row = pg_fetch_row($result))
        {
          $nombre = $row[15];
          $pid = $row[16];
          echo "
                  <div class=\"ley col-lg-3 col-md-6\">
                    <a class='btn-icon-clipboard' href='declaracion_jurada_SAT.php?uid=$UID&pid=$pid' title='$nombre'>
                      <div class='law_name'>
                        <i class='ni ni-single-copy-04'></i>
                        <span>".$nombre."</span>
                      </div>
                      <label class='fas fa-star' id= 'ki'>
                        <input type='checkbox' id='on'> 
                      </label>
                    </a>
                  </div>
                  ";
        }
      }
      else
      {
        echo "No se encontraron resultados";
      }
    ?>
          </div>
        </div>
        <!-- Ampliación -->
        <div class="card-header bg-transparent">
          <h3 class="mb-0">Ampliación</h3>
        </div>
        <div class="card-body">
         <div class="row icon-examples">
         <?php
      
      $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
      $query = "SELECT * FROM ampliacion WHERE usuario='$UID'";
      $result = pg_query($link, $query);
      $si_hay=pg_num_rows($result);

      if($si_hay > 0)
      {
        while ($row = pg_fetch_row($result))
        {
          $nombre = $row[10];
          $pid = $row[11];
          echo "
                  <div class=\"ley col-lg-3 col-md-6\">
                    <a class='btn-icon-clipboard' href='ampliacion.php?uid=$UID&pid=$pid' title='$nombre'>
                      <div class='law_name'>
                        <i class='ni ni-single-copy-04'></i>
                        <span>".$nombre."</span>
                      </div>
                      <label class='fas fa-star' id= 'ki'>
                        <input type='checkbox' id='on'> 
                      </label>
                    </a>
                  </div>
                  ";
        }
      }
      else
      {
        echo "No se encontraron resultados";
      }
    ?>
          </div>
        </div>
        <!-- Nombramiento de administrador -->
        <div class="card-header bg-transparent">
          <h3 class="mb-0">Nombramiento de administrador</h3>
        </div>
        <div class="card-body">
          <div class="row icon-examples">
            <?php
      
              $link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
              $query = "SELECT * FROM nombramiento WHERE usuario='$UID'";
              $result = pg_query($link, $query);
              $si_hay=pg_num_rows($result);

              if($si_hay > 0)
              {
                while ($row = pg_fetch_row($result))
                {
                  $nombre = $row[14];
                  $pid = $row[15];
                  echo "
                  <div class=\"ley col-lg-3 col-md-6\">
                    <a class='btn-icon-clipboard' href='nombramiento_admin.php?uid=$UID&pid=$pid' title='$nombre'>
                      <div class='law_name'>
                        <i class='ni ni-single-copy-04'></i>
                        <span>".$nombre."</span>
                      </div>
                      <label class='fas fa-star' id= 'ki'>
                        <input type='checkbox' id='on'> 
                      </label>
                    </a>
                  </div>
                  ";
                }
              }
              else
              {
                echo "No se encontraron resultados";
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include 'footer.php' ?>

