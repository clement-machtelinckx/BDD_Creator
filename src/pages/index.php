<?php
include_once '../class/Database.php';
// Usage:
// host / username / password / dbname
$db = new Database('localhost', 'root', '');
$db->connect();
// $db->addColumn('zz', 'test', 'coucou', 'VARCHAR(200)');

var_dump($pdo);
if (isset($_POST['addBDD'])) {
    $databaseName = $_POST['addBDD'];
    $db->createDatabase($databaseName);
}
var_dump($_POST['addBDD']);

if (isset($_POST['addTable']) && isset($_POST['dbName'])) {
    $tableName = $_POST['addTable'];
    $dbName = $_POST['dbName'];
    $db->createTable($tableName, $dbName);
}

?>
<!DOCTYPE html>


<form action="" method="POST">
    <label for="addBDD">Create database</label>
    <input type="text" id="addBDD" name="addBDD">
    <input type="submit" value="Enter">
</form>

<form method="POST">
    <label for="addTable">Create Table</label>
    <input type="text" name="addTable" id="addTable">
    <label for="dbName">into</label>
    <input type="text" name="dbName" id="dbName">
    <input type="submit" value="Enter">
</form>

<form method="GET" action="">
<label for="selectBDD"> selectBDD</label>
<select name="selectBDD" id="selectBDD">
    <?php

    $databases = $db->showDatabases();
    var_dump($databases);
    foreach ($databases as $database) {
        echo "<option value='$database'>$database</option>";
    }

    ?> 
</select>
<input type="submit" value="Enter">
