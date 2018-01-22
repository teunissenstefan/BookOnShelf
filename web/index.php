<?php
    require "includes/connection.php";

    if(!empty($_SESSION['user'])) 
    { 
        $sessionId = $_SESSION['user']['id'];
        include "includes/bits/usersession.php";
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

    if(isset($_GET['p'])){
        $page = $_GET['p'];
    }else{
        $page = "home";
    }
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BookOnShelf</title>
    <link rel="stylesheet" type="text/css" href="css/bos.css">
</head>
<body>
    <div class="wrapper">
        <div class="menuWrapper">
            <?php
                include "includes/bits/menu.php";
            ?>
        </div>
        <div class="contentWrapper">
            <div class="content">
                <?php
                    if(file_exists("includes/pages/".$page.".php")){
                        include "includes/pages/".$page.".php";
                    }else{
                        echo "Opgevraagde pagina bestaat niet";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>