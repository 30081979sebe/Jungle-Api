<?php
/**
*		Constante prédéfinie `defined('EXEC') or die('Accès direct interdit !');` 
*		qui est vérifié dans les fichiers inclus pour empêcher l'accès direct 
**/
defined('API_EXEC') or die(http_response_code(500));



/**
 * Fonctions utilitaires pour le projet
 */

/**
 * Connexion à la base de données
 */
function get_db_connection() {
    static $pdo = null;

    if ($pdo === null) {
        try {
            // config.php  doit etre chargé avant d'exécuter cette fonction
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
    var_dump($pdo);
}


/**
 * Vérifie si un utilisateur est connecté
 */
function is_logged_in() {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_role']);
}
/**
 * Vérifie l'expiration de session
 */
function check_session_timeout($timeout = 1800) { // 1800 secondes = 30 minutes
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
        session_unset();
        session_destroy();
        redirect('public/login.php');
    }
    $_SESSION['last_activity'] = time();
}

/**
 * Redirige vers une autre page
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Vérifie si l'utilisateur est un administrateur
 */
function is_admin() {
    return is_logged_in() && $_SESSION['user_role'] === 'admin';
}

/**
 * Vérifie si l'utilisateur est un utilisateur standard
 */
function is_user() {
    return is_logged_in() && $_SESSION['user_role'] === 'user';
}
/**
 * Récupérer tous les utilisateurs
 */
function get_all_users() {
    $pdo = get_db_connection();
    $stmt = $pdo->query("SELECT id, nom,prenom, email FROM utilisateur");
    return $stmt->fetchAll();
}


/**
 * CRUD pour les entreprises
 */

/**
 * Lister les entreprises
 */
function list_compagny($proprietaire_id) {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare("SELECT * FROM entreprise WHERE proprietaire_id = :proprietaire_id");
    $stmt->execute(['proprietaire_id' => $proprietaire_id]);
    return $stmt->fetchAll();
}

/**
 * Ajouter une entreprise
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
 * Modifier une entreprise
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
 * Supprimer une entreprise
 */
function remove_compagny($company_id) {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare("DELETE FROM entreprise WHERE id = :id");
    return $stmt->execute(['id' => $company_id]);
}
/**
 * Inclut le home du projet
 */
function include_home() {
    include PATH_BASE . 'include/home.php';
}

/**
 * Inclut le header du projet
 */
function include_header() {
    include PATH_BASE . 'include/layouts/header.php';
}

/**
 * Inclut le footer du projet
 */
function include_footer() {
    include PATH_BASE . 'include/layouts/footer.php';
}
/**
 * Inclut le formulaire de login du projet
 */
function include_loginform() {
    include PATH_BASE . 'include/loginform.php';
}
/**
 * Inclut le admin_dasboard
 */
function include_admin_dasboard() {
    include PATH_BASE . 'include/admin_dasboard.php';
}
/**
 * Inclut le user_dasboard
 */
function include_user_dasboard() {
    include PATH_BASE . 'include/user_dasboard.php';
}

?>

