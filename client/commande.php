<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commander des plats</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
    <h1>Commander des plats</h1>
    <form method="post" action="">
        <label>Plat :</label>
        <select name="plat">
            <option value="pizza">Pizza</option>
            <option value="pasta">Pâtes</option>
            <option value="salad">Salade</option>
        </select>
        <br><br>
        <label>Quantité :</label>
        <input type="number" name="quantite" min="1" value="1">
        <br><br>
        <input type="submit" value="Commander">
    </form>
    <br>
    <a href="index.php">Retour à l'accueil</a>
</body>
</html>