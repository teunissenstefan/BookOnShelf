<?php
if(isset($_GET['q']) && $_GET['q'] != ""){
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
            echo "<a href='?p=viewbook&id={$bookRow['id']}'><div class='rowWrapper'>";
                echo "<div class='rowChild title'>{$bookRow['title']}</div>";
                echo "<div class='rowChild'>{$descr}</div>";
                echo "<div class='rowChild'>Auteur: {$authorRow['firstname']} {$authorRow['lastname']}</div>";
                echo "<div class='rowChild'>ISBN13: {$bookRow['isbn13']}</div>";
                echo "<div class='rowChild'>Uitgeleend: {$bookRow['takenby']}</div>";
            echo "</div></a>";
        }
    }
}
?>