<?php include('doctype.php')?>
    <link rel="stylesheet" href="style.css">
    <title>Assuretout - Les contrats </title>
</head>
<body>
    <?php 
session_start ();

if(isset($_SESSION['login']) && isset($_SESSION['pwd'])){
  include('menu.php');
  echo"<h1>Nos contrats</h1>";
  $userBdd ='root';
  $pass ='';
  //Connexion à la BDD en PDO
  try {
      $dbh = new PDO('mysql:host=localhost;dbname=assuretout', $userBdd, $pass);
  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage() . "<br/>";
      die();
  }
  $sql="SELECT * FROM  contrats";
  $req = $dbh->query($sql);

  echo "<table class='tableau_contrat mx-auto'>";
    echo "<th>";

    echo "<tr>";
    while ($row=$req->fetch()){    
      //var_dump($row);
      echo "<td><ul>".$row['id']."</ul></td>";
      echo "<td><ul>".$row['type']."</ul></td>";
      echo "<td><ul>".$row['tarif']." €</ul></td>"; 
      echo "<td><ul><a href=modifier_contrat.php?contratid=".$row['id']."><img src='img/editer.png' alt='modifier' width='20px' height='20px'/></a></ul></td>";
      echo "<td><ul><a href=supprimer_contrat.php?contratid=".$row['id']."><img src='img/effacer.png' alt='supprimer' width='20px' height='20px'/></a></ul></td>";
      echo "</tr>";

    }
    echo "</table>";   
    echo "<a href='ajouter_contrat.php' class=''><img src='img/ajouter.png' alt='ajouter' width='20px' height='20px'> Ajouter un contrat</a>";
  } else {
		header("Location:index.php");
	}

