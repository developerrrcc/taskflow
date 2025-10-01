<?php 

class Controller_Task {

    static public function ctrSaveTask($datos) {

       if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["titulo"])) {

            $tabla = "task";

            $token = bin2hex(random_bytes(64));
            

            $datos = array(
                "KeyApi" => $token,
                "titulo" => $datos["titulo"],
                "descripcion" => $datos["descripcion"],
                "fecha_limite" => $datos["fecha"],
                "prioridad" => $datos["prioridad"],
                "estado" => "Pendiente"
            );
            
            $respuesta = Model_Task::mdlSaveTask($tabla, $datos);

            return $respuesta;

       } else {

        $respuesta = "error";
        return $respuesta;

       }

    }

    /**
     * MÉTODO PARA OBTENER TAREAS
     */

    static public function ctrListTask($item, $valor) {

        $tabla = "task";

        $respuesta = Model_Task::mdlListTask($tabla, $item, $valor);
        return $respuesta;

    }

    /**
     * Editar task
     */

}