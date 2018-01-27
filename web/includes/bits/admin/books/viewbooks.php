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
    foreach($bookRows as $bookRow){
        $authorQuery = " 
            SELECT 
                *
            FROM auteurs
            WHERE 
                id = :authorid
        "; 
        $query_params = array( 
            ':authorid' => $bookRow['auteursid']
        ); 
        try 
        { 
            $stmt = $db->prepare($authorQuery); 
            $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query (2)"); 
        }
        $authorRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $descrLengte = 60;
        $descr = (strlen($bookRow['description']) > $descrLengte) ? substr($bookRow['description'], 0, $descrLengte) . '...' : $bookRow['description'];
        echo "<div class='rowWrapper'>";
            echo "<div class='rowChild'><a href='?p=".DisplayGetVar('p')."&action=delete&id={$bookRow['id']}'><button class='delete'>Verwijder</button></a><br/>
                        <a href='?p=".DisplayGetVar('p')."&action=edit&id={$bookRow['id']}'><button class='edit'>Bewerk</button></a></div>";
            echo "<div class='rowChild title'>{$bookRow['title']}</div>";
            echo "<div class='rowChild'>{$descr}</div>";
            echo "<div class='rowChild'>Auteur: <a href='?p=manageauthors&action=edit&id={$authorRow['id']}'>{$authorRow['firstname']} {$authorRow['lastname']}</a></div>";
            echo "<div class='rowChild'>ISBN13: {$bookRow['isbn13']}</div>";
            echo "<div class='rowChild'>Uitgeleend: {$bookRow['takenby']}</div>";
        echo "</div>";
    }
}

?>