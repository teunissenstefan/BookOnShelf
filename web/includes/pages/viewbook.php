<?php
$boekQuery = " 
    SELECT 
        *
    FROM boeken
    WHERE
        id =:id
    LIMIT 1
"; 
$query_params = array( 
    ':id' => DisplayGetVar('id')
); 

try 
{ 
    $stmt = $db->prepare($boekQuery); 
    $stmt->execute($query_params); 
} 
catch(PDOException $ex) 
{ 
    die("Failed to run query (1)"); 
} 
$bookRow = $stmt->fetch(PDO::FETCH_ASSOC);
if($bookRow){
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
    ?>

<div class="topMenu">
    <h1><?php echo $bookRow['title']; ?></h1>
</div>
<div>
    <?php echo nl2br($bookRow['description']); ?>
</div><hr>
<div>
    <?php 
        echo "Auteur: ".$authorRow['firstname']." ".$authorRow['lastname']."<br />"; 
        echo "ISBN13: ".$bookRow['isbn13']."<br />";
        echo "Uitgeleend: ".$bookRow['takenby'];
    ?>
</div>
<?php
}else{
    echo "Opgevraagde boek niet gevonden";
}
?>