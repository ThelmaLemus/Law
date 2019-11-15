  <?php
    session_start();
    error_reporting(0);

    $varsesion = $_SESSION['usuario'];

  ?>

  <!DOCTYPE html>
  <!--
  Template Name: Drywest
  Author: <a href="https://www.os-templates.com/">OS Templates</a>
  Author URI: https://www.os-templates.com/
  Licence: Free to use under our free template licence terms
  Licence URI: https://www.os-templates.com/template-terms
  -->
  <html lang="">
  <!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
  <head>
  <title>Lawbrary</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="layout/scripts/index.js"></script>

    <body id="top">
  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <div id="logo" class="fl_left">
        <h1>Lawbrary</h1>
      </div>
      <!-- ################################################################################################ -->
    </header>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- Top Background Image Wrapper -->
  <div class="bgded" style="background-image:url('../style/images/Logo.jpeg');"> 
    <!-- ################################################################################################ -->
    
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
    <div class="wrapper overlay">
      <article id="pageintro" class="hoc clear"> 
        <!-- ################################################################################################ -->
        <!-- <h3 class="heading">Biblioteca virtual</h3> -->
        <!--<p>Posuere nisi in gravida nisl in est ligula tempus ut mollis quis tempus vitae orci morbi nulla tortor.</p>
      -->
      
      <footer class="lr_forms">
        <!-- <a class="btn btn-info" href="#">Iniciar</a> -->
        <form class="login_form" method="post">
          <!-- <input type="text" name="search" placeholder="Search.."> -->
          <div class="form-group">
            <label for="usr">Usuario</label>
            <input type="text" name="user" placeholder="Usuario" class="form-control" id="usr" required>
            </div>
            <div class="form-group">
              <label for="pswrd">Contraseña</label>
              <input type="password" name= "password" placeholder="Contraseña" class="form-control" id="pswrd" required>
            </div>
            <label for="lbut" style="color:white;">Contraseña</label>
            <div class="form-group">
              <input type="submit" name="Ingresar" value="Ingresar" class="btn btn-secondary" id="lbut">
            </div>
          </form>
          <form class="register_form" method="post">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="inputName">Nombre</label>
                <input required type="text" name = "Nombre" class="form-control" id="inputName" placeholder="Nombre">
              </div>
              <div class="form-group col-md-6">
                <label for="inputLastName">Apellido</label>
                <input required type="text" name = "Apellido" class="form-control" id="inputLastName" placeholder="Apellido">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="inputCorreo">Correo</label>
                <input required type="text" name = "Correo" class="form-control" id="inputCorreo" placeholder="Correo">
              </div>
              <div class="form-group col-md-6">
                <label for="inputUsuario">Usuario</label>
                <input required type="text" name = "Usuario" class="form-control" id="inputUsuario" placeholder="Usuario">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="inputContra">Contraseña</label>
                <input required type="password" name = "Contra" class="form-control" id="  inputContra" placeholder="Contraseña">
              </div>
              <div class="form-group col-md-6">
                <label for="inputContrac">Confirmar contraseña</label>
                <div class="confirm_pass">
                  <input required type="password" name = "Contra2" class="form-control" id="inputContrac" placeholder="Contraseña" onkeyup="passwordConfirmation(Contra.value, Contra2.value)">
                  <div class="fa fa-times-circle" id="pass2check" style="display:none;"></div>
                </div>
              </div>
              <div class="form-group col-md-12">
                <input type="submit" name="Registrar" class="btn btn-secondary" value="Registrar" id= "regbut">
              </div>
            </div>
          </form>
          <?php include 'layout/PHP/login.php'?>
        </footer>
        <!-- ################################################################################################ -->
      </article>
    </div>
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
  <!-- JAVASCRIPTS -->
  <script src="layout/scripts/jquery.min.js"></script>
  <script src="layout/scripts/jquery.backtotop.js"></script>
  <script src="layout/scripts/jquery.mobilemenu.js"></script>
  </body>
  </html>