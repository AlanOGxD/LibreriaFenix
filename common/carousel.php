<section>
    <div id="carouselPrincipal" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php foreach($carousel as $key => $libro): ?>
            <li data-target="#carouselPrincipal" data-slide-to="<?php echo $key ?>" class="<?php echo ($key === 0) ? 'active' : ' ' ?>"></li>
            <?php endforeach; ?>
        </ol>
        <div class="carousel-inner">
            <?php foreach($carousel as $key => $libro): ?>
            <div class="carousel-item <?php echo ($key === 0) ? 'active' : ' ' ?>">
                <a href="libro.php?isbn=<?php echo $libro->isbn ?>">
                    <img class="img-fluid" src="<?php echo API_URL . '/media/'. $libro->imagen ?>" alt="<?php  echo $libro->nombre; ?>">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h3> <?php  echo $libro->nombre; ?> </h3>
                    <p> <?php  echo $libro->sinopsis; ?> </p>
                    <button class="btn btn-primary"> <i class="icofont-shopping-cart"></i> Comprar</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselPrincipal" role="button" data-slide="prev">
            <span class="sr-only"></span>
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#carouselPrincipal" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only"></span>
        </a>
    </div>
</section>