<?php

require_once '../vendor/autoload.php';
require_once 'conf.php';
use App\Class\Database;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dir = dirname(__FILE__). '/dump/';

var_dump($dir);


scandir($dir);
// var_dump(scandir($dir));

$n = 0;

foreach (scandir($dir) as $file) {
    if ('.' === $file) continue;
    if ('..' === $file) continue;
    $dir = 'C:\wamp64\www\BDD_Creator\src/dump/' . $file;
    $databaseName = "test" . $n +=1;
    exec("mysqldump --user={$USERNAME} --password={$PASSWORD} --host={$HOST} {$databaseName} --result-file={$dir} 2>&1", $output);
    // echo $databaseName;
    // echo $output;
    echo $file ;
}