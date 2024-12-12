<?php
/**
 * Tableau de bord Utilisateur
 */
session_start();

require_once '../../include/fonctions.php';
check_session_timeout();

// Vérification de la connexion et du rôle
if (!is_logged_in() || !is_user()) {
    redirect('../../public/login.php');
}
// déconnexion et retour a login.php
if (isset($_POST['logout'])) {
    session_destroy(); // Détruit la session
    redirect('../../public/login.php'); // Redirige vers la page de connexion
}


// Gestion des actions CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $pdo = get_db_connection();

        if ($_POST['action'] === 'add') {
            ajouterentreprise(
                $_SESSION['user_id'], // Utiliser le bon ID utilisateur (propriétaire)
                $_POST['nom'],
                $_POST['adresse'],
                $_POST['secteur']
            );
        } elseif ($_POST['action'] === 'edit') {
            // Vérifier que l'entreprise appartient à l'utilisateur connecté
            $stmt = $pdo->prepare("SELECT proprietaire_id FROM entreprise WHERE id = :id");
            $stmt->execute(['id' => $_POST['id']]);
            $entreprise = $stmt->fetch();

            if ($entreprise && $entreprise['proprietaire_id'] === $_SESSION['user_id']) {
                modifierentreprise($_POST['id'], $_POST['nom'], $_POST['adresse'], $_POST['secteur']);
            } else {
                // Gérer une tentative non autorisée de modifier une entreprise
                die("Erreur : Vous n'êtes pas autorisé à modifier cette entreprise.");
            }
        } elseif ($_POST['action'] === 'delete') {
            // Vérifier que l'entreprise appartient à l'utilisateur connecté
            $stmt = $pdo->prepare("SELECT proprietaire_id FROM entreprise WHERE id = :id");
            $stmt->execute(['id' => $_POST['id']]);
            $entreprise = $stmt->fetch();

            if ($entreprise && $entreprise['proprietaire_id'] === $_SESSION['user_id']) {
                supprimerentreprise($_POST['id']);
            } else {
                // Gérer une tentative non autorisée de supprimer une entreprise
                die("Erreur : Vous n'êtes pas autorisé à supprimer cette entreprise.");
            }
        }

        // Rediriger vers le tableau de bord après une action
        redirect('dashboard.php');
    }
}

// Récupération des entreprises
$entreprise = listeentreprise($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tableau de bord Utilisateur</title>
</head>
<body>
<div class="container mt-5">
    <h2>Bonjour, <?php echo htmlspecialchars($_SESSION['user_name']); ?> (Utilisateur)</h2>
    <form method="POST" class="d-inline">
        <button type="submit" name="logout" class="btn btn-danger">Se déconnecter</button>
    </form>
    <h3 class="mt-4">Mes Entreprises</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Secteur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entreprise as $entreprises): ?>
                <tr>
                    <td><?php echo $entreprises['id']; ?></td>
                    <td><?php echo htmlspecialchars($entreprises['nom']); ?></td>
                    <td><?php echo htmlspecialchars($entreprises['adresse']); ?></td>
                    <td><?php echo htmlspecialchars($entreprises['secteur']); ?></td>
                    <td>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?php echo $entreprises['id']; ?>">
                            <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                        </form>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $entreprises['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h3 class="mt-4">Ajouter une nouvelle entreprise</h3>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" required>
        </div>
        <div class="form-group">
            <label for="secteur">Secteur</label>
            <input type="text" class="form-control" id="secteur" name="secteur" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Ajouter</button>
    </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
