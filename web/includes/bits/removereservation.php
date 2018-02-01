<?php
if(!$isLoggedIn || $isAdmin){
    header("Location: ?p=viewbook&id=".DisplayGetVar('id')); 
}

$uitgeleendQuery = " 
    SELECT 
        *
    FROM uitgeleend
    WHERE
        userid =:userid AND bookid =:bookid AND borrowed = 0
    LIMIT 1
    "; 
$uitgeleendQuery_params = array( 
    ':bookid' => DisplayGetVar('id'),
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
$uitgeleendRow = $stmt->fetch(PDO::FETCH_ASSOC);
if($uitgeleendRow){
    $query = " 
        DELETE
        FROM uitgeleend
        WHERE
            userid =:userid AND bookid =:bookid AND borrowed = 0
        LIMIT 1
    "; 
    $query_params = array( 
        ':bookid' => DisplayGetVar('id'),
        ':userid' => $sessionId
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
    header("Location: ?p=borrowed");
}else{
    echo "De reservering kan niet worden verwijderd omdat het niet is gevonden";
}
?>