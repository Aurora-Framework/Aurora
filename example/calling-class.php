<?php
include "../vendor/autoload.php";

use Aurora\MVC\Controller;

class Home extends Controller
{

	public function view($id)
	{

	}

}


$Injector      = new Aurora\Injector();

$Injector->define("Aurora\\Http\\Request",[
	":GET" => $_GET,
	":POST" => $_POST,
	":COOKIE" => $_COOKIE,
	":FILES" => $_FILES,
	":SERVER" => $_SERVER,
]);

$Config        = new Aurora\Config();
$Application   = new Aurora\Application($Config, $Injector);

$Router = new Aurora\Router();
$Router->addRoute('GET', '/message/send/{id}', ["Home", "view"]);
$found = $Router->findRoute('GET', '/message/send/John');

$Application->run($found["action"], $found["params"]);
