<?php
		echo"
			<script>
				var array_comentarios = null;
				console.log('entro');
			</script>
		";
	$lid = $_GET["lid"];
	$pagina = $_GET["pagina"];
	//OBTENGO LOS COMENTARIOS DE la LEY PRINCIPALES
	$link = pg_connect("host=localhost dbname=proyectoleyes user=postgres password=1998");
	$dbconn = $link or die('Could not connect: ' . pg_last_error());
	$query = "SELECT * FROM comentarios WHERE '$lid'=lid AND 0=padre";
	$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
	$si_hay=pg_num_rows($result);

	if($si_hay > 0)
	{
		echo "<ul class='list-group list-group-flush posts'>";
		while ($row = pg_fetch_row($result))
		{
			$username_query = "SELECT * FROM usuarios WHERE '$row[0]'=uid";
			$user_result = pg_query($dbconn, $username_query) or die('Query failed: ' . pg_last_error());
			$user = pg_fetch_row($user_result);
			$full_name =$user[1].$user[2];
			echo"
				<script>
					var comentario = {comment_ID:\"$row[0]\"};
					debugger
				</script>
			";
			echo
			"
			<li class='list-group-item'>
				<div class='post'>
					<div class='titlepost'>
						<h4> Pagina: ";
						echo $row[4];
						echo "</h4>
					</div>
					<div class='postcontent'>";
						echo $row[2];
					echo "</div>
					<div class='postactions'>
						<div class='actionsgroup'>
							<div class='ashow far fa-comment' name=\"bubble\"  data-toggle='collapse' data-target='.commentID' aria-expanded='true' aria-controls='commentID'>
							</div>
							<div class='ashow far fa-bookmark>
							</div>
						</div>
					</div>
				</div>
			</li>
			";
		}
		echo "</ul>";
	} 
	else
	{
		echo "\nNo existen comentarios";
	}

								
	$valor = pg_fetch_row($result);
	//COMPRUEBO SI HAY POR LO MENOS UNO
	$comentario = $valor[2];
	echo
	"
	<script>
		pagina=".$page.";
		var newurl=\"../Admin/\"+url+\"#page=\"+pagina+\"\";
	</script>
	";
?>