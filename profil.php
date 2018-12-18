<?php
require_once ("connexion.php");

$profil = new Connexion();






if(isset($_GET["id"])){

    $return_db = $profil->selectPersonneByid($_GET["id"]);

    if($return_db){
    

    $result = intval($return_db->id); 

    }else {
        echo "NO WAY !!!!";
        die();
    }    

//$result = intval($_GET["id"]);

?>
<html lang="en">

<head>
    <link href="https://fonts.googleapis.com/css?family=Aref+Ruqaa" rel="stylesheet">
    <link rel="stylesheet" href="profil.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mini-Book</title>
</head>

<body>
    <h1>PROFIL de:</h1>

    
    <?php 
        $fiche =$profil->selectPersonneByid($result);
    
    
    ?>
    <div>
        <div>
            <p>
                <?php echo "<p class='userlist'><img class='img' src='".$fiche->URL_Photo."'>" ?>
            </p>
            <p class="NomPos">
                <?php echo $fiche->Nom." "; ?>
            </p>
            <p class="prenomPos">
                <?php echo $fiche->Prenom; ?>
            </p>    
        </div>
    
    
    
    </div>






    <div class="divTopRight">
        <br>
        <a href="Recherche.php" id="buttonDeSortir" class="buttonSize">Sortir</a>
    </div>
    <?php
        $fiche = $profil->selectPersonneById($result);
        /* foreach ($fiche as $key){ */
            
            
    ?>

   
    <div class="divTopLeft daTa">
        <div class="alignleft">
            <p><?php echo $fiche->Date_Naissance  ?></p>
        </div>
        <div class="alignright">
            <p><?php echo $fiche->Statut_couple;  ?></p>
        </div>
    </div>
    <div class="divTopLeft song">
        <div class="alignleft">
            <p>Préférences Musicales</p>
        </div>
        <div class="divTopLeft diver">
            <div class="alignleft">
                <?php
                

                $musique = $profil->selectAllMusiqueById($result);

                foreach($musique as $key){

                    echo "<p>".$key->Type."</p>";

                } 
                
                ?>
            </div>
        </div>
    </div>
    <div class="divTopLeft song">
        <div class="alignleft">
            <p>Hobbies</p>
        </div>
        <?php



        $hobi = $profil->selectAllHobbiesById($result);

            foreach($hobi as $key){

                echo "<p>".$key->Type."</p>";

            } 





        ?>
        <div class="divTopLeft diver">
            <div class="alignleft">
               
            </div>
        </div>
    </div>
       
    <div class="divTopLeft song">
        <div class="alignleft">
            <p>Il connait personnellement...</p>
        </div>
    </div>
    <?php
        $friend = $profil->selectAllPersonneFriends($result);


       /*  echo "<pre>";

            print_r($friend);

        echo "</pre>"; */


        
        foreach ($friend as $key){


            echo '<div class="divTopLeft diver">
            <div class="alignleft">
                <p><img src="'.$key->URL_Photo.'"/></p>
            </div>
            <div class="alignright">
                <p>'.$key->Nom.' &nbsp '.$key->Prenom.' &nbsp '.$key->Type.'&nbsp <a href="profil.php?id='.$key->id.'"> Voir le Profil </a></p>
            </div>
    
        </div>';
        }

    ?>
 

            

    


        
    <?php
        }else {

            echo "Not found !!!";
        }
    ?>
</body>

</html>