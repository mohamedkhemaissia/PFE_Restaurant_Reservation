<?php require_once("../config/database.php") ?>
<?php include("navbar.php"); ?>

<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: connexion.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réserver une table</title>
    <link rel="stylesheet" href="../public/style.css">
</head>

<body>
    <h1>Réserver une table</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $date = $_POST["date"];
        $heure = $_POST["heure"];
        $personnes = $_POST["personnes"];

        $sql="INSERT INTO reservations(nom, email,date,heure,personnes) values(?,?,?,?,?)";
        $stmt=$pdo->prepare($sql);
        if($stmt->execute([$nom,$email,$date,$heure,$personnes])){
        echo "<p style='color:green;'>Votre réservation a bien été enregistrée !</p>";

        } else 
        {
        echo "<p style='color:red;'>Erreur lors de l'enregistrement.</p>";}
        }
    ?>
    
    <form method="post" action="">
        <label>Nom :</label>
        <input type="text" name="nom" required>
        <br><br>
        <label>Email :</label>
        <input type="email" name="email" required>
        <br><br>
        <label>Date :</label>
        <input type="date" name="date" required>
        <br><br>
        <label>Heure :</label>
        <input type="time" name="heure" required>
        <br><br>
        <label>Nombre de personnes :</label>
        <input type="number" name="personnes" min="1" max="20" required>
        <br><br>
        <input type="submit" value="Réserver">
    </form>
    <br>
    <a href="index.php">Retour à l'accueil</a>
</body>

</html>