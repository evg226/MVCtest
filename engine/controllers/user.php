<?php

class ControllerUser extends Controller {
    public function __construct()    {
        parent::__construct();
        $this->model=new ModelUser;
    }

    function index (){
        if (isset($_SESSION["user"])&&isset($_SESSION["user"]["id"])) {
            $data=$this->model->getUser($_SESSION["user"]["id"]);
            $this->view->generate("userView.php","templateView.php",$data);
        } else {
            $data=['type'=>"login"];
            $this->view->generate("userLoginView.php", "templateView.php",$data );
        }
    }

    function login (){
        $data=['type'=>"login"];
        if ($_POST["userLogin"] && $_POST["userPwd"]) {
            $user = $this->model->login($_POST["userLogin"], $_POST["userPwd"]);
            if ($user) {
                $_SESSION["user"] = $user;
            } else {
                $data["message"]="Неправильный логин или пароль";
                $this->view->generate("userLoginView.php", "templateView.php",$data );
            };
            $this->index();
        } else {
            $data["message"]="Введите логин и пароль";
            $this->view->generate("userLoginView.php","templateView.php",$data);
        }
    }

    function logout(){
        unset($_SESSION['user']);
        session_destroy();
        $this->view->generate("mainView.php");
    }

    function signup (){
        $data=['type'=>"signup"];
        if ($_POST["userLogin"] && $_POST["userPwd"] && $_POST["userName"] && $_POST["userSurname"]) {
            $user= $this->model->signup($_POST["userLogin"], $_POST["userPwd"],$_POST["userName"],$_POST["userSurname"]);
            if (!isset($user['error'])) {
                $_SESSION["user"] = $user;
            } else {
                $data['message']=$user['error'];
                $this->view->generate("userLoginView.php", "templateView.php",$data );
            };
            $this->index();
        } else {
            $data["message"]="Заполните все поля";
            $this->view->generate("userLoginView.php","templateView.php",$data);
        }
    }
}