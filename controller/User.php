<?php

class Controller_User {

    static public function ctrSaveUser($datos) {

       if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombres"]) &&
          preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $datos["email"]) &&
          preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+$/', $datos["pass_temp"])) {

            $keyApi = bin2hex(random_bytes(64));

            $datos = array(
                "keyApiU" => $keyApi,
                "nombres" => $datos["nombres"],
                "email" => $datos["email"],
                "password" => $datos["pass_temp"]
            );

            return $datos;


       }

    }

}