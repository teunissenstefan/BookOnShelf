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

    $auteurListQuery = " 
        SELECT * FROM auteurs
        WHERE
            id = :id
    ";
    $auteurQuery_params = array( 
        ':id' => strip_tags($_POST['auteursid'])
    );

    try 
    {
        $stmt = $db->prepare($auteurListQuery); 
        $stmt->execute($auteurQuery_params);
    } 
    catch(PDOException $ex) 
    { 
        die("Failed to run query (2)");
    }
    $authorRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if($authorRow){
        $msgAuthorNotFound = false;
    }else{
        $msgAuthorNotFound = true;
        $failed = true;
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
    <?php if($msgAuthorNotFound){?>
        <div>Auteur niet gevonden</div>
    <?php } ?>
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
    <?php include "includes/bits/admin/authorlist.php"; ?><br />
    <button type="submit" onclick="return GetAuthor();" class="add">Toevoegen</button>
    <a href='?p=<?php echo DisplayGetVar("p"); ?>' class="linkbutton edit">Annuleren</a>
</form>