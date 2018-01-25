<?php
if(!empty($_POST)){
    $failed = false;
    if(empty($_POST['title'])) 
    { 
        $msgEnterTitle = true;
        $failed = true;
    } else{
        $msgEnterTitle = false;
    }

    if(empty($_POST['description'])) 
    { 
        $msgEnterDescr = true;
        $failed = true;
    } else{
        $msgEnterDescr = false;
    }

    if(empty($_POST['auteursid'])) 
    { 
        $msgEnterAuthor = true;
        $failed = true;
    } else{
        $msgEnterAuthor = false;
    }

    if(empty($_POST['isbn13'])) 
    { 
        $msgEnterISBN = true;
        $failed = true;
    } else{
        $msgEnterISBN = false;
    }
    
    $msgFailedQuery3 = false;
    if(!$failed){
        $query = " 
            INSERT INTO boeken ( 
                id,
                title, 
                description,
                isbn13,
                auteursid
            ) VALUES ( 
                :id,
                :title, 
                :description,
                :isbn13,
                :auteursid
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
            ':title' => strip_tags($_POST['title']), 
            ':description' => strip_tags($_POST['description']),
            ':isbn13' => strip_tags($_POST['isbn13']),
            ':auteursid' => strip_tags($_POST['auteursid'])
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
    <?php if($msgEnterTitle){?>
        <div>Vul een titel in</div>
    <?php } ?>
    <?php if($msgEnterDescr){?>
        <div>Vul een beschrijving in</div>
    <?php } ?>
    <?php if($msgEnterISBN){?>
        <div>Vul een ISBN13 nummer in</div>
    <?php } ?>
    <?php if($msgEnterAuthor){?>
        <div>Vul een auteur in</div>
    <?php } ?>
    <?php if($msgFailedQuery3){?>
        <div>Fout bij het toevoegen (3)</div>
    <?php } ?>
<?php } ?>

<form action="?p=<?php echo DisplayGetVar('p'); ?>&action=add&id=<?php echo $_GET['id']; ?>" method="post">
    <label for="inputTitle">Titel</label><br />
    <input type="text" id="inputTitle" name="title" placeholder="Titel" value="<?php echo !empty($_POST['title']) ? $_POST['title'] : ''; ?>"><br />
    <label for="inputDescription">Beschrijving</label><br />
    <textarea type="text" id="inputDescription" name="description" rows="20" cols="50" placeholder="Beschrijving"><?php echo !empty($_POST['description']) ? $_POST['description'] : ''; ?></textarea><br />
    <label for="inputISBN">ISBN13</label><br />
    <input type="text" id="inputISBN" name="isbn13" placeholder="ISBN13" value="<?php echo !empty($_POST['isbn13']) ? $_POST['isbn13'] : ''; ?>"><br />
    <label for="inputAuthor">Auteur</label><br />
    Auteurs uit DB krijgen en in DATALIST stoppen
    <input type="text" id="inputAuthor" autocomplete="off" name="auteursid" placeholder="Auteur" list="auteurLijst" value="<?php echo !empty($_POST['auteursid']) ? $_POST['auteursid'] : ''; ?>">
    <datalist id="auteurLijst">
        <option data-value="jansmit" value="Jan Smit">
        <option data-value="pieterpost" value="Pieter Post">
    </datalist><br />
    <label for="inputTaken">Uitgeleend</label><br />
    <input type="text" id="inputTaken" name="takenby" placeholder="Uitgeleend" value="<?php echo !empty($_POST['takenby']) ? $_POST['takenby'] : ''; ?>"><br />
    <button type="submit" onclick="return GetAuthor();" class="add">Toevoegen</button>
    <a href='?p=<?php echo DisplayGetVar("p"); ?>' class="linkbutton edit">Annuleren</a>
</form>