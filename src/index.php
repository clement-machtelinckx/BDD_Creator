<?php



require_once '../vendor/autoload.php';
require_once 'conf.php';
use App\Class\Database;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new Database($HOST, $USERNAME, $PASSWORD);
$db->connect();
$dbColection = $db->getCollectionDatabases();

var_dump( $dbColection);
$db->useDatabase('test');
// $db->insertRow('restaurant', ['name' => 'McDonalds', 'age' => 30, 'float' => 10.5, 'date' => '2021-03-01', 'description' => 'Fast food']);


$db->updateRow('restaurant', 'id', 1, ['name' => 'McGronalds', 'age' => 55, 'date' => '2022-03-01', 'description' => 'slow food']);
// $db->insertRow('restaurant', [
//     ['name' => 'McDonalds', 'age' => 30, 'date' => '2021-03-01', 'description' => 'Fast food'],
//     // ['name' => 'Burger King', 'age' => 40, 'date' => '2020-05-15', 'description' => 'Fast food'],
//     // add more rows as needed
// ]);
