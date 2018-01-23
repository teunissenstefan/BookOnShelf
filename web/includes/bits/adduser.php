<?php
if(!empty($_POST)){
    $failed = false;
    if(empty($_POST['username'])) 
    { 
        $msgEnterUsername = true;
        $failed = true;
    } else{
        $msgEnterUsername = false;
    }

    if(empty($_POST['rank'])){
        $rank = 0;
    }else{
        $rank = strip_tags($_POST['rank']);
    }
    
    if(empty($_POST['password'])) 
    { 
        $msgEnterPassword = true;
        $msgRetypePassword = false;
        $failed = true;
    } else{
        $msgEnterPassword = false;
    }

    if(empty($_POST['firstname'])) 
    { 
        $msgEnterFirstName = true;
        $failed = true;
    } else{
        $msgEnterFirstName = false;
    }

    if(empty($_POST['lastname'])) 
    { 
        $msgEnterLastName = true;
        $failed = true;
    } else{
        $msgEnterLastName = false;
    }
    
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    { 
        $msgInvalidEmail = true;
        $failed = true;
    } else{
        $msgInvalidEmail = false;
    }
    
    $query = " 
        SELECT 
            1 
        FROM gebruikers 
        WHERE 
            username = :username 
    "; 
    
    $query_params = array( 
        ':username' => $_POST['username'] 
    ); 
    
    try 
    { 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
        $msgFailedQuery1 = false;
    } 
    catch(PDOException $ex) 
    { 
        $msgFailedQuery1 = true;
        $failed = true;
    } 
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    
    if($row) 
    { 
        if(!$msgEnterUsername){
            $msgUsernameUsed = true;
        }else{
            $msgUsernameUsed = false;
        }
        $failed = true;
    } else{
        $msgUsernameUsed = false;
    }
    
    $query = " 
        SELECT 
            1 
        FROM gebruikers 
        WHERE 
            email = :email 
    "; 
    
    $query_params = array( 
        ':email' => $_POST['email'] 
    ); 
    
    try 
    { 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
        $msgFailedQuery2 = false;
    } 
    catch(PDOException $ex) 
    { 
        $msgFailedQuery2 = true;
        $failed = true;
    } 
    
    $row = $stmt->fetch(); 
    
    if($row) 
    { 
        if(!$msgInvalidEmail){
            $msgEmailTaken = true;
        }else{
            $msgEmailTaken = false;
        }
        $failed = true;
    } else{
        $msgEmailTaken = false;
    }
    
    $msgFailedQuery3 = false;
    if(!$failed){
        $query = " 
            INSERT INTO gebruikers ( 
                id,
                firstname, 
                lastname, 
                username, 
                password, 
                salt, 
                email,
                rank
            ) VALUES ( 
                :id,
                :firstName, 
                :lastName, 
                :username, 
                :password, 
                :salt, 
                :email,
                :rank
            ) 
        "; 
        
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        
        $password = hash('sha256', strip_tags($_POST['password']) . $salt); 
        
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
        
        $idtje = base_convert(microtime(false), 10, 36);

        $query_params = array( 
            ':id' => $idtje, 
            ':firstName' => strip_tags($_POST['firstname']), 
            ':lastName' => strip_tags($_POST['lastname']), 
            ':username' => strip_tags($_POST['username']), 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => strip_tags($_POST['email']),
            ':rank' => $rank
        ); 
        
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            $msgFailedQuery3 = true;
            echo $ex;
        } 
        
        header("Location: ?p=manageusers"); 
    }
}
    ?>

<?php if(!empty($_POST)){ ?>
    <?php if($msgEnterUsername){?>
        <div>Vul een gebruikersnaam in</div>
    <?php } ?>
    <?php if($msgUsernameUsed){?>
        <div>Gebruikersnaam is al bezet</div>
    <?php } ?>
    <?php if($msgEnterFirstName){?>
        <div>Vul uw voornaam in</div>
    <?php } ?>
    <?php if($msgEnterLastName){?>
        <div>Vul uw achternaam in</div>
    <?php } ?>
    <?php if($msgEnterPassword){?>
        <div>Vul een wachtwoord in</div>
    <?php } ?>
    <?php if($msgEmailTaken){?>
        <div>Er bestaat al een account met het opgegeven e-mailadres</div>
    <?php } ?>
    <?php if($msgInvalidEmail){?>
        <div>Ongeldig e-mailadres</div>
    <?php } ?>
    <?php if($msgFailedQuery1){?>
        <div>Fout bij het registreren (1)</div>
    <?php } ?>
    <?php if($msgFailedQuery2){?>
        <div>Fout bij het registreren (2)</div>
    <?php } ?>
    <?php if($msgFailedQuery3){?>
        <div>Fout bij het registreren (3)</div>
    <?php } ?>
<?php } ?>

    <form action="?p=manageusers&action=add&id=<?php echo $_GET['id']; ?>" method="post">
        <label for="inputFirstName">Voornaam</label><br />
        <input type="text" id="inputFirstName" name="firstname" placeholder="Voornaam" value="<?php echo !empty($_POST['firstname']) ? $_POST['firstname'] : ''; ?>"><br />
        <label for="inputLastName">Achternaam</label><br />
        <input type="text" id="inputLastName" name="lastname" placeholder="Achternaam" value="<?php echo !empty($_POST['lastname']) ? $_POST['lastname'] : ''; ?>"><br />
        <label for="inputUsername">Gebruikersnaam</label><br />
        <input type="text" id="inputUsername" name="username" placeholder="Gebruikersnaam" value="<?php echo !empty($_POST['username']) ? $_POST['username'] : ''; ?>"><br />
        <label for="inputEmail3">E-mailadres</label><br />
        <input type="email" id="inputEmail3" name="email" placeholder="E-mailadres" value="<?php echo !empty($_POST['email']) ? $_POST['email'] : ''; ?>"><br />
        <label for="inputPassword">Wachtwoord</label><br />
        <input type="password" id="inputPassword" name="password" placeholder="Wachtwoord" value=""><br />
        <label for="inputRank">Rang (1=beheerder,0=standaard)</label><br />
        <input type="rank" id="inputRank" name="rank" placeholder="0" value="0"><br />
        <button type="submit" class="add">Toevoegen</button>
        <a href='?p=manageusers' class="linkbutton edit">Annuleren</a>
    </form>