<?php
//namespace route;

//use config\database; 
//use controller\courseController;
include_once('../controller/courseController.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = explode( '/', $uri );

if ($uri[4] !== 'course.php') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$getId = null;
$getId = htmlspecialchars($_GET["id"]);

$requestMethod = $_SERVER["REQUEST_METHOD"];

$courseController = new courseController();

switch ($requestMethod) {
	case 'GET':
		if ($getId) {
			$response = $courseController->show($getId);
		} else {
			$response = $courseController->index();
		};
	break;
	case 'POST':
		$response = $courseController->create();
	break;
	case 'PUT':
		$response = $courseController->update($this->userId);
	break;
	case 'DELETE':
		$response = $courseController->destroy($this->userId);
	break;
	default:
		$response = $this->notFoundResponse();
	break;
}

echo $response;
?>
