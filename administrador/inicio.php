<?php

include("templates/cabecera.php");

?>

<title>Inicio administrador</title>

<?php

include("templates/header.php");

?>

    <div class="container">
    <div class="row">

            <div class="jumbotron">
                <h1 class="display-3">Bienvenido<?php echo $nombreUsuario;?></h1>
                <p class="lead">Vamos a administrar nuestros libros!</p>
                <hr class="my-2">
                <p>panel de administración</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="sesiones/productos.php" role="button">Administrar libros</a>
                </p>
            </div>


        </div>
    </div>
<?php

include("templates/pie.php");

?>