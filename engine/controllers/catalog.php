<?php
class ControllerCatalog extends Controller {
    public function __construct()    {
        parent::__construct();
        $this->model=new ModelCatalog;
    }

    function index (){
        $this->view->contentView="catalogView.php";
        return $this->model->getData();
    }
}