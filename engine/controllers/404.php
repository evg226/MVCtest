<?php

class Controller404 extends Controller {
    function index (){
        $this->view->contentView="404View.php";
        return [];
    }
}