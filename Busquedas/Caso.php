<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Caso específico</title>
	<?php include "../style/navbar.php" ?>

<body>
	<?php 

// 		$pdf = pdf_new('test.pdf');
// echo "adfe";
// pdf_open_file($pdf);

// pdf_begin_page($pdf, 500, 700);

		// include('../PDFTT/PdfToText.phpclass');
		// $pdf= new PdfToText();
		// $pdf= new PdfToText('http://localhost:8081/ProyectoLeyes/Busquedas/test.pdf');
		$string = "";



		$optlist = "destination={page=1 type=fixed zoom=1 top=100 left=50}";
		PDF_begin_document("test.pdf", "test", $optlist );





		// $data = $pdf->Text;
		// if (strops($data,$string) !== flase) {
		// 	echo $string;
		// 	# code...
		// }else{
		// 	echo "fail";
		// }



	 ?>
</body>
</html>