<?php     
    $submitted_username = ''; 
    
    if($isLoggedIn) 
    { 
        header("Location: ?p=home"); 
        die("Redirecting"); 
    } 

    if(!empty($_POST)) 
    { 
        $msgFailedQuery1 = false;
        $failed = false;

        if(empty($_POST['username'])) 
        { 
            $msgEnterUsername = true;
            $failed = true;
        } else{
            $msgEnterUsername = false;
        }

        if(empty($_POST['password'])) 
        { 
            $msgEnterPassword = true;
            $failed = true;
        } else{
            $msgEnterPassword = false;
        }
        if(!$failed){
            $query = " 
                SELECT 
                    * 
                FROM gebruikers 
                WHERE 
                    (username = :username OR email = :username) 
            "; 
            
            $query_params = array( 
                ':username' => strip_tags($_POST['username']) 
            ); 
            
            try 
            { 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            { 
                die("Failed to run query (1)"); 
            } 
            
            $login_ok = false; 
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC); 
            if($row) 
            { 
                $check_password = hash('sha256', strip_tags($_POST['password']) . $row['salt']); 
                for($round = 0; $round < 65536; $round++) 
                { 
                    $check_password = hash('sha256', $check_password . $row['salt']); 
                } 
                
                if($check_password === $row['password']) 
                { 
                    $login_ok = true; 
                } 
            } 
            
            if($login_ok) 
            { 
                unset($row['salt']); 
                unset($row['password']); 
                
                $_SESSION['user'] = $row; 
                
                header("Location: ?p=home"); 
                die("Redirecting"); 
            } 
            else 
            { 
                $msgFailedQuery1 = true;
                
                $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
            } 
        }
    } 
    
?> 

<?php if(!empty($_POST)){ ?>
    <div>
        <?php if($msgEnterUsername){?>
            <div>Vul een gebruikersnaam of e-mailadres in</div>
        <?php } ?>
        <?php if($msgEnterPassword){?>
            <div>Vul een wachtwoord in</div>
        <?php } ?>
        <?php if($msgFailedQuery1){?>
            <div>Inloggen mislukt, probeer opnieuw</div>
        <?php } ?>
    </div>
<?php } ?>

<form action="?p=login" method="post">
    <div>
        <label for="inputUsername">Gebruikersnaam of e-mailadres</label>
        <div>
            <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Gebruikersnaam" value="<?php if(!empty($_POST['username'])){echo $_POST['username'];} ?>">
        </div>
    </div>
    <div>
        <label for="inputPassword">Wachtwoord</label>
        <div>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Wachtwoord" value="<?php if(!empty($_POST['password'])){echo $_POST['password'];} ?>">
        </div>
    </div>
    <div>
        <div>
            <button type="submit">Inloggen</button>
        </div>
    </div>
</form>