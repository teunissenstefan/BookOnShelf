<?php

if(!$isLoggedIn || $isAdmin){
    header("Location: ?p=viewbook&id=".DisplayGetVar('id')); 
}  

$uitgeleendQuery = " 
    SELECT 
        *
    FROM uitgeleend
    WHERE 
        bookid = :bookid AND userid = :userid AND borrowed = 0
    LIMIT 1
"; 
$uitgeleendQuery_params = array( 
    ':bookid' => $bookRow['id'],
    ':userid' => $sessionId
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
$bestaandeUitgeleendRow = $stmt->fetch(PDO::FETCH_ASSOC);
if($bestaandeUitgeleendRow){
    $update_query = " 
        UPDATE uitgeleend 
        SET
            borrowed = 1
        WHERE
            id =:id
    ";
    $update_query_params = array( 
        ':id' => $bestaandeUitgeleendRow['id']
    ); 

    try 
    { 
        $stmt = $db->prepare($update_query); 
        $stmt->execute($update_query_params); 
    } 
    catch(PDOException $ex) 
    { 
        die("Failed to run query (2)"); 
    }
    header("Location: ?p=borrowed");
}else{
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
    if($beschikbaar > 0){
        $failed = false;
        $query = " 
            INSERT INTO uitgeleend ( 
                id,
                bookid, 
                userid,
                borrowed
            ) VALUES ( 
                :id,
                :bookid,
                :userid,
                1
            ) 
        "; 
        
        $idtje = base_convert(microtime(false), 10, 36);

        $query_params = array( 
            ':id' => $idtje, 
            ':bookid' => DisplayGetVar('id'), 
            ':userid' => $sessionId
        ); 
        
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            $failed = true;
        } 
        if(!$failed){
            echo "Je leent nu dit boek";
            header("Location: ?p=borrowed");
        }else{
            echo "Het boek kan niet geleend worden";
        }
    }else{
        echo "Het boek kan niet geleend worden omdat er niet genoeg exemplaren beschikbaar zijn";
    }
}


?>