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

