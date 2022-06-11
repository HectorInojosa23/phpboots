<?php

session_start();

include("templates/cabecera.php");

if ($_POST) {
    if(($_POST['usuario']=="WebtorDev")&&($_POST['pass']=="sistemaTor")){

        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']="WebtorDev";

        header('location:inicio.php');
    } else {

        $mensaje= "Error. Usuario o Contraseña errorneos";

    }

}

?>


    
<title>Administrador</title>
<br/><br/><br/>
    <div class="container mt-4">
        <div class="row">
        

            <div class="col-md-4">

            </div>

            <div class="col-md-4">
                
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                    <?php if (isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje ?>
                            </div>
                        <?php } ?>
                        <form method="POST">
                        <div class = "form-group">
                        <label >Usuario</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Introducir Usuario" name="usuario">
                        </div>
                        <div class="form-group">
                        <label >Contraseña</label>
                        <input type="password" class="form-control" placeholder="Contraseña" name="pass">
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-4">Entrar al Sistema Administrador</button>
                        </form>
                        
                    </div>
                   
                </div>



            </div>
            
        </div>
    </div>



<?php

include("templates/pie.php");

?>