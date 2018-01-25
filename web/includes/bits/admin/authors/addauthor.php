<?php
if(!empty($_POST)){
    $failed = false;
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
    
    $query = " 
        SELECT 
            1 
        FROM auteurs 
        WHERE 
            firstname = :firstname AND lastname = :lastname
    "; 
    
    $query_params = array( 
        ':firstname' => $_POST['firstname'],
        ':lastname' => $_POST['lastname'] 
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
        if(!$msgEnterFirstName && !$msgEnterLastName){
            $msgAuthorExists = true;
        }else{
            $msgAuthorExists = false;
        }
        $failed = true;
    } else{
        $msgAuthorExists = false;
    }
    
    $msgFailedQuery3 = false;
    if(!$failed){
        $query = " 
            INSERT INTO auteurs ( 
                id,
                firstname, 
                lastname
            ) VALUES ( 
                :id,
                :firstName, 
                :lastName
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
            ':lastName' => strip_tags($_POST['lastname'])
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
        
        header("Location: ?p=".DisplayGetVar('p')); 
    }
}
    ?>

<?php if(!empty($_POST)){ ?>
    <?php if($msgAuthorExists){?>
        <div>Auteur bestaat al</div>
    <?php } ?>
    <?php if($msgEnterFirstName){?>
        <div>Vul een voornaam in</div>
    <?php } ?>
    <?php if($msgEnterLastName){?>
        <div>Vul een achternaam in</div>
    <?php } ?>
    <?php if($msgFailedQuery1){?>
        <div>Fout bij het toevoegen (1)</div>
    <?php } ?>
    <?php if($msgFailedQuery3){?>
        <div>Fout bij het toevoegen (3)</div>
    <?php } ?>
<?php } ?>

    <form action="?p=<?php echo DisplayGetVar('p'); ?>&action=add&id=<?php echo $_GET['id']; ?>" method="post">
        <label for="inputFirstName">Voornaam</label><br />
        <input type="text" id="inputFirstName" name="firstname" placeholder="Voornaam" value="<?php echo !empty($_POST['firstname']) ? $_POST['firstname'] : ''; ?>"><br />
        <label for="inputLastName">Achternaam</label><br />
        <input type="text" id="inputLastName" name="lastname" placeholder="Achternaam" value="<?php echo !empty($_POST['lastname']) ? $_POST['lastname'] : ''; ?>"><br />
        <button type="submit" class="add">Toevoegen</button>
        <a href='?p=<?php echo DisplayGetVar("p"); ?>' class="linkbutton edit">Annuleren</a>
    </form>