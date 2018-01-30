<?php
if(isset($_GET['q'])){
    $query = " 
        SELECT 
            *
        FROM gebruikers
        WHERE 
            (username LIKE :sq OR lastname LIKE :sq OR firstname LIKE :sq)
            AND
            id <> :myId
        ORDER BY
            lastname ASC
    "; 


    $searchQuery = "%".$_GET['q']."%";
    $query_params = array( 
        ':sq' => $searchQuery,
        ':myId' => $sessionId
    ); 
}else{
    $query = " 
        SELECT 
            *
        FROM gebruikers
        WHERE 
            id <> :id
        ORDER BY
            lastname ASC
    "; 
    $query_params = array( 
        ':id' => $sessionId
    ); 
}
    

    try 
    { 
        $stmt = $db->prepare($query); 
        $stmt->execute($query_params); 
    } 
    catch(PDOException $ex) 
    { 
        die("Failed to run query (1)"); 
    } 
    $userRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $numberOfRows = count($userRows);
?>

<?php
if($numberOfRows == 0){
    echo "Er zijn geen gebruikers gevonden";
}else{
    foreach($userRows as $userRow){
        $uitgeleendQuery = " 
            SELECT 
                *
            FROM uitgeleend
            WHERE 
                userid = :userid
        "; 
        $uitgeleendQuery_params = array( 
            ':userid' => $userRow['id']
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
        $uitgeleend = count($uitgeleendRows);

        $panelName = $userRow['firstname']." ".$userRow['lastname'];
        $panelRank = $userRow['rank'];
        $panelUsername = $userRow['username'];
        $panelEmail = $userRow['email'];
        $panelId = $userRow['id'];
        include "includes/bits/userpanel.php";

        /*echo "<div class='rowWrapper'>";
            echo "<div class='rowChild'><a href='?p=".DisplayGetVar('p')."&action=delete&id={$userRow['id']}'><button class='delete'>Verwijder</button></a><br/>
                        <a href='?p=".DisplayGetVar('p')."&action=edit&id={$userRow['id']}'><button class='edit'>Bewerk</button></a></div>";
            echo "<div class='rowChild title'>{$userRow['firstname']} {$userRow['lastname']}</div>";
            echo "<div class='rowChild'>Rang: {$userRow['rank']}</div>";
            echo "<div class='rowChild'>Gebruikersnaam: {$userRow['username']}</div>";
            echo "<div class='rowChild'>E-mail: {$userRow['email']}</div>";
            echo "<div class='rowChild'>Boeken: {$uitgeleend}</div>";
        echo "</div>";*/
    }
}

?>