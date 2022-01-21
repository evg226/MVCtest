<?php

class Controller404 extends Controller {
    function index (){
        $this->view->render("404View.php",);
    }
}