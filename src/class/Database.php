<?php

namespace App\Class;
use PDO;
use PDOException;
class Database
{
    private $host;
    private $username;
    private $password;
    private $dbName;
    private $pdo;

    public function __construct($host, $username, $password, $dbName = null)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
    }

    public function connect()
    {
        try {
            $dsn = "mysql:host={$this->host}";
            if ($this->dbName) {
                $dsn .= ";dbname={$this->dbName}";
            }
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    public function createDatabase($databaseName)
    {
        $sql = "CREATE DATABASE $databaseName";
        try {
            $this->pdo->exec($sql);
            echo json_encode(["result" => "success", "message" => "Database created successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["result" => "error", "message" => "Error creating database: " . $e->getMessage()]);
        }
    }
    public function dropDatabase($databaseName)
    {
        $sql = "DROP DATABASE $databaseName";
        try {
            $this->pdo->exec($sql);
            echo json_encode(["result" => "success", "message" => "Database dropped successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["result" => "error", "message" => "Error dropping database: " . $e->getMessage()]);
        }
    }
    public function useDatabase($databaseName)
    {
        $sql = "USE $databaseName";
        try {
            $this->pdo->exec($sql);
            echo json_encode(["result" => "success", "message" => "Database connected successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["result" => "error", "message" => "Error connecting database: " . $e->getMessage()]);
        }
    }
    public function getDatabase($databaseName)
    {
        $sql = "SHOW DATABASES LIKE '$databaseName'";
        $stmt = $this->pdo->query($sql);
        $database = $stmt->fetch();
        return $database;
    }
    public function createTable($tableName, $columns)
    {
        $sql = "CREATE TABLE $tableName ($columns)";
        try {
            $this->pdo->exec($sql);
            echo json_encode(["result" => "success", "message" => "Table created successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["result" => "error", "message" => "Error creating table: " . $e->getMessage()]);
        }
    }
    public function dropTable($tableName)
    {
        $sql = "DROP TABLE $tableName";
        try {
            $this->pdo->exec($sql);
            echo json_encode(["result" => "success", "message" => "Table dropped successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["result" => "error", "message" => "Error dropping table: " . $e->getMessage()]);
        }
    }
    public function getTableColumns($tableName)
    {
        $sql = "SHOW COLUMNS FROM $tableName";
        $stmt = $this->pdo->query($sql);
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $columns;
    }
    public function getTableData($tableName)
    {
        $sql = "SELECT * FROM $tableName";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function addColumn ($tableName, $columnName, $columnType) {
        $sql = "ALTER TABLE $tableName ADD COLUMN $columnName $columnType";
        try {
            $this->pdo->exec($sql);
            echo json_encode(["result" => "success", "message" => "Column added successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["result" => "error", "message" => "Error adding column: " . $e->getMessage()]);
        }
    }
    public function dropColumn ($tableName, $columnName) {
        $sql = "ALTER TABLE $tableName DROP COLUMN $columnName";
        try {
            $this->pdo->exec($sql);
            echo json_encode(["result" => "success", "message" => "Column dropped successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["result" => "error", "message" => "Error dropping column: " . $e->getMessage()]);
        }
    }
    public function getTableCollection()
    {
        $sql = "SHOW TABLES";
        $stmt = $this->pdo->query($sql);
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $tables;
    }
    public function getTableCollectionAndColumns(){
        $sql = "SHOW TABLES";
        $stmt = $this->pdo->query($sql);
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

        for ($i=0; $i < count($tables); $i++) { 
            $sql = "SHOW COLUMNS FROM $tables[$i]";
            $stmt = $this->pdo->query($sql);
            $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            $tables[$i] = [
                "tableName" => $tables[$i],
                "columns" => $columns
            ];
        }
        return $tables;
    }

    public function insertRow($tableName, $data)
    {
        $columns = implode(', ', array_keys($data[0]));
        $values = [];
    
        foreach ($data as $row) {
            $escapedValues = array_map([$this->pdo, 'quote'], $row);
            $values[] = '(' . implode(', ', $escapedValues) . ')';
        }
    
        $sql = "INSERT INTO $tableName ($columns) VALUES " . implode(', ', $values);
    
        try {
            $this->pdo->exec($sql);
            echo json_encode(["result" => "success", "message" => "Data inserted successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["result" => "error", "message" => "Error inserting data: " . $e->getMessage()]);
        }
    }

    public function dropRow($tableName, $columnName, $value)
    {
        $sql = "DELETE FROM $tableName WHERE $columnName = '$value'";
        try {
            $this->pdo->exec($sql);
            echo json_encode(["result" => "success", "message" => "Row deleted successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["result" => "error", "message" => "Error deleting row: " . $e->getMessage()]);
        }
    }

// _______________________________________________________________________________________________________________________

    public function getCollectionDatabases()
    {
        $sql = "SHOW DATABASES";
        $stmt = $this->pdo->query($sql);
        $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $databases;
    }

    public function getDatabaseTables($dbName)
    {
        $sql = "SHOW TABLES FROM $dbName";
        $stmt = $this->pdo->query($sql);
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $tables;
    }



    public function insertIntoTable2($tableName, $dbName, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode("', '", array_values($data));
        $sql = "INSERT INTO $tableName ($columns) VALUES ('$values')";
        if ($this->pdo->exec($sql)) {
            echo "Data inserted successfully";
        } else {
            echo "Error inserting data: " . $this->pdo->errorInfo();
        }
    }


    public function modifyTable($tableName, $dbName, $columnName, $columnType)
    {
        $sql = "ALTER TABLE $dbName.$tableName MODIFY COLUMN $columnName $columnType";
        if ($this->pdo->exec($sql)) {
            echo "Table modified successfully";
        } else {
            $errorInfo = $this->pdo->errorInfo();
            if ($errorInfo[0] !== '00000') {
                echo "Error modifying table: " . implode(' ', $errorInfo);
            }
        }
    }


    
    

    public function getPdo()
    {
        return $this->pdo;
    }
}

// Usage:
// host / username / password / dbname
// $db = new Database('localhost', 'root', '');
// $db->connect();
// $pdo = $db->getPdo();
