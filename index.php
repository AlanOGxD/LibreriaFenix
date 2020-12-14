<?php

include_once('controllers/checkSession.php');
include_once('controllers/LibroController.php');
include_once('controllers/CarritoController.php');

$carrito = CarritoController::getAll($_SESSION['usuario']);
$carousel = LibroController::getSuggestions();
$slider = LibroController::getAll();
$index = rand(0, count($slider) - 1);
$libroSemana = $slider[ $index ];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreria Fenix</title>
    <link rel="stylesheet" href="css/index.css">
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

                <?php include_once('common/menu.php') ?>
                <?php include_once('common/carousel.php') ?>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <section class="w-100 py-5">
                <h2 class="title">Libros más vendidos</h2>
                <div class="books">
                    <?php foreach($slider as $key => $libro): ?>
                    <div class="card text-justify">
                        <a href="libro.php?isbn=<?php echo $libro->isbn ?>">
                            <img src="<?php echo API_URL . '/media/'. $libro->imagen ?>" alt="<?php  echo $libro->nombre; ?>" class="card-img">
                        </a>
                        <div class="card-body text-center">
                            <p class="card-subtitle"><?php  echo $libro->autor; ?></p>
                            <h6 class="card-title"><strong> <?php  echo $libro->nombre; ?> </strong></h6>
                            <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p> -->
                            <p class="card-text text-danger"><strong>MXN <?php  echo '$'.number_format($libro->precio, 2); ?></strong></p>
                            <a class="btn btn-outline-primary btn-sm capitalize add-cart" book-isbn="<?php echo $libro->isbn; ?>">
                                <i class="icofont-shopping-cart"></i>
                                Añadir al carrito
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <section class="container">
                <div class="row">
                    <h2 class="title">Libro de la semana</h2>
                    <div class="d-none d-sm-block col-sm-2">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <img src="<?php echo API_URL . '/media/'. $libroSemana->imagen ?>" alt="<?php  echo $libroSemana->nombre; ?>" class="card-img">
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-10">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <a href="libro.php?isbn=<?php echo $libroSemana->isbn ?>">
                                        <img src="<?php echo API_URL . '/media/'. $libroSemana->imagen ?>" alt="<?php  echo $libroSemana->nombre; ?>" class="card-img">
                                    </a>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <h4><?php  echo $libroSemana->nombre; ?></h4>
                                    <p>de <?php  echo $libroSemana->autor; ?></p>
                                    <div class="w-100">
                                        <h4 class="card-text text-danger"><strong>MXN <?php  echo '$'.number_format($libroSemana->precio, 2); ?></strong></h4>
                                        <p>
                                            <?php  echo $libroSemana->sinopsis; ?>
                                        </p>
                                        <a class="btn btn-outline-primary capitalize add-cart" book-isbn="<?php echo $libroSemana->isbn; ?>">
                                            <i class="icofont-shopping-cart"></i>
                                            Añadir al carrito
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
    <script>
        let carrito = <?php echo json_encode($carrito); ?>;
        localStorage.setItem('carrito', JSON.stringify(carrito));
        const API_URL = '<?php echo API_URL; ?>'
    </script>
    <script src="js/slider.js"></script>
    <script src="js/carrito.js"></script>
</body>

</html>