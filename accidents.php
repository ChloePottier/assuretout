<?php include('doctype.php')?>

    <title>Assuretout - Les accidents </title>
</head>
<body>
        <?php 
    session_start();
  if(isset($_SESSION['login']) && isset($_SESSION['pwd'])){
    include('menu.php');
    $userBdd ='root';
    $pass ='';
  //Connexion à la BDD en PDO
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=assuretout', $userBdd, $pass);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    $loc2="SELECT * FROM clients";
    $req2 = $dbh->query($loc2);
  ?>
    <!-- // afficher une boucle en liste en affichant -->
  <form action='' method='get'>
        <select name='client' class='select-expert mt-5'>     
          <option value='' disabled selected>--Sélectionner un client--</option>
          <?php
          while ($row=$req2->fetch()){    
          echo" <option value='".$row['id']."'>".$row['nom']." " .$row['prenom']."</option>";
          }?>
        </select>
      <button type='submit' >Sélectionner</button>
  </form>
  <?php
  if(!empty($_GET['client'])){
    $sqldommages = "SELECT * FROM clients
    INNER JOIN dommages
    ON clients.id = dommages.id_clients
    JOIN accident
    ON accident.id = dommages.id_accident
    WHERE dommages.id_clients =".$_GET['client'].""; 
    // sql_client('functions.php');
    $dbh->query($sqldommages);
    $reqDommages = $dbh->query($sqldommages);
    echo " <div class='row bold border-bottom mt-5'><div class='civilite'>Titre de civilité</div><div class='nom_client'>Nom</div><div class='prenom_client'>Prénom</div><div class='nom_client'>Type accident</div><div class='nom_client'>Responsabilité</div><div class='nom_client'>Date</div>";
    echo "</div>";
  
    while($row2=$reqDommages->fetch(PDO::FETCH_ASSOC)){
    echo "<div class='row mt-2 mb-2 border-bottom'><div class='civilite' >".$row2['titre_de_civilite']."</div><div class='nom_client' >".$row2['nom']."</div> <div class='prenom_client'>".$row2['prenom']."</div> <div class='nom_client'>".$row2['type_accident']."</div><div class='nom_client'>".$row2['responsabilite']."</div><div class='nom_client'>".$row2['date']."</div></div>";
    };
  }

}