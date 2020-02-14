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

        ?>
        <div class="container">
            <h1>Ajouter un type de contrat</h1>
            <!-- formulaire ajout contrat -->
            <form action='' method='post' class='form-ajout-contrat mx-auto d-flex justify-content-center'>
                <input type='text' name='type' placeholder='Nom du contrat' class=''>
                <input type='text' name='tarif' placeholder='Tarif du contrat'>
                <button type='submit' value='ajouter'>Ajouter un contrat</button>
            </form>
        </div>
        <?php

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