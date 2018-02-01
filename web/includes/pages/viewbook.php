<?php
$boekQuery = " 
    SELECT 
        *
    FROM boeken
    WHERE
        id =:id
    LIMIT 1
"; 
$query_params = array( 
    ':id' => DisplayGetVar('id')
); 

try 
{ 
    $stmt = $db->prepare($boekQuery); 
    $stmt->execute($query_params); 
} 
catch(PDOException $ex) 
{ 
    die("Failed to run query (1)"); 
} 
$bookRow = $stmt->fetch(PDO::FETCH_ASSOC);
if($bookRow){
    if(DisplayGetVar('action') == "reserve"){
        include "includes/bits/reserve.php";
    }else if(DisplayGetVar('action') == "borrow"){
        include "includes/bits/borrow.php";
    }else if(DisplayGetVar('action') == "removereservation"){
        include "includes/bits/removereservation.php";
    }else if(DisplayGetVar('action') == "returnbook"){
        include "includes/bits/returnbook.php";
    }else{
        $auteursString = explode(",",$bookRow['auteurs']);
        $auteurs = "";
        foreach($auteursString as $auteurid){
            if(!empty($auteurid)){
                $geschrevenQuery = " 
                    SELECT 
                        *
                    FROM auteurs
                    WHERE
                        id =:id
                "; 
                $geschrevenQuery_params = array( 
                    ':id' => $auteurid
                ); 

                try 
                { 
                    $stmt = $db->prepare($geschrevenQuery); 
                    $stmt->execute($geschrevenQuery_params); 
                } 
                catch(PDOException $ex) 
                { 
                    die("Failed to run query (5)"); 
                } 
                $geschrevenRow = $stmt->fetch(PDO::FETCH_ASSOC);
                $auteurs.= $geschrevenRow['firstname']." ".$geschrevenRow['lastname'].",";
            }
        }
        $auteurs = trim($auteurs,',');
        $uitgeleendQuery = " 
            SELECT 
                *
            FROM uitgeleend
            WHERE 
                bookid = :bookid
        "; 
        $uitgeleendQuery_params = array( 
            ':bookid' => $bookRow['id']
        ); 
        try 
        { 
            $stmt = $db->prepare($uitgeleendQuery); 
            $stmt->execute($uitgeleendQuery_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query (3)"); 
        }
        $uitgeleendRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $beschikbaar = $bookRow['amount'] - count($uitgeleendRows);
    ?>

    <div class="topMenu">
        <button onclick="window.history.back();">Terug</button> 
        <?php
            if($isLoggedIn){
                echo "<a href='?p=viewbook&id=".DisplayGetVar('id')."&action=reserve'><button>Reserveren</button></a>"; 
                echo "<a href='?p=viewbook&id=".DisplayGetVar('id')."&action=borrow'><button>Lenen</button></a>"; 
            }
        ?>
        <h1 class="wordwrap"><?php echo $bookRow['title']; ?></h1>
    </div>
    <div class="wordwrap">
        <?php echo nl2br($bookRow['description']); ?>
    </div><hr>
    <div class="wordwrap">
        <?php 
            echo "Auteurs: ".$auteurs."<br />"; 
            echo "ISBN13: ".$bookRow['isbn13']."<br />";
            echo "Beschikbaar: ".$beschikbaar."/".$bookRow['amount'];
        ?>
    </div>
<?php
    }
}else{
    echo "Opgevraagde boek niet gevonden";
}
?>