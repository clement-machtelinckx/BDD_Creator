<?php

// route : http://localhost/BDD_Creator/src/routes/GET/getCollectionDatabases.php
// method : GET



include '../../../class/Database.php';
include '../../../conf.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db = new Database($HOST, $USERNAME, $PASSWORD);
    $db->connect();
    $databases = $db->getCollectionDatabases();
    echo json_encode($databases);
} else {
    echo json_encode(["result" => "error", "message" => "Invalid request method"]);
}
