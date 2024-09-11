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
var_dump(scandir($dir));