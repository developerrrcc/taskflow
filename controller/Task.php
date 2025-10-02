<?php

class Controller_Task
{

    static public function ctrSaveTask($datos)
    {

        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["titulo"])) {

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

    static public function ctrListTask($item, $valor)
    {

        $tabla = "task";

        $respuesta = Model_Task::mdlListTask($tabla, $item, $valor);
        return $respuesta;
    }

    /**
     * Editar task
     */

    static public function ctrUpdateTask()
    {

        if (isset($_POST["task_name"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["task_name"])) {

                $item = "keyApi";
                $valor = $_POST["token"];
                $tabla = "task";

                $selToken = Model_Task::mdlListTask($tabla, $item, $valor);

                if (isset($selToken["keyApi"]) && !empty($selToken["keyApi"])) {


                    if ($selToken["keyApi"] == $_POST["token"] && $selToken["tareaId"] == $_POST["id"]) {

                        $tokenUpdate = bin2hex(random_bytes(64));


                        $datos = array(
                            "tareaId" => $_POST["id"],
                            "keyApi" => $tokenUpdate,
                            "titulo" => $_POST["task_name"],
                            "fecha_limite" => $_POST["date_limit"],
                            "prioridad" => $_POST["selPrioridadUpdate"],
                            "descripcion" => $_POST["descripcionUpdate"]
                        );

                        $respuesta = Model_Task::mdlUpdateTask($tabla, $datos);

                        if ($respuesta == "ok") {

                            echo '<script>

                                    Swal.fire({
                                    icon: "success",
                                    title: "TAREA ACTUALIZADA EXITOSAMENTE",
                                    showClass: {
                                        popup: `
                                        animate__animated
                                        animate__jackInTheBox
                                        animate__faster
                                        `
                                    },
                                    hideClass: {
                                        popup: `
                                        animate__animated
                                        animate__fadeOutDown
                                        animate__faster
                                        `
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {

                                        window.location="task"
                                    }
                                });
                            
                            </script>';
                        } else {

                            echo '<script>

                                    Swal.fire({
                                    icon: "error",
                                    title: "ERROR AL ACTUALIZAR",
                                    showClass: {
                                        popup: `
                                        animate__animated
                                        animate__jackInTheBox
                                        animate__faster
                                        `
                                    },
                                    hideClass: {
                                        popup: `
                                        animate__animated
                                        animate__fadeOutDown
                                        animate__faster
                                        `
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {

                                        window.location="task"
                                    }
                                });
                            
                            </script>';
                        }
                    } else {

                        return false;
                    }
                } else {

                    return false;
                }
            } else {
                return false;
            }
        }
    }

    /**
     * metodo para eliminar
     */

    static public function ctrDeleteTask()
    {

        if (isset($_POST["tokenEliminar"])) {

            $item = "keyApi";
            $valor = $_POST["tokenEliminar"];
            $tabla = "task";

            $selToken = Model_Task::mdlListTask($tabla, $item, $valor);

            if (isset($selToken["keyApi"]) && !empty($selToken["keyApi"])) {

                if ($selToken["keyApi"] == $_POST["tokenEliminar"] && $selToken["tareaId"] == $_POST["tkenEliminarId"]) {

                    $tabla = "task";

                    $datos = $_POST["tokenEliminar"];
                    
                    $respuesta = Model_Task::mdlDeleteTask($tabla, $datos);

                    if($respuesta == "ok") {

                        echo '<script>

                                Swal.fire({
                                icon: "success",
                                title: "TAREA ACTUALIZADA EXITOSAMENTE",
                                showClass: {
                                    popup: `
                                    animate__animated
                                    animate__jackInTheBox
                                    animate__faster
                                    `
                                },
                                hideClass: {
                                    popup: `
                                    animate__animated
                                    animate__fadeOutDown
                                    animate__faster
                                    `
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {

                                    window.location="task"
                                }
                            });
                        
                        </script>';

                    }

                } else {

                    echo "false";
                }
            } else {

                echo "change token";
            }
        }
    }

    /**
     * Cambio de estado
     */

    static public function ctrChangeStatus($datos) {


        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $datos["estado"])) {
            
            $tabla = "task";

            $datos = array(
                "estado" => $datos["estado"],
                "keyApi" => $datos["keyApi"]
            );

            $respuesta = Model_Task::mdlChangeStatus($tabla, $datos);

            return $respuesta;

        } else {

            $respuesta = "error";
            return $respuesta;

        }

    }
}
