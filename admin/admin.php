<?php 
session_start();
require_once("../config/database.php");
if(!isset($_SESSION["user_id"])){
    header ("Location: ../connexion.php");
    exit;
}
$stmt = $pdo->prepare(("SELECT is_admin FROM utilisateurs where id =?"));
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt-> fetch();
if (!$user || !$user["is_admin"]) {
    header("Location: ../index.php");
    exit;
}
// Traitement du changement de statut
if (isset($_POST['commande_id'], $_POST['nouveau_statut'])) {
    $update = $pdo->prepare("UPDATE commandes SET statut = ? WHERE id = ?");
    $update->execute([$_POST['nouveau_statut'], $_POST['commande_id']]);
}

// Récupérer toutes les commandes
$commandes = $pdo->query("SELECT c.*, u.email FROM commandes c JOIN utilisateurs u ON c.user_id = u.id ORDER BY c.id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <div class="container mt-5">
    <h1>Liste des commandes</h1>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Pizza</th>
                <th>Taille</th>
                <th>Quantité</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($commandes as $commande): ?>
            <tr>
                <td><?= $commande['id'] ?></td>
                <td><?= htmlspecialchars($commande['email']) ?></td>
                <td><?= htmlspecialchars($commande['nom']) ?></td>
                <td><?= htmlspecialchars($commande['taille']) ?></td>
                <td><?= $commande['quantite'] ?></td>
                <td>
                    <span class="badge bg-info"><?= htmlspecialchars($commande['statut'] ?? 'Reçue') ?></span>
                </td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="commande_id" value="<?= $commande['id'] ?>">
                        <select name="nouveau_statut" class="form-select form-select-sm d-inline w-auto">
                            <option <?= ($commande['statut'] ?? 'Reçue') == 'Reçue' ? 'selected' : '' ?>>Reçue</option>
                            <option <?= ($commande['statut'] ?? '') == 'En cours' ? 'selected' : '' ?>>En cours</option>
                            <option <?= ($commande['statut'] ?? '') == 'Prête' ? 'selected' : '' ?>>Prête</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary">Changer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="admin.php" class="btn btn-secondary">Retour au dashboard</a>
</div>
</body>
</html>