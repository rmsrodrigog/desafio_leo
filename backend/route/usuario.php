<?php
//namespace route; 

//use config\database; 
//use controller\courseController;
include_once('../controller/usuarioController.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = explode( '/', $uri );

if ($uri[4] !== 'usuario.php') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$getId = null;
$getId = htmlspecialchars($_GET["id"]);

$requestMethod = $_SERVER["REQUEST_METHOD"];

$controller = new usuarioController();

switch ($requestMethod) {
	case 'GET':
		if ($getId) {
			$response = $controller->show($getId);
		} else {
			$response = $controller->index();
		};
	break;
	case 'POST':
		$response = $controller->store();
	break;
	case 'PUT':
		$response = $controller->update($getId);
	break;
	case 'DELETE':
		$response = $controller->destroy($getId);
	break;
	default:
		$response = json_encode(array("error" => "Rota não encontrada."));
	break;
}

echo $response;
?>
