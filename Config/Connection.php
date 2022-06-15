<?php

class Connection
{

    private static $connection;

    private function __construct()
    {
        
    }

    public static function connect(): PDO
    {
        $host = "localhost";
        $dbname = "shopping";
        $user = "root";
        $pwd = "";

        try {
            self::$connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$connection;
        } catch (PDOException $e) {
            echo "Falha de conexão: " . $e->getMessage();
        }
    }
}
?>