<?php

// if (!$_SESSION){
//     session_start();
// }
session_start();
$hostname = "localhost";
$username = "root";
$password = "";


// showDatabases($connect);
var_dump($_POST);
var_dump($_GET);
$_SESSION['dbName'] = $_GET['selectBDD'];

if(isset($_GET['selectBDD'])){
    $dbName = $_GET['selectBDD'];
    $connect = mysqli_connect($hostname, $username, $password, $dbName);
    showTables($connect, $dbName);

}
if(isset($_GET['selectTable'])){
    $tableName = $_GET['selectTable'];
    $dbName = $_SESSION['dbName'];
    $connect = mysqli_connect($hostname, $username, $password, $dbName);
    showTableData($connect, $tableName, $dbName);
}
function getTables($connect, $dbName)
{
    $sql = "SHOW TABLES FROM $dbName";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $tables[] = $row["Tables_in_" . $dbName];
        }
    } else {
        echo "0 results";
    }
    return $tables;
}

function showTables($connect, $dbName)
{
    $sql = "SHOW TABLES FROM $dbName";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row["Tables_in_" . $dbName] . "<br>";
        }
    } else {
        echo "0 results";
    }
}
function showTableData($connect, $tableName, $dbName)
{
    $sql = "SELECT * FROM $dbName.$tableName";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row["firstname"] . " " . $row["lastname"] . " (" . $row["email"] . ")<br>";
        }
    } else {
        echo "0 results";
    }
}
function insertData($connect, $tableName, $dbName, $firstname, $lastname, $email)
{
    $sql = "INSERT INTO $dbName.$tableName (firstname, lastname, email)
    VALUES ('$firstname', '$lastname', '$email')";
    if ($connect->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}


?>
<!DOCTYPE html>



</form>
<form method="GET">
    <label for="selectTable">select Table</label>
    <select name="selectTable" id="selectTable">
        <?php
        $connect = mysqli_connect($hostname, $username, $password);
        $dbName = $_GET['selectBDD'];
        $tables = getTables($connect, $dbName);
        foreach ($tables as $table) {
            echo "<option value='$table'>$table</option>";
        }
        ?>
    </select>
    <input type="submit" value="Enter">