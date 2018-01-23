<?php 

    require "includes/connection.php"; 

    $query = " 
        SELECT 
            * 
        FROM gebruikers 
        WHERE 
            rank = 1 
    ";
    
    try 
    { 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    { 
        echo $ex;
    } 
    
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    //Alleen admin registreren als er nog geen zijn
    if(count($row) >= 1){
        
    }else{
        if(!empty($_POST)) 
        { 
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
                $msgRetypePassword = false;
                $failed = true;
            } else{
                $msgEnterPassword = false;
            }

            if(empty($_POST['firstName'])) 
            { 
                $msgEnterFirstName = true;
                $failed = true;
            } else{
                $msgEnterFirstName = false;
            }

            if(empty($_POST['lastName'])) 
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
            
            $row = $stmt->fetch(); 
            
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
                        1
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
                    ':firstName' => strip_tags($_POST['firstName']), 
                    ':lastName' => strip_tags($_POST['lastName']), 
                    ':username' => strip_tags($_POST['username']), 
                    ':password' => $password, 
                    ':salt' => $salt, 
                    ':email' => strip_tags($_POST['email'])
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
                
                //header("Location: ?p=login"); 
                
                //die("Redirecting to login page"); 

                //______tmp message
                if($msgFailedQuery3 == false){
                    echo "Geregistreerd";
                }
                die();
                //______tmp message
            }
        }
?>

<?php if(!empty($_POST)){ ?>
        <?php if($msgEnterUsername){?>
            <div class="panel-body">Please enter a username</div>
        <?php } ?>
        <?php if($msgUsernameUsed){?>
            <div class="panel-body">Username already taken</div>
        <?php } ?>
        <?php if($msgEnterFirstName){?>
            <div class="panel-body">Please enter your first name</div>
        <?php } ?>
        <?php if($msgEnterLastName){?>
            <div class="panel-body">Please enter your last name</div>
        <?php } ?>
        <?php if($msgEnterPassword){?>
            <div class="panel-body">Please enter a password</div>
        <?php } ?>
        <?php if($msgEmailTaken){?>
            <div class="panel-body">E-mail address already taken</div>
        <?php } ?>
        <?php if($msgInvalidEmail){?>
            <div class="panel-body">Invalid e-mail address</div>
        <?php } ?>
        <?php if($msgFailedQuery1){?>
            <div class="panel-body">Failed to register (1)</div>
        <?php } ?>
        <?php if($msgFailedQuery2){?>
            <div class="panel-body">Failed to register (2)</div>
        <?php } ?>
        <?php if($msgFailedQuery3){?>
            <div class="panel-body">Failed to register (3)</div>
        <?php } ?>
<?php } ?>

<form action="_registeradmin.php" method="post">
    <label for="inputFirstName" class="col-sm-2 col-form-label">First name</label><br />
    <input type="text" class="form-control" id="inputFirstName" name="firstName" placeholder="First name" value="<?php if(!empty($_POST['firstName'])){echo $_POST['firstName'];} ?>"><br />
    <label for="inputLastName" class="col-sm-2 col-form-label">Last name</label><br />
    <input type="text" class="form-control" id="inputLastName" name="lastName" placeholder="Last name" value="<?php if(!empty($_POST['lastName'])){echo $_POST['lastName'];} ?>"><br />
    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label><br />
    <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="<?php if(!empty($_POST['username'])){echo $_POST['username'];} ?>"><br />
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label><br />
    <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email" value="<?php if(!empty($_POST['email'])){echo $_POST['email'];} ?>"><br />
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label><br />
    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" value="<?php if(!empty($_POST['password'])){echo $_POST['password'];} ?>"><br />
    <button type="submit" class="btn btn-pawhub-primary">Registreren</button>
</form>

<?php
}
?>