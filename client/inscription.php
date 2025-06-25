<?php require_once("../config/database.php") ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Creer un compte</title>
    <link rel="stylesheet" href="../public/style.css">
</head>

<body>
    <h1>Creer un compte</h1>
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
    <form method="post" action="">
        <label>Email :</label>
        <input type="email" name="email" required>
        <br><br>
        <label>Mot de passe:</label>
        <input type="password" name="mot_de_passe" required>
        <br><br>
        <input type="submit" value="Créer un compte">
    </form>
    <br>
    <a href="index.php">Retour à l'accueil</a>
</body>

</html>