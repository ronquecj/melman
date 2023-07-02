<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST, OPTIONS');
header('Content-Type: application/json; charset=utf8');

date_default_timezone_set('Asia/Manila');

$rootPath = $_SERVER['DOCUMENT_ROOT'];
$apiPath = $_SERVER['DOCUMENT_ROOT'] . '/cse5/api';
require_once $apiPath . '/config/Connection.php';
require_once $apiPath . '/controllers/Path.controller.php';

$db = new Connection();
$pdo = $db->connect();
$gm = new GlobalMethods($pdo);
$auth = new Auth($pdo, $gm);
$delivery = new Delivery($pdo, $gm, $auth);

$req = [];

if (isset($_REQUEST['request'])) {
  $req = explode('/', $_REQUEST['request']);
} else {
  $req = ['errorcatcher'];
}

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    print_r('Bad Request');
    http_response_code(403);
    break;

  case 'POST':
    $d = json_decode(file_get_contents('php://input'));
    require_once $apiPath . '/routes/Delivery.route.php';
    break;

  default:
    print_r('Forbidden Access');
    http_response_code(403);
    break;
}

?>
