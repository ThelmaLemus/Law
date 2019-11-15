<?php

    session_start();

    require "vendor/autoload.php";

    use Google\Cloud\Vision\VisionClient;

    $certificado_archivo = file_get_contents("Prueba-cloudVision-af8167c90826.json");
    $certificado = json_decode($certificado_archivo);

    $config = ['keyFilePath' => "Prueba-cloudVision-af8167c90826.json"];

    var_dump($certificado);

    $vision = new VisionClient($config);

    $familyphotoresource = fopen($_FILES['image']['tmp_name'], 'r');

    $image = $vision->image($familyphotoresource, ['FACE_DETECTION', 'WEB_DETECTION']);
    $result = $vision->annotate($image);

    var_dump($result);
/* 
    if($result)
    {
        $imagetoken = random_int(1111111, 999999999);
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/feed/' . $imagetoken . ".jpg");
    }
    else
    {
        header("location: prueba-cloud.html");
        die();
    }

    $faces = $result->faces();
    $logos = $result->logos();
    $labels = $result->labels();
    $text = $result->text();
    $fullText = $result->fullText();
    $properties = $result->imageProperties();
    $cropHints = $result->cropHints();
    $web = $result->web();
    $safeSearch = $result->safeSearch();
    $landmarks = $result->landmarks(); */
?>

<!-- <!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cloud Vision API</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src='main.js'></script>

    <style>
        body, html {
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="container-fluid" style="max-width: 1080px;">
        <br><br><br>
        <div class="row">
            <div class="col-md-12" style="margin: auto; background: white; padding: 20px; box-shadow: 10px 10px 5px #888;">
                <div class="panel-heading">
                    <h2><a href="/">Google Cloud Vision API</h2>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4" style="text-align: center;">
                        <img class="img-thumbnail" src="
                        <?php 
                            /* if($faces == null)
                            {
                                echo "/feed/" . $imagetoken . ".jpg";
                            }
                            else
                            {
                                //NEED TWEAK HERE
                                echo "/feed/" . $imagetoken . ".jpg";
                            } */
                        ?>
                        " alt="Imagen analizada">
                    </div>
                    <div class="col-md-8 border" style="padding: 10px;">
                        <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tab-list">
                            <li class="nav-item">
                                <a href="#pills-face" role="tab" class="nav-link active" id="pills-face-tab" data-toggle="pill" aria-controls="pills-face" aria-selected="true">Faces</a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    
</body>
</html> -->