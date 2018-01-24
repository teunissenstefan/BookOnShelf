<?php
    if(!$isLoggedIn || !$isAdmin){
        header("Location: ?p=home"); 
    }  
?>
<div class="topMenu">
    <h1>Auteurs</h1>
    <?php   if(!isset($_GET['action'])||(isset($_GET['action'])&& !isset($_GET['id']))){
        echo "";
        echo "<form action='?p=".DisplayGetVar('p')."&' method='get'>
                <a href='?p=".DisplayGetVar('p')."&action=add&id=n' class='linkbutton'>Toevoegen</a>
                <input type='hidden' name='p' value='".DisplayGetVar('p')."'/>
                <input type='text' name='q' placeholder='Zoekterm' value='".DisplayGetVar('q')."'/>
                <button type='submit'>Zoek</button>
            </form>";
    }   ?>
</div>
<?php
    if(!isset($_GET['action'])){
        include "includes/bits/admin/authors/viewauthors.php";
    }else if($_GET['action'] == "delete" && isset($_GET['id'])){
        include "includes/bits/admin/authors/deleteauthor.php";
    }else if($_GET['action'] == "edit" && isset($_GET['id'])){
        include "includes/bits/admin/authors/updateauthor.php";
    }else if($_GET['action'] == "add"){
        include "includes/bits/admin/authors/addauthor.php";
    }else{
        include "includes/bits/admin/authors/viewauthors.php";
    }
?>