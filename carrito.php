<?php

include_once('controllers/checkSession.php');
include_once('controllers/CarritoController.php');

$carrito = CarritoController::getAll($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compra</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/icofont/icofont.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="w-100 bg-red">

                <?php include_once('common/menu.php') ?>

            </div>
        </div>

        <p>&nbsp;</p>

        <div class="container text-center">
            <div class="row">
                <h3 class="title">Carrito de compra</h3>
                <div class="col-12 col-sm-8">
                    <div class="card text-left">
                        <img class="card-img-top" src="holder.js/100px180/" alt="">
                        <div class="card-body">
                            <h5 class="card-title"> <strong>En el carrito (<?php  echo count($carrito) ?> elementos)</strong> </h5>
                            <div class="carrito-wrapper w-100">
                                <!-- AUI VA EL CARRITo -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="card text-left">
                        <img class="card-img-top" src="holder.js/100px180/" alt="">
                        <div class="card-body">
                            <h5 class="card-title">  <strong>Total a pagar</strong> </h5>
                            <p class="card-text">
                                <table class="table table-light">
                                    <tbody >
                                        <tr>
                                            <td> Subtotal: </td>
                                            <td> MXN <span class="subtotal-carrito">$0,00</span></td>
                                        </tr>
                                        <tr>
                                            <td> Envios: </td>
                                            <td> Gratis </td>
                                        </tr>
                                        <tr class="border-top">
                                            <td> Total: </td>
                                            <td> MXN <span class="total-carrito">$0,00</span> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button class="btn btn-primary btn-block btn-lg capitalize btnPayment" <?php echo (count($carrito) == 0) ? 'disabled': '' ?>>Pagar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </p>
                        </div>
                    </div>
                </div>
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