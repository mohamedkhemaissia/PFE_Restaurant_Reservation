<?php require_once("../config/database.php") ?>
<?php include("navbar.php"); ?>
<?php 
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: connexion.php");
    exit;
}?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Commander des pizzas</title>
    <link rel="stylesheet" href="../public/style.css">
</head>

<body>
    <h1>Commander une pizza</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = htmlspecialchars($_POST["nom"]);
        $taille = htmlspecialchars($_POST["taille"]);
        $quantite = (int)$_POST["quantite"];
         $user_id = $_SESSION["user_id"]; 

        $sql = "INSERT INTO commandes(nom, taille,quantite,user_id) values(?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nom, $taille, $quantite, $user_id])) {
            echo "<p style='color:green;'>Votre commande a bien été enregistrée !</p>";
        } else {
            echo "<p style='color:red;'>Erreur lors de l'enregistrement.</p>";
        }
    }
    ?>

    <form method="post" action="">
        <label>Pizza :</label>
        <select name="nom" required>
            <option value="Margherita">Margherita</option>
            <option value="Reine">Reine</option>
            <option value="4 Fromages">4 Fromages</option>
       </select>
        <br><br>
        <label>Quantité :</label>
        <input type="number" name="quantite" min="1" value="1" required>
        <br><br>
                   <label>Taille :</label>

          <select name="taille" required>
            <option value="petite">petite</option>
            <option value="moyenne">moyenne</option>
            <option value="grande">grande</option>
       </select>

        <input type="submit" value="Commander">
    </form>
    <br>
    <a href="index.php">Retour à l'accueil</a>
</body>

</html>