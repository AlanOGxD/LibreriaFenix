
<link href='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css' rel='stylesheet' />
<link href='../css/footer.css' rel='stylesheet' />
<footer class="header-top pt-4">
    <div class="container">
    <?php

        $page_name = basename($_SERVER['PHP_SELF']);
        $hide = 'd-none';
        if($page_name === 'index.php') {
            $hide = '';
        }
    ?>
        <div class="row">
            <div class="col-lg-3 col-md-6 p-3 text-center">
                <img src="../assets/img/logo.png" width="200" alt="logo" loading="lazy">
                <p class="py-4">
                    <a class="social-media" href="#" target="_blank">
                        <span><i class="icofont-facebook"></i></span>
                    </a> &nbsp;
                    <a class="social-media" href="#">
                        <span><i class="icofont-send-mail"></i></span>
                    </a> &nbsp;
                    <a class="social-media" href="#" target="_blank">
                        <span><i class="icofont-facebook-messenger"></i></span>
                    </a>
                </p>
            </div>
            <div class="col-lg-3 col-md-6 p-3 border-left-footer">
                <h6 class="footer-title">Visitanos</h6>
                <div class="footer-info">
                    <p>
                        <span> <i class="icofont-calendar"></i> Horario:</span><br>
                        <span>Lunes-Viernes 9:30 a 18:00</span><br>
                        <span>S&aacute;bado 9:30 a 14:00</span><br>
                    </p> 
                    <span><i class="icofont-location-pin"></i></span> 
                    <span>Paseo Fco. García Salinas 329, Lomas del Convento, 98609 Guadalupe, Zac.</span>
                    <div class="w-100">
                        <div id='map' style='width: 100%; height: 150px;'></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 p-3 border-left-footer">
                <h6 class="footer-title">Mi cuenta</h6>
                <div class="w-100 footer-info">
                    <p> <a href="registro.html" class="p-2"> Registrarse </a></p>
                    <p> <a href="login.html" class="p-2"> Iniciar sesi&oacute;n </a></p>
                    <!-- <p> <a href="#" class="p-2"> Favoritos </a></p> -->
                </div>
            </div>
            <div class="col-lg-3 col-md-6 p-3 border-left-footer">
                <h6 class="footer-title">Informaci&oacute;n</h6>
                <div class="w-100 footer-info">
                    <p> <a href="#" class="p-2"> FAQ </a><br> </p>
                    <p> <a href="#" class="p-2"> T&eacute;rminos y condiciones </a><br> </p>
                    <p> <a href="#" class="p-2"> Aviso de privacidad </a><br> </p>
                </div>

                <br>
                <br>
                <h6 class="footer-title">M&eacute;todos de pago</h6>
                <div class="w-100">
                    <span class="payment-method"><i class="icofont-visa-alt"></i></span>
                    <span class="payment-method"><i class="icofont-mastercard-alt"></i></span>
                    <span class="payment-method"><i class="icofont-american-express-alt"></i></span>
                    <span class="payment-method-filter">
                        <img class="img-thumbnail" src="https://blog.boletopolis.com/wp-content/uploads/2017/03/oxxo_pay_Grande.png" alt="oxxo_pay" width="80px">
                    </span>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- <script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoiam9zZWx1aXNjYWxkZXJhIiwiYSI6ImNqd21yNXEwNTAyYWw0NHQ4c3RzZms1cWwifQ.LFQJdFzd2-SIlctLmyYFbA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/outdoors-v11',
        center: [-102.54327397670693, 22.759159641882416], // starting position [lng, lat]
        zoom: 15, // starting zoom
    });

    var marker = new mapboxgl.Marker()
        .setLngLat([-102.54327397670693, 22.759159641882416])
        .addTo(map);
</script> -->
