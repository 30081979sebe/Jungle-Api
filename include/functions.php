<?php
/**
 * Constante prédéfinie `defined('EXEC') or die('Accès direct interdit !');`
 * qui est vérifié dans les fichiers inclus pour empêcher l'accès direct
 */
defined('API_EXEC') or die(http_response_code(500));

/**
 * Connexion à la base de données
 *
 * @return PDO Instance PDO connectée à la base de données.
 */
function get_db_connection() {
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
            die('Erreur : ' . $e->getMessage());
        }
    }
    return $pdo;
}

/**
 * Vérifie si un utilisateur est connecté
 *
 * @return bool True si l'utilisateur est connecté, False sinon.
 */
function is_logged_in() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_role']);
}

/**
 * Vérifie l'expiration de session
 *
 * @param int $timeout Temps d'inactivité maximal en secondes (par défaut : 1800 secondes).
 */
function check_session_timeout($timeout = 1800) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
        session_unset();
        session_destroy();
        redirect('include/home.php');
    }
    $_SESSION['last_activity'] = time();
}

/**
 * Redirige vers une autre page
 *
 * @param string $url URL de la page cible.
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Vérifie si l'utilisateur est un administrateur
 *
 * @return bool True si l'utilisateur est administrateur, False sinon.
 */
function is_admin() {
    return is_logged_in() && $_SESSION['user_role'] === 'admin';
}

/**
 * Vérifie si l'utilisateur est un utilisateur standard
 *
 * @return bool True si l'utilisateur est un utilisateur standard, False sinon.
 */
function is_user() {
    return is_logged_in() && $_SESSION['user_role'] === 'user';
}

/**
 * Récupère tous les utilisateurs
 *
 * @return array Tableau contenant les utilisateurs.
 */
function get_all_users() {
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
function list_compagny($proprietaire_id) {
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
function add_compagny($proprietaire_id, $nom, $adresse, $secteur) {
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
function update_compagny($company_id, $nom, $adresse, $secteur) {
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
function remove_compagny($company_id) {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare("DELETE FROM entreprise WHERE id = :id");
    return $stmt->execute(['id' => $company_id]);
}

/**
 * Inclut le fichier du projet à la maison
 */
function include_home() {
    include PATH_BASE . 'include/home.php';
}

/**
 * Inclut le fichier header
 */
function include_header() {
    include PATH_BASE . 'include/layouts/header.php';
}

/**
 * Inclut le fichier header du tableau de bord
 */
function include_headerdashboard(){
    include PATH_BASE.'include/layouts/headerdashboard';
}

/**
 * Inclut le fichier footer
 */
function include_footer() {
    include PATH_BASE . 'include/layouts/footer.php';
}

/**
 * Inclut le fichier card
 */
function include_card() {
    include PATH_BASE . 'include/layouts/card.php';
}

/**
 * Inclut le formulaire de connexion
 */
function include_loginform() {
    include PATH_BASE . 'include/loginform.php';
}

/**
 * Inclut le tableau de bord admin
 */
function include_admin_dasboard() {
    include PATH_BASE . 'include/admin_dasboard.php';
}

/**
 * Inclut le tableau de bord utilisateur
 */
function include_user_dasboard() {
    include PATH_BASE . 'include/user_dasboard.php';
}

?>
