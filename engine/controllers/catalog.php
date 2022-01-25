<?php
class ControllerCatalog extends Controller {
    public function __construct()    {
        parent::__construct();
        $this->model=new ModelCatalog;
    }

    function index (){
        if(isset($_GET["id"])){
            $this->view->contentView="productView.php";
            return $this->model->getById($_GET["id"]);
        } else {
            $this->view->contentView="catalogView.php";
            $startId=isset($_GET["startId"])?$_GET["startId"]:0;
            $limit=isset($_GET["limit"])?$_GET["limit"]:3;
            return $this->model->getData($startId,$limit);
        }
    }
    function getImages(){
        if(isset($_GET["productId"])){
            return $this->model->getImages($_GET["productId"]);
        }
    }
}