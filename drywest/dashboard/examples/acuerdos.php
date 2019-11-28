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
        <div class="card-body">
          <?php
            if (isset($_POST['buscar'])) {
              $gsearch = $_POST['gsearch'];

              $gsearch = urlencode($gsearch);

              echo"<div class=\"row icon-examples\">";
              $laws_query = "SELECT * FROM biblioteca WHERE '$UID'=uid";
              $laws_result = pg_query($dbconn, $laws_query) or die('Laws query failed: ' . pg_last_error());
              $Fav_laws =null;
              while ($laws = pg_fetch_row($laws_result)) {
                $Fav_laws[]= $laws[1];
              }
              pg_free_result($laws_result);
              $i=0;
              foreach ($Fav_laws as $valor) {
                $laws_query = "SELECT distinct L.nombre_original
                              FROM contenido C, comentarios Com, leyes L 
                              WHERE '$valor' = L.lid AND L.tipo = 'L'
                              AND C.lid = L.lid AND Com.lid = L.lid AND 
                              (L.nombre_original ILIKE '%".$gsearch."%' 
                              OR L.nombre_sintilde ILIKE '%".$gsearch."%' 
                              OR C.contenido ILIKE '%".$gsearch."%' OR 
                              Com.comentario ILIKE '%".$gsearch."%') order by L.nombre_original";
                  $laws_result = pg_query($dbconn, $laws_query) or die('Laws query failed: ' . pg_last_error());
                  $law = pg_fetch_row($laws_result);
                  $law_ID = $valor;
                  $law_name = $law[0];
                  $pa_comment= $law[1];
                  $pa_content = $law[2];
                  if($pa_comment > $pa_content)
                  {
                    $pa = $pa_content;
                  }
                  else
                  {
                    $pa = $pa_comment;
                  }
                  $rows=pg_num_rows($laws_result);
                  if ($rows>0) {
                    echo"<div class=\"ley col-lg-3 col-md-6\">";
                      if($admin){

                        echo"<a class=\"btn-icon-clipboard\" href=\"pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$law_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$law_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
                      }else{
                        echo"<a class=\"btn-icon-clipboard\" href=\"examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$law_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$law_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
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
                  }else{
                    echo"<script>
                      console.log('no se encontró nada');
                    </script>";
                  }
                }
                pg_free_result($laws_result);
                echo"</div>
                <div class=\"row icon-examples\">";
                $laws_query = "SELECT DISTINCT L.lid, L.nombre_original
                FROM contenido C, comentarios Com, leyes L, vistas V 
                WHERE V.lid = C.lid L.tipo = 'L'
                AND C.lid = L.lid AND Com.lid = L.lid AND 
                (L.nombre_original ILIKE '%".$gsearch."%' 
                OR L.nombre_sintilde ILIKE '%".$gsearch."%' 
                OR C.contenido ILIKE '%".$gsearch."%' OR 
                Com.comentario ILIKE '%".$gsearch."%') order by L.nombre_original";
                $laws_result = pg_query($dbconn, $laws_query) or die('Laws query failed: ' . pg_last_error());
                $i=0;
                while ($laws = pg_fetch_row($laws_result)) {
                  $law_ID = $laws[0];
                  if (!(in_array($law_ID, $Fav_laws))) {
                    $law_name = $laws[1];
                    echo"
                      <div class=\"ley col-lg-3 col-md-6\">";
                      if($admin){
                        echo"<a class=\"btn-icon-clipboard\" href=\"pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$law_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$law_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
                      }else{
                        echo"<a class=\"btn-icon-clipboard\" href=\"examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$law_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$law_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
                      }
                      echo"
                          <div class=\"law_name\">
                            <i class=\"ni ni-single-copy-04\"></i>
                            <span>".$law_name."</span>
                          </div>
                          <label class=\"far fa-star\" id= \"12amyChecka$i\">
                            <input type=\"checkbox\" id=\"12myChecka$i\" onClick=\"funcionFavorito('12myChecka$i',$law_ID,$uid)\"> 
                          </label>
                        </a>
                      </div>
                    ";
                  }
                  $i++;
                }
                  
                pg_free_result($laws_result);
              echo"</div>";

              echo "<div class=\"card-header bg-transparent\">
                  <h3 class=\"mb-0\">Acuerdos</h3>
                </div>
                <div class=\"row icon-examples\">";
                $agreements_query = "SELECT * FROM biblioteca WHERE '$UID'=uid";
                $agreements_result = pg_query($dbconn, $agreements_query) or die('agreements query failed: ' . pg_last_error());
                $Fav_agreements =null;
                while ($agreements = pg_fetch_row($agreements_result)) {
                  $Fav_agreements[]= $agreements[1];
                }
                pg_free_result($agreements_result);
                $i=0;
                foreach ($Fav_agreements as &$valor) {
                  $agreements_query = "SELECT distinct L.nombre_original
                  FROM contenido C, comentarios Com, leyes L 
                  WHERE '$valor' = L.lid AND L.tipo = 'A'
                  AND C.lid = L.lid AND Com.lid = L.lid AND 
                  (L.nombre_original ILIKE '%".$gsearch."%' 
                  OR L.nombre_sintilde ILIKE '%".$gsearch."%' 
                  OR C.contenido ILIKE '%".$gsearch."%' OR 
                  Com.comentario ILIKE '%".$gsearch."%') order by L.nombre_original";
                  $agreements_result = pg_query($dbconn, $agreements_query) or die('agreements query failed D: ' . pg_last_error());
                  $agreement = pg_fetch_row($agreements_result);
                  $agreement_ID = $agreement[0];
                  $agreement_name = $agreement[1];
                  $rows=pg_num_rows($agreements_result);
                  if ($rows>0) {
                    echo"
                      <div class=\"ley col-lg-3 col-md-6\">";
                      if($admin){
                        echo"<a class=\"btn-icon-clipboard\" href=\"pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$agreement_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$agreement_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
                      }else{
                        echo"<a class=\"btn-icon-clipboard\" href=\"examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$agreement_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$agreement_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
                      }
                      echo"
                          <div class=\"law_name\">
                            <i class=\"ni ni-single-copy-04\"></i>
                            <span>".$agreement_name."</span>
                          </div>
                          <label class=\"fas fa-star\" id= \"12amyCheckc$i\">
                            <input type=\"checkbox\" id=\"12myCheckc$i\" onClick=\"funcionFavorito('12myCheckc$i',$agreement_ID,$uid)\"checked> 
                          </label>
                        </a>
                      </div>
                    ";
                    $i++;
                  }
                }
                pg_free_result($agreements_result);
              echo"</div>
                <div class=\"row icon-examples\">";
                $agreements_query = "SELECT distinct L.nombre_original
                FROM contenido C, comentarios Com, leyes L, vistas V
                WHERE L.tipo = 'A' AND V.lid = C.lid AND
                AND C.lid = L.lid AND Com.lid = L.lid AND 
                (L.nombre_original ILIKE '%".$gsearch."%' 
                OR L.nombre_sintilde ILIKE '%".$gsearch."%' 
                OR C.contenido ILIKE '%".$gsearch."%' OR 
                Com.comentario ILIKE '%".$gsearch."%') order by L.nombre_original";
                $agreements_result = pg_query($dbconn, $agreements_query) or die('agreements query failed A: ' . pg_last_error());
                $i=0;
                while ($agreements = pg_fetch_row($agreements_result)) {
                  $agreement_ID = $agreements[0];
                  if (!(in_array($agreement_ID, $Fav_agreements))) {
                    $agreement_name = $agreements[1];
                    echo"
                      <div class=\"ley col-lg-3 col-md-6\">";
                      if($admin){
                        echo"<a class=\"btn-icon-clipboard\" href=\"pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$agreement_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$agreement_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
                      }else{
                        echo"<a class=\"btn-icon-clipboard\" href=\"examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$agreement_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$agreement_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
                      }
                      echo"
                          <div class=\"law_name\">
                            <i class=\"ni ni-single-copy-04\"></i>
                            <span>".$agreement_name."</span>
                          </div>
                          <label class=\"far fa-star\" id= \"12amyCheckd$i\">
                            <input type=\"checkbox\" id=\"12myCheckd$i\" onClick=\"funcionFavorito('12myCheckd$i',$agreement_ID,$uid)\"> 
                          </label>
                        </a>
                      </div>
                    ";
                  }
                  $i++;
                }
                  
                pg_free_result($agreements_result);
                // pg_close($dbconn);
              echo"</div>";

              echo "<div class=\"card-header bg-transparent\">
                  <h3 class=\"mb-0\">Convenios</h3>
                </div>
                <div class=\"row icon-examples\">";
                $arrangements_query = "SELECT * FROM biblioteca WHERE '$UID'=uid";
                $arrangements_result = pg_query($dbconn, $arrangements_query) or die('arrangements query failed: ' . pg_last_error());
                $Fav_arrangements =null;
                while ($arrangements = pg_fetch_row($arrangements_result)) {
                  $Fav_arrangements[]= $arrangements[1];
                }
                pg_free_result($arrangements_result);
                $i=0;
                foreach ($Fav_arrangements as &$valor) {
                  $arrangements_query = "SELECT distinct L.nombre_original
                  FROM contenido C, comentarios Com, leyes L, vistas V 
                  WHERE '$valor' = L.lid AND V.lid = C.lid AND L.tipo = 'C'
                  AND C.lid = L.lid AND Com.lid = L.lid AND 
                  (L.nombre_original ILIKE '%".$gsearch."%' 
                  OR L.nombre_sintilde ILIKE '%".$gsearch."%' 
                  OR C.contenido ILIKE '%".$gsearch."%' OR 
                  Com.comentario ILIKE '%".$gsearch."%') order by L.nombre_original";
                  $arrangements_result = pg_query($dbconn, $arrangements_query) or die('arrangements query failed: ' . pg_last_error());
                  $arrangement = pg_fetch_row($arrangements_result);
                  $arrangement_ID = $arrangement[0];
                  $arrangement_name = $arrangement[1];
                  $rows=pg_num_rows($arrangements_result);
                  if ($rows>0) {
                    echo"
                      <div class=\"ley col-lg-3 col-md-6\">";
                      if($admin){
                        echo"<a class=\"btn-icon-clipboard\" href=\"pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$arrangement_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$arrangement_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
                      }else{
                        echo"<a class=\"btn-icon-clipboard\" href=\"examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$arrangement_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$arrangement_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
                      }
                      echo"
                          <div class=\"law_name\">
                            <i class=\"ni ni-single-copy-04\"></i>
                            <span>".$arrangement_name."</span>
                          </div>
                          <label class=\"fas fa-star\" id= \"12amyChecke$i\">
                            <input type=\"checkbox\" id=\"12myChecke$i\" onClick=\"funcionFavorito('12myChecke$i',$arrangement_ID,$uid)\"checked> 
                          </label>
                        </a>
                      </div>
                    ";
                    $i++;
                  }
                }
                pg_free_result($arrangements_result);
                echo"
                </div>
                <div class=\"row icon-examples\">";
                $arrangements_query = "SELECT distinct L.nombre_original
                FROM contenido C, comentarios Com, leyes L 
                WHERE L.tipo = 'C'
                AND C.lid = L.lid AND Com.lid = L.lid AND 
                (L.nombre_original ILIKE '%".$gsearch."%' 
                OR L.nombre_sintilde ILIKE '%".$gsearch."%' 
                OR C.contenido ILIKE '%".$gsearch."%' OR 
                Com.comentario ILIKE '%".$gsearch."%') order by L.nombre_original";
                $arrangements_result = pg_query($dbconn, $arrangements_query) or die('arrangements query failed: ' . pg_last_error());
                $i=0;
                while ($arrangements = pg_fetch_row($arrangements_result)) {
                  $arrangement_ID = $arrangements[0];
                  if (!(in_array($arrangement_ID, $Fav_arrangements))) {
                    $arrangement_name = $arrangements[1];
                    echo"
                      <div class=\"ley col-lg-3 col-md-6\">";
                      if($admin){
                        echo"<a class=\"btn-icon-clipboard\" href=\"pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$arrangement_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$arrangement_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
                      }else{
                        echo"<a class=\"btn-icon-clipboard\" href=\"examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$arrangement_ID&b=11&search=$gsearch&p=$pa&c=3\" title=\"".$arrangement_name."\">";
                        echo "<script>localStorage.setItem('vs','$gsearch');</script>";
                      }
                      echo"
                          <div class=\"law_name\">
                            <i class=\"ni ni-single-copy-04\"></i>
                            <span>".$arrangement_name."</span>
                          </div>
                          <label class=\"far fa-star\" id= \"12amyCheckf$i\">
                            <input type=\"checkbox\" id=\"12myCheckf$i\" onClick=\"funcionFavorito('12myCheckf$i',$arrangement_ID,$uid)\"> 
                          </label>                        
                        </a>
                      </div>
                    ";
                  }
                  $i++;
                }
                  
                pg_free_result($arrangements_result);
                // pg_close($dbconn);

            }else{
             echo"
                <div class=\"card-header bg-transparent\">
                  <h3 class=\"mb-0\">Acuerdos</h3>
                </div>
                <div class=\"row icon-examples\">";
                $agreements_query = "SELECT * FROM biblioteca WHERE '$UID'=uid";
                $agreements_result = pg_query($dbconn, $agreements_query) or die('agreements query failed: ' . pg_last_error());
                $Fav_agreements =null;
                while ($agreements = pg_fetch_row($agreements_result)) {
                  $Fav_agreements[]= $agreements[1];
                }
                pg_free_result($agreements_result);
                $i=0;
                foreach ($Fav_agreements as &$valor) {
                  $agreements_query = "SELECT * FROM leyes WHERE '$valor'= lid AND tipo='A'";
                  $agreements_result = pg_query($dbconn, $agreements_query) or die('agreements query failed: ' . pg_last_error());
                  $agreement = pg_fetch_row($agreements_result);
                  $agreement_ID = $agreement[0];
                  $agreement_name = $agreement[1];
                  $rows=pg_num_rows($agreements_result);
                  if ($rows>0) {
                    echo"
                      <div class=\"ley col-lg-3 col-md-6\">";
                      if($admin){
                        echo"<a class=\"btn-icon-clipboard\" href=\"pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$agreement_ID&b=0\" title=\"".$agreement_name."\">";
                        echo "<script>localStorage.setItem('vs','');</script>";
                      }else{
                        echo"<a class=\"btn-icon-clipboard\" href=\"examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$agreement_ID&b=0\" title=\"".$agreement_name."\">";
                        echo "<script>localStorage.setItem('vs','');</script>";
                      }
                      echo"
                          <div class=\"law_name\">
                            <i class=\"ni ni-single-copy-04\"></i>
                            <span>".$agreement_name."</span>
                          </div>
                          <label class=\"fas fa-star\" id= \"12amyCheckc$i\">
                            <input type=\"checkbox\" id=\"12myCheckc$i\" onClick=\"funcionFavorito('12myCheckc$i',$agreement_ID,$uid)\"checked> 
                          </label>
                        </a>
                      </div>
                    ";
                    $i++;
                  }
                }
                pg_free_result($agreements_result);
              echo"</div>
                <div class=\"row icon-examples\">";
                $agreements_query = "SELECT * FROM leyes WHERE tipo = 'A'";
                $agreements_result = pg_query($dbconn, $agreements_query) or die('agreements query failed: ' . pg_last_error());
                $i=0;
                while ($agreements = pg_fetch_row($agreements_result)) {
                  $agreement_ID = $agreements[0];
                  if (!(in_array($agreement_ID, $Fav_agreements))) {
                    $agreement_name = $agreements[1];
                    echo"
                      <div class=\"ley col-lg-3 col-md-6\">";
                      if($admin){
                        echo"<a class=\"btn-icon-clipboard\" href=\"pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$agreement_ID&b=0\" title=\"".$agreement_name."\">";
                        echo "<script>localStorage.setItem('vs','');</script>";
                      }else{
                        echo"<a class=\"btn-icon-clipboard\" href=\"examples/pdf.js-master/examples/components/simpleviewer.php?uid=$uid&lid=$agreement_ID&b=0\" title=\"".$agreement_name."\">";
                        echo "<script>localStorage.setItem('vs','');</script>";
                      }
                      echo"
                          <div class=\"law_name\">
                            <i class=\"ni ni-single-copy-04\"></i>
                            <span>".$agreement_name."</span>
                          </div>
                          <label class=\"far fa-star\" id= \"12amyCheckd$i\">
                            <input type=\"checkbox\" id=\"12myCheckd$i\" onClick=\"funcionFavorito('12myCheckd$i',$agreement_ID,$uid)\"> 
                          </label>
                        </a>
                      </div>
                    ";
                  }
                  $i++;
                }
                  
                pg_free_result($agreements_result);
                // pg_close($dbconn);
              echo"</div>";
               
            }
            ?> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
