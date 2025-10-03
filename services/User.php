<?php

require_once "../controller/User.php";
require_once "../model/User.php";

class API_user {

    public $nameFull;
    public $emailUser;
    public $passTemp;

    public function apiSaveUser() {

        $datos = array(
            "nombres" => $this->nameFull,
            "email" => $this->emailUser,
            "pass_temp" => $this->passTemp
        );

        $respuesta = Controller_User::ctrSaveUser($datos);

        echo json_encode($respuesta);

    }

}

if(isset($_POST["nameFull"])) {
    $create = new API_user();
    $create -> nameFull  = $_POST["nameFull"];
    $create -> emailUser = $_POST["emailUser"];
    $create -> passTemp  = $_POST["passTemp"];
    $create -> apiSaveUser();
}