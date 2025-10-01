<?php

require_once "../controller/Task.php";
require_once "../model/Task.php";

class API_Task {

    public $titulo;
    public $fechaLimite;
    public $prioridad;
    public $descripcion;

    public function apiSaveTask() {

        $datos = array(
            "titulo" => $this->titulo,
            "fecha" => $this->fechaLimite,
            "prioridad" => $this->prioridad,
            "descripcion" => $this->descripcion
        );
        
        $respuesta = Controller_Task::ctrSaveTask($datos);

        echo json_encode($respuesta);

    }

}

if(isset($_POST["titulo"])) {
    $save = new API_Task();
    $save -> titulo = $_POST["titulo"];
    $save -> fechaLimite = $_POST["fechaLimite"];
    $save -> prioridad = $_POST["prioridad"];
    $save -> descripcion = $_POST["descripcion"];
    $save -> apiSaveTask();
}