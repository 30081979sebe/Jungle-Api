<?php

/**
 * Recherche un utilisateur dans la table admin par email.
 *
 * @param string $email L'email de l'utilisateur.
 * @return array|null Les données de l'utilisateur ou null si introuvable.
 */
function get_admin_by_email(string $email): ?array {
    $pdo = get_db_connection();
    $query = $pdo->prepare("SELECT * FROM admin WHERE email = :email");
    $query->execute(['email' => $email]);
    return $query->fetch() ?: null;
}

/**
 * Recherche un utilisateur dans la table utilisateur par email.
 *
 * @param string $email L'email de l'utilisateur.
 * @return array|null Les données de l'utilisateur ou null si introuvable.
 */
function get_user_by_email(string $email): ?array {
    $pdo = get_db_connection();
    $query = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
    $query->execute(['email' => $email]);
    return $query->fetch() ?: null;
}

/**
 * Authentifie un utilisateur en fonction de l'email et du mot de passe.
 *
 * @param string $email L'email de l'utilisateur.
 * @param string $password Le mot de passe de l'utilisateur.
 * @return array Un tableau contenant le statut de la connexion et les données utilisateur si réussie.
 */
function authenticate_user(string $email, string $password): array {
    $response = ['success' => false, 'error' => null, 'user' => null, 'redirect' => null];

    try {
        // Vérification dans la table admin
        $admin = get_admin_by_email($email);
        if ($admin && md5($password) === $admin['mot_de_passe']) {
            $response['success'] = true;
            $response['user'] = ['id' => $admin['id'], 'role' => 'admin'];
            $response['redirect'] = 'admin_dashboard.php';
            return $response;
        }

        // Vérification dans la table utilisateur
        $user = get_user_by_email($email);
        if ($user && md5($password) === $user['mot_de_passe']) {
            $response['success'] = true;
            $response['user'] = ['id' => $user['id'], 'role' => 'user'];
            $response['redirect'] = 'user_dashboard.php';
            return $response;
        }

        $response['error'] = 'Email ou mot de passe incorrect.';
    } catch (PDOException $e) {
        error_log("Database connection error: " . $e->getMessage(), 3, __DIR__ . '/../logs/errors.log');
        $response['error'] = 'Erreur de connexion. Réessayez plus tard.';
    }

    return $response;
}

/**
 * Retourne une connexion PDO à la base de données.
 *
 * @return PDO L'objet PDO connecté.
 */
function get_db_connection(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        try {
            $pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
                DB_USER,
                DB_PASS
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException('Erreur : ' . $e->getMessage());
        }
    }
    return $pdo;
}

/**
 * Récupère tous les utilisateurs
 *
 * @return array Tableau contenant les utilisateurs.
 */
function get_all_users(): array {
    $pdo = get_db_connection();
    $stmt = $pdo->query("SELECT id, nom, prenom, email FROM utilisateur");
    return $stmt->fetchAll();
}

/**
 * Liste les entreprises appartenant à un propriétaire
 *
 * @param int $proprietaire_id ID du propriétaire.
 * @return array Tableau contenant les entreprises.
 */
function list_compagny(int $proprietaire_id): array {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare("SELECT * FROM entreprise WHERE proprietaire_id = :proprietaire_id");
    $stmt->execute(['proprietaire_id' => $proprietaire_id]);
    return $stmt->fetchAll();
}

/**
 * Ajoute une entreprise
 *
 * @param int $proprietaire_id ID du propriétaire.
 * @param string $nom Nom de l'entreprise.
 * @param string $adresse Adresse de l'entreprise.
 * @param string $secteur Secteur d'activité.
 * @return bool True si l'ajout réussit, False sinon.
 */
function add_compagny(int $proprietaire_id, string $nom, string $adresse, string $secteur): bool {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare("INSERT INTO entreprise (proprietaire_id, nom, adresse, secteur) VALUES (:proprietaire_id, :nom, :adresse, :secteur)");
    return $stmt->execute([
        'proprietaire_id' => $proprietaire_id,
        'nom' => $nom,
        'adresse' => $adresse,
        'secteur' => $secteur,
    ]);
}

/**
 * Met à jour une entreprise
 *
 * @param int $company_id ID de l'entreprise.
 * @param string $nom Nom de l'entreprise.
 * @param string $adresse Adresse de l'entreprise.
 * @param string $secteur Secteur d'activité.
 * @return bool True si la mise à jour réussit, False sinon.
 */
function update_compagny(int $company_id, string $nom, string $adresse, string $secteur): bool {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare("UPDATE entreprise SET nom = :nom, adresse = :adresse, secteur = :secteur WHERE id = :id");
    return $stmt->execute([
        'id' => $company_id,
        'nom' => $nom,
        'adresse' => $adresse,
        'secteur' => $secteur,
    ]);
}

/**
 * Supprime une entreprise
 *
 * @param int $company_id ID de l'entreprise.
 * @return bool True si la suppression réussit, False sinon.
 */
function remove_compagny(int $company_id): bool {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare("DELETE FROM entreprise WHERE id = :id");
    return $stmt->execute(['id' => $company_id]);
}

?>
