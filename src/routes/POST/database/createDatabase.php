<?php

require_once '../../../../vendor/autoload.php';
include '../../../conf.php';
use App\Class\Database;

// route : http://localhost/BDD_Creator/src/routes/POST/database/createDatabase.php
// method : POST
// body : raw : JSON
// {
//     "databaseName": "test"
// }



header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $db = new Database($HOST, $USERNAME, $PASSWORD);
    $db->connect();
    if ($data['databaseName'] === '') {
        echo json_encode(["result" => "error", "message" => "Database name is required"]);
        return;
    }
    $db->createDatabase($data['databaseName']);
} else {
    echo json_encode(["result" => "error", "message" => "Invalid request method"]);
}