
<div class="menu d-flex justify-content-between">
    <nav class="d-flex ">
        <ul class="">
            <li><a href="home.php">Accueil</a></li>
            <li><a href="contrats.php">Les contrats</a></li>
            <li><a href="clients.php">Les clients</a></li>
            <li><a href="accidents.php">Les accidents</a></li>
            <li><a href="intervention_expert.php">Intervention expert</a></li>
        </ul>
    </nav>
     
 <?php if(isset($_SESSION['login']) && isset($_SESSION['pwd'])){}?>
 <!-- <form action='logout.php' method='POST'><button type='submit' value='deconnect'>déconnection</button></form></div> -->
<div class="d-flex justify-content-end padding-right-40"><a href="logout.php" class="d-flex justify-content-end align-items-center"><img src="img/logout.png" alt="déconnection" width="40px" height="40px">Déconnection</a></div>
</div>