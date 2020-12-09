<?php
session_start();
if(!$_SESSION['aut'] == true){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Shop</title>
        <link rel="stylesheet" type="text/css" href="d/main.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
        <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <!-- bxSlider Javascript file -->
        <script src="js/jquery.bxslider.min.js"></script>
        <script src="js/slider.js"></script>
        <!-- bxSlider CSS file -->
        <link href="css/jquery.bxslider.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="conatiner">
                    <nav class="navbar navbar-inverse navbar-static-top">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li><a href="#">Inicio</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categorias <span class="caret"></span></a>
                                        <ul class="dropdown-menu list">
                                            <div class="categories">
                                                <?php
                                                include("conexion.php");
                                                $link=conectarse();
                                                $sql= "SELECT NOMBRE FROM CATEGORIA";
                                                $result = $link->query($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($fila = $result->fetch_assoc()) {
                                                        print '<li><a href="#">'.$fila['NOMBRE'].'</a></li>';
                                                    }
                                                }else{
                                                    echo 'No hay categorias para mostrar';
                                                }
                                                $link->close();
                                                ?>
                                            </div>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <a class="search-box">
                                            <input class="form-control search" type="text" placeholder="Buscar" id="searchBox"/>
                                            <button class="btn btn-primary glyphicon glyphicon-search btn-search" onclick="buscar()"></button>
                                        </a>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <?php echo $_SESSION["user"]; ?>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <div class="">
                                                <li><a href="nuevo_producto.php">Vender</a></li>
                                                <li><a href="configuracion.php">Configurar cuenta</a></li>
                                                <li><a href="logout.php">Salir</a></li>
                                            </div>
                                        </ul>
                                    </li>
                                    <li class="dropdown" >
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <span class="glyphicon glyphicon-shopping-cart"></span>
                                            &nbsp;Carrito 
                                            <span class="badge btn btn-danger" id="num-articulos">
                                            <?php
                                                $link=conectarse();
                                                $sql = "SELECT * FROM CARRITO WHERE USUARIO = ".$_SESSION["id_user"];
                                                $res = $link->query($sql);
                                                echo $res->num_rows;
                                            ?>
                                            </span>
                                        </a>
                                        <ul class="dropdown-menu" id="carrito">
                                            <!-- Elementos del carrito -->
                                            <script>$("#carrito").load("carrito.php");</script>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                </div>

                <!-- Modal eliminar-->
                <div id="eliminarArticulo" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header btn-danger">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Atenci&oacute;n</h4>
                            </div>
                            <div class="modal-body">
                                <h4>¿Esta seguro que desea eliminar este producto?</h4><br>
                                <div class="car-product no-border">
                                    <img id="eModalImg" src="media/images/1.jpg" width="85" height="85">
                                    <div>
                                        <label id="eModalNombre"><strong>Nombre producto</strong></label><br>
                                        <label id="eModalPrecio">$ 0.00</label><br>
                                        <label id="eModalCantidad">Cantidad: 2</label><br>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="eliminar()">Aceptar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- contenido principal -->
                <div class="main-content">
                    <div class="container-fluid">
                        <div id="myCarousel" class="carousel row" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                                <li data-target="#myCarousel" data-slide-to="3"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="title">
                                        <label>Nueva Ipad 3</label>
                                        <div class="description"></div>
                                    </div>
                                    <img class="carousel-img" src="media/images/1.jpg" alt="Chania">
                                </div>

                                <div class="item">
                                    <div class="title">
                                        <label>Huawei Ascend Mate 7</label>
                                        <div class="description"></div>
                                    </div>
                                    <img class="carousel-img" src="media/images/2.jpg" alt="Chania">
                                </div>

                                <div class="item">
                                    <div class="title">
                                        <label>OnePlus 2</label>
                                        <div class="description"></div>
                                    </div>
                                    <img class="carousel-img" src="media/images/3.jpg" alt="Chania">
                                </div>

                                <div class="item">
                                    <div class="title">
                                        <label>Microsoft Surface</label>
                                        <div class="description"></div>
                                    </div>
                                    <img class="carousel-img" src="media/images/4.jpg" alt="Chania">
                                </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Siguiente</span>
                            </a>
                        </div>
                        <div class="list-products">
                            <?php
                                $link=conectarse();
                                $sql= "SELECT NOMBRE FROM CATEGORIA";
                                $result = $link->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($fila = $result->fetch_assoc()) {
                                        echo '<h4 class="col-md-10 col-md-offset-1">'.$fila["NOMBRE"].'</h4>';
                                        $className = str_replace(" ", "-",$fila["NOMBRE"]);
                                        echo '<div class="'.$className.' col-lg-12 col-md-12 col-sm-10 col-xs-10">';
                                        $sql= "SELECT * FROM ARTICULO WHERE CATEGORIA = (SELECT idCategoria FROM CATEGORIA WHERE NOMBRE LIKE '".$fila["NOMBRE"]."') LIMIT 12";
                                        $res = $link->query($sql);
                                        $num = $res->num_rows;
                                        if ($num > 0) {
                                            while ($articulo = $res->fetch_assoc()) {
                                                $imagen = explode(",",$articulo['imagen'])[0];
                                                echo '<div class="slide">
                                                        <div class="promo"></div>
                                                        <a href="articulo.php?producto='.$articulo["idArticulo"].'">
                                                            <img src="media/images/products/'.$imagen.'"  title="'.$articulo["nombre"].'" width="300" height=225">
                                                        </a>
                                                    </div>';
                                            }                                         
                                        }
                                        echo '</div>';
                                        echo '<script>createSlider(\''.$className.'\')</script>';
                                    }
                                }else{
                                    echo 'No hay categorias para mostrar';
                                }
                                $link->close();
                            ?>
                        </div>
                    </div>
                </div>
                <!-- contenido principal -->
                <footer class="col-xs-12 col-sm-12 col-md-12">
                    <div class="footer-top">
                        <div class="little-padding">
                            <h4>Siguenos en nuestras redes sociales.</h4>
                            <a href="https://www.facebook.com/PaginaOficialSHOP"><img class="icon icons8-Facebook" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAABqElEQVRoQ2NkGOKAcYi7n2HUAwMdg6MxMOhjwDZgWwATw798BkZGB7o69v//A/8YmCYe3uC1AZ+9eJOQfcDW+QyMDAl0dTiaZf//MzQe2uDdgMsNOD0ADnnG/+sH0vEwu//+/+d4ZIPvAWxuwekBu8CtBxgZGOwHgwf+MzAcPLTeG2sSxukB+8Ct/weD42FuOLjeG6tbRz1Ar1gaNDHg4SjD4O4ozWCoI4zhd4egbTjDY1B4oKXCmMHGTBynIwe1B0AhX5GrhzfFDWoPTGi2YDDQFhq6HjiwzgvD8TUdZxmOnHpJVDkw4HkAmwfwJRl0X416gKh4xqNoSMYANkfj8uOXb38YfGJ2Da56gBQPXLj6jqGg9sTQ9cCaLQ8Ypsy7NnQ9sGDlbQYQxgVGS6ERWQohe3pIFqOjHkAKgdFMPJqJsTSnR1ujDAy45weoPS40WowO9MDWaAyQGgNDfnB3yA+vgyouu4AtCxgZGeMprcQo0U/2BAfMUpuAzQ5MjEwN9J4rAM0J/Pv/rwHXxAbMfaOzlJQkD2roHY0BaoQiJWaMxgAloUcNvQDVMwpAikLd1gAAAABJRU5ErkJggg==" width="48" height="48"></a>
                            <!-- Twitter icon by Icons8 -->
                            <a href="https://twitter.com/ShopOficial"><img class="icon icons8-Twitter" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAADTklEQVRoQ+1Y3VHbQBD+9kTMZCwGdxB3EFEBTgWBFwxPmAowFQAVxB3gPGH7BaeCKBXEqQDTAYwFCZm528yd+XGwJZ1OAoYZ6VXan+/bb/f2RHjjD73x/FECeO0KlhUoK5CTgVJCOQnMbf6yFTj9XRdC7gNoEBDo7BkYAQhVpXqMTbqcQzSIAmz5+puFTzqA00kDOythXqpE//qQwEdxfhh8SUQHcsvv4oxruL1Z98BtJlyopt9yA3DGNfE3OgfTUG37e64gRC86IUJsEv/5ZYQgNKbV4StV8esLK3NnlFyB00nDE/TdOGN0XUB4g6gFxklW8CZ5ogbeVcf4EwVxKkgEIPqTIwIdPgbnoaz4e0mMPE1U9KJzItSzAgB4CKYaE68ZIDF9kBGAqcRYMe9Z9cUgCjzGz+zJP1pI0Caa1aFbD8xIaN4BD6VaOsDO+3Gcc1f5POg/gfn7mMk9MG3iMYFW41nkoWTRxXb125x85iRoX4s05u0AABC9qEMEPbsTHzMGgZCZQiW8ESCvPD3rHRpYB5KKP9nINP0c0FW4vR4R4UMaiCLfFwOgf73hgVel8n4IkkMifCwyySRfkrCWdAJbSUj0ojYRvrxU0rNxZNNPVweQcqUsYAy6gGfGL7Xtm10p7UlF6fUnIUDraY6KfM/A16T9ZzZWKgC8QhVsR6gGkg4AQJ4DKWtlzA7UXKnZ2lkBMM5MJbjz3HJi8LFqrsSu3U+B2QPQ9wJviQXLDQLatgxl+c6wr5aCpPXEGcD8ZpolNbtvs7Jv3QMmvNVeZJfooq+YcaGWq0GWVT0bgLs+EMxh8nLnBsJ2dXCW0IPh9GJ+RMCuW6rzVi7Sufdi38RP4w6iQCj9d4EbIPrsCibLobUohjuA6aq9D2J97bSe27NJ5E0+ew/cRff60S4D7ft/Oy7s55GN3SqhfyjBe7iJCVYNggrY/JRyY1wHNtOGuWVzWbEhJl5C07GpD6x2EVNHH1IAOqrid7KOyiQg6T2gpw7JDQAtlwuNZtwkvlztFpm42xTS+xAQMJvpU2em+uxVU7NMwIiZRiQwktILs6wFNpLJfw64RHlGm3QJPWPwIlyXAIpgMY+PsgJ52CvCtqxAESzm8VFWIA97Rdj+A7EwUUCG28orAAAAAElFTkSuQmCC" width="48" height="48"></a>
                            <!-- Google Plus icon by Icons8 -->
                            <a href="https://plus.google.com/106594315412726743376"><img class="icon icons8-Google-Plus" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAC30lEQVRoQ+2ZPVATURSFv+2ZkRIqwwzWhp7wU2IjzEhaAWshlqQxabTlp0/SUxgbLEkkPem1oNNOmMF6ncPLG5mwb13ZZ7Jx9jaZgff2nXPvuT9vN2DCLZhw/OQExh3BPAKZj0BYYp2QPQJWRgo2pEPAYXBOO+7cWAmFJZrA1kiBDx8WUg961FwYnARuPQ8fxgreHh6yGvToRGFxE1i8DeFyRgh0g160hOMiEGYC/ABEcB7ds3ICo4pSHgGnp4srsPYS9DtbuL+s34VGDfqRRSRxAP1HYGoa9pswOwfVdfh+CfNFqLZg/incXMHuKnztJwYZ27C8J/G7Niw+h/KcAW9tpgCNPkw9gi99eLWQQQLydOMCbq7h2fR9gK8PYHPP/F1RSCkfPcavhLZrsP3WAFyKqMTKh6Mz8//jN3BykDoK/47AsIQs1M+DPljdgF7sPJaInF8Ca1smgWXNOjQjZi0RkMTKBZPQUWZJRkVxaL1fAnq4EtVVbSzB99vwqeX28FgJqNqoZBaXjYePKvDtEkrrUK5AEumMlYD1qxL2SRFEyFYel6y0x4J2xcUhJ/8SGgZwt/JMJAF15tMfv2lpfGjV4ytMJiSkpqZkloSkf8nJmhJYieyysRLYrMCLPfh5DedtuBgMa4qEklujhOzkEI4rGSqjAnh4Zjzt6rJac9QxkZHtLKQe6vwlsZ1zeh/NFOoykVCvmHlsZBTXDxL0Yn8ETq+MPOIqjQVkZyYPA50/AjbxdFHZ/cO7rv3WoLHFjBMJvK8l/ggIlG5gsjhpqDppIlWepJSPXwLSti4zGiFkurQIoH6tqZwubZjxwsMk6peABamBTUDlaSWqTNOnLi8qqSLlmkITyubuMn8SesDhPrbkBHx4Mc0z/j4C/8HL3cl+va5whyV0HxwU/TQCSLH3oR847JHh4u17+drIvxWEdHWu68OGxZd/pUwhDi9b8wh4cWOKh+QRSOE8L1t/AR5fMUDBTdheAAAAAElFTkSuQmCC" width="48" height="48"></a>
                            <a href="https://icons8.com">Icon pack by Icons8</a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script>
            var click = false;
            var articuloEliminar = 0;
            function mostrarProductos(){
                if(!click){
                    $("#productos").show(100);
                    click = true;
                }else{
                    $("#productos").hide(100);
                    click = false;
                }
            }
            
            function modalEliminar(nombre, imagen, precio, cantidad, id){
                $("#eModalImg").attr("src","media/images/products/"+imagen);
                $("#eModalNombre").html("Articulo: " + nombre);
                $("#eModalPrecio").html("Total: $ "+ precio);
                $("#eModalCantidad").html("Cantidad: "+ cantidad);
                articuloEliminar = id;
            }
            
            function eliminar(){
                $.ajax({
                    url: "eliminarCarrito.php",
                    data: {articulo: articuloEliminar},
                    type: "post",
                    success: function(data){
                        $("#carrito").load("carrito.php");
                        $("#num-articulos").html(data);
                    }                    
                });
            }
            
            function buscar(){
                q = $("#searchBox").val();
                if(q.trim().length > 0)
                    location.href = "search.php?q="+q;
                else
                    $("#searchBox").parent().addClass("has-error");
                    
            }
        </script>
    </body>
</html>