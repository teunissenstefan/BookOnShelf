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
    foreach($authorRows as $authorRow){
        echo "<div class='rowWrapper'>";
            echo "<div class='rowChild'><a href='?p=".DisplayGetVar('p')."&action=delete&id={$authorRow['id']}'><button class='delete'>Verwijder</button></a><br/>
                        <a href='?p=".DisplayGetVar('p')."&action=edit&id={$authorRow['id']}'><button class='edit'>Bewerk</button></a></div>";
            echo "<div class='rowChild title'>{$authorRow['firstname']} {$authorRow['lastname']}</div>";
        echo "</div>";
    }
}

?>