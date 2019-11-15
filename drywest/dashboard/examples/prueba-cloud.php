<?php

require "vendor/autoload.php";

use Google\Cloud\Vision\VisionClient;

$vision = new VisionClient(['keyFile' => json_decode(file_get_contents("Prueba-cloudVision-af8167c90826.json"), true)]);

$familyphotoresource = fopen("imagen.jpeg", 'r');

$image = $vision->image($familyphotoresource, ['FACE_DETECTION', 'WEB_DETECTION']);
$result = $vision->annotate($image);

var_dump($result);

?>