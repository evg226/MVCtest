<?php

class ControllerMain extends Controller {
    function index (){
        $this->view->render("mainView.php");

    }
}
