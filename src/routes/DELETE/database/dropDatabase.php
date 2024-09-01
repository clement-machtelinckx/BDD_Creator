<?php

use App\Database;

// require '../../../../vendor/autoload.php';
require_once '../../../../vendor/autoload.php';
// route : http://localhost/BDD_Creator/src/routes/DELETE/database/dropDatabase.php
// method : DELETE
// {
//     "databaseName": "testjson23"
// }


include '../../../../conf.php';


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    $db = new Database($HOST, $USERNAME, $PASSWORD);
    $db->connect();
    if ($data['databaseName'] === '') {
        echo json_encode(["result" => "error", "message" => "Database name is required"]);
        return;
    }
    $db->dropDatabase($data['databaseName']);
} else {
    echo json_encode(["result" => "error", "message" => "Invalid request method"]);
}