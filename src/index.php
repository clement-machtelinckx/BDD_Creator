<?php

require_once '../vendor/autoload.php';
require_once 'conf.php';
use App\Class\Database;
use App\Class\User;

$user = new User();
$db = new Database($HOST, $USERNAME, $PASSWORD);
$db->connect();
$bdd = $db->getDatabase('dbClement');
var_dump($bdd) ;
$db->useDatabase('dbClement');
$table = $db->getTableCollection();
var_dump($table);

$tableColums = $db->getTableColumns('user');

var_dump($tableColums); 

$tableData = $db->getTableData('user');
var_dump($tableData);


$addTable = $db->addColumn('user', 'test', 'VARCHAR');