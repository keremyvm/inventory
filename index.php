<?php
require_once "system/general/config_general.php";
require "config/constant/config_system.php";
require "config/constant/config_app.php";
require "autoload.php";

echo 'Hola Mundo';
exit();

use \system\route\Route as Route;
$route=new Route();
$route->url();

