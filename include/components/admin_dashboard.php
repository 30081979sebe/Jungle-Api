<?php
/**
 * Tableau de bord Admin
 */
session_start();
require_once '../../include/fonctions.php';
check_session_timeout();

// Vérification de la connexion et du rôle
if (!is_logged_in() || !is_admin()) {
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
        if ($_POST['action'] === 'delete_user') {
            delete_user($_POST['id']);
        } elseif ($_POST['action'] === 'delete_company') {
            delete_company($_POST['id']);
        }
        redirect('dashboard.php');
    }
}
//Pagination pour la liste des utilisateurs :
/*$pages = $_GET['pages'] ?? 1;
$users = pagination("SELECT id, nom, prenom, email FROM utilisateur", [], 10, $pages);

//Pagination pour la liste des entreprises :
$companies = pagination("
    SELECT e.id AS entreprise_id, e.nom AS entreprise_nom, e.adresse, e.secteur,
           u.id AS user_id, u.nom AS user_nom, u.prenom AS user_prenom, u.email
    FROM entreprises e
    JOIN users u ON e.user_id = u.id
", [], 10, $page);*/



// Récupération des utilisateurs et entreprises
$users = get_all_users();
$entreprise = list_compagny($liste_id);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tableau de bord Admin</title>
</head>
<body>
<div class="container mt-5">
    <h2>Bonjour, <?php echo htmlspecialchars($_SESSION['user_name']); ?> (Admin)</h2>
    <form method="POST" class="d-inline">
        <button type="submit" name="logout" class="btn btn-danger">Se déconnecter</button>
    </form>

    <h3 class="mt-4">Liste des utilisateurs</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['nom']); ?></td>
                    <td><?php echo htmlspecialchars($user['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="action" value="delete_user">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3 class="mt-4">Liste des entreprises</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Secteur</th>
                <th>Utilisateur</th>
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
                        <?php echo htmlspecialchars($entreprises['user_nom'] . ' ' . $entreprises['user_prenom']); ?>
                        (<?php echo htmlspecialchars($entreprises['email']); ?>)
                    </td>
                    <td>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="action" value="supprimerentreprise">
                            <input type="hidden" name="id" value="<?php echo $company['entreprise_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
