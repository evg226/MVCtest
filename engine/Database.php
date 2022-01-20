<?php

class Database extends PDO {

    private $server = "localhost";
    private $dbname = "shop";
    private $username = "shop";
    private $passwd = "Pass12@@";
    private static Database $instance;

    private function __construct(){
        $dsn="mysql:host=$this->server;dbname=$this->dbname";
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES=>false
        ];
        parent::__construct( $dsn,$this->username, $this->passwd, $options);
    }

    private function __clone(){}

    public static function connect(){
        if (empty(self::$isntance)){
            try{
                self::$instance=new Database;
            }catch (PDOException $e){
                die($e->getMessage());
            }
        }
        return self::$instance;
    }
}

