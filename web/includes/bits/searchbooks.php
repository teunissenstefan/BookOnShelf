<?php
if(isset($_GET['q']) && $_GET['q'] != ""){
    $query_s = " 
        SELECT 
            *
        FROM boeken
        WHERE 
            (title LIKE :sq OR description LIKE :sq OR isbn13 LIKE :sq)
        ORDER BY
            title ASC
    "; 


    $searchQuery = "%".$_GET['q']."%";
    $query_params_s = array( 
        ':sq' => $searchQuery
    ); 
    try 
    { 
        $stmt = $db->prepare($query_s); 
        $stmt->execute($query_params_s); 
    } 
    catch(PDOException $ex) 
    { 
        die("Failed to run query (1)"); 
    } 
    $bookRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $numberOfRows = count($bookRows);
    if($numberOfRows == 0){
        echo "Er zijn geen boeken gevonden";
    }else{
        echo "<div id='boekenDiv'>";
        include "includes/bits/loadbooks.php";
        echo "</div>";
        if($numberOfRows > 5){
            echo "<button id='loadbooks'>Nog 5 boeken laten zien</button>";
        }
    }
}
?>