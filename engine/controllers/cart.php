<?php

class ControllerCart extends Controller{
    public function __construct(){
        parent::__construct();
        $this->model = new ModelCart;
    }

    function index (){
        return("index");
    }

    function add (){
        if(!isset($_SESSION["user"])) {
            header('Location: ' . $host . "/user");
        }
        $values=[
            "userId"=>$_SESSION["user"]["id"],
            "productId"=>$_POST["productId"],
            "quantity"=>$_POST["quantity"]?$_POST["quantity"]:1,
            "color"=>$_POST["color"],
            "size"=>$_POST["size"]
        ];
        $this->view->contentView="result.php";
        return $this->model->add($values);

    }
}
