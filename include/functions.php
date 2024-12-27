<?php
/**
 * Constante prédéfinie `defined('EXEC') or die('Accès direct interdit !');`
 * qui est vérifié dans les fichiers inclus pour empêcher l'accès direct
 */
defined('API_EXEC') or die(http_response_code(500));


/**
 * Vérifie si un utilisateur est connecté
 *
 * @return bool True si l'utilisateur est connecté, False sinon.
 */
function is_logged_in(): bool {
    return isset($_SESSION['user_id']) && isset($_SESSION['user_role']);
}

/**
 * Retourne le nom et le prénom de la personne connectée
 *
 * @return string Nom et prénom de l'utilisateur ou "Invité".
 */
function get_logged_in_user_name(): string {
    return isset($_SESSION['user']) ? $_SESSION['user']['nom'] . ' ' . $_SESSION['user']['prenom'] : 'Invité';
}

/**
 * Vérifie l'expiration de session
 *
 * @param int $timeout Temps d'inactivité maximal en secondes (par défaut : 1800 secondes).
 */
function check_session_timeout(int $timeout = 1800): void {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
        session_unset();
        session_destroy();
        redirect('index.php?action=home');
    }
    $_SESSION['last_activity'] = time();
}

//fonction de delog
function logout() {
    session_unset(); // Détruit toutes les variables de session
    session_destroy(); // Détruit la session elle-même
    header("Location: index.php"); // Redirige vers la page d'accueil ou de login
    exit();
}
/**
 * Redirige vers une autre page
 *
 * @param string $url URL de la page cible.
 */
function redirect(string $url): void {
    header("Location: $url");
    exit();
}

/**
 * Vérifie si l'utilisateur est un administrateur
 *
 * @return bool True si l'utilisateur est administrateur, False sinon.
 */
function is_admin(): bool {
    return is_logged_in() && $_SESSION['user_role'] === 'admin';
}

/**
 * Vérifie si l'utilisateur est un utilisateur standard
 *
 * @return bool True si l'utilisateur est un utilisateur standard, False sinon.
 */
function is_user(): bool {
    return is_logged_in() && $_SESSION['user_role'] === 'user';
}

/**
 * Inclut dynamiquement des fichiers de layout
 */
function include_layout($layout) {
    $path = PATH_ROOT . 'Views/layouts/' . $layout . '.php';
    if (file_exists($path)) {
        include $path;
    } else {
        echo "Layout not found: $layout";
    }
}

?>
