<?php

require_once '../vendor/autoload.php';
require_once 'conf.php';
use App\Class\Database;


$db = new Database($HOST, $USERNAME, $PASSWORD);
$db->connect();
$db->useDatabase('1dbbcreatortest');
// $db->insertRow('oyooyoyo', [
//     [
//         "testINT" => 62,
//         "testVAR" => "yoyo",
//         "testText" => "superpassword",
//         "testDate" => "2024-09-19",
//         "testDECI" => 5.5,
//     ]
// ]);

$db->updateRow('oyooyoyo', 'id', 3, [
    "testINT" => 65,
    "testVAR" => "mod",
    "testText" => "p",
    "testDate" => "2024-09-19",
    "testDECI" => 5.5,
]);


// $db->addColumn('testtabldzde222', 'testDrop', 'VARCHAR(255)');
// $db->dropColumn('testtabldzde222', 'testDrop');


// $db->dropRow('testtabldzde222', "id", 65);



