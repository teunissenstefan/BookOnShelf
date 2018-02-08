<?php

if(isset($_POST['boeken_start'])){
    $path = "../";
    $boekenStart = $_POST['boeken_start'];
}else{
    $path = "includes/";
}

if(!empty($_SESSION['user'])) 
{ 
    $sessionId = $_SESSION['user']['id'];
    include $path."bits/usersession.php";
    $sessionFirstName = $_SESSION['user']['firstName'];
    $sessionLastName = $_SESSION['user']['lastName'];
    $sessionUsername = $_SESSION['user']['username'];
    $sessionEmail = $_SESSION['user']['email'];
    $sessionRank = $_SESSION['user']['rank'];

    $isLoggedIn = true;

    if($sessionRank == 1){
        $isAdmin = true;
    }else{
        $isAdmin = false;
    }
}else{
    $isLoggedIn = false;
    $sessionId = "";
    $sessionFirstName = "";
    $sessionLastName = "";
    $sessionUsername = "";
    $sessionRank = "0";
    $isAdmin = false;
}

?>