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
        $auteursString = explode(",",$_POST['auteurs']);
        $auteurs = "";
        foreach($auteursString as $auteurString){
            if(!empty($auteurString)){
                $auteurString = explode(" ",$auteurString);
                $geschrevenQuery = " 
                    SELECT 
                        *
                    FROM auteurs
                    WHERE
                        firstname =:firstname AND lastname =:lastname
                "; 
                $geschrevenQuery_params = array( 
                    ':firstname' => $auteurString[0],
                    ':lastname' => $auteurString[1]
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
                $auteurs.= $geschrevenRow['id'].",";
            }
        }


        $update_query = " 
            UPDATE boeken 
            SET
                title = :title,
                description = :description,
                isbn13 = :isbn13,
                auteurs = :auteurs,
                amount = :amount
            WHERE
                id =:id
        ";
        $update_query_params = array( 
            ':id' => $_GET['id'],
            ':title' => strip_tags($_POST['title']),
            ':description' => strip_tags($_POST['description']),
            ':isbn13' => strip_tags($_POST['isbn13']),
            ':auteurs' => strip_tags($auteurs),
            ':amount' => strip_tags($_POST['amount'])
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
        <label for="inputAmount">Aantal</label><br />
        <input type="text" id="inputAmount" name="amount" placeholder="<?php echo $bookRow['amount']; ?>" value="<?php echo !empty($_POST['amount']) ? $_POST['amount'] : $bookRow['amount']; ?>"><br />
        <label for="inputAuthor">Auteurs</label><br />
        <input type="text" id="inputAuthor" autocomplete="off" name="auteurs" placeholder="<?php echo $bookRow['auteurs']; ?>" value="<?php echo !empty($_POST['auteurs']) ? $_POST['auteurs'] : $auteurs; ?>"><br />
        <?php
            $uitgeleendQuery = " 
                SELECT 
                    *
                FROM uitgeleend
                WHERE
                    bookid =:bookid
            "; 
            $uitgeleendQuery_params = array( 
                ':bookid' => $_GET['id']
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
            if(count($uitgeleendRows) > 0){
                echo "Uitgeleend:<br/ >";
                foreach($uitgeleendRows as $uitgeleendRow){
                    $userQuery = " 
                        SELECT 
                            *
                        FROM gebruikers
                        WHERE
                            id =:userid
                        LIMIT 1
                    "; 
                    $userQuery_params = array( 
                        ':userid' => $uitgeleendRow['userid']
                    ); 
                    
                    try 
                    { 
                        $stmt = $db->prepare($userQuery); 
                        $stmt->execute($userQuery_params); 
                    } 
                    catch(PDOException $ex) 
                    { 
                        die("Failed to run query (4)"); 
                    } 
                    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo "{$userRow['firstname']} {$userRow['lastname']}<br />";
                }
            }
        ?>
        <button type="submit" onclick="return GetAuthor();" class="add">Aanpassingen opslaan</button>
        <a href='?p=<?php echo DisplayGetVar("p"); ?>' class="linkbutton edit">Annuleren</a>
    </form>

    <?php
}else{
    echo "Boek niet gevonden";
}
?>