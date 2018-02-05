<?php
$gebruikerQuery = " 
    SELECT 
        *
    FROM auteurs
    WHERE
        id =:id
    LIMIT 1
"; 
$query_params = array( 
    ':id' => $_GET['id']
); 

try 
{ 
    $stmt = $db->prepare($gebruikerQuery); 
    $stmt->execute($query_params); 
} 
catch(PDOException $ex) 
{ 
    die("Failed to run query (1)"); 
} 
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
$numberOfRows = count($userRow);
if($numberOfRows != 1){
    if(!empty($_POST)){
        $update_query = " 
            UPDATE auteurs 
            SET
                firstname = :firstname,
                lastname = :lastname
            WHERE
                id =:id
        "; 
        $udpate_query_params = array( 
            ':id' => $_GET['id'],
            ':firstname' => trim(strip_tags($_POST['firstname'])),
            ':lastname' => trim(strip_tags($_POST['lastname']))
        ); 

        try 
        { 
            $stmt = $db->prepare($update_query); 
            $stmt->execute($udpate_query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query (2)"); 
        } 
        header("Location: ?p=".DisplayGetVar('p'));
    }else{

    }
    ?>

    <form action="?p=<?php echo DisplayGetVar('p'); ?>&action=edit&id=<?php echo $_GET['id']; ?>" method="post">
        <label for="inputFirstName">ID</label><br />
        <input type="text" value="<?php echo $userRow['id']; ?>" disabled><br />
        <label for="inputFirstName">Voornaam</label><br />
        <input type="text" id="inputFirstName" name="firstname" placeholder="<?php echo $userRow['firstname']; ?>" value="<?php echo !empty($_POST['firstname']) ? $_POST['firstname'] : $userRow['firstname']; ?>"><br />
        <label for="inputLastName">Achternaam</label><br />
        <input type="text" id="inputLastName" name="lastname" placeholder="<?php echo $userRow['lastname']; ?>" value="<?php echo !empty($_POST['lastname']) ? $_POST['lastname'] : $userRow['lastname']; ?>"><br />
        <button type="submit" class="add">Aanpassingen opslaan</button>
        <a href='?p=<?php echo DisplayGetVar("p"); ?>' class="linkbutton edit">Annuleren</a>
    </form>

    <?php
}else{
    echo "Gebruiker niet gevonden";
}
?>