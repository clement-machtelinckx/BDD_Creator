<?php

require_once '../vendor/autoload.php';
require_once 'conf.php';
use App\Class\Database;
use App\Class\User;

$user = new User();
$db = new Database($HOST, $USERNAME, $PASSWORD);
$db->connect();
$bdd = $db->getDatabase('testjson');
var_dump($bdd) ;
$db->useDatabase('testjson');
$table = $db->getTableCollection();
var_dump($table);

