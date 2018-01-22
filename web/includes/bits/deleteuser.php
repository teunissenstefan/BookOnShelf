<?php
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
        header("Location: ?p=manageusers");
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
            echo "{$userRow['lastname']}, {$userRow['firstname']}<br />";
            echo "{$userRow['username']}<br />";
            echo "{$userRow['email']}<br /><hr>";
            echo "Weet je zeker dat je deze gebruiker wilt verwijderen?<br/>";
            echo "<a href='?p=manageusers&action=delete&id={$_GET['id']}&confirm=true'><button class='delete'>Ja</button></a> <a href='?p=manageusers'><button>Nee</button></a>";
        }else{
            echo "Gebruiker niet gevonden";
        }
    }
?>