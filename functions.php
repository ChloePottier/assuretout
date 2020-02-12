<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Assuretout - Modification suppression client</title>
</head>
<body>
    

<?php
// function listing_clients(){
//     $userBdd ='root';
//     $pass ='';
//     //Connexion à la BDD en PDO
//     try {
//         $dbh = new PDO('mysql:host=localhost;dbname=assuretout', $userBdd, $pass);
//         // print 'connexion bdd ok'; //juste pour voir si il se connecte correctement
//     } catch (PDOException $e) {
//         print "Erreur !: " . $e->getMessage() . "<br/>";
//         die();
//     }
//     //la requête
//     $sqlClients = "SELECT * FROM clients
//         INNER JOIN vehicules ON vehicules.id_client = clients.id
//         JOIN contrats ON contrats.id = vehicules.id_contrats"; 
//     $dbh->query($sqlClients);
//     $reqClients = $dbh->query($sqlClients);
//     while($reqClientsFinal=$reqClients->fetch(PDO::FETCH_ASSOC)){
//         echo $reqClientsFinal['titre_de_civilite']." ".$reqClientsFinal['nom']." ".$reqClientsFinal['prenom']." ".$reqClientsFinal['adresse']." ".$reqClientsFinal['tel']." ".$reqClientsFinal['marque']." ".$reqClientsFinal['genre']." ".$reqClientsFinal['type'];
//     };
// };
session_start ();
if(isset($_SESSION['login']) && isset($_SESSION['pwd'])){
    include('menu.php');
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
    if(isset($_GET['modif_client'])){
        $modifClient = $_GET['modif_client'];
        $sqlModif = "SELECT * FROM clients
        INNER JOIN vehicules ON vehicules.id_client = clients.id
        JOIN contrats ON contrats.id = vehicules.id_contrats
        WHERE clients.id=".$modifClient."";
        $reqModifClient = $dbh->query($sqlModif);
        //requete pour afficher les contrats
        $sqlContrats ="SELECT * FROM contrats";
        $reqContrats = $dbh->query($sqlContrats);
        while($resModifClient=$reqModifClient->fetch(PDO::FETCH_ASSOC)){
            echo "<form method='POST' action='#' class='form-modif-clients'>
                    <input name='civilite' type='text' value='".$resModifClient['titre_de_civilite']."'/> 
                    <input name='nom' type='text' value='".$resModifClient['nom']."'/> 
                    <input name='prenom' type='text' value='".$resModifClient['prenom']."'/> 
                    <input name='adresse' type='text' value='".$resModifClient['adresse']."'/> 
                    <input name='tel' type='text' value='".$resModifClient['tel']."'/> 
                    <input name='marque' type='text' value='".$resModifClient['marque']."'/> 
                    <input name='genre' type='text' value='".$resModifClient['genre']."'/> 
                    <select name='type'>";
                    while($resContrats=$reqContrats->fetch(PDO::FETCH_ASSOC)){
                        echo"<option value='".$resContrats['id']."'>".$resContrats['type']."</option>";
                    };
        };
        echo"</select><button type='submit' value='submit' name='modification' class='btn-modif'>Modifier</button></form>";
        if (!empty($_POST['civilite']) && !empty($_POST['nom']) && !empty($_POST['prenom'])&& !empty($_POST['adresse'])&& !empty($_POST['tel'])){
            $civilite = $_POST['civilite'];  
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];   
            $adresse = $_POST['adresse'];
            $tel = $_POST['tel']; 
            $tab = array(
                'id' => $modifClient,
                'titre_de_civilite'=>$civilite,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'adresse'=>$adresse,
                'tel'=>$tel);
            $sqlModifClient = "UPDATE clients SET titre_de_civilite='$civilite', nom = '$nom', prenom = '$prenom', adresse = '$adresse', tel = '$tel' WHERE id=".$modifClient." ";
            $reqModifClient = $dbh->prepare($sqlModifClient);
            $reqModifClient ->execute(array($sqlModifClient));
            // // si une modif est faite 
            if($sqlModifClient == true){
                header("Location: clients.php");
            } else {
                echo"Modification impossible, veuillez vérifier tous les champs";

            }
        }if(!empty($_POST['marque']) && !empty($_POST['genre'])){
            $marque = $_POST['marque'];
            $genre = $_POST['genre'];
            $tab2 = array(
                'marque' =>$marque,
                'genre'=> $genre);
            $sqlModifVehicule = "UPDATE vehicules SET marque = '$marque', genre = '$genre' WHERE id_client = $modifClient";
            $reqVehicule = $dbh->query($sqlModifVehicule);
            if($sqlModifVehicule == true){
                header("Location: clients.php");
            } else {
                echo"Modification impossible, veuillez vérifier tous les champs";
            }
        } 
        if(!empty($_POST['type'])){
            $idContrats = $_POST['type'];
            $sqlContratsClient = "UPDATE vehicules SET id_contrats = '$idContrats' WHERE id_client =".$modifClient." ";
            $reqContratsClient = $dbh->query($sqlContratsClient);
            if($sqlContratsClient == true){
                header("Location: clients.php");
            } else {
                echo"Modification impossible, veuillez vérifier tous les champs";
            }
        }
    } 
    else if(isset($_GET['suppr_client'])){
        $supprClient = $_GET['suppr_client'];
        $sqlSupprVehicule = "DELETE FROM vehicules WHERE id_client = $supprClient";
        $reqSupprVehicule = $dbh->query($sqlSupprVehicule);
        $sqlSupprClient ="DELETE FROM clients WHERE id = $supprClient";
        $reqSupprClient = $dbh->query($sqlSupprClient);
        if($sqlSupprClient == true){
            header("Location: clients.php");
        } else {
            echo"Suppression impossible";
        }
    };
};

?>
</body>
</html>