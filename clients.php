<?php include('doctype.php')?>
<!DOCTYPE html>
<html lang="en">
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
        ?>
        <div class="padding-top-40"><a href="ajout-client.php"><img src="img/ajouter.png" alt="ajouter" width="20px" height="20px"> Ajouter un client ou un véhicule</a></div>
        <?php
        //la requête
        $sqlClients = "SELECT * FROM clients
            INNER JOIN vehicules ON vehicules.id_client = clients.id
            JOIN contrats ON contrats.id = vehicules.id_contrats"; 
        // sql_client('functions.php');
        $dbh->query($sqlClients);
        $reqClients = $dbh->query($sqlClients);?>
        <div class="row padding-top-40 bold border-bottom"><div class='civilite'>Civilité</div><div class='nom_client'>Nom du client</div><div class='prenom_client'>Prénom du client</div><div class='adresse'>Adresse</div><div class='tel_client'>Téléphone</div><div class='marque_vehicule'>Marque du véhicule</div><div class='genre_vehicule'>Genre du véhicule</div><div class='type_contrat'>Type de contrat</div><div class='modifier'>modifier</div><div class='supprimer'>supprimer</div></div>
        <?php while($reqClientsFinal=$reqClients->fetch(PDO::FETCH_ASSOC)){
            echo "<div class='row  border-bottom'><div class='civilite'>".$reqClientsFinal['titre_de_civilite']."</div> <div class='nom_client'>".$reqClientsFinal['nom']."</div> <div class='prenom_client'>".$reqClientsFinal['prenom']."</div> <div class='adresse'>".$reqClientsFinal['adresse']."</div> <div class='tel_client'>".$reqClientsFinal['tel']."</div> <div class='marque_vehicule'>".$reqClientsFinal['marque']."</div> <div class='genre_vehicule'>".$reqClientsFinal['genre']."</div> <div class='type_contrat'>".$reqClientsFinal['type']."</div><div class='modifier'><a href='functions.php?modif_client=".$reqClientsFinal['id_client']."'><img src='img/editer.png' alt='modifier' width='20px' height='20px'/></a></div><div class='supprimer'><a href='functions.php?suppr_client=".$reqClientsFinal['id_client']."'><img src='img/effacer.png' alt='supprimer' width='20px' height='20px'/></a></div></div>";
        };
    } else {
		header("Location:index.php");

	}
    ?>
 

    
    
    
    


</body>