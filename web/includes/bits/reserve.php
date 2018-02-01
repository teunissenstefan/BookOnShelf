<?php

if(!$isLoggedIn || $isAdmin){
    header("Location: ?p=viewbook&id=".DisplayGetVar('id')); 
}  

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
            userid
        ) VALUES ( 
            :id,
            :bookid,
            :userid
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
        echo "Boek is gereserveerd";
        header("Location: ?p=borrowed");
    }else{
        echo "Het boek kon niet gereserveerd worden";
    }
}else{
    echo "Het boek kan niet gereserveerd worden omdat er niet genoeg exemplaren beschikbaar zijn";
}
?>