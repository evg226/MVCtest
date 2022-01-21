<?php

abstract class Model{
    protected static $db;

    public function __construct(){
        require_once "engine/Database.php";
        self::$db=Database::connect();
    }

    function getData(){

    }

    public static function writeHistoryDB($userId,$path){
        try {
            require_once "engine/Database.php";
            self::$db=Database::connect();
            $statement=self::$db->prepare(
                "INSERT into userPages (path,userId)
                        VALUES (:path1,:userId)"
            );
            $result = $statement->execute([
                ':path1'=>$path,
                ':userId'=>$userId,
            ]);
            return ["id"=>self::$db->lastInsertId()];
        }catch (PDOException $e){
            return ["error"=>$e->getMessage()];
        }
    }
}
