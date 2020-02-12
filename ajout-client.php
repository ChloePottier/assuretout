<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Assuretout - Listing des clients </title>
</head>
<body>
    <?php 
session_start ();
    
    if(isset($_SESSION['login']) && isset($_SESSION['pwd'])){
        include('menu.php');
        // require('functions.php');
        // listing_clients();
        $userBdd ='root';
        $pass ='';
        //Connexion à la BDD en PDO
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=assuretout', $userBdd, $pass);
            // print 'connexion bdd ok'; //juste pour voir si il se connecte correctement
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        $sqlContrats ="SELECT * FROM contrats";
        $reqContrats = $dbh->query($sqlContrats);
        if(isset($_POST['ajouter-client'])){
            $civilite = $_POST['civilite'];  
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];   
            $adresse = $_POST['adresse'];
            $tel = $_POST['tel']; 
            $immatriculation = $_POST['immatriculation'];
            $marque = $_POST['marque'];
            $genre = $_POST['genre'];
            $places = $_POST['nb-places'];
            $date1ereImmat = $_POST['date-1ere-immat'];
            $idContrats = $_POST['type'];
            $tab = array(
                'id' => '',
                'titre_de_civilite'=>$civilite,
                'nom' => $nom,
                'prenom'=> $prenom,
                'adresse'=> $adresse,
                'tel'=> $tel );
            $sqlAjoutClient ="INSERT INTO clients VALUES(:id, :titre_de_civilite, :nom, :prenom, :adresse, :tel)";
            $reqAjoutClient = $dbh->prepare($sqlAjoutClient);
            $reqAjoutClient ->execute($tab);
            $tab2 = array(
                'plaques_immatriculation' => $immatriculation,
                'id_client'=> '', //il doit prendre l'id créé avec le client, donc il faudrait créer un 2eme formulaire
                'marque'=> $marque,
                'genre' => $genre,
                'nombre_de_places' => $places,
                'date_premiere_immatriculation'=> $date1ereImmat,
                'id_contrats' => $idContrats);
            $sqlAjoutVehicule ="INSERT INTO vehicules VALUES(:plaques_immatriculation, :id_client, :marque, :genre, :nombre_de_places, :date_premiere_immatriculation, :id_contrats)";
            $reqAjoutVehicule = $dbh->prepare($sqlAjoutVehicule);
            $reqAjoutVehicule ->execute($tab2);
            if($reqAjoutVehicule == true ){
                // header("Location: index.php"); 
                echo "ca marche";
                var_dump( $reqAjoutVehicule);
                var_dump($reqAjoutClient);
            } else {
                echo "Ajout impossible";
            }

        } 
          ?>  
        <form method='POST' action='#' class='form-ajout-clients'>
                    <input name='civilite' type='text' placeholder='Civilité'/> 
                    <input name='nom' type='text' placeholder='Nom' /> 
                    <input name='prenom' type='text' placeholder='Prénom' /> 
                    <input name='adresse' type='text' placeholder='Adresse' /> 
                    <input name='tel' type='text' placeholder='Téléphone' /> 
                    <input name='immatriculation' type='text' placeholder="Plaque d'immatriculation" /> 
                    <input name='marque' type='text' placeholder='Marque de la voiture' /> 
                    <input name='genre' type='text' placeholder='Genre' /> 
                    <input name='nb-places' type='number' placeholder='Nombre de places' /> 
                    <label for="date-1ere-immat">Date de la première immatriculation</label>
                    <input name='date-1ere-immat' type='date' /> 

                    <select name='type'>
                        <option value=''>--contrats--</option><?php
                        while($resContrats=$reqContrats->fetch(PDO::FETCH_ASSOC)){
                            echo"<option value='".$resContrats['id']."'>".$resContrats['type']."</option>";
                        };?>
        
                    </select>
                    <button type='submit' value='submit' name='ajouter-client' class='btn-modif'>Ajouter client</button></form>
                    

<?php



    }
?>
</body>
</html>