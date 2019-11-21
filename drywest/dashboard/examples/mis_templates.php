<!--

    AUTENTICACIÓN DE FIRMA - 1
    CARTA DE PODER - 2



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
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header bg-transparent">
          <h3 class="mb-0">Mis documentos</h3>
        </div>
        <div class="card-body">
      <!-- Table -->
      <?php
      echo"<div class=\"row icon-examples\">";
      
      $laws_query = "SELECT * FROM autenticacion_de_firma WHERE '$UID'= uid";
      $laws_result = pg_query($dbconn, $laws_query) or die('Laws query failed: ' . pg_last_error());
      $law = pg_fetch_row($laws_result);
      $law_ID = $law[0];
      $law_name = $law[1];
        $rows=pg_num_rows($laws_result);
        if ($rows>0) {
          echo"
            <div class=\"ley col-lg-3 col-md-6\">";
            if($admin){
              echo"<a class=\"btn-icon-clipboard\" href=\"pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$law_ID&b=0\" title=\"".$law_name."\">";
              echo "<script>localStorage.setItem('vs','');</script>";
            }else{
              echo"<a class=\"btn-icon-clipboard\" href=\"examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$law_ID&b=0\" title=\"".$law_name."\">";
              echo "<script>localStorage.setItem('vs','');</script>";
            }
            echo"
                <div class=\"law_name\">
                  <i class=\"ni ni-single-copy-04\"></i>
                  <span>".$law_name."</span>
                </div>
                <label class=\"fas fa-star\" id= \"12amyChecka$i\">
                  <input type=\"checkbox\" id=\"12myChecka$i\" onClick=\"funcionFavorito('12myChecka$i',$law_ID,$uid)\"checked> 
                </label>
              </a>
            </div>
          ";
          $i++;
        }
      }
      pg_free_result($laws_result);
    echo"</div>";
    ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php' ?>

