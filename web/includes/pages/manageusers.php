<?php
    if(!$isLoggedIn || !$isAdmin){
        header("Location: ?p=home"); 
    }  
?>
<div class="topMenu">
    <h1>Gebruikers</h1>
    <?php   if(!isset($_GET['action'])||(isset($_GET['action'])&& !isset($_GET['id']))){
        echo "<a href='?p=manageusers&action=add'><button>Toevoegen</button></a>";
    }   ?>
</div>
<?php
    if(!isset($_GET['action'])){
        include "includes/bits/viewusers.php";
    }else if($_GET['action'] == "delete" && isset($_GET['id'])){
        include "includes/bits/deleteuser.php";
    }else if($_GET['action'] == "edit" && isset($_GET['id'])){
        
    }else if($_GET['action'] == "add"){
        
    }else{
        include "includes/bits/viewusers.php";
    }
?>