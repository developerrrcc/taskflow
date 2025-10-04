<?php

    if(!isset($_GET["token"]) ||  empty($_GET["token"])) {

        echo '<script>

                window.location = "task";

        </script>';
        return false;

    }

    // Validar si no existe route o no es update-task
    if(!isset($_GET["route"]) || $_GET["route"] !== "view-task") {
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
        <b class="w3-text-blue">DETALLE TASK</b> 
        <i class="fas fa-info-circle w3-text-blue"></i>
    </h3>

    <p class="w3-left w3-text-grey w3-large">
        Detalle de : <span><?php echo strtoupper($respuesta["titulo"]) ?></span>
    </p>

    <section class="w3-section">
        <table class="w3-table-all w3-card w3-small">
            <thead>
                <tr class="w3-light-grey">
                    <th>#</th>
                    <th>Descripción</th>
                    <th>Fecha Límite</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Fecha Registro</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $respuesta["tareaId"] ?></td>
                    <td style="width: 350px;"><?php echo $respuesta["descripcion"] ?></td>
                    <td><?php echo $respuesta["fecha_limite"] ?></td>
                    <td><?php echo strtoupper($respuesta["prioridad"]) ?></td>
                    <td><?php echo strtoupper($respuesta["estado"]) ?></td>
                    <td><?php echo $respuesta["fecha_rehistro"] ?></td>
                </tr>
            </tbody>
        </table>
    </section>
    
    <section id="new_task" class="w3-padding">

        <div class="w3-content" style="max-width: 500px; margin-top: 8px;" id="new_add_task">

           <form method="post">

                <div class="w3-row-padding w3-center">

                    <div class="w3-col l6">
                        <a href="task" class="w3-button w3-block w3-danger w3-mobile">REGRESAR <i class="fas fa-arrow-left"></i></a>
                    </div>
                    <div class="w3-col l6">
                        <a href="task" class="w3-button w3-blue w3-block w3-mobile">ENVIAR TASK <i class="fas fa-paper-plane"></i></a>
                    </div>

                </div>

           </form>

        </div>

    </section>

</div>
