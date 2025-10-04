<?php

require_once "Conexion.php";

class Model_User {

    static public function mdlSaveUser($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(keyApiU, nombres, email, password, token)
             VALUES(:keyApiU, :nombres, :email, :password, :token)"
        );

        $stmt -> bindParam(":keyApiU", $datos["keyApiU"], PDO::PARAM_STR);
        $stmt -> bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":token", $datos["token"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        } 

    }

    /**
     * Método para mostrar registros
     */

    static public function mdlListUser($tabla, $item, $valor) {

        if($item != null && $valor != null) {

            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla WHERE $item = :$item"
            );

            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla ORDER BY id DESC"
            );

            $stmt->execute();

            return $stmt->fetchAll();

        }

    }

    /**
     * Actualizar la ultima hora de ingreso
     */

    static public function mdlUpdateUser($tabla, $item1, $valor1, $item2, $valor2) {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return print_r(Conexion::conectar()->errorInfo());

		}

    }

}