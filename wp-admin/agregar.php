<?php
    include_once('../controllers/checkSession.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ALTA LIBROS</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel="stylesheet" href="../css/index2.css">
    <link rel="stylesheet" href="../css/icofont/icofont.min.css">
    <link rel="stylesheet" href="../assets/plugins/slick/slick.css">
    <link rel="stylesheet" href="../assets/plugins/slick/slick-theme.css">
    <link rel="stylesheet" href="../assets/plugins/sweetalert/sweetalert2.min.css">
    <link rel="shortcut icon" href="../img/favicon.ico" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/icofont/icofont.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
    <body>
    
    <div class="container-fluid bg-red">
        <div class="row">
            <div class="main">

                <?php include_once('../common/menuwpAdmin.php') ?>

            </div>
        </div>
    </div>

        <h4 style="background-color:#5a1313bf; 
                    text-align:center; 
                    padding:15px; 
                    margin-bottom:15px;
                    border: 0px;"> AGREGAR LIBRO</h4>

<main class="card form-signin">
        <form class="needs-validation">

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputIsbn" >ISBN</label>
                    <input pattern="[0-9]+" type="text" class="form-control" id="inputIsbn" placeholder="ISBN" 
                            name="caja_isbn" required autocomplete="nope">
                </div>
                <div class="form-group col-md-6">
                <label for="inputNombre" >Nombre</label>
                <input type="text" pattern="[a-zA-Z]+" class="form-control" id="inputNombre" placeholder="Nombre"
                            name="caja_nombre" required autocomplete="nope">
                </div>
            </div>

            <div class="form-group">
                <label for="inputAutor" >Autor</label>
                <input type="text" pattern="[a-zA-Z]+" class="form-control" id="inputAutor" placeholder="Autor"
                        name="caja_autor" required autocomplete="nope">
            </div>
            <div class="form-group">
                <label for="inputEditorial" >Editorial</label>
                <input type="text" pattern="[a-zA-Z]+" class="form-control" id="inputEditorial" placeholder="Editorial"
                        name="caja_editorial" required autocomplete="nope">
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="inputStock" >Stock</label>
                    <input type="text" pattern="[0-9]+" class="form-control" id="inputStock" name="caja_stock" placeholder="Stock" required autocomplete="nope">
                </div>
                
                <div class="form-group col-md-2">
                <label for="inputCategoria" >Categoria</label>
                <input type="text" pattern="[a-zA-Z]+" class="form-control" id="inputCategoria"  name="caja_categoria" placeholder="Categoria" required autocomplete="nope">
                </div>

                <div class="form-group col-md-2">
                <label for="inputAnio" >Año Publicación</label>
                <input type="text" pattern="[0-9]+" class="form-control" id="inputAnio"  name="caja_anio" placeholder="Año Publicación" required autocomplete="nope">
                </div>

                <div class="form-group col-md-6">
                <label for="inputImagen">Seleciona una imagen:</label>
                <input type="file" id="inputImagen" name="caja_imagen" required autocomplete="nope">
                </div>

                <div class="form-group col-md-8">
                <label for="inputSinopsis">sinopsis</label>
                <input type="text" pattern="[a-zA-Z]+" class="form-control" id="inputSinopsis"  name="caja_sinopsis" placeholder="sinopsis" required autocomplete="nope">
                </div>

                <div class="form-group col-md-2">
                <label for="inputPrecio" >precio</label>
                <input type="text"  pattern="[0-9]+" class="form-control" id="inputPrecio"  name="caja_precio" placeholder="Precio" required autocomplete="nope">
                </div>
            </div>
            
            <button type="submit" class="w-100 btn btn-lg btn-primary" >GUARDAR</button>
            </form>
    </main>

    <!-- /.login-box -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>
    <script src="../assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="../js/agregar.js"></script>
    </body>
</html>