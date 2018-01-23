<?php
if(isset($_GET['username'])){
    $query = " 
        SELECT 
            *
        FROM gebruikers
        WHERE 
            username LIKE :uname
            AND
            id <> :myId
        ORDER BY
            lastname ASC
    "; 
    $searchUname = "%".$_GET['username']."%";
    $query_params = array( 
        ':uname' => $searchUname,
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
    echo "<table>";
    echo "<tr><th>Bewerkingen</th><th>Rang</th><th>Achternaam</th><th>Voornaam</th><th>Gebruikersnaam</th><th>E-mail</th></tr>";
        foreach($userRows as $userRow){
            echo "<tr>";
            echo "<td center><a href='?p=manageusers&action=delete&id={$userRow['id']}'><button class='delete'>Verwijder</button></a><br/>
                        <a href='?p=manageusers&action=edit&id={$userRow['id']}'><button class='edit'>Bewerk</button></a></td>
                    <td center>{$userRow['rank']}</td>
                    <td>{$userRow['lastname']}</td>
                    <td>{$userRow['firstname']}</td>
                    <td>{$userRow['username']}</td>
                    <td>{$userRow['email']}</td>";
            echo "</tr>";
        }
    echo "</table>";
}

?>