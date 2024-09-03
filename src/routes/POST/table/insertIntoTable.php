<?php

require_once '../../../../vendor/autoload.php';
include '../../../conf.php';
use App\Class\Database;


// route : http://localhost/BDD_Creator/src/routes/POST/table/insertIntoTable.php
// method : POST
// {
//     "databaseName": "testjson",
//     "tableName": "testtabldzde222",
//     "values": [
//         {
//             "id": 65,
//             "name": "clement",
//             "password": "superpassword",
//             "confirmePassword": "superpassword"
//         }
//     ]
// }

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $db = new Database($HOST, $USERNAME, $PASSWORD);
    $db->connect();
    $db->useDatabase($data['databaseName']);
    $db->insertIntoTable($data['tableName'], $data['values']);
}