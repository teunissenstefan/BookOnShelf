<?php
if(isset($_GET['q'])){
    $query = " 
        SELECT 
            *
        FROM auteurs
        WHERE 
            (firstname LIKE :sq OR lastname LIKE :sq)
        ORDER BY
            lastname ASC
    "; 


    $searchQuery = "%".$_GET['q']."%";
    $query_params = array( 
        ':sq' => $searchQuery
    ); 
}else{
    $query = " 
        SELECT 
            *
        FROM auteurs
        ORDER BY
            lastname ASC
    "; 
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
    $authorRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $numberOfRows = count($authorRows);
?>

<?php
if($numberOfRows == 0){
    echo "Er zijn geen auteurs gevonden";
}else{
    echo "<table>";
    echo "<tr><th>Bewerkingen</th><th>Achternaam</th><th>Voornaam</th></tr>";
        foreach($authorRows as $autorRow){
            echo "<tr>";
            echo "<td center><a href='?p=".DisplayGetVar('p')."&action=delete&id={$autorRow['id']}'><button class='delete'>Verwijder</button></a><br/>
                        <a href='?p=".DisplayGetVar('p')."&action=edit&id={$autorRow['id']}'><button class='edit'>Bewerk</button></a></td>
                    <td>{$autorRow['lastname']}</td>
                    <td>{$autorRow['firstname']}</td>";
            echo "</tr>";
        }
    echo "</table>";
}

?>