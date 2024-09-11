<?php

require_once '../vendor/autoload.php';
require_once 'conf.php';
use App\Class\Database;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new Database($HOST, $USERNAME, $PASSWORD);
$db->connect();

$databaseUnchangeName = "autocompletion2024-09-111726064380.sql";
$databaseRestoreName = "autocompletion2024-09-111726064380.sql";
$databaseRestoreName = str_replace("-", "", $databaseRestoreName);
$databaseRestoreName = str_replace(".sql", "", $databaseRestoreName);

$filePath = "dump/" . $databaseUnchangeName;

if (!file_exists($filePath)) {
    die("File not found: " . $filePath);
}

try {
    $db->createDatabase($databaseRestoreName);
    $db->useDatabase($databaseRestoreName);

    $command = "mysql -u root -p{$PASSWORD} {$databaseRestoreName} < {$filePath} 2>&1";
    exec($command, $output, $returnVar);

    if ($returnVar !== 0) {
        throw new Exception("mysql command failed with output: " . implode("\n", $output));
    }
} catch (Exception $e) {
    echo $e->getMessage();
}


?>

<!DOCTYPE html>

<form class="test" action="" method="post">
    <input type="file">
    <input type="submit" value="postage">
</form>


<style>
    .test{
        margin-top:30px;
        margin-left:30px;
    }
</style>