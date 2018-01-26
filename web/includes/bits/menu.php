<div class="menu">
    <ul class="menuul">
                <li><a href="?p=home">Home</a></li>
        <?php
            if($isLoggedIn){
                if($isAdmin){
        ?>
                <li><a href="?p=manageusers">Gebruikers beheren</a></li>
                <li><a href="?p=manageauthors">Auteurs beheren</a></li>
                <li><a href="?p=managebooks">Boeken beheren</a></li>
        <?php
                }
        ?>
                <li><a href="?p=changepassword">Wachtwoord wijzigen</a></li>
                <li><a href="?p=logout">Uitloggen</a></li>
        <?php
            }else{
        ?>
                <li><a href="?p=home">Inloggen</a></li>
        <?php
            }
        ?>
    </ul>
</div>