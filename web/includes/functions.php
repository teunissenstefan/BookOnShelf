<?php
function DisplayGetVar($get){
    $var = "";
    if(isset($_GET[$get])){
        $var = $_GET[$get];
    }
    return $var;
}
?>