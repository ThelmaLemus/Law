<title>Perfil</title>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="../assets/css/profile.css">
  <script src="../../layout/scripts/index.js"></script>
<?php
  include 'navbar.php'; 
  include '../assets/php/validar_foto.php';
  include '../assets/php/validar_contra.php';
  include '../assets/php/validar_info.php';

  $dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
  // echo $varsesion;
  $query = "SELECT * FROM usuarios WHERE '$varsesion'=usuario";
  $result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
  $row = pg_fetch_row($result);
  $user_name = trim($row[1]);
  $user_last_name = trim($row[2]);
  $username = trim($row[3]);
  $user_pass=trim($row[4]);
  $user_email=trim($row[5]);
  $user_full_name= trim($row[1])." ".trim($row[2]);
  $user_dpi = trim(row[8]);
  $user_phone = trim(row[10]);
  $user_col = trim(row[9]);
  $user_des = trim(row[11]);
  $user_addr = trim(row[12]);
  pg_free_result($result);
  pg_close($dbconn);
	//
?>
<body class="">
    
    <!-- Header -->
    <!-- <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;"> -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 200px;">

      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <!-- Right navbar -->
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <div href="">
                  <?php 
                      echo $profile_image; 
                  ?>
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Editar </a>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambiar foto de perfil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="post" class="formp" enctype= "multipart/form-data" >
                          <div class="form-group">
                            <div class="input-group mb-3">
                              <div class="custom-file">
                                <input  type="file" name="imagen" accept="image/jpeg, image/png" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01" style="display:flex;">Elige un archivo</label>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input type="submit" name="submit" value="Cambiar" class="btn btn-primary" >
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <a href="#" class="btn btn-sm btn-default float-right">Message</a> -->
              </div>
            </div>

            <?php
              $dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
              // echo $varsesion;
              $query = "SELECT * FROM comentarios WHERE '$uid'=uid";
              $result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
              $comments=pg_num_rows($result);
              pg_free_result($result);
              pg_close($dbconn);     
            ?>

            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading"><?php echo$favorites ?></span>
                      <span class="description">Favoritos</span>
                    </div>
                    <div>
                      <span class="heading"><?php echo$comments ?></span>
                      <span class="description">Comentarios</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  <?php echo $user_full_name ?>
                </h3>
              </div>
            </div>
          </div>
        </div>
        <!-- Right navbar -->

        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Mi cuenta</h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
              <form method='post' action="../assets/php/validar_info.php">
                <h6 class="heading-small text-muted mb-4">General</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-nombre">Nombre</label>
                        <input name="u_name" type="text" id="input-nombre" class="form-control form-control-alternative" placeholder="Nombre" value="<?php echo $user_name?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-apellido">Apellido</label>
                        <input name="u_last_name" type="text" id="input-apellido" class="form-control form-control-alternative" placeholder="Apellido" value= "<?php echo $user_last_name?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Usuario</label>
                        <input name="u_username" type="text" id="input-username" class="form-control form-control-alternative" placeholder="Usuario" value="<?php echo $username?>" required disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-dpi">DPI</label>
                        <input name="u_dpi" type="text" id="input-dpi" class="form-control form-control-alternative" placeholder="DPI" value="<?php echo $user_dpi?>" required disabled>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email</label>
                        <input name="u_email" type="email" id="input-email" class="form-control form-control-alternative" placeholder="ejemplo@lawbrary.com" value="<?php echo $user_email?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-pass">Contraseña</label>
                        <input name="u_pass" type="password" id="input-pass" class="form-control form-control-alternative" placeholder="Contraseña" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <input type="submit" name="IChange" class="btn btn-secondary" value="Cambiar"> 
                    </div>
                  </div>
                </div>
                <hr class="my-4"/>
              </form>
              <form method='post'>
                <h6 class="heading-small text-muted mb-4">Cambio de contraseña</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-passactual">Contraseña actual</label>
                        <input type="password"  name = "actual" id="input-passactual" class="form-control form-control-alternative" placeholder="Contraseña" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-pass1">Contraseña nueva</label>
                        <input type="password"  name = "Contra" id="input-pass1" class="form-control form-control-alternative" placeholder="Contraseña" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-pass2">Confirma tu contraseña nueva</label>
                        <div class="row">
                            <input type="password"  name = "Contra2" id="input-pass2" class="form-control form-control-alternative col-lg-10" placeholder="Contraseña" onkeyup="passwordConfirmation(Contra.value, Contra2.value)" required>
                            <div class="col-lg-1 fa fa-times-circle" id="pass2check" style="display:none; color: red;"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="submit" name="PChange" class="btn btn-secondary" value="Cambiar" id= "regbut"> 
                </div>
              </form>
              <form method='post'>
                <h6 class="heading-small text-muted mb-4">Perfil profesional</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-passactual">Número de teléfono</label>
                        <input type="text"  name = "num" id="input-passactual" class="form-control form-control-alternative" placeholder="35335 1207" value="<?php echo $user_phone ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-pass2">Número de colegiado</label>
                        <input type="text"  name = "numc" id="input-pass2" class="form-control form-control-alternative col-lg-10" value="<?php echo $user_col ?>" placeholder="Extendido por el colegio de abogados" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-pass1">Descripción del profesional (Incluir especialidad)</label>
                        <textarea type="text"  name = "descr" id="input-pass1" class="form-control form-control-alternative" value="<?php echo $user_des ?>" placeholder="Máximo 500 caracteres" onkeyup="validDesc(this)" required></textarea>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-pass1">Dirección de oficina</label>
                        <input type="text"  name = "dire" id="input-pass1" class="form-control form-control-alternative" value="<?php echo $user_addr ?>" placeholder="10ma Calle 13-75 Edificio Americas oficina 702" required>
                      </div>
                    </div>
                  </div>
                  <input type="submit" name="proff" class="btn btn-secondary" value="Agregar" id= "regbut"> 
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
    </div>
  </div>

  <?php include 'footer.php'; ?>

</body>

</html>