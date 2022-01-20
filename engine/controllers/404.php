<?php

class Controller404 extends Controller {
    function index (){
        $this->view->generate("404View.php",);
    }
}