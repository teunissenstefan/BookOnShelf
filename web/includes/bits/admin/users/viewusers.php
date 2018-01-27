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
        echo "<div class='rowWrapper'>";
            echo "<div class='rowChild'><a href='?p=".DisplayGetVar('p')."&action=delete&id={$userRow['id']}'><button class='delete'>Verwijder</button></a><br/>
                        <a href='?p=".DisplayGetVar('p')."&action=edit&id={$userRow['id']}'><button class='edit'>Bewerk</button></a></div>";
            echo "<div class='rowChild title'>{$userRow['firstname']} {$userRow['lastname']}</div>";
            echo "<div class='rowChild'>Rang: {$userRow['rank']}</div>";
            echo "<div class='rowChild'>Gebruikersnaam: {$userRow['username']}</div>";
            echo "<div class='rowChild'>E-mail: {$userRow['email']}</div>";
        echo "</div>";
    }
}

?>