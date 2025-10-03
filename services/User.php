<?php
require_once "../vendor/autoload.php";
require_once "../controller/User.php";
require_once "../model/User.php";

class API_user {

    /**
     * Metodo para listar
     */

    public function apigetData() {

        $respuesta = Controller_User::ctrListUser(null, null);

        echo json_encode($respuesta);

    }

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

// 👇 Ruteo sencillo
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nameFull"])) {
    $create = new API_user();
    $create->nameFull  = $_POST["nameFull"];
    $create->emailUser = $_POST["emailUser"];
    $create->passTemp  = $_POST["passTemp"];
    $create->apiSaveUser();
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    $list = new API_user();
    $list->apiGetData();
}