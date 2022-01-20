<?php
abstract class Controller {
    public $model;
    public $view;

    function __construct(){
        $this->view=new View;

    }

    abstract function index();

    function writeHistory($controller,$action){
        $path=($controller=="main"?"":$controller)."/".($action=="index"?"":$action);
        if (isset($_SESSION["user"])&&isset($_SESSION["user"]["id"])&&($_SESSION["user"]["id"])) {
           Model::writeHistoryDB($_SESSION["user"]["id"],$path);
        }
    }
}
