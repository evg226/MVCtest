<?php

class ControllerUser extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelUser;
    }

    function index()
    {
        if (isset($_SESSION["user"]) && isset($_SESSION["user"]["id"])) {
            $data = $this->model->getUser($_SESSION["user"]["id"]);
            $this->view->contentView = "userView.php";
        } else {
            $data = ['type' => "login"];
            $this->view->contentView = "userLoginView.php";
        }
        return $data;
    }

    function login()
    {
        $data = ['type' => "login"];
        $this->view->contentView = "userLoginView.php";
        if (isset($_POST["userLogin"])&&$_POST["userLogin"] && $_POST["userPwd"]) {
            $user = $this->model->login($_POST["userLogin"], $_POST["userPwd"]);
            if ($user) {
                $_SESSION["user"] = $user[0];
                $data["message"] = "Успешно";
                header('Location: ' . $host . "/user");
            } else {
                $data["message"] = "Неправильный логин или пароль";
            };
        } else {
            $data["message"] = "Введите логин и пароль";
        }
        return $data;
    }

    function logout() {
        unset($_SESSION['user']);
        session_destroy();
          $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('Location: ' . $host);
        $data["message"] = "Успешно";
        return $data;
    }

    function signup(){
        $data = ['type' => "signup"];
        $this->view->contentView = "userLoginView.php";
        if (!isset($_POST["userLogin"])) return $data;
        if ($_POST["userLogin"] && $_POST["userPwd"] && $_POST["userName"] && $_POST["userSurname"]) {
            $user = $this->model->signup($_POST["userLogin"], $_POST["userPwd"], $_POST["userName"], $_POST["userSurname"]);
            if (!isset($user['error'])) {
                $_SESSION["user"] = $user;
                $data["message"] = "Успешно";
                header('Location: ' . $host . "/user");
            } else {
                $data["message"] = $user["error"];
            }
        } else {
            $data["message"] = "Заполните все поля";
        }
        return $data;
    }



}