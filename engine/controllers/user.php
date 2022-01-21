<?php

class ControllerUser extends Controller {
    public function __construct()    {
        parent::__construct();
        $this->model=new ModelUser;
    }

    function index (){
        if (isset($_SESSION["user"])&&isset($_SESSION["user"]["id"])) {
            $data=$this->model->getUser($_SESSION["user"]["id"]);
            $this->view->render("userView.php",$data);
        } else {
            $data=['type'=>"login"];
            $this->view->render("userLoginView.php", $data );
        }
    }

    function login (){
        $data=['type'=>"login"];
        if (isset($_POST["userLogin"]) && isset($_POST["userPwd"])) {
            $user = $this->model->login($_POST["userLogin"], $_POST["userPwd"]);
            if ($user) {
                $_SESSION["user"] = $user[0];
            } else {
                $data["message"]="Неправильный логин или пароль";
                $this->view->render("userLoginView.php", $data );
            };
            $this->index();
        } else {
            $data["message"]="Введите логин и пароль";
            $this->view->render("userLoginView.php",$data);
        }
    }

    function logout(){
        unset($_SESSION['user']);
        session_destroy();
//        $this->view->render("mainView.php");
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('Location: '.$host);
    }

    function signup (){
        $data = ['type' => "signup"];
        if (!isset($_POST["userLogin"])) {
            $this->view->render("userLoginView.php", $data);
        } elseif ($_POST["userLogin"] && $_POST["userPwd"] && $_POST["userName"] && $_POST["userSurname"]) {
            $user = $this->model->signup($_POST["userLogin"], $_POST["userPwd"], $_POST["userName"], $_POST["userSurname"]);
            if (!isset($user['error'])) {
                $_SESSION["user"] = $user;
                $this->index();
            } else {
                $data['message'] = $user['error'];
                $this->view->render("userLoginView.php", $data);
            };
        }
    else {
        $data["message"] = "Заполните все поля";
        $this->view->render("userLoginView.php", $data);
    }

    }
}