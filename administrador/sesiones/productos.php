<?php

include("../templates/cabecera.php");

?>
<?php 
$txtid = (isset($_POST['txtid']))?$_POST['txtid']:"";
$txtnombre = (isset($_POST['txtnombre']))?$_POST['txtnombre']:"";
$txtimagen = (isset($_FILES['txtimagen']['name']))?$_FILES['txtimagen']['name']:"";
$txtaccion = (isset($_POST['accion']))?$_POST['accion']:"";


?>

<title>Productos administrador</title>


<?php

include("../templates/header.php");

include("../config/DB.php");

switch($txtaccion) {

    case 'agregar':

        //INSERT INTO `libros` (`id`, `nombre`, `imagen`) VALUES ('1', 'Libro de php', 'php.jpg');
        
        $sentenciaMSQL = $conexion->prepare("INSERT INTO libros (`nombre`, `imagen`) VALUES (:nombre, :imagen);");
        $sentenciaMSQL->bindParam(':nombre', $txtnombre);

        $fecha = new DateTime();

        $nombreArchivo = ($txtimagen!="")?$fecha->getTimestamp()."_".$_FILES['txtimagen']['name']:"php.jpg";

        $tempimg = $_FILES["txtimagen"]["tmp_name"];

        if($tempimg != "") {

            move_uploaded_file($tempimg, "../../img/".$nombreArchivo);

        }

        $sentenciaMSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaMSQL->execute();
                    
        header("location:productos.php");
        break;
    
        case 'modificar':
            
            $sentenciaMSQL = $conexion->prepare("UPDATE libros SET nombre=:nombre WHERE id=:id");
            $sentenciaMSQL->bindParam(':id', $txtid);
            $sentenciaMSQL->bindParam(':nombre', $txtnombre);
            $sentenciaMSQL->execute();


                if($txtimagen != "") {

                    //Se agrega el archivo
                    $fecha = new DateTime();
                    $nombreArchivo = ($txtimagen!="")?$fecha->getTimestamp()."_".$_FILES['txtimagen']['name']:"php.jpg";            
                    $tempimg = $_FILES["txtimagen"]["tmp_name"];
                    move_uploaded_file($tempimg, "../../img/".$nombreArchivo);

                    //Se borra el archivo

                    $sentenciaMSQL = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
                    $sentenciaMSQL->bindParam(':id', $txtid);
                    $sentenciaMSQL->execute();
                    $libro=$sentenciaMSQL->fetch(PDO::FETCH_LAZY);

                    if (isset($libro["imagen"]) && ($libro["imagen"] != "php.jpg")) {

                        if (file_exists("../../img/".$libro["imagen"])) {

                            unlink("../../img/".$libro["imagen"]);

                        }


                    }


                    $sentenciaMSQL = $conexion->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id");
                    $sentenciaMSQL->bindParam(':imagen', $nombreArchivo);
                    $sentenciaMSQL->bindParam(':id', $txtid);
                    $sentenciaMSQL->execute();

                }

                header("location:productos.php");

            break;

            case 'cancelar':
                
                    //redirigir a productos
                    header("location:productos.php");


                break;

                case 'borrar':
                    
                    $sentenciaMSQL = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
                    $sentenciaMSQL->bindParam(':id', $txtid);
                    $sentenciaMSQL->execute();
                    $libro=$sentenciaMSQL->fetch(PDO::FETCH_LAZY);

                    if (isset($libro["imagen"]) && ($libro["imagen"] != "php.jpg")) {

                        if (file_exists("../../img/".$libro["imagen"])) {

                            unlink("../../img/".$libro["imagen"]);

                        }


                    }

                        $sentenciaMSQL = $conexion->prepare("DELETE FROM `libros` WHERE id=:id");
                        $sentenciaMSQL->bindParam(':id', $txtid);
                        $sentenciaMSQL->execute();

                        header("location:productos.php");
                    break;

                    case 'seleccionar':
                        $sentenciaMSQL = $conexion->prepare("SELECT * FROM `libros` WHERE id=:id");
                        $sentenciaMSQL->bindParam(':id', $txtid);
                        $sentenciaMSQL->execute();
                        $libro=$sentenciaMSQL->fetch(PDO::FETCH_LAZY);

                        $txtnombre = $libro['nombre'];
                        $txtimagen = $libro['imagen'];

                        
                        break;

}

$sentenciaMSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaMSQL->execute();
$listalibros=$sentenciaMSQL->fetchAll(PDO::FETCH_ASSOC);


?>

    <div class="container">
        <div class="row mt-4">
            <div class="col-md-5">
                
            <div class="card">
                    <div class="card-header">Datos de Libros</div>
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                <div class = "form-group">
                <label>ID</label>
                <input type="text" required readonly class="form-control" value="<?php echo $txtid; ?>" name="txtid" id="txtid" placeholder="ID">
                
                </div>

                <div class = "form-group">
                <label>Nombre:</label>
                <input type="text" required class="form-control" value="<?php echo $txtnombre; ?>"  name="txtnombre" id="txtnombre" placeholder="Nombre del Libro:">
                
                </div>

                <div class = "form-group">
                <label>Imagen:</label>
                
                <?php 
                    
                    if ($txtimagen != "") {
                    
                ?>
                <br/>
              <img class="img-thumbnail rounded" src="../../img/<?php echo $txtimagen;?>" width="50" alt="productolibro">
                
                <?php }?>

                <input type="file" required class="form-control" name="txtimagen" id="txtimagen">

               
                
                </div>

                         <div class="btn-group mt-4" role="group" aria-label="">
                            <button type="submit" name="accion" <?php echo ($txtaccion == "seleccionar")?"disabled":"";?> value="agregar" class="btn btn-success">Agregar</button>
                            <button type="submit" name="accion" <?php echo ($txtaccion != "seleccionar")?"disabled":"";?> value="modificar" class="btn btn-warning">Modificar</button>
                            <button type="submit" name="accion" <?php echo ($txtaccion != "seleccionar")?"disabled":"";?> value="cancelar" class="btn btn-info">Cancelar</button>
                         </div>       
                
                </form>
                    </div>
                </div>       
                

            </div>
            <div class="col-md-7">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>IMAGEN</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                    <?php foreach ($listalibros as $libro) {  ?>
                    
                            <td scope="row"><?php echo $libro['id']; ?> </td>
                            <td><?php echo $libro['nombre']; ?></td>
                            <td>


                        <img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen']; ?>" width="50" alt="productolibro">
                            
                        
                        </td>
                            <td>
                                
                            
                        <form method="POST">

                            <input type="hidden" name="txtid" id="txtid" value="<?php echo $libro['id'] ?>"/>


                            <input type="submit" name="accion" value="seleccionar" class="btn btn-primary"/>
                            <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>


                        </form>
                        
                                                                      
                        
                        </td>
                        </tr>
                 <?php }  ?>   
                    </tbody>
                </table>

            </div>

        </div>
    </div>





<?php

include("../templates/pie.php");

?>