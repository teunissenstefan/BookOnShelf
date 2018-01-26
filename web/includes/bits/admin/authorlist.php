<?php

$auteurListQuery = " 
    SELECT * FROM auteurs
";
if(isset($getAuthorFromList)){
    $getAuthorQuery = " 
        SELECT * FROM auteurs
        WHERE
            id = :auteursid
    ";
    $authorParams = array( 
        ':auteursid' => $getAuthorFromList
    ); 
    try{
        $stmt = $db->prepare($getAuthorQuery); 
        $stmt->execute($authorParams);
        $getAuthorRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $selectedAuthor = $getAuthorRow['firstname']." ".$getAuthorRow['lastname'];
    }catch(PDOException $ex){
        $selectedAuthor = "";
    }
}else{
    $selectedAuthor = "";
}

try 
{
    $stmt = $db->prepare($auteurListQuery); 
    $stmt->execute();
    $authorRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $numberOfAuthors = count($authorRows);
} 
catch(PDOException $ex) 
{ 
    $numberOfAuthors = 0;
}

?>

<input type="text" id="inputAuthor" autocomplete="off" name="auteursid" placeholder="Auteur" list="auteurLijst" value="<?php echo !empty($_POST['auteursid']) ? $_POST['auteursid'] : $selectedAuthor; ?>">
<datalist id="auteurLijst">
    <?php
        foreach($authorRows as $authorRow){
            echo "<option data-value='".$authorRow['id']."' value='".$authorRow['firstname']." ".$authorRow['lastname']."'>";
        }
    ?>
</datalist>