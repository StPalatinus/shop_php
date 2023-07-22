<?php
$console_log = function($data){ 
    if(is_array($data) || is_object($data)){
        echo("<script>console.log('php_array: ".json_encode($data)."');</script>");
    } else {
        echo("<script>console.log('php_string: ".$data."');</script>");
    };
}
?>