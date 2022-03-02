<?php

class ControllerAbout extends Controller {
    function index (){
        $this->view->contentView="aboutView.php";
        return [];
    }
}
