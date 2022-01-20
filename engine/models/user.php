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
        if (!$userLogin||!$userPwd) return [];
        $statement=self::$db->prepare("SELECT * FROM users WHERE login=:userLogin AND password=:userPwd");
        $statement->execute([
            ':userLogin' => $userLogin,
            ':userPwd' => md5($userPwd)
        ]);
        $user=$statement->fetch();
        return $user?:[];
    }

    function signup($userLogin,$userPwd,$userName,$userSurname):array{
        if (!$userName||!$userPwd) return [];
        try {
            $statement=self::$db->prepare(
                "INSERT into users (login,password,name,surname)
                        VALUES (:login,:pwd,:userName,:surname)"
            );
            $result = $statement->execute([
                ':login'=>$userLogin,
                ':pwd'=>md5($userPwd),
                ':userName'=>$userName,
                ':surname'=>$userSurname,
            ]);
        }catch (PDOException $e){
            return ["error"=>$e->getMessage()];
        }
        return $result?[
            "id"=>self::$db->lastInsertId(),
            "login"=>$userLogin,
            "name"=>$userName,
            "surname"=>$userSurname,
            "error"=>$result
        ]
            :
            ["error"=>"Не добавлено"];
    }

}



