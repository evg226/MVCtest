<?php
class ControllerCatalog extends Controller {
    public function __construct()    {
        parent::__construct();
        $this->model=new ModelCatalog;
    }

    function index (){
        $data=$this->model->getData();
        $this->view->render("catalogView.php",$data);

    }
}