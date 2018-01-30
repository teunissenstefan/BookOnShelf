<?php
$titleLengte = 60;
$title = (strlen($panelTitle) > $titleLengte) ? mb_substr($panelTitle, 0, $titleLengte) . '...' : $panelTitle;
$descrLengte = 700;
$descr = (strlen($panelDescr) > $descrLengte) ? mb_substr($panelDescr, 0, $descrLengte) . '...' : $panelDescr;
?>

<?php
if(!$isAdmin){
    echo "<a href='?p=viewbook&id={$bookRow['id']}'>";
}
?>
    <div class="panel">
        <div class="panelTitle wordwrap">
            <h3><?php echo $title; ?></h3>
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
                echo $descr;
            ?>
        </div>

    </div>
<?php
if(!$isAdmin){
    echo "</a>";
}
?>