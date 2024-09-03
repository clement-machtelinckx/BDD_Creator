<?php
require_once '../../../../vendor/autoload.php';
include '../../../conf.php';
use App\Class\Database;

// route : http://localhost/BDD_Creator/src/routes/GET/table/getCollectionTable.php
// method : POST

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:POST');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database($HOST, $USERNAME, $PASSWORD);
    $db->connect();
    $db->useDatabase($data['databaseName']);
    $tables = $db->getTableCollection();
    echo json_encode($tables);
} else {
    echo json_encode(["result" => "error", "message" => "Invalid request method"]);
}