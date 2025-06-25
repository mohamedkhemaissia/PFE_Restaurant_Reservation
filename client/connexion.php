
<?php require_once("../config/database.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
    <h1>Connexion</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = htmlspecialchars($_POST["email"]);
        $mot_de_passe = $_POST["mot_de_passe"];

        // On va chercher l'utilisateur dans la base
        $sql = "SELECT * FROM utilisateurs WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Vérification du mot de passe
        if ($user && password_verify($mot_de_passe, $user["mot_de_passe"])) {
            session_start();
            $_SESSION["user_id"] = $user["id"];
            echo "<p style='color:green;'>Connexion réussie !</p>";
            header("Location: index.php");
            exit;
        } else {
            echo "<p style='color:red;'>Email ou mot de passe incorrect.</p>";
        }
    }
    ?>
    <form method="post" action="">
        <label>Email :</label>
        <input type="email" name="email" required>
        <br><br>
        <label>Mot de passe :</label>
        <input type="password" name="mot_de_passe" required>
        <br><br>
        <input type="submit" value="Se connecter">
    </form>
    <br>
    <a href="index.php">Retour à l'accueil</a>
</body>
</html>