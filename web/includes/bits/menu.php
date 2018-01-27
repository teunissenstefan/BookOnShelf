<div class="menu">
    <ul class="menuul">
                <li><a href="?p=home" class="menuLink">Home</a></li>
        <?php
            if($isLoggedIn){
                if($isAdmin){
        ?>
                <li><a href="?p=manageusers" class="menuLink">Gebruikers beheren</a></li>
                <li><a href="?p=manageauthors" class="menuLink">Auteurs beheren</a></li>
                <li><a href="?p=managebooks" class="menuLink">Boeken beheren</a></li>
        <?php
                }
        ?>
                <li><a href="?p=changepassword" class="menuLink">Wachtwoord wijzigen</a></li>
                <li><a href="?p=logout" class="menuLink">Uitloggen</a></li>
        <?php
            }else{
        ?>
                <li><a href="?p=login" class="menuLink">Inloggen</a></li>
        <?php
            }
        ?>
    </ul>
</div>