<?php

class Database 
{
    // configuração do banco de dados
    private static $driver = 'pgsql';
    private static $name = 'ppo_php';
    private static $host = 'localhost';
    private static $username = 'postgres';
    private static $password = 'ifpe';

    private static $instance;
    private static $error;

    final private function __construct()
    {
    }

    final private function __clone()
    {
    }

    public static function getInstance(): ?PDO
    {
        if (empty(self::$instance)) {
            try {
                self::$instance = new PDO(
                    self::$driver . ':host=' . self::$host . ';dbname=' . self::$name,
                    self::$username,
                    self::$password
                );
            } catch (PDOException $e) {
                self::$error = $e;
            }
        }

        return self::instance;
    }

    public static function getError(): ?Exception {
        return self::error;
    }
}
 