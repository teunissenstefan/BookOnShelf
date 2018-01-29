<?php
$gebruikerQuery = " 
    SELECT 
        *
    FROM gebruikers
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
        if(empty($_POST['password'])){
            $newPassword = $userRow['password'];
            $newSalt = $userRow['salt'];
        }else{
            $newSalt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
            $newPassword = hash('sha256', strip_tags($_POST['password']) . $newSalt); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $newPassword = hash('sha256', $newPassword . $newSalt); 
            } 
        }
        $update_query = " 
            UPDATE gebruikers 
            SET
                firstname = :firstname,
                lastname = :lastname,
                username = :username,
                email = :email,
                password = :password,
                salt = :salt,
                rank = :rank
            WHERE
                id =:id
        "; 
        $udpate_query_params = array( 
            ':id' => $_GET['id'],
            ':firstname' => strip_tags($_POST['firstname']),
            ':lastname' => strip_tags($_POST['lastname']),
            ':username' => strip_tags($_POST['username']),
            ':email' => strip_tags($_POST['email']),
            ':password' => $newPassword,
            ':salt' => $newSalt,
            ':rank' => strip_tags($_POST['rank'])
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
        <label for="inputUsername">Gebruikersnaam</label><br />
        <input type="text" id="inputUsername" name="username" placeholder="<?php echo $userRow['username']; ?>" value="<?php echo !empty($_POST['username']) ? $_POST['username'] : $userRow['username']; ?>"><br />
        <label for="inputEmail3">E-mailadres</label><br />
        <input type="email" id="inputEmail3" name="email" placeholder="<?php echo $userRow['email']; ?>" value="<?php echo !empty($_POST['email']) ? $_POST['email'] : $userRow['email']; ?>"><br />
        <label for="inputPassword">Wachtwoord (leeg laten om niet te wijzigen)</label><br />
        <input type="password" id="inputPassword" name="password" placeholder="Wachtwoord" value=""><br />
        <label for="inputRank">Rang (1=beheerder,0=standaard)</label><br />
        <input type="rank" id="inputRank" name="rank" placeholder="<?php echo $userRow['rank']; ?>" value="<?php echo !empty($_POST['rank']) ? $_POST['rank'] : $userRow['rank']; ?>"><br />
        <?php
            $uitgeleendQuery = " 
                SELECT 
                    *
                FROM uitgeleend
                WHERE
                    userid =:userid
            "; 
            $uitgeleendQuery_params = array( 
                ':userid' => $_GET['id']
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
                echo "Boeken:<br/ >";
                foreach($uitgeleendRows as $uitgeleendRow){
                    $bookQuery = " 
                        SELECT 
                            *
                        FROM boeken
                        WHERE
                            id =:bookid
                        LIMIT 1
                    "; 
                    $bookQuery_params = array( 
                        ':bookid' => $uitgeleendRow['bookid']
                    ); 
                    
                    try 
                    { 
                        $stmt = $db->prepare($bookQuery); 
                        $stmt->execute($bookQuery_params); 
                    } 
                    catch(PDOException $ex) 
                    { 
                        die("Failed to run query (4)"); 
                    } 
                    $bookRow = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo "{$bookRow['title']}<br />";
                }
            }
        ?>
        <button type="submit" class="add">Aanpassingen opslaan</button>
        <a href='?p=<?php echo DisplayGetVar("p"); ?>' class="linkbutton edit">Annuleren</a>
    </form>

    <?php
}else{
    echo "Gebruiker niet gevonden";
}
?>