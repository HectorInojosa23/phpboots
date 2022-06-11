<?php

include("templates/cabezera.php");

?>

<title>Libros</title>

<?php

include("administrador/config/DB.php");
$sentenciaMSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaMSQL->execute();
$listalibros=$sentenciaMSQL->fetchAll(PDO::FETCH_ASSOC);


include("templates/header.php");

?>





<div class="container-fluid row mt-3">


<?php foreach($listalibros as $libro) { ?>
<div class="col-md-3">

<div class="card text-left">
      <img class="card-img-top" width="200" height="350" src="./img/<?php echo $libro['imagen']; ?>" alt="">
      <div class="card-body">
        <h4 class="card-title"><?php echo $libro['nombre']; ?></h4>
       <button class="btn btn-primary"><a href="https://goalkicker.com/" style="color: white;">Ver más</a></button>
      </div>
    </div>

</div>

<?php } ?>



<?php

include("templates/pie.php");

?>