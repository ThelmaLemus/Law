<?php
    
    if (isset($_POST["Ingresar"])){
        $dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

        $usuario=$_POST['user'];
        $contraseña=$_POST['password'];
        session_start();
        $_SESSION['usuario'] = $usuario;

        // echo "<script>console.log('$usuario'); </script>";
        // echo "<script>console.log('$contraseña'); </script>";
        
        
        $query = "SELECT * FROM usuarios WHERE '$usuario'=usuario AND '$contraseña'=contraseña";
        $result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
        
        $rows = pg_num_rows($result);
        
        if($rows>0){
            pg_free_result($result);
            pg_close($dbconn);
            echo "<script>
                window.location= 'dashboard/';
                </script>";
        } else {
            pg_free_result($result);
            pg_close($dbconn);
            echo "<script>
                alert('Usuario y/o contraseña incorrecta');
                </script>";
                    
        }
    }
    else if (isset($_POST["Registrar"])){

        $dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());

        $nombre=$_POST["Nombre"];
        $apellido=$_POST["Apellido"];
        $correo=$_POST["Correo"];
        $contraseña=$_POST["Contra"];
        $usuario=$_POST["Usuario"];

        $f5 = 0;
        $f6 = 0;

        $query1 = "SELECT * FROM usuarios WHERE usuario='$usuario'";
        $result1 = pg_query($dbconn, $query1) or die('Query failed: ' . pg_last_error());

        $rows1 = pg_num_rows($result1);

        if($rows1>0){
            echo "<script>
                alert('Usuario ya existente, intenta con uno diferente');
                window.location= 'index.php'
                </script>";
        } else {
            $f5=1;
        } 

        $query2 = "SELECT * FROM usuarios WHERE correo='$correo'";
        $result2 = pg_query($dbconn, $query2) or die('Query failed: ' . pg_last_error());

        $rows2 = pg_num_rows($result2);

        if($rows2>0){
            echo "<script>
                alert('Este correo ya está registrado, ingresa uno diferente.');
                window.location= 'index.php'
                </script>";
        } else {
            $f6=1;
        }

        if(($f5==1)&&($f6==1)){
            $date = date("Y-m-d");
            $query = "INSERT INTO usuarios(nombre, apellido, correo, usuario, contraseña, fecha_c) VALUES ( '$nombre', '$apellido','$correo', '$usuario', '$contraseña', '$date')";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());
            pg_free_result($result);
            pg_close($dbconn);
            session_start();
            $_SESSION['usuario'] = $usuario;
            echo "<body class='fondo'>";
            echo "<script>
                window.location= 'dashboard';
                alert('¡Bienvenido!');
                </script>";
        }
        
    }

?>
