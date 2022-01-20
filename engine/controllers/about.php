<?php

class ControllerAbout extends Controller {
    function index (){
        $this->view->generate("aboutView.php",);

    }
}
