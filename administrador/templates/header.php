
<?php 

session_start();
    if (!isset($_SESSION['usuario'])) {
        header("location:../index.php");
    } else {

        if($_SESSION['usuario']=="ok") {

            $nombreUsuario=$_SESSION["nombreUsuario"];

        }

    }
?>

<?php $url ="http://" . $_SERVER['HTTP_HOST']. "/phpboots" ;  ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-4">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">administrador del sito web <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/inicio.php">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/sesiones/productos.php">Libros</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/sesiones/cerrar.php">Cerrar</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>">Ver Sitio WEB </a>
        
        </div>
    </nav>