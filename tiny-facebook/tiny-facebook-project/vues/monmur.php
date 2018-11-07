<div class="container">
    <div class="dim" id="dim"></div>
    <div class="col-md-6">
        <fieldset>
            <legend>
                <h1>Mon mur</h1>
            </legend>

            <?php
$sql = "SELECT * FROM user WHERE id=?";

// Etape 1  : preparation
$q = $pdo->prepare($sql);

// Etape 2 : execution : 2 paramètres dans la requêtes !!
$q->execute(array($_SESSION['id']));

// Etape 3 : ici le login est unique, donc on sait que l'on peut avoir zero ou une  seule ligne.
$line = $q->fetch();
?>



                <div class="image-upload">
                    <label for="file-input"><?php
                   if($line['avatar'] != null){
    echo ("<img id='imgpp' src='uploads/".$line['avatar']."'/>");
}else{
    echo ("<p>Vous n'avez pas de photo pour l'instant</p>");
}

?>
                    <div class="overlay">
                <p id="modifyprofilepic">Modifier</p>


</div>
                        </label>
                </div>
                <form enctype="multipart/form-data" role="form" action="index.php?action=upload" method="POST">

                    <input type="file" name="fileToUpload" id="file-input" />
                    <input type="submit" name="sub" id="submit" class="btn btn-success btn-lg" value="Envoyer" />
                </form>


                <p>Mes amis:</p>
                <ul id="friendlist">

                </ul>
                <button class="btn btn-primary toggle">Ajouter des amis</button>
                <div class="search-box" id="target">
                    <main>
                        <form role="form" autocomplete="off">

                            <input type="text" class="search" placeholder="Recherchez un amis" size="30" id="search" />
                        </form>
                        <div id="display"></div>


                    </main>
                </div>
        </fieldset>

    </div>
</div>
