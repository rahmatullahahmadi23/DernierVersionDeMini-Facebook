
<?php
require("connexion.php");

$fiche  = new Connexion();
$connexion =$fiche->getConnnexion();


if(isset($_GET["Fname"])){
    $Nom            =$_GET["Fname"];
    $Prenom         =$_GET["Pnom"];
    $PURL           =$_GET["pUrl"];
    $Date_naissance =$_GET["bDate"];
    $Statut         =$_GET["Status"];





    $musique=array();
    $musique_filter = array();

    $musique[1]     = @$_GET["Rock"];
    $musique[2]     = @$_GET["Pop"];
    $musique[3]     = @$_GET["Rap"];
    $musique[6]     = @$_GET["Country"];
    $musique[7]     = @$_GET["Chill-Out"];
    $musique[8]     = @$_GET["Jazz"];
    $musique[9]     = @$_GET["Autres"];
    foreach ($musique as $key =>$value){

        if($value== "on"){
            $musique_filter[$key] = 1;
        }
    }

    

//Hobby
$hobby = array();
$hobby_filter =array();

$hobby[1] 			= @$_GET["Camping"]; 
$hobby[3]			= @$_GET["Tennis"];
$hobby[4]			= @$_GET["Golf"];
$hobby[5]			= @$_GET["Echecs"];
$hobby[6] 			= @$_GET["Velo"];
$hobby[7] 			= @$_GET["Lecture"];
$hobby[8] 			= @$_GET["Cinema"];
$hobby[9] 			= @$_GET["Autres"];

foreach($hobby as $key => $value){
    if($value == "on"){
        $hobby_filter[$key]=1;
    }
}




//Personne

$personne_get = $fiche->selectAllPersonne();

$per = array();

		foreach($personne_get as $value=>$key){

			if(@$_GET["$key->Prenom"]){
				$per["$key->id"] = @$_GET["$key->Prenom"];
			}

        }
        

           



        

    $fiche->insertPersonne($Nom,$Prenom,$PURL,$Date_naissance,$Statut);
    $personne_id = $connexion->lastInsertId();
    Status :

        foreach($per as $key =>$value){
            $fiche->relationPersonne($personne_id, $key, $value);
        }
        foreach ($musique_filter as $key => $value){
            $fiche->RelationMusique($personne_id, $key);
        }

        foreach ($hobby_filter as $key => $value){
            $fiche->RelationHobby($personne_id, $key);
        }



     
        //$hobby_filter
       header('Location: profil.php?id='.$personne_id);

}//la fin de premier if isset

?>




<!DOCTYPE html>
<html>
<head>

    <link href="https://fonts.googleapis.com/css?family=Aref+Ruqaa" rel="stylesheet">
    <link rel="stylesheet" href="inscription.css">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Annuaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>

</head>

<body>

    <a id="Retour" href="Recherche.php" class="buttonRetour">Retour</a>
 
    <h1>INSCRIPTION</h1>
    <div class="inscription">
        <form method="get" id="inscription" action="inscription.php">
            <label class="nom">Nom de Famille :</label>
            <label class="prenom">Prénom</label><br>

            <input type="text" name="Fname" id="NomDeFamille" class="input" placeholder="Inserez ici votre nom">
            
            <input type="text" name="Pnom" id="prenom" class="input" placeholder="Inserez ici votre prénom"><br>
            
            <label for="">Insertion photo</label>
            <label>Date de Naissance :</label><br>

            <input type="text" id="url" name="pUrl" class="input" placeholder="URL de Photo">
            
            <input type="date" id="date" name="bDate" class="date" min="1900-01-01" max="2500-01-01"><br><br>
            
            <div class="statut">Statut :</div><br>                
            <div class="couple">  
                <label for="celib">Célibataire <input type="radio" name="Status" id="celib" value="Celibataire"></label>            
                
                <label for="couple">En couple <input type="radio" name="Status" id="couple" value="En Couple"></label>              
                
                <label for="pasDef">Pas Défini <input type="radio" name="Status" id="pasDef" value="Pas Defini"></label><br><br>
                </div>
            <div class="musique">Préférences Musicales :</div><br>  
            <div class="couple">            
                <label for="Rock">Rock </label>       
                <input type="checkbox" name="Rock" id="Rock">
         
                <label for="Pop">Pop </label>           
                <input type="checkbox" name="Pop" id="Pop">
     
                <label for="Rap">Rap </label>         
                <input type="checkbox" name="Rap" id="Rap">
      
                <label for="Country">Country </label>
                <input type="checkbox" name="Country" id="Country">


                <label for="Chill-Out" >Chill-Out</label>
                <input type="checkbox" name="Chill-Out" id="Chill-Out">


                <label for="Jazz" >Jazz</label>
                <input type="checkbox" name="Jazz" id="Jazz">


                <label for="Autres..." >Autres...</label>
                <input type="checkbox" name="Autres" id="Autres..."><br><br>

            </div>  
            <div class="hobbies">Hobbies :</div><br>  
            <div class="couple">            
                <label for="velo"> Camping </label>
                <input type="checkbox" name="Camping" id="Camping">

                <label for="Tennis"> Tennis </label>   
                <input type="checkbox" name="Tennis" id="Tennis">
          
                <label for="Golf"> Golf </label>
                <input type="checkbox" name="Golf" id="Golf">

                <label for="Echecs"> Echecs </label>
                <input type="checkbox" name="Echecs" id="Echecs">

                <label for="Velo"> Velo </label>
                <input type="checkbox" name="Velo" id="Velo">

                <label for="Lecture"> Lecture </label>
                <input type="checkbox" name="Lecture" id="Lecture">

                <label for="Cinema"> Cinéma </label>
                <input type="checkbox" name="Cinema" id="Cinema">


                <label for="Autres..."> Autres...</label> 
                <input type="checkbox" name="Autres..." id="Autres..."><br><br>

            </div> 
            <div class="connais">Je connais...</div><br>
            <div id="ami">
            <?php
					$personne = $fiche->selectAllPersonne();
					 foreach($personne as $key){

                            echo '<p><label name="'.$key->Prenom.'">'.$key->Prenom.' '.$key->Nom.'</label>
                            <select class="select_option" name="'.$key->Prenom.'">
                            <option default></option>
                            <option>Ami</option>
                            <option>Famille</option>
                            <option>Collegue</option>

                            </select>
                            </p>';

                        } 

					//<input type="text" name="'.$key->Prenom.'">
					
                ?>
                </div>
        
            <input type="submit" value="J'ai terminé !" class="submit_buttons">
            <input type="reset" value="Reset" class="submit_buttons"><br><br>
        </form>
    </div>
    
</body>

</html>