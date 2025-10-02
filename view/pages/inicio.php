<div class="w3-row-padding w3-margin-bottom w3-light-grey w3-padding-32">

    <?php 
    
        $item = null;
        $valor = null;

        $tareas = Controller_Task::ctrListTask($item, $valor);

        //var_dump($tareas);

        $total = count($tareas);

        //Pendientes:

        $pendientes = count(array_filter($tareas, function($t){
            return strtolower($t["estado"] === "pendiente");
        }));

        //// En progreso

        $progreso = count(array_filter($tareas, function($t){
            return strtolower($t["estado"] === "progreso");
        }));

        ///// Completadas

        $completadas = count(array_filter($tareas, function($t){
            return strtolower($t["estado"] === "completada");
        }));
    
    ?>


    <div class="w3-quarter">
        <div class="w3-container w3-round w3-card w3-win8-teal w3-padding-16">
            <div class="w3-left"><i class="fa fa-book w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?php echo $total; ?></h3>
            </div>
            <div class="w3-clear"></div>
            <a href="task" style="text-decoration: none;">
                <h4>Tareas Generales</h4>
            </a>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-round w3-card w3-win8-cyan w3-padding-16">
            <div class="w3-left"><i class="fa-solid fa-hourglass-half w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?php echo $pendientes; ?></h3>
            </div>
            <div class="w3-clear"></div>
            <a href="task" style="text-decoration: none;">
                <h4>Tareas Pendientes</h4>
            </a>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-round w3-card w3-win8-blue w3-padding-16">
            <div class="w3-left"><i class="fa-solid fa-circle-check w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?php echo $completadas; ?></h3>
            </div>
            <div class="w3-clear"></div>
            <a href="task" style="text-decoration: none;">
                <h4>Tareas Terminadas</h4>
            </a>
        </div>
    </div>

    <div class="w3-quarter">
        <div class="w3-container w3-round w3-card w3-pink w3-padding-16">
            <div class="w3-left"><i class="fa-solid fa-user-gear w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3>
                    <i class="fa-solid fa-id-badge"></i>
                </h3>
            </div>
            <div class="w3-clear"></div>
            <a href="" style="text-decoration: none;">
                <h4>Mi Cuenta</h4>
            </a>
        </div>
    </div>

</div>
