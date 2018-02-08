<?php
if(isset($_POST['boeken_start'])){
    $path = "../";
    $boekenStart = $_POST['boeken_start'];
}else{
    $boekenStart = 0;
    $path = "includes/";
}
require $path."connection.php";
require $path."session.php";

$query = " 
    SELECT 
        *
    FROM boeken
    WHERE 
        (title LIKE :sq OR description LIKE :sq OR isbn13 LIKE :sq)
    ORDER BY
        title ASC
    LIMIT :bs,5
"; 


$searchQuery = "%".$_GET['q']."%";
try 
{ 
    $stmt = $db->prepare($query); 
    $stmt->bindValue(':sq', $searchQuery);
    $stmt->bindValue(':bs', (int) trim($boekenStart), PDO::PARAM_INT);
    $stmt->execute(); 
} 
catch(PDOException $ex) 
{ 
    die("Failed to run query (1)"); 
} 
$bookRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($bookRows as $bookRow){
    $auteursString = explode(",",$bookRow['auteurs']);
    $auteurs = "";
    foreach($auteursString as $auteurid){
        if(!empty($auteurid)){
            $geschrevenQuery = " 
                SELECT 
                    *
                FROM auteurs
                WHERE
                    id =:id
            "; 
            $geschrevenQuery_params = array( 
                ':id' => $auteurid
            ); 

            try 
            { 
                $stmt = $db->prepare($geschrevenQuery); 
                $stmt->execute($geschrevenQuery_params); 
            } 
            catch(PDOException $ex) 
            { 
                die("Failed to run query (5)"); 
            } 
            $geschrevenRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $auteurs.= $geschrevenRow['firstname']." ".$geschrevenRow['lastname'].",";
        }
    }
    $auteurs = trim($auteurs,',');
    $authorQuery = " 
        SELECT 
            *
        FROM auteurs
        WHERE 
            id = :authorid
    "; 
    $uitgeleendQuery = " 
        SELECT 
            *
        FROM uitgeleend
        WHERE 
            bookid = :bookid
    "; 
    $uitgeleendQuery_params = array( 
        ':bookid' => $bookRow['id']
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
    $beschikbaar = $bookRow['amount'] - count($uitgeleendRows);

    $panelTitle = $bookRow['title'];
    $panelId = $bookRow['id'];
    $panelDescr = $bookRow['description'];
    include $path."bits/bookpanel.php";
}

?>