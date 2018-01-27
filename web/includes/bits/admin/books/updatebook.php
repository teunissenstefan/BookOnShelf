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
    ':id' => $_GET['id']
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
$numberOfRows = count($bookRow);
if($numberOfRows != 1){
    if(!empty($_POST)){
        $update_query = " 
            UPDATE boeken 
            SET
                title = :title,
                description = :description,
                isbn13 = :isbn13,
                auteursid = :auteursid,
                takenby = :takenby
            WHERE
                id =:id
        "; 
        $update_query_params = array( 
            ':id' => $_GET['id'],
            ':title' => strip_tags($_POST['title']),
            ':description' => strip_tags($_POST['description']),
            ':isbn13' => strip_tags($_POST['isbn13']),
            ':auteursid' => strip_tags($_POST['auteursid']),
            ':takenby' => strip_tags($_POST['takenby'])
        ); 

        try 
        { 
            $stmt = $db->prepare($update_query); 
            $stmt->execute($update_query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query (2)"); 
        } 
        header("Location: ?p=".DisplayGetVar('p'));
    }
    ?>

    <form action="?p=<?php echo DisplayGetVar('p'); ?>&action=edit&id=<?php echo $_GET['id']; ?>" method="post">
        <label for="inputID">ID</label><br />
        <input type="text" value="<?php echo $bookRow['id']; ?>" disabled><br />
        <label for="inputTitle">Titel</label><br />
        <input type="text" id="inputTitle" name="title" placeholder="<?php echo $bookRow['title']; ?>" value="<?php echo !empty($_POST['title']) ? $_POST['title'] : $bookRow['title']; ?>"><br />
        <label for="inputDescription">Beschrijving</label><br />
        <textarea type="text" id="inputDescription" name="description" rows="20" cols="50"><?php echo !empty($_POST['description']) ? $_POST['description'] : $bookRow['description']; ?></textarea><br />
        <label for="inputISBN">ISBN13</label><br />
        <input type="text" id="inputISBN" name="isbn13" placeholder="<?php echo $bookRow['isbn13']; ?>" value="<?php echo !empty($_POST['isbn13']) ? $_POST['isbn13'] : $bookRow['isbn13']; ?>"><br />
        <label for="inputAuthor">Auteur</label><br />
        <?php 
            $getAuthorFromList = $bookRow['auteursid'];
            include "includes/bits/admin/authorlist.php";
        ?><br />
        <label for="inputTaken">Uitgeleend</label><br />
        <input type="text" id="inputTaken" name="takenby" placeholder="<?php echo $bookRow['takenby']; ?>" value="<?php echo !empty($_POST['takenby']) ? $_POST['takenby'] : $bookRow['takenby']; ?>"><br />
        <button type="submit" onclick="return GetAuthor();" class="add">Aanpassingen opslaan</button>
        <a href='?p=<?php echo DisplayGetVar("p"); ?>' class="linkbutton edit">Annuleren</a>
    </form>

    <?php
}else{
    echo "Boek niet gevonden";
}
?>