<?php

include_once('controllers/checkSession.php');
include_once('controllers/LibroController.php');

if (!isset($_GET['isbn'])) {
    header('location: 404.php');
}

$libro = LibroController::getLibro($_GET['isbn']);
if ($libro === null) {
    header('location: 404.php');
}

$sugerancias = LibroController::getSuggestions();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/icofont/icofont.min.css">
    <link rel="stylesheet" href="assets/plugins/slick/slick.css">
    <link rel="stylesheet" href="assets/plugins/slick/slick-theme.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="w-100 bg-red">

                <?php include_once('common/menu.php') ?>

            </div>
        </div>

        <section class="container">
            <div class="row">
                <h2 class="title">&nbsp;</h2>
                <div class="d-none d-sm-block col-sm-2">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <img src="<?php echo API_URL . '/media/' . $libro->imagen ?>" alt="<?php echo $libro->nombre; ?>" class="card-img img-thumbnail">
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-sm-10">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <img src="<?php echo API_URL . '/media/' . $libro->imagen ?>" alt="<?php echo $libro->nombre; ?>" class="card-img">
                            </div>
                            <div class="col-12 col-sm-7">
                                <h4><?php echo $libro->nombre; ?></h4>
                                <p>de <?php echo $libro->autor; ?></p>
                                <div class="w-100">
                                    <h4 class="card-text text-danger"><strong>MXN <?php echo '$' . number_format($libro->precio, 2); ?></strong></h4>
                                    <p>
                                        <?php echo $libro->sinopsis; ?>
                                    </p>
                                    <a class="btn btn-outline-primary capitalize add-cart">
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

        <p>&nbsp;</p>
        <p>&nbsp;</p>

        <div class="container">
            <div class="row">
                <section class="w-100 py-5">
                    <h5 class="title">Tambien te pueden interesar</h5>
                    <div class="books">
                        <?php foreach ($sugerancias as $key => $libro) : ?>
                            <div class="card text-justify">
                                <a href="libro.php?isbn=<?php echo $libro->isbn ?>">
                                    <img src="<?php echo API_URL . '/media/' . $libro->imagen ?>" alt="<?php echo $libro->nombre; ?>" class="card-img">
                                </a>
                                <div class="card-body text-center">
                                    <p class="card-subtitle"><?php echo $libro->autor; ?></p>
                                    <h6 class="card-title"><strong> <?php echo $libro->nombre; ?> </strong></h6>
                                    <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p> -->
                                    <p class="card-text text-danger"><strong>MXN <?php echo '$' . number_format($libro->precio, 2); ?></strong></p>
                                    <a href="libro.php?isbn=<?php echo $libro->isbn ?>" class="btn btn-outline-primary btn-sm capitalize add-cart">
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
    </div>


    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <?php include_once('common/footer.php') ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="assets/plugins/slick/slick.js"></script>
    <script src="js/slider.js"></script>
</body>

</html>