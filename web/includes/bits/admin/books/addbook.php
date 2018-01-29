<?php
if(!empty($_POST)){
    $failed = false;
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

    if(empty($_POST['auteurs'])) 
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

    if(empty($_POST['amount'])) 
    { 
        $msgEnterAMOUNT = true;
        $failed = true;
    } else{
        $msgEnterAMOUNT = false;
    }
    
    $msgFailedQuery3 = false;
    if(!$failed){
        $query = " 
            INSERT INTO boeken ( 
                id,
                title, 
                description,
                isbn13,
                auteurs,
                amount
            ) VALUES ( 
                :id,
                :title, 
                :description,
                :isbn13,
                :auteurs,
                :amount
            ) 
        "; 
        
        $idtje = base_convert(microtime(false), 10, 36);

        $query_params = array( 
            ':id' => $idtje, 
            ':title' => strip_tags($_POST['title']), 
            ':description' => strip_tags($_POST['description']),
            ':isbn13' => strip_tags($_POST['isbn13']),
            ':auteurs' => strip_tags($auteurs),
            ':amount' => strip_tags($_POST['amount'])
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
    <?php if($msgEnterAMOUNT){?>
        <div>Vul een aantal in</div>
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
    <label for="inputAmount">Aantal</label><br />
    <input type="text" id="inputAmount" name="amount" placeholder="Aantal" value="<?php echo !empty($_POST['amount']) ? $_POST['amount'] : ''; ?>"><br />
    <label for="inputAuthor">Auteurs</label><br />
    <input type="text" id="inputAuthor" autocomplete="off" name="auteurs" placeholder="Auteurs" value="<?php echo !empty($_POST['auteurs']) ? $_POST['auteurs'] : ''; ?>"><br />
    <button type="submit" onclick="return GetAuthor();" class="add">Toevoegen</button>
    <a href='?p=<?php echo DisplayGetVar("p"); ?>' class="linkbutton edit">Annuleren</a>
</form>