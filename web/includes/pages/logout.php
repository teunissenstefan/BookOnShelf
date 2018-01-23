<?php 
     
    unset($_SESSION['user']); 
     
    header("Location: ?p=home"); 
    die("Redirecting");

?>