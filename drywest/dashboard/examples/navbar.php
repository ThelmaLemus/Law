<?php

  $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
  "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
  $_SERVER['REQUEST_URI']; 
  $isSimpleViewer = (strpos($link, 'simpleviewer.php') !== false);
  $add = $isSimpleViewer? "../../../": "";
  echo"<script> var addjs = \"".$add."\"</script>";
	session_start();
	error_reporting(0);
  $varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion == ''){
    
    if(strpos($link, 'examples') !== false){
      echo "<script>
        alert('Debe inciar sesión para entrar');
        window.location= $add+'../../';
      </script>";
    }else{
      echo "<script>
        alert('Debe inciar sesión para entrar');
        window.location= $add+'../';
      </script>";
    }
  }
 
  $admin = $varsesion == "admin"? true:false;

  if ($admin) {
    echo"<script>
      var favdoc = [];
      var ftimes = [];
      var users = new Array(12).fill(0);
    </script>";
    $adminconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error()); 
    $admquery = "SELECT lid, COUNT(lid) as fav FROM biblioteca GROUP BY lid ORDER BY fav DESC LIMIT 5";
    $aqueryresult = pg_query($adminconn, $admquery) or die('Query failed: ' . pg_last_error());
    while($arow = pg_fetch_row($aqueryresult))
		{

      $fdocnameq = "SELECT nombre_original FROM leyes WHERE lid='$arow[0]'";
      $fdnresult = pg_query($adminconn, $fdocnameq) or die('Query failed: ' . pg_last_error());
      while($drow = pg_fetch_row($fdnresult)){
        echo"<script>
            ftimes.push('$arow[1]');
            favdoc.push('".trim($drow[0])."');
          </script>";
      }
    }
    $m_pos = 0;
    $usrsquery = "SELECT Extract(month from fecha_c) as month, count(uid) as users FROM usuarios GROUP BY fecha_c ORDER BY Extract(month from fecha_c)";
    $usresult = pg_query($adminconn, $usrsquery) or die('Query failed: ' . pg_last_error());
    while($usrow = pg_fetch_row($usresult))
		{
      $m_pos = $usrow[0]-1; 
      echo"<script>
        users[$m_pos]= $usrow[1];
      </script>";
      
      
    }
 

    echo"<script>
        localStorage.setItem(\"USRS\",users);
        localStorage.setItem(\"FAVN\",favdoc);
        localStorage.setItem(\"FAVT\",ftimes);
    </script>";


    pg_free_result($fdnresult);
    pg_free_result($aqueryresult);
    pg_close($adminconn);
    




    echo"<script>
      // localStorage.setItem('');
    </script>";
  }


  echo"
    <script>
      var admin = '$admin';
    </script>
  ";
	$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error()); 
	$query = "SELECT uid FROM usuarios WHERE usuario ='$varsesion' ";
	$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
	$row = pg_fetch_row($result);
	$uid = $row[0];
	pg_free_result($result);
	pg_close($dbconn);
  

    // Include Composer autoloader if not already done.
    // $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
    // "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
    // $_SERVER['REQUEST_URI']; 
    // if (strpos($link, 'examples') !== false) {
    //   include '../../../Admin/vendor/autoload.php';
    // }else{
    //   include '../../Admin/vendor/autoload.php';
    // }
     
    // Parse pdf file and build necessary objects.
    // $parser = new \Smalot\PdfParser\Parser();

	
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  
  <?php 

// Program to display current page URL. 
    $library = false;
    if(strpos($link, "library") || (!$admin && substr($link, -10, 10) == "dashboard/")){
      $library = true;
    }
  
    if(strpos($link, 'examples') !== false){
      $index = 0;
      echo"
      <link href=\"".$add."../assets/img/brand/favicon.png\" rel=\"icon\" type=\"image/png\">
      <link href=\"".$add."../assets/js/plugins/nucleo/css/nucleo.css\" rel=\"stylesheet\" />
      <link href=\"".$add."../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" />
      <link href=\"".$add."../assets/css/argon-dashboard.css?v=1.1.0\" rel=\"stylesheet\" />
      <link href=\"".$add."../assets/css/nvbr.css\" rel=\"stylesheet\" />
      <link href=\"".$add."../assets/css/main.css\" rel=\"stylesheet\" />
      ";
    }else{
      $index = 1;
      echo"
        <link href=\"".$add."assets/img/brand/favicon.png\" rel=\"icon\" type=\"image/png\">
        <link href=\"".$add."assets/js/plugins/nucleo/css/nucleo.css\" rel=\"stylesheet\" />
        <link href=\"".$add."assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" />
        <link href=\"".$add."assets/css/argon-dashboard.css?v=1.1.0\" rel=\"stylesheet\" />
        <link href=\"".$add."assets/css/nvbr.css\" rel=\"stylesheet\" />
        <link href=\"".$add."assets/css/main.css\" rel=\"stylesheet\" />
      ";
    }
  ?>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
</head>

<?php

    $dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
    // echo $varsesion;
    $query0 = "SELECT * FROM usuarios WHERE '$varsesion'=usuario";
    $result0 = pg_query($dbconn, $query0) or die('Query failed: ' . pg_last_error());
    $row0 = pg_fetch_row($result0);
    $user_name = $row0[1]."";
    $user_last_name = $row0[2];
    $username = $row0[3];
    $user_pass=$row0[4];
    $user_email=$row0[5];
    $user_full_name= trim($row0[1])." ".trim($row0[2]);
    $user_dpi = trim($row0[8]);

    $query = "SELECT * FROM biblioteca WHERE '$row0[0]'=uid";
    $result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
    $row=pg_num_rows($result);

    $added_url = $index==1?$add."/dashboard/assets/img/profile/default.png": $isSimpleViewer? "assets/img/profile/default.png": "assets/img/profile/default.png";
    $added_url = $admin? $added_url : $index==1? "/dashboard/assets/img/profile/default.png": $added_url;
    $profile_image = $row0[6] == null? "<img alt=\"Image placeholder\" src=\"$add../$added_url\" class=\"rounded-circle\">":"<img alt=\"Image placeholder\" src = \"data:image/jpg;base64,".base64_encode(pg_unescape_bytea($row0[6]))."\" class=\"rounded-circle\">";

    // echo "<script>console.log('$isSimpleViewer')</script";
    // echo $row;

  ?>


<!-- Navbar -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
  <div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <?php 
      $href = $index==1?"<a class=\"navbar-brand pt-0\" href=\"".$add."\">":"<a class=\"navbar-brand pt-0\" href=\"".$add."..\">";
      echo $href;
    ?>
      <h1>LAWBRARY</h1>
    </a>
    <!-- User -->
    <ul class="nav align-items-center d-md-none">
      <li class="nav-item dropdown">
        <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="ni ni-bell-55"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
              <?php 
                  echo $profile_image;  
              ?>
            </span>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
          <div class=" dropdown-header noti-title">
            <h6 class="text-overflow m-0">Welcome!</h6>
          </div>
          <?php 
            $href = $index==1?"<a href=\"".$add."examples/profile.php\" class=\"dropdown-item\">":"<a href=\"".$add."profile.php\" class=\"dropdown-item\">";
            echo $href;
          ?>
          <a href="profile.php" class="dropdown-item">
            <i class="ni ni-single-02"></i>
            <span>My profile</span>
          </a>
          <a href="profile.php" class="dropdown-item">
            <i class="ni ni-settings-gear-65"></i>
            <span>Settings</span>
          </a>
          <a href="profile.php" class="dropdown-item">
            <i class="ni ni-calendar-grid-58"></i>
            <span>Activity</span>
          </a>
          <a href="profile.php" class="dropdown-item">
            <i class="ni ni-support-16"></i>
            <span>Support</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#!" class="dropdown-item">
            <i class="ni ni-user-run"></i>
            <span>Logout</span>
          </a>
        </div>
      </li>
    </ul>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
      <!-- Collapse header -->
      <div class="navbar-collapse-header d-md-none">
        <div class="row">
          <div class="col-6 collapse-brand">
            <a href="<?php echo $add ?>../">
            <?php 
              $href = $index==1?"<a class=\"navbar-brand pt-0\" href=\"".$add."\">":"<a class=\"navbar-brand pt-0\" href=\"".$add."..\">";
              echo $href;
            ?>
              <h1>LAWBRARY</h1>
            </a>
          </div>
          <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
      <!-- Form -->
      <form class="mt-4 mb-3 d-md-none">
        <div class="input-group input-group-rounded input-group-merge">
          <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Buscar" aria-label="Search">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <span class="fa fa-search"></span>
            </div>
          </div>
        </div>
      </form>
      <!-- Navigation -->
      <ul class="navbar-nav">
        <li class="nav-item" > <!-- this can have 'active' class -->
          <?php 
            $href = $index==1?"<a class=\" nav-link \" href=\"".$add."\">":"<a class=\" nav-link \" href=\"".$add."../\">"; /* this can have 'active' class */
            echo $href;
            $adminoruserhtml = $varsesion== "admin"? "<i class=\"ni ni-tv-2\"></i> Dashboard":"<i class=\"ni ni-air-baloon\"></i> Inicio";
            echo $adminoruserhtml;
          ?>
          </a>
        </li>
        
       
          <?php 
            if ($varsesion == "admin") {
              echo " <li class=\"nav-item\">";
              $href = $index==1?"<a class=\"nav-link \" href=\"".$add."examples/library.php\">":"<a class=\"nav-link \" href=\"".$add."library.php\">";
              echo $href."
                  <i class=\"ni ni-books\"></i>Biblioteca
                </a>
              </li>";
            }
          ?>
        <li class="nav-item">
          <?php 
            $href = $index==1?"<a class=\"nav-link \" href=\"".$add."examples/profile.php\">":"<a class=\"nav-link \" href=\"".$add."profile.php\">";
            echo $href;
          ?>
            <i class="ni ni-single-02"></i> Perfil
          </a>
        </li>

        <li class="nav-item">
          <?php 
            $href = $index==1?"<a class=\"nav-link \" href=\"examples/templates.php\">":"<a class=\"nav-link \" href=\"templates.php\">";
            echo $href;
          ?>
            <i class="ni ni-paper-diploma"></i> Plantillas
          </a>
        </li>

        <li class="nav-item">
          <?php 
            $href = $index==1?"<a class=\"nav-link \" href=\"examples/mis_templates.php\">":"<a class=\"nav-link \" href=\"mis_templates.php\">";
            echo $href;
          ?>
            <i class="ni ni-paper-diploma"></i> Mis plantillas
          </a>
        </li>
        
        <?php
          $new_doc = $admin? "<li class=\"nav-item\">":"<li class=\"nav-item\" style=\"display:none\">";
          echo $new_doc;
          $href = $index==1?"<a class=\"nav-link \" href=\"".$add."examples/newfile.php\">":"<a class=\"nav-link \" href=\"".$add."newfile.php\">";
            echo $href;
        ?>
            <i class="ni ni-collection"></i> Nuevo documento
          </a>
        </li>


        <!-- <li class="nav-item">
          <?php 
            // $href = $index==1?"<a class=\"nav-link \" href=\"examples/tables.php\">":"<a class=\"nav-link \" href=\"tables.php\">";
            // echo $href;
          ?>
            <i class="ni ni-bullet-list-67"></i> Tables
          </a>
        </li> -->
      </ul>
      <!-- Divider -->
      <hr class="my-3">
      <!-- Heading -->
    </div>
  </div>
</nav>
<div class="main-content">
  <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
      <!-- Brand -->
     <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block">Perfil</a>
      <!-- Form -->
      <?php 
        if ($library) {
          $valuetosearch = $_POST['valuetosearch'];
			    $valuetosearch = urlencode($valuetosearch);
          echo"
              <form method='post' class=\"navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto\">
                <div class=\"form-group mb-0\">
                  <div class=\"input-group input-group-alternative\">
                    <div class=\"input-group-prepend\">
                      <button class=\"fas fa-search rounded-circle\" type=\"submit\" name=\"buscar\">
                      </button>
                    </div>
                    <input class=\"form-control\" name=\"gsearch\" placeholder=\"Buscar\" type=\"text\">
                  </div>
                </div>
              </form>
          ";
        }
      ?>

      <!-- User -->
      <ul class="navbar-nav align-items-center d-none d-md-flex">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              
              <span class="avatar avatar-sm rounded-circle">
                <?php 
                  echo $profile_image;
                ?>
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold"><?php echo $username ?></span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <!-- <h6 class="text-overflow m-0">Welcome!</h6> -->
            </div>
            <?php 
              $added= $index == 1? $add."examples":$add."../examples"; 
              $exit = $index == 1? $add."../../inicio/salir.php": $add."../../../inicio/salir.php";
            ?>
            <?php echo"
              <a href=\"$added/profile.php\" class=\"dropdown-item\">
            ";?>
              <i class="ni ni-single-02"></i>
              <span>Perfil</span>
            </a>
            <div class="dropdown-divider"></div>
            <a <?php echo "href= \"".$add.$exit." \"" ?> class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Cerrar sesión</span>
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
<!-- End Navbar -->

  <?php 
    if ($admin) {
      $favoritequery = "SELECT * FROM biblioteca";
      $usersquery = "SELECT * FROM usuarios";
       $uresult = pg_query($dbconn, $usersquery) or die('Query failed: ' . pg_last_error());
      $users=pg_num_rows($uresult);
    }else{
      $favoritequery = "SELECT * FROM biblioteca WHERE '$uid'=uid";
    }
    $fresult = pg_query($dbconn, $favoritequery) or die('Query failed: ' . pg_last_error());
    $favorites=pg_num_rows($fresult);

  ?>


  <!-- Header -->
  <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
      <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Favoritos</h5>
                    <span class="h2 font-weight-bold mb-0"><?php echo$favorites ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                      <i class="far fa-star"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                  <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                  <span class="text-nowrap">Since last month</span> -->
                </p>
              </div>
            </div>
          </div>
          <?php 
            $userscard = $admin? "<div class=\"col-xl-3 col-lg-6\">": "<div class=\"col-xl-3 col-lg-6\" style=\"display:none;\">";
            echo $userscard;
          ?>
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Usuarios</h5>
                    <span class="h2 font-weight-bold mb-0"><?php echo$users ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-blue text-white rounded-circle shadow">
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                  <!-- <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                  <span class="text-nowrap">Since yesterday</span> -->
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    
    function funcionFavorito(p1,idFile,idUser, addjs) {
      if ($('#'+p1).is(':checked')) {
			    $('#a'+p1).toggleClass('fas fa-star');
            // alert( "Checked" );
            if(admin ==1){
              $.ajax({
              url: '../assets/php/crud.php',
              type: 'POST',
              data: {tipo:'fav',idF:idFile,idU:idUser,is:1},
                  success: function(data){
                    if (data == "Repetido"){
                        alert(data);	
                    }
                      location.reload();
                  }
        	    });
            }
            else{
              $.ajax({
              url: 'assets/php/crud.php',
              type: 'POST',
              data: {tipo:'fav',idF:idFile,idU:idUser,is:1},
                  success: function(data){
                    if (data == "Repetido"){
                        alert(data);	
                    }
                      location.reload();
                  }
        	    });
            }
        }else{
        	$('#a'+p1).toggleClass('far fa-star');
            // alert( "No Checked" );
            if(admin ==1){
              $.ajax({
              url: '../assets/php/crud.php',
              type: 'POST',
              data: {tipo:'fav',idF:idFile,idU:idUser,is:0},
                  success: function(data){
                      if (data == "No existe"){
                        alert(data);	
                    }
                      location.reload();
                  }
              });
            }
            else{
              $.ajax({
              url: 'assets/php/crud.php',
              type: 'POST',
              data: {tipo:'fav',idF:idFile,idU:idUser,is:0},
                  success: function(data){
                      if (data == "No existe"){
                        alert(data);	
                    }
                      location.reload();
                  }
              });

            }
        }
    }
  </script>