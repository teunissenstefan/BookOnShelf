<div class="topMenu">
    <h1>Boeken zoeken</h1>
    <?php
        echo "<form action='?p=home&' method='get'>
                <input type='hidden' name='p' value='home'/>
                <input type='text' name='q' placeholder='Zoekterm' value='".DisplayGetVar('q')."'/>
                <button type='submit'>Zoek</button>
            </form>";
       ?>
</div>
<?php
    include "includes/bits/searchbooks.php";
?>