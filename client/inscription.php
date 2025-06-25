<?php require_once("../config/database.php") ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Creer un compte</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../public/style.css">
</head>

<body>
  <center>  <h1>Creer un compte</h1></center>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = htmlspecialchars($_POST["email"]);
        $mot_de_passe = password_hash($_POST["mot_de_passe"],PASSWORD_DEFAULT);
        

        $sql="INSERT INTO utilisateurs(email,mot_de_passe) values(?,?)";
        $stmt=$pdo->prepare($sql);
        if($stmt->execute([$email,$mot_de_passe])){
        echo "<p style='color:green;'>Compte crée avec succes !</p>";

        } else 
        {
        echo "<p style='color:red;'>Echec de creation de compte.</p>";}
        }
    ?>
    <form method="post" action="" class="p-4 rounded shadow bg-white" style="max-width:350px;margin:auto;">
            <div class="mb-3">

        <label class="form-label">Email :</label>
        <input type="email" name="email" class="form-control" required>
    </div>
        <div class="mb-3">

        <label class="form-label">Mot de passe:</label>
        <input type="password" name="mot_de_passe"  class="form-control"  required>
    </div>
        <input type="submit" value="Créer un compte" class="btn btn-primary w-100">
    </form>
    <br>
    <a href="index.php">Retour à l'accueil</a>
</body>

</html>