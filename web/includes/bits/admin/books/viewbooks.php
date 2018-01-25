<?php
if(isset($_GET['q'])){
    $query = " 
        SELECT 
            *
        FROM boeken
        WHERE 
            (title LIKE :sq OR description LIKE :sq OR isbn13 LIKE :sq)
        ORDER BY
            title ASC
    "; 


    $searchQuery = "%".$_GET['q']."%";
    $query_params = array( 
        ':sq' => $searchQuery
    ); 
}else{
    $query = " 
        SELECT 
            *
        FROM boeken
        ORDER BY
            title ASC
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
    $bookRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $numberOfRows = count($bookRows);
?>

<?php
if($numberOfRows == 0){
    echo "Er zijn geen boeken gevonden";
}else{
    echo "<table>";
    echo "<tr><th>Bewerkingen</th><th>ISBN13</th><th>Auteur</th><th>Uitgeleend</th><th>Titel</th><th>Beschrijving</th></tr>";
        foreach($bookRows as $bookRow){
            $descrLengte = 60;
            $descr = (strlen($bookRow['description']) > $descrLengte) ? substr($bookRow['description'], 0, $descrLengte) . '...' : $bookRow['description'];
            echo "<tr>";
            echo "<td center><a href='?p=".DisplayGetVar('p')."&action=delete&id={$bookRow['id']}'><button class='delete'>Verwijder</button></a><br/>
                        <a href='?p=".DisplayGetVar('p')."&action=edit&id={$bookRow['id']}'><button class='edit'>Bewerk</button></a></td>
                    <td>{$bookRow['isbn13']}</td>
                    <td>{$bookRow['auteursid']}</td>
                    <td>{$bookRow['takenby']}</td>
                    <td>{$bookRow['title']}</td>
                    <td>{$descr}</td>";
            echo "</tr>";
        }
    echo "</table>";
}

?>