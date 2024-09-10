<?php

require_once '../vendor/autoload.php';
require_once 'conf.php';
use App\Class\Database;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new Database($HOST, $USERNAME, $PASSWORD);
$db->connect();
$db->useDatabase('11testreload');
// $db->insertRow('oyooyoyo', [
//     [
//         "testINT" => 62,
//         "testVAR" => "yoyo",
//         "testText" => "superpassword",
//         "testDate" => "2024-09-19",
//         "testDECI" => 5.5,
//     ]
// ]);

// $db->updateRow('oyooyoyo', 'id', 3, [
//     "testINT" => 65,
//     "testVAR" => "mod",
//     "testText" => "p",
//     "testDate" => "2024-09-19",
//     "testDECI" => 5.5,
// ]);


// $db->addColumn('testtabldzde222', 'testDrop', 'VARCHAR(255)');
// $db->dropColumn('testtabldzde222', 'testDrop');


// $db->dropRow('testtabldzde222', "id", 65);

$database = "11testreload";
$time = time();
$date = date($time);
var_dump($date . " " . $time);
$databaseName = "11testreload"; 
$fileName = $databaseName . $time . ".sql"; 
var_dump($databaseName);
echo $databaseName;

$dir = dirname(__FILE__) . '/dump/'. $fileName;

echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";

exec("mysqldump --user={$USERNAME} --password={$PASSWORD} --host={$HOST} {$database} --result-file={$dir} 2>&1", $output);

var_dump($output);  
var_dump($time);

$files1 = scandir("dump");
var_dump($files1);

