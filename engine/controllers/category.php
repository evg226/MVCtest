<?php
class ControllerCategory extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new ModelCategory;
    }

    function index()
    {
        return $this->model->getData();
    }
}