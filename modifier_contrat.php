<?php include('doctype.php')?>
    <title>Assuretout - modifier un contrat</title>
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

$sql="SELECT * FROM contrats WHERE id=".$_GET['contratid']." ";
$req = $dbh->query($sql);

echo "<form action='' method='post'>";
while ($row=$req->fetch()){

	echo $row['id']." <input type='text' name ='nomducontrat' value=' ".$row['type']."'>";
	echo $row['id']." <input type='text' name ='prixducontrat' value=' ".$row['tarif']."'>";
	
}
echo "<button type='submit' value='modifier'>Modifier</button>";

echo "</form>";


if(isset($_POST['nomducontrat'])){
    $update="UPDATE contrats SET type='".$_POST['nomducontrat']." ' WHERE id=".$_GET['contratid']." ";   
	$stmt = $dbh->prepare($update);
	$stmt->execute();

}
if(isset($_POST['prixducontrat'])){
    $update="UPDATE contrats SET tarif='".$_POST['prixducontrat']." ' WHERE id=".$_GET['contratid']." ";   
	$stmt = $dbh->prepare($update);
	$stmt->execute();

}
if( isset($_POST['prixducontrat'])) {
header("Location:contrats.php");
}
} else {
	header("Location:index.php");

}

