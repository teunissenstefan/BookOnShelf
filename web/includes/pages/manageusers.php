<?php
    if(!$isLoggedIn || !$isAdmin){
        header("Location: ?p=home"); 
    }  
?>
<div class="topMenu">
    <h1>Gebruikers</h1>
    <?php   if(!isset($_GET['action'])||(isset($_GET['action'])&& !isset($_GET['id']))){
        echo "";
        echo "<form action='?p=manageusers&' method='get'>
                <a href='?p=manageusers&action=add&id=n' class='linkbutton'>Toevoegen</a>
                <input type='hidden' name='p' value='manageusers'/>
                <input type='text' name='username' placeholder='Gebruikersnaam'/>
                <button type='submit'>Zoek</button>
            </form>";
    }   ?>
</div>
<?php
    if(!isset($_GET['action'])){
        include "includes/bits/viewusers.php";
    }else if($_GET['action'] == "delete" && isset($_GET['id'])){
        include "includes/bits/deleteuser.php";
    }else if($_GET['action'] == "edit" && isset($_GET['id'])){
        include "includes/bits/updateuser.php";
    }else if($_GET['action'] == "add"){
        include "includes/bits/adduser.php";
    }else{
        include "includes/bits/viewusers.php";
    }
?>