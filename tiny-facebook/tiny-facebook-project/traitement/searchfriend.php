<?php

include("../config/fonctionhelper.php");
include "../config/bd.php";
if(!check_login()){
session_start();
}
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
 $Name = $_POST['search'];
 
//Search query.
 
$sql = "SELECT login FROM user WHERE login LIKE '%$Name%' LIMIT 5";
 
//Query execution
 
$q = $pdo->prepare($sql);

// Etape 2 : execution : 2 paramètres dans la requêtes !!
$q->execute();
$pasamis=false;
$notfound=false;
//Creating unordered list to display result.
 
 
   //Fetching result from database.
 
    $resultAjax = $q->fetch();
            
        

        //Pour chaque resulat de la recherche :
       ?>
    <ul>
        <li>



            <?php  echo $resultAjax["login"]; //Resultat de la recherche AJAX?>

            <?php

            $sql = "SELECT login FROM user u INNER JOIN friends f on f.idfriend = u.id WHERE f.iduser = ?"; //Renvoie liste des nom AMIS de la personne connecté 
            $q = $pdo->prepare($sql);
            $q->execute(array($_SESSION["id"]));
            while ($result = $q->fetch()){ 
                // pour chaque amis renvoie 
                $listeFriend[] = $result;
                }

    $array=[];
    foreach($listeFriend as $elem){
        foreach($elem as $friend){  
           $array = array_unique (array_merge ($elem, $array));
        }
    }
    
                if(in_array($resultAjax["login"],$array)){
               ?>
                <form name='form-search' class='myform' action='index.php?action=delfriendaction' method='POST'>
                    <?php
                echo "<input type='hidden' name='friendname' id='friendname' value=".$resultAjax['login']." />";
                echo "<button type='button' class='btn btn-secondary btn-sm' disabled>Déja amis</button>";
                echo "<button type='submit' class='btn btn-danger btn-sm'>Supprimer</button>";   
                ?></form>
                <?php
                }else{
                   $pasamis=true;  
                }
                
                if(!$resultAjax){
                  $notfound=true;
                 }
    
    
    if($notfound){
        $pasamis=false;  
        echo"Nous n'avons personne a ce nom désolé :(";
    } 
    
    if($pasamis && $resultAjax['login'] != $_SESSION['login']){
        
        ?>
                    <form name='form-search' class="myform" action='index.php?action=addfriendaction' method='POST'>
                        <?php
                  
        echo "<input type='hidden' class='friendname' name='friendname' value=".$resultAjax['login']." />";
          echo "<button type='submit' id='addfriend' class='btn btn-success btn-sm'>Envoyer une demande</button>";  
        ?>
                            <?php
    }
                
           
                
            
            ?>



                    </form>

        </li>



        <?php
 
}
 
 
?>

    </ul>
