<?php include('doctype.php')?>
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
	$update="DELETE FROM contrats WHERE id=".$_GET['contratid']." ";
	$stmt = $dbh->prepare($update);
	$stmt->execute();
	header("Location:contrats.php");
	
	} else {
		header("Location:index.php");

	}