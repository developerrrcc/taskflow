<?php

require_once "vendor/autoload.php";

require_once "controller/Template.php";

require_once "controller/Task.php";
require_once "model/Task.php";

require_once "controller/User.php";
require_once "model/User.php";

$render = new Template();
$render -> ctrTemplate();