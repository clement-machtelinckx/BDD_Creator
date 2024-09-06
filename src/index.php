<?php

require_once '../vendor/autoload.php';
require_once 'conf.php';
use App\Class\Database;


$db = new Database($HOST, $USERNAME, $PASSWORD);
$db->connect();
$db->useDatabase('aicha');
$db->insertRow('testtype', [
    [
        "number" => 65,
        "courtext" => "clement",
        "longtext" => "superpassword",
        "created_at" => "2024-09-19",
        "testFloat" => 5.5,
    ]
]);


// $db->addColumn('testtabldzde222', 'testDrop', 'VARCHAR(255)');
// $db->dropColumn('testtabldzde222', 'testDrop');


// $db->dropRow('testtabldzde222', "id", 65);



