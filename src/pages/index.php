<?php

$hostname = "localhost";
$username = "root";
$password = "";


// showDatabases($connect);
var_dump($_POST);



if (isset($_POST['addBDD'])) {
    $databaseName = $_POST['addBDD'];
    $connect = mysqli_connect($hostname, $username, $password,);
    createDatabase($connect, $databaseName);
}
if (isset($_POST['addTable']) && isset($_POST['dbName'])) {
    $tableName = $_POST['addTable'];
    $dbName = $_POST['dbName'];
    $connect = mysqli_connect($hostname, $username, $password, $dbName);
    createTable($connect, $tableName, $dbName);
}
function createDatabase($connect, $databaseName)
{
    $sql = "CREATE DATABASE $databaseName";
    if (mysqli_query($connect, $sql)) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . mysqli_error($connect);
    }
}

function createTable($connect, $tableName, $dbName)
{
    $sql = "CREATE TABLE $dbName.$tableName (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP
        )";
    if (mysqli_query($connect, $sql)) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($connect);
    }
}



function showDatabases($connect)
{
    $sql = "SHOW DATABASES";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row["Database"] . "<br>";
        }
    } else {
        echo "0 results";
    }
}

?>
<!DOCTYPE html>


<form method="POST">
    <label for="addBDD">Create database</label>
    <input type="text" id="addBDD" name="addBDD">
    <input type="submit" value="Enter">
</form>

<form action="POST">
    <label for="addTable">Create Table</label>
    <input type="text" name="addTable" id="addTable">
    <label for="dbName">into</label>
    <input type="text" name="dbName" id="dbName">
    <input type="submit" value="Enter">
</form>