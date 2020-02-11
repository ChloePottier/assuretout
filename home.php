<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Assuretout  - accueil</title>
</head>
<body>
<?php 
// démarrer la session
session_start();
include('menu.php');
//si la session existe alors afficher la page sinon retour vers la page de connection
if(isset($_SESSION['login']) && isset($_SESSION['pwd'])){
    echo "<div >Bienvenue ".$_SESSION['login']." !</div>
";?>
        <form action='logout.php' method='POST'><button type='submit' value='deconnect'>déconnection</button></form>

<?php

} else{
    header("Location: index.php");
}
?>
</body>
</html>
