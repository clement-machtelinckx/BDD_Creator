<?php

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
        if ($this->pdo->exec($sql)) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $this->pdo->errorInfo();
        }
    }

    public function showDatabases()
    {
        $sql = "SHOW DATABASES";
        $stmt = $this->pdo->query($sql);
        $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $databases;
    }

    public function createTable($tableName, $dbName)
    {
        $sql = "CREATE TABLE $dbName.$tableName (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            reg_date TIMESTAMP
            )";
        if ($this->pdo->exec($sql) == true) {
            echo "Table created successfully";
        } else {
            $errorInfo = $this->pdo->errorInfo();
            if ($errorInfo[0] !== '00000') {
                echo "Error creating table: " . implode(' ', $errorInfo);
            }
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

    public function addColumn($tableName, $dbName, $columnName, $columnType)
    {
        $sql = "ALTER TABLE $dbName.$tableName ADD COLUMN $columnName $columnType";
        if ($this->pdo->exec($sql)) {
            echo "Column added successfully";
        } else {
            $errorInfo = $this->pdo->errorInfo();
            if ($errorInfo[0] !== '00000') {
                echo "Error adding column: " . implode(' ', $errorInfo);
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
$db = new Database('localhost', 'root', '');
$db->connect();
$pdo = $db->getPdo();
