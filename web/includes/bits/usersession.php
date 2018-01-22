<?php
    $query = " 
        SELECT 
            *
        FROM gebruikers 
        WHERE 
            id = :id 
        LIMIT 1
    "; 
    $query_params = array( 
        ':id' => $sessionId
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
    $numberOfRows = count($stmt->fetchAll(PDO::FETCH_ASSOC)); 
    try 
    { 
        $stmt = $db->prepare($query); 
        $stmt->execute($query_params); 
    } 
    catch(PDOException $ex) 
    { 
        die("Failed to run query (2)"); 
    } 
    $row = $stmt->fetch();
    $_SESSION['user']['firstName'] = $row['firstname'];
    $_SESSION['user']['lastName'] = $row['lastname'];
    $_SESSION['user']['username'] = $row['username'];
    $_SESSION['user']['email'] = $row['email'];
    $_SESSION['user']['rank'] = $row['rank'];
?>