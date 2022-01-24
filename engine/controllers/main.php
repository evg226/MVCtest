<?php

class ControllerMain extends Controller {
    function index (){
        $this->view->contentView="mainView.php";
        return [];

    }
}
