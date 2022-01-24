<?php
class View {
    public $contentView="";
    function render ($data=null,$templateView="templateView.php"){
//        if (is_array($data)) extract($data);
        include "engine/views/$templateView";
    }
}
