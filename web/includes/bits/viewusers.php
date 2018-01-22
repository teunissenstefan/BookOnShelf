<?php
    $query = " 
        SELECT 
            *
        FROM gebruikers
        ORDER BY
            lastname ASC
    "; 

    try 
    { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
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
    echo "<tr><th>Bewerkingen</th><th>Achternaam</th><th>Voornaam</th><th>Gebruikersnaam</th><th>E-mail</th></tr>";
        foreach($userRows as $userRow){
            echo "<tr>";
            echo "<td><a href='?p=manageusers&action=delete'>Verwijder</a><br/><a href='?p=manageusers&action=edit'>Bewerk</a></td>
                    <td>{$userRow['lastname']}</td>
                    <td>{$userRow['firstname']}</td>
                    <td>{$userRow['username']}</td>
                    <td>{$userRow['email']}</td>";
            echo "</tr>";
        }
    echo "</table>";
}


?>