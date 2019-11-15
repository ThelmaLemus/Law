<?php 
	if ((isset($_POST['tipo'])) & (isset($_POST['idF'])) & (isset($_POST['idU'])) ) {
		$cat=$_POST['tipo'];
		$idf=$_POST['idF'];
		$idu=$_POST['idU'];
		$is=$_POST['is'];
		switch ($cat) {
		    case 'fav':
			        $dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
					$query = "SELECT * FROM biblioteca WHERE uid = '$idu' AND lid = '$idf'";
					$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
		    	if ($is==1) {
					$count = pg_num_rows($result);
					if($count==1){
							echo "Repetido";
	 					 }
					else { 
							$query = "INSERT INTO biblioteca VALUES ('$idu', '$idf') ";
							$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
					}
		    	}elseif ($is==0) {
		    		$count = pg_num_rows($result);
					if($count==1){
							$query = "DELETE FROM biblioteca WHERE uid='$idu' AND lid= '$idf'";
							$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
	 					 }
					else { 
							echo "No existe";
					}
		    	}


				pg_free_result($result);
				pg_close($dbconn);
		        
		        break;
		    case 'book':
		        echo "i es igual a 1";
		        break;
		    case 'ver':
		       	$dbconn = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
					$query = "SELECT * FROM ver WHERE uid = '$idu' AND lid = '$idf'";
					$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
		    	if ($is==1) {
					$count = pg_num_rows($result);
					if($count==1){
							echo "Repetido";
	 					 }
					else { 
							$query = "INSERT INTO ver VALUES ('$idu', '$idf') ";
							$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
					}
		    	}elseif ($is==0) {
		    		$count = pg_num_rows($result);
					if($count==1){
							$query = "DELETE FROM ver WHERE uid='$idu' AND lid= '$idf'";
							$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
	 					 }
					else { 
							echo "No existe";
					}
		    	}


				pg_free_result($result);
				pg_close($dbconn);
		        break;
		}
	}else{

	echo "Fuera";
	}
?>