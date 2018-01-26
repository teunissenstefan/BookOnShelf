<?php
    if(isset($_GET['confirm'])){
        $query = " 
            DELETE
            FROM boeken
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
            FROM boeken
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
        $bookRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $numberOfRows = count($bookRow);
        if($numberOfRows != 1){
            echo "<h2>{$bookRow['title']}</h2><hr>".nl2br($bookRow['description'])."<br /><hr>";
            echo "Weet je zeker dat je dit boek wilt verwijderen?<br/>";
            echo "<a href='?p=".DisplayGetVar('p')."&action=delete&id={$_GET['id']}&confirm=true'><button class='delete'>Ja</button></a> <a href='?p=".DisplayGetVar('p')."'><button class='edit'>Nee</button></a>";
        }else{
            echo "Boek niet gevonden";
        }
    }
?>