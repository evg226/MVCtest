<?php
class View {
    function render ($contentView, $data=null,$templateView="templateView.php"){
//        if (is_array($data)) extract($data);
        include "engine/views/$templateView";
    }
}
