<?php
session_start();
?>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">LOGO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                <a class="nav-link" href="commande.php">Commander</a>
                <a class="nav-link" href="reservation.php">Réserver</a>
                <?php if (isset($_SESSION["user_id"])): ?>
                    <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                <?php else: ?>
                    <a class="nav-link" href="connexion.php">connexion</a>
                    <a class="nav-link" href="inscription.php">inscription</a>
                <?php endif; ?>





            </div>
        </div>
    </div>
</nav>