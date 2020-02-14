<?php include('doctype.php')?>
    <title>Assuretout - Ajouter un contrat</title>
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
   
    

    echo "<form action='' method='post'>";
    echo "<input type='text' name='type' value=''>";
    echo "<input type='text' name='tarif' value=''>";
    echo "<input type='submit' value='ajouer'>";
    echo "</form>";

if(isset($_POST['type'])){

    $ajout="INSERT INTO contrats (type, tarif) VALUES ('".$_POST['type']."' , '".$_POST['tarif']."')";
	$stmt = $dbh->prepare($ajout);
    $stmt->execute();
}
    if(isset($_POST['type'])) {
     header("Location:contrats.php");
    }
} else {
    header("Location:index.php");

}