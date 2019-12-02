<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  
<?php 
   include 'navbar.php';

  $admin = $varsesion=="admin";
  if ($admin) {
    
    echo"
      <script>console.log('admin')</script>
      <script src=\"../assets/js/plugins/chart.js/dist/Chart.min.js\"></script>
      <script src=\"../assets/js/plugins/chart.js/dist/Chart.extension.js\"></script>
      <link rel=\"stylesheet\" href=\"../assets/css/library.css\">";
    }else{
      echo"
      <script>console.log('nadmin')</script>
      <script src=\"../assets/js/plugins/chart.js/dist/Chart.min.js\"></script>
      <script src=\"../assets/js/plugins/chart.js/dist/Chart.extension.js\"></script>
      <link rel=\"stylesheet\" href=\"../assets/css/library.css\">";
  }
  $dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
  $user_query = "SELECT * FROM usuarios WHERE '$varsesion'=usuario";
  $user_result = pg_query($dbconn, $user_query) or die('User query failed: '.pg_last_error());
  $user = pg_fetch_row($user_result);
  $UID = $user[0];
  pg_free_result($user_result);
  ?>
  <div class="container-fluid mt--7">
  <!-- Table -->
  <div class="card-body">
              <!-- Chart -->
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <div class="card-header bg-transparent">
          <h3 class="mb-0">Leyes</h3>
        </div>
        <div class="card-body">
          <?php
            echo"
              <div class=\"row icon-examples\">";
              $laws_query = "SELECT * FROM usuarios WHERE n_telefono != ''";
              $laws_result = pg_query($dbconn, $laws_query) or die('Laws query failed: ' . pg_last_error());
              $i=0;
              while ($laws = pg_fetch_row($laws_result)) {
                  $law_name = trim($laws[1]). " " .trim($laws[2]);
                  $user_phone = trim($laws[10]);
                  $user_mail = trim($laws[5]);
                  $user_desc = trim($laws[11]);
                  $user_addr = trim($laws[12]);
                  echo"
                    <div class=\"ley col-lg-3 col-md-6\">";
                    if($admin){
                      echo"<div class=\"btn-icon-clipboard\" href=\"pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$law_ID&b=0\" title=\"".$user_desc."\">";
                      echo "<script>localStorage.setItem('vs','');</script>";
                    }else{
                      echo"<div class=\"btn-icon-clipboard\" href=\"examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$law_ID&b=0\" title=\"".$user_desc."\">";
                      echo "<script>localStorage.setItem('vs','');</script>";
                    }
                    echo"
                        <div class=\"law_name\">
                          <i class=\"ni ni-single-copy-04\"></i>
                          <span>".$law_name."</span>
                        </div>
                        <div class='uinfo row'>
                          <span><i class='fas fa-phone fa-xs'></i> $user_phone</span>
                          <span><i class='fas fa-map-marker-alt fa-xs'></i>$user_addr</span>
                          <span><i class='fas fa-at fa-xs'></i>$user_mail</span>
                        </div>
                      </div>
                    </div>
                  ";
              }
            
            ?> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
