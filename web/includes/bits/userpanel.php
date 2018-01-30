<div class="panel">
    <div class="panelTitle wordwrap">
        <h3><?php echo $panelName; ?></h3>
    </div>
    
    <?php
        if($isAdmin){
            echo "  <div style='background-color:lightblue;width:100%;'>
                        <a href='?p=".DisplayGetVar('p')."&action=delete&id={$panelId}'><button class='delete'>Verwijder</button></a>
                        <a href='?p=".DisplayGetVar('p')."&action=edit&id={$panelId}'><button class='edit'>Bewerk</button></a>
                    </div>";
        }
    ?>

    <div class="wordwrap">
        <?php
            echo "Rang: ".$panelRank."<br/>";
            echo "Gebruikersnaam: ".$panelUsername."<br/>";
            echo "E-mail: ".$panelEmail."<br/>";
        ?>
    </div>

</div>