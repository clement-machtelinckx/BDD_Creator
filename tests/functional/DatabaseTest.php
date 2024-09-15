<?php

use PHPUnit\Framework\TestCase;
use App\Class\Database;
use GuzzleHttp\Client;
include '../src/conf.php';

class DatabaseTest extends TestCase
{

    public function __construct()
    {
        $HOST = 'localhost';
        $USERNAME = 'root';
        $PASSWORD = 'Clement2203$';


    }
    // public function testGetCollectionDatabases()
    // {
    //     global $HOST, $USERNAME, $PASSWORD;
    //     $db = new Database($HOST, $USERNAME, $PASSWORD);
    //     $db->connect();
    //     $this->assertIsArray($db->getCollectionDatabases());
    // }
    



    public function testCreateDatabase()
    {
        global $HOST, $USERNAME, $PASSWORD;
        $db = new Database($HOST, $USERNAME, $PASSWORD);
        $db->connect();
   
        $client = new Client();
        $response = $client->request('POST', 'http://localhost/BDD_Creator/src/routes/POST/database/createDatabase.php', [
            'json' => ['databaseName' => 'test']
        ]);
    
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getBody());
        $this->assertArrayHasKey('result', json_decode($response->getBody(), true));
        $this->assertEquals('success', json_decode($response->getBody(), true)['result']);
    }
    
}