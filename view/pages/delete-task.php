<?php

    if(!isset($_GET["token"]) ||  empty($_GET["token"])) {

        echo '<script>

                window.location = "task";

        </script>';
        return false;

    }

    // Validar si no existe route o no es update-task
    if(!isset($_GET["route"]) || $_GET["route"] !== "delete-task") {
        echo '<script>window.location = "task";</script>';
        exit;
    }

    $item = "keyApi";

    $valor = $_GET["token"];

    $respuesta = Controller_Task::ctrListTask($item, $valor);
    

    // Si no existe ninguna tarea con ese token
    if(!$respuesta) {
        echo '<script>window.location = "task";</script>';
        exit;
    }

?>

<div class="w3-content">
    <h3 class="w3-center animate__animated animate__fadeInDown">
        <b class="w3-text-danger">ELIMINAR TASK</b> 
        <i class="fa fa-trash w3-text-red"></i>
    </h3>

    <p class="w3-center w3-text-grey w3-large">
        ¿Estás seguro de eliminar ésta tarea?
        <span>No se Podrá reventir cambios.</span>
    </p>
    
    <section id="new_task" class="w3-padding">

        <div class="w3-content" style="max-width: 500px; margin-top: 8px;" id="new_add_task">

           <form method="post">

                <div class="w3-row-padding w3-center">

                    <div class="w3-col l6">
                        <button type="submit" class="w3-button w3-block w3-blue w3-mobile">ELIMINAR <i class="fa fa-trash"></i></button>
                        <input type="hidden" name="tokenEliminar" value="<?php echo $respuesta["keyApi"] ?>">
                        <input type="hidden" name="tkenEliminarId" value="<?php echo $respuesta["tareaId"] ?>">
                    </div>
                    <div class="w3-col l6">
                        <a href="task" class="w3-button w3-danger w3-block w3-mobile">Cancelar <i class="fa fa-times"></i></a>
                    </div>

                </div>

           </form>

           <?php 

                $delete = new Controller_Task();
                $delete -> ctrDeleteTask();
           
           ?>

        </div>

    </section>

</div>
