<?php
    if($isAdmin){
        include "includes/bits/admin/admincp.php";
    }else{
        include "includes/bits/userhome.php";
    }
?>
