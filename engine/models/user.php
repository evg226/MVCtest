<?php

class ModelUser extends Model{
    function getUser($userId):array{
        $statement=self::$db->prepare("SELECT * FROM users WHERE id=:userId");
        $statement->execute([
            ":userId"=>$userId
        ]);
        $user=$statement->fetch();
        $statement2=self::$db->prepare("
            SELECT path,count(path) as pageCount FROM 
                (SELECT path from userPages WHERE userId=:userId ORDER BY id DESC) as t
            GROUP BY path
            
             ");
        $statement2->execute([
            ":userId"=>$userId
        ]);
        $pages=$statement2->fetchAll();
        return ["user"=>$user,"pages"=>$pages];
    }

    function login($userLogin,$userPwd):array{
        if ($userLogin&&$userPwd) {
            return self::$db->select("users",["login"=>$userLogin,"password"=>md5($userPwd)]);
        }
        else {
            return [];
        }
    }

    function signup($login,$password,$name,$surname):array{
        if ($login&&$password) {
            return self::$db->delete("users", 51);
        } else {
            return [];
        }
    }

}



