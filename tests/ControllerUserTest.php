<?php
//include_once "tests/AppTest.php";
include_once "engine/controllers/user.php";
include_once "engine/models/user.php";
use PHPUnit\Framework\TestCase;

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

        $result=$user->index();
        $this->assertSame($_SESSION["user"]["login"],$result["user"]["login"]);
        $this->assertSame(true,is_array($result["pages"]));

        $user->logout();
        $this->assertSame(false,isset($_SESSION["user"]));
    }
}

