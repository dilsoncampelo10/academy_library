<?php

namespace core\config;

use PDO;
use PDOException;

class Connection
{
    private static $instance;
    private $conn;
    
    private const DRIVER = $_ENV["DB_DRIVER"];
    private const HOST = $_ENV['DB_HOST'];
    private const DBNAME = $_ENV['DB_NAME'];
    private const USER = $_ENV['DB_USER'];
    private const PASSWORD = $_ENV['DB_PASSWORD'];

    private function __construct()
    {
        $this->conn = $this->connect();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance->getConnection();
    }

    public static function getConn()
    {
        return self::getInstance();
    }

    public function getConnection()
    {
        return $this->conn;
    }

    private function connect()
    {
        try {
            $conn = new PDO(
                self::DRIVER . ":host=" . self::HOST . ";dbname=" . self::DBNAME,
                self::USER,
                self::PASSWORD
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $ex) {
            die("Falha na conexão com o banco de dados: " . $ex->getMessage());
        }
    }
}
