<?php
    if(!$isLoggedIn || !$isAdmin){
        header("Location: ?p=home"); 
    }  
?>
<div class="topMenu">
    <h1>Gebruikers</h1>
    <?php   if(!isset($_GET['action'])){
        echo "<a href='?p=manageusers&action=add'>Toevoegen</a>";
    }   ?>
</div>
<?php
    if(!isset($_GET['action'])){
        include "includes/bits/viewusers.php";
    }else{
        
    }
?>