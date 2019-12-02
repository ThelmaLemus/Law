<?php
    session_start();
	error_reporting(0);
	$varsesion = $_SESSION['usuario'];
	if($varsesion == null || $varsesion == ''){
		echo "<body class='fondo'>";
		echo "<script>
               	alert('Debe inciar sesión para entrar');
       			window.location= 'index.php'
   			</script>";
	}
	// include 'navbar.php'; 

	
	if(isset($_POST['IChange'])){
        $user_name = $_POST['u_name'];
        $user_last_name = $_POST['u_last_name'];
        $user_email = $_POST['u_email'];
        $user_pass = $_POST['u_pass'];
        
        $dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

        $query2 = "SELECT * FROM usuarios WHERE '$varsesion' = usuario";
        $result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
        $row2 = pg_fetch_row($result2);

        if (!($user_pass == trim($row2[4]))) {
            pg_free_result($result);
            pg_free_result($result2);
            pg_close($dbconn);
            echo "<script>
                    alert('Contraseña incorrecta');
                    window.location= '../examples/profile.php'
                </script>";
        }elseif ($user_pass == trim($row2[4])) {
            $query = "UPDATE usuarios SET nombre = '$user_name', apellido = '$user_last_name', correo= '$user_email' WHERE usuario='$varsesion'";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());
            pg_free_result($result);
            pg_free_result($result2);
            pg_close($dbconn);
            echo "<script>
            alert('Información actualizada exitosamente');
            window.location= '../examples/profile.php'
            </script>";
        }	

    }
    
    if(isset($_POST['proff'])){
        
        $uphone = $_POST['num'];
        $ucol =$_POST['numc'];
        $uadd =$_POST['dire'];
        $udesc =$_POST['descr'];


        $dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

        $query2 = "SELECT * FROM usuarios WHERE '$varsesion' = usuario";
        $result2 = pg_query($query2) or die('Query failed: ' . pg_last_error());
        $row2 = pg_fetch_row($result2);

            $query = "UPDATE usuarios SET n_telefono = '$uphone', n_colegiado = '$ucol', descripcion= '$udesc', d_oficina = '$uadd' WHERE usuario='$varsesion'";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());
            pg_free_result($result);
            pg_free_result($result2);
            pg_close($dbconn);
            echo "<script>
            alert('Información actualizada exitosamente');
            window.location= '../examples/profile.php'
            </script>";

	}
?>