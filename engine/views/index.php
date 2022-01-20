<?php
class View {
    function generate ($contentView, $templateView="templateView.php",$data=null){
        if (is_array($data)) extract($data);
        include "engine/views/$templateView";
    }
}
