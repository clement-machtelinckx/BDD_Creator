
<?php
require_once '../../../../vendor/autoload.php';
include '../../../conf.php';
use App\Class\Database;

// route : http://localhost/BDD_Creator/src/routes/GET/database/getDatabaseSave.php
// method : GET

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // $srcPath = dirname(__DIR__);
    // echo json_encode ($srcPath);
    $path = 'C:\wamp64\www\BDD_Creator\src\dump';
    $files = array_diff(scandir($path), array('.', '..'));
    echo json_encode($files);
} else {
    echo json_encode(["result" => "error", "message" => "Invalid request method"]);
}