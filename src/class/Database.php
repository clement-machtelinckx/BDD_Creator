<?php

class Database
{
    private $host;
    private $username;
    private $password;
    private $dbName;
    private $pdo;

    public function __construct($host, $username, $password, $dbName)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
    }

    public function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}

// Usage:
// host / username / password / dbname
$db = new Database('localhost', 'root', '', 'blog');
$db->connect();
$pdo = $db->getPdo();
