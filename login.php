<?php 
//password_hash();
//password_verify ();
//variables pour la connexion BDD
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
//variable du formulaire
$user = $_POST['user'];
$pwd = $_POST['pwd'];
//requete SQL
$sql = "SELECT 'pseudo', 'pass' FROM connection WHERE pseudo = '".$user."' AND pass = '".$pwd."'"; 
//exécute la requête SQL 
$dbh->query($sql);
//resultat de la requete
$requete = $dbh->query($sql);
//recuperation des données dans un tableau
$res = $requete->fetch(PDO::FETCH_ASSOC);
//si les champs sont ok alors rediriger vers la page home sinon retourner sur la page index.
if($res==true){
    session_start();
    $_SESSION['login'] = $user;
    $_SESSION['pwd'] = $pwd;
    header("Location: home.php");
    exit();
} else{
    header("Location: index.php");
}

//user et pwd existe alors
//déconnection de la BDD : A METTRE A LA FIN SINON IL N'EXECUTE PAS LES REQUETES !!!
$dbh = null;
?>