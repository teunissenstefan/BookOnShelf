<?php
    if(!$isLoggedIn){
        header("Location: ?p=login"); 
    }
    if($isAdmin){
        include "includes/bits/admin/admincp.php";
    }else{
        include "includes/bits/userhome.php";
    }
?>
