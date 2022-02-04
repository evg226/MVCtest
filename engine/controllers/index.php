<?php
abstract class Controller {
    public $model;
    public $view;

    function __construct(){
        $this->view=new View;
    }

    abstract function index();

    protected function chechAuth(){
        if (!isset($_SESSION["user"])||$_SESSION["user"]["role"]!=="ADMIN")
            return ["error" => "Требуется аутентификация ADMIN"];
        else
            return $_SESSION['user'];
    }

    function writeHistory($controller,$action){
        $path=($controller=="main"?"":$controller)."/".($action=="index"?"":$action);
        if (isset($_SESSION["user"])&&isset($_SESSION["user"]["id"])&&($_SESSION["user"]["id"])) {
           Model::writeHistoryDB($_SESSION["user"]["id"],$path);
        }
    }
}
