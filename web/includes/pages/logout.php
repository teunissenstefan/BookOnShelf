<?php 
     
    unset($_SESSION['user']); 
     
    header("Location: ?page=home"); 
    die("Redirecting");

?>