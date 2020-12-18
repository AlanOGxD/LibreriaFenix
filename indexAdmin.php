<?php

include_once('controllers/checkSession.php');
include_once('controllers/LibroController.php');

$carousel = LibroController::getSuggestions();
$slider = LibroController::getAll();
$index = rand(0, count($slider) - 1);

$libroSemana = $slider[ $index ];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Libreria Fenix</title>
    <link rel="stylesheet" href="css/index2.css">
    <link rel="stylesheet" href="css/icofont/icofont.min.css">
    <link rel="stylesheet" href="assets/plugins/slick/slick.css">
    <link rel="stylesheet" href="assets/plugins/slick/slick-theme.css">
    <link rel="stylesheet" href="assets/plugins/sweetalert/sweetalert2.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    </head>
    <body>
    <div class="container-fluid bg-red">
        <div class="row">
            <div class="main">

                <?php include_once('common/menuAdmin.php') ?>
                <?php include_once('common/carousel.php') ?>

            </div>
        </div>
    </div>

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <?php include_once('common/footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="assets/plugins/slick/slick.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    
    <script src="js/slider.js"></script>
    </body>
</html>