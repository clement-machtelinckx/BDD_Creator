<?php

require_once '../vendor/autoload.php';
require_once 'conf.php';
use App\Class\Database;


$db = new Database($HOST, $USERNAME, $PASSWORD);
$db->connect();
$bdd = $db->getDatabase('aicha');
var_dump($bdd);
$db->useDatabase('testjson');

$tableCollection = $db->getTableCollection();
var_dump($tableCollection);
// $db->addColumn('testtabldzde222', 'testDrop', 'VARCHAR(255)');
// $db->dropColumn('testtabldzde222', 'testDrop');

$db->insertIntoTable('testtabldzde222', ['id'=> 37, 'name' => 'clement'] );

// $db->dropRow('testtabldzde222', "id", 65);



