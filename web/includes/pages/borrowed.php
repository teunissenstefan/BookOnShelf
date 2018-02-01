<?php
if(!$isLoggedIn){
    header("Location: ?p=home");
}

$query = " 
    SELECT 
        *
    FROM uitgeleend
    WHERE 
        (userid=:userid)
    "; 

$query_params = array( 
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
$totaalUitgeleendRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totaalUitgeleend = count($totaalUitgeleendRows);
if($totaalUitgeleend > 0){
    $query = " 
        SELECT 
            *
        FROM uitgeleend
        WHERE 
            (userid=:userid AND borrowed=1)
        "; 

    $query_params = array( 
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
    $uitgeleendRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $numberOfUitgeleend = count($uitgeleendRows);
    if($numberOfUitgeleend > 0){
        echo "<h1>Uitgeleend</h1><hr>";
        foreach($uitgeleendRows as $uitgeleendRow){
            $query = " 
                SELECT 
                    *
                FROM boeken
                WHERE 
                    (id=:bookid)
                LIMIT 1
                "; 

            $query_params = array( 
                ':bookid' => $uitgeleendRow['bookid']
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
            $boekRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $panelTitle = $boekRow['title'];
            $panelId = $boekRow['id'];
            $panelDescr = $boekRow['description'];
            echo "<a href='?p=viewbook&id=".$panelId."&action=returnbook'><button>Terugbrengen</button></a>"; 
            include "includes/bits/bookpanel.php";
        }
    }


    $query = " 
        SELECT 
            *
        FROM uitgeleend
        WHERE 
            (userid=:userid AND borrowed=0)
        "; 

    $query_params = array( 
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
    $gereserveerdRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $numberOfGereserveerd = count($gereserveerdRows);
    if($numberOfGereserveerd > 0){
        echo "<h1>Gereserveerd</h1><hr>";
        foreach($gereserveerdRows as $gereserveerdRow){
            $query = " 
                SELECT 
                    *
                FROM boeken
                WHERE 
                    (id=:bookid)
                LIMIT 1
                "; 

            $query_params = array( 
                ':bookid' => $gereserveerdRow['bookid']
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
            $boekRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $panelTitle = $boekRow['title'];
            $panelId = $boekRow['id'];
            $panelDescr = $boekRow['description'];
            echo "<a href='?p=viewbook&id=".$panelId."&action=borrow'><button>Lenen</button></a>"; 
            echo "<a href='?p=viewbook&id=".$panelId."&action=removereservation'><button>Reservering verwijderen</button></a>"; 
            include "includes/bits/bookpanel.php";
        }
    }
}else{
    echo "U leent op dit moment geen boeken";
}
?>