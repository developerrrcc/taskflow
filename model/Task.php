<?php
require_once "Conexion.php";

class Model_Task {

    static public function mdlSaveTask($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(KeyApi, titulo, descripcion, fecha_limite, prioridad, estado)
            VALUES(:KeyApi, :titulo, :descripcion, :fecha_limite, :prioridad, :estado)"
        );

        $stmt -> bindParam(":KeyApi", $datos["KeyApi"], PDO::PARAM_STR);
        $stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_limite", $datos["fecha_limite"], PDO::PARAM_STR);
        $stmt -> bindParam(":prioridad", $datos["prioridad"], PDO::PARAM_STR);
        $stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }

    }

    /**
     * Método para listar tareas
     */

    static public function mdlListTask($tabla, $item, $valor) {

        if($item != null && $valor != null) {

            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla WHERE $item = :$item"
            );

            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla"
            );

            $stmt->execute();

            return $stmt->fetchAll();

        }

    }

    /**
     * Actualizar task
     */

    static public function mdlUpdateTask($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET keyApi = :keyApi, titulo = :titulo, descripcion = :descripcion, fecha_limite = :fecha_limite, prioridad = :prioridad WHERE tareaId = :tareaId"
        );

        $stmt -> bindParam(":tareaId", $datos["tareaId"], PDO::PARAM_STR);
        $stmt -> bindParam(":keyApi", $datos["keyApi"], PDO::PARAM_STR);
        $stmt -> bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":fecha_limite", $datos["fecha_limite"], PDO::PARAM_STR);
        $stmt -> bindParam(":prioridad", $datos["prioridad"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }

    }

}