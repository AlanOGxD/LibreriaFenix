<div class="container">
    <div class="row">
        <section class="p-5 w-100">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/logo.png" width="150" alt="logo" loading="lazy">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">                       
                        <?php  if(!isset($_SESSION['nombre'])): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="login.html">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="registro.html">Registrate</a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Bienvenido <?php echo $_SESSION['nombre'] ?></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-warning text-white" href="#" tabindex="-1" aria-disabled="true">
                                <i class="icofont-shopping-cart"></i> 10
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="controllers/logout.php">
                                <span>Salir</span> <i class="icofont-logout"></i>
                            </a>
                        </li>
                        <?php endif; ?>                        
                    </ul>
                </div>
            </nav>
        </section>
    </div>
</div>