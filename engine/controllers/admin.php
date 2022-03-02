<?php

class ControllerAdmin extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelAdmin;
        $this->view->contentView="adminView.php";
    }

    function index()
    {
        $user=$this->chechAuth();
        if (isset($user['error'])) return $user;

        $entity=isset($_GET['entity'])??$_GET['entity'];
        switch ($entity){
            case "product":
                return $this->model->getProducts();
            case "collection":
                return ["result"=>"collection"];
            case "category":
                return ["result"=>"category"];
            default:
                return $this->model->getOrders();
        }
    }
}
