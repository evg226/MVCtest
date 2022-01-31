<?php
session_start();
use PHPUnit\Framework\TestCase;
//include "./engine/index.php";
include "./engine/views/index.php";
include "./engine/controllers/index.php";
include "./engine/models/index.php";
include "./engine/models/user.php";
include "./engine/controllers/user.php";



class ControllerUserTest extends TestCase{
    function testSignup()
    {
        $user = new ControllerUser();
        $_POST=[];
        $result=$user->signup();
        $this->assertSame(false,isset($result["message"]));
        $_POST=[
            "userLogin"=>"",
            "userPwd"=>"1",
            "userName"=>"Bob",
            "userSurname"=>"Johnson"
        ];
        $result=$user->signup();
        $this->assertSame("Заполните все поля",$result["message"]);
        $_POST=[
            "userLogin"=>"user5",
            "userPwd"=>"1",
            "userName"=>"Bob",
            "userSurname"=>"Johnson"
        ];
        $result=$user->signup();
        $this->assertSame(true,isset($result["error"]));
        $_POST=[
            "userLogin"=>"testUser1", //Каждый раз нужен новый логин
            "userPwd"=>"1",
            "userName"=>"Bob",
            "userSurname"=>"Johnson"
        ];
        $result=$user->signup();
        $this->assertSame(true,isset($result["id"])); //Будет фейл, см. комментарий стр.37
    }
    function testLoginGetUser(){
        $user=new ControllerUser();
        $_POST=[];
        $loginResult=$user->login();
        $this->assertSame("Введите логин и пароль",$loginResult["message"]);
        $_POST["userLogin"]="user5";
        $_POST["userPwd"]="6";
        $loginResult=$user->login();
        $this->assertSame("Неправильный логин или пароль",$loginResult["message"]);
        $_POST["userLogin"]="user5";
        $_POST["userPwd"]="5";
        $user->login();
        $this->assertSame("user5",$_SESSION["user"]["login"]);

        $user->getUser($_SESSION["user"]["id"]);
        $this->assertSame($_SESSION["user"]["name"],$user["name"]);
        $this->assertSame(true,is_array($user["pages"]));

        $user->logout();
        $this->assertSame(false,isset($_SESSION["user"]));
    }
}

