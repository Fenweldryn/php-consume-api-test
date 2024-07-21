<?php
header("Access-Control-Allow-Origin: *");
// Preflight request handling
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    // Allow for 5 minutes
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Content-Length: 0");
    header("Content-Type: text/plain");
    die();
}
require '../vendor/autoload.php';

use App\Helpers\DotEnvHelper;
DotEnvHelper::load('../.env');

$router = require '../Routes.php';