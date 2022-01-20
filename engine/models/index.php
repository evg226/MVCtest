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
//            $statement2=self::$db->prepare("SELECT path FROM userPages WHERE userId=:userId ORDER BY id DESC LIMIT 1");
//            $statement2->execute([
//                ":userId"=>$userId
//            ]);
//            $lastPath=$statement2->fetch()["path"];
//            if($path==$lastPath) return ["id"=>0];
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
