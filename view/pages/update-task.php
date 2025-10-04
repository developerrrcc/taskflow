<?php

    if(!isset($_GET["token"]) ||  empty($_GET["token"])) {

        echo '<script>

                window.location = "task";

        </script>';
        return false;

    }

    // Validar si no existe route o no es update-task
    if(!isset($_GET["route"]) || $_GET["route"] !== "update-task") {
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
        <b>ACTUALIZAR TASK</b> 
        <i class="fa-solid fa-list-check"></i>
    </h3>
    
    <section id="new_task" class="w3-padding">

        <div class="w3-content" style="max-width: 500px; margin-top: 8px;" id="new_add_task">

            <form method="post" id="formTask" class="w3-padding-16 w3-round">

               <div class="w3-row-padding">
                
                    <div class="w3-col l12">

                        <label for="task_name" class="w3-small w3-text-grey">Título</label>

                        <input class="w3-input w3-border w3-small w3-margin-bottom" type="text" name="task_name" id="task_name" value="<?php echo $respuesta["titulo"] ?>" placeholder="Ingresar Título">
                        <input type="hidden" name="token" value="<?php echo $respuesta["keyApi"] ?>">
                        <input type="hidden" name="id" value="<?php echo $respuesta["tareaId"] ?>">
                    </div>

               </div>

               <div class="w3-row-padding">

                    <div class="w3-col l6">

                        <label for="limit_date" class="w3-small w3-text-grey">Fecha Límite</label>

                        <input class="w3-input w3-border w3-small w3-margin-bottom" id="limit_date" value="<?php echo $respuesta["fecha_limite"] ?>" type="date" name="date_limit">

                    </div>

                    <div class="w3-col l6">
                        <label for="selPrioridad" class="w3-small w3-text-grey">Prioridad</label>

                        <select name="selPrioridadUpdate" class="w3-select w3-border" id="selPrioridad" required>
                            <option value="alta">Alta</option>
                            <option value="media">Media</option>
                            <option value="baja">Baja</option>

                        </select>
                    </div>

               </div>

               <div class="w3-row-padding">

                    <div class="w3-col l12">
                        <p></p>
                        <textarea name="descripcionUpdate" id="descripcion" class="w3-input w3-border"><?php echo $respuesta["descripcion"] ?></textarea>

                    </div>

               </div>

               <div class="w3-row-padding">

                    <div class="w3-col l12">
                        <p>
                            <input type="submit" class="w3-button w3-card w3-block w3-blue" value="Actualizar Task">
                        </p>
                    </div>

               </div>

            </form>

            <?php 

                $update = new Controller_Task();
                $update -> ctrUpdateTask();
            
            ?>

        </div>

    </section>

</div>
