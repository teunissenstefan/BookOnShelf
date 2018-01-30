<?php
$uitgeleendQuery = " 
    SELECT 
        *
    FROM uitgeleend
    WHERE
        userid =:userid
    "; 
$uitgeleendQuery_params = array( 
    ':userid' => $_GET['id']
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
if(count($uitgeleendRows) == 0){
    if(isset($_GET['confirm'])){
        $query = " 
            DELETE
            FROM gebruikers
            WHERE
                id =:id
        "; 
        $query_params = array( 
            ':id' => $_GET['id']
        ); 

        try 
        { 
            $stmt = $db->prepare($query); 
            $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query (1)"); 
        } 
        header("Location: ?p=".DisplayGetVar('p'));
    }else{
        $query = " 
            SELECT 
                *
            FROM gebruikers
            WHERE
                id =:id
            LIMIT 1
        "; 
        $query_params = array( 
            ':id' => $_GET['id']
        ); 

        try 
        { 
            $stmt = $db->prepare($query); 
            $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query (1)"); 
        } 
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $numberOfRows = count($userRow);
        if($numberOfRows != 1){
            echo "<div class='wordwrap'>{$userRow['lastname']}, {$userRow['firstname']}</div>";
            echo "<div class='wordwrap'>{$userRow['username']}</div>";
            echo "<div class='wordwrap'>{$userRow['email']}</div><hr>";
            echo "Weet je zeker dat je deze gebruiker wilt verwijderen?<br/>";
            echo "<a href='?p=".DisplayGetVar('p')."&action=delete&id={$_GET['id']}&confirm=true'><button class='delete'>Ja</button></a> <a href='?p=".DisplayGetVar('p')."'><button class='edit'>Nee</button></a>";
        }else{
            echo "Gebruiker niet gevonden";
        }
    }
}else{
    echo "Deze gebruiker kan niet verwijderd worden omdat er boeken uitgeleend zijn aan deze gebruiker<br /><a href='?p=".DisplayGetVar('p')."'><button class='edit'>Terug</button></a>";
}
?>