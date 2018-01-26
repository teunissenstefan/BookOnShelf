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
    ':id' => $sessionId
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
        if(empty($_POST['password']) || empty($_POST['newPassword'])){
            echo "Vul alle velden in";
        }else{
            $check_password = hash('sha256', strip_tags($_POST['password']) . $userRow['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $userRow['salt']); 
            } 
            echo $check_password;
            echo "<br/>".$userRow['password'];
            if($check_password === $userRow['password']){
                $newSalt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
                $newPassword = hash('sha256', strip_tags($_POST['newPassword']) . $newSalt); 
                for($round = 0; $round < 65536; $round++) 
                { 
                    $newPassword = hash('sha256', $newPassword . $newSalt); 
                } 
                $update_query = " 
                    UPDATE gebruikers 
                    SET
                        password = :password,
                        salt = :salt
                    WHERE
                        id =:id
                "; 
                $udpate_query_params = array( 
                    ':id' => $sessionId,
                    ':password' => $newPassword,
                    ':salt' => $newSalt
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
                header("Location: ?p=logout");
            }else{
                echo "Het oude wachtwoord klopt niet";
            }
        }
    }else{

    }
    ?>

    <form action="?p=<?php echo DisplayGetVar('p'); ?>" method="post">
        <label for="inputPassword">Oude wachtwoord</label><br />
        <input type="password" id="inputPassword" name="password" placeholder="Oud wachtwoord" value=""><br />
        <label for="inputNewPassword">Nieuw wachtwoord</label><br />
        <input type="password" id="inputNewPassword" name="newPassword" placeholder="Nieuw wachtwoord" value=""><br />
        <button type="submit" class="add">Wachtwoord wijzigen</button>
        <a href='?p=home' class="linkbutton edit">Annuleren</a>
    </form>

    <?php
}else{
    echo "Gebruiker niet gevonden";
}
?>