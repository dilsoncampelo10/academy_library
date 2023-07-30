<?php

namespace core\config;

use PDO;
use PDOException;

class Connection
{
    private static $instance;
    private $conn;

    private const DRIVER = "mysql";
    private const HOST = "localhost";
    private const DBNAME = "academy_library";
    private const USER = "root";
    private const PASSWORD = "";

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
