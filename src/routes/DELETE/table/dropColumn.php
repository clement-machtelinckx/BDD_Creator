<?php

require_once '../../../../vendor/autoload.php';
include '../../../conf.php';
use App\Class\Database;

// route : http://localhost/BDD_Creator/src/routes/DELETE/table/dropColumn.php
// method : DELETE
// {
//     "databaseName": "testjson23",
//     "tableName": "table1",
//     "columnName": "name"
// }

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
    } else if ($data['tableName'] === '') {
        echo json_encode(["result" => "error", "message" => "Table name is required"]);
        return;
    } else if ($data['columnName'] === '') {
        echo json_encode(["result" => "error", "message" => "Column name is required"]);
        return;
    }
    $db->useDatabase($data['databaseName']);
    $db->dropColumn($data['tableName'], $data['columnName']);
} else {
    echo json_encode(["result" => "error", "message" => "Invalid request method"]);
}