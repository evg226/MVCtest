<?php

class ControllerMain extends Controller {
    function index (){
        $this->view->generate("mainView.php");

    }
}
