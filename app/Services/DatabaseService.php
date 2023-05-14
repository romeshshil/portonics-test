<?php

namespace App\Services;

use App\Configs\Config;
use PDO;
use PDOException;

class DatabaseService
{
    private $host;
    private $username;
    private $password;
    private $database;

    protected $pdo;

    public function __construct()
    {
        $this->host = Config::DB_HOST;
        $this->username = Config::DB_USER;
        $this->password = Config::DB_PASS;
        $this->database = Config::DB_NAME;

        $this->createConnection();
    }

    private function createConnection()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }



    public function getPDO()
    {
        return $this->pdo;
    }
}
