<?php

/**
 * @software       API Jungle
 * @company        SEB DEV
 * @license        Licences Open Source
 * @author         Sébastien Béguin
 * @version_crm    1.0 version beta
 * @version_php    min 7.4+
 */

// Empêche l'accès direct au fichier si la constante EXEC n'est pas définie
define('API_EXEC', 1) or die('No direct access allowed');

// Configure l'encodage des caractères
ini_set('default_charset', 'UTF-8');

// Début du calcul du temps d'exécution
define('TIME_START', microtime(true));

// Configuration du fuseau horaire
if (!defined('API_DEFAULT_TIMEZONE')) {
    define('API_DEFAULT_TIMEZONE', 'Europe/Paris');
    date_default_timezone_set(API_DEFAULT_TIMEZONE);
}

// Vérifie la version minimale requise de PHP
$minPhpVersion = '7.4';
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your <strong>PHP</strong> version must be <strong>%s</strong> or higher to run this application<br><br>
        Current version: <strong>%s</strong>',
        $minPhpVersion,
        PHP_VERSION
    );
    exit($message);
}

// Autoload : Charger les fichiers essentiels
$autoload_files = [
    __DIR__ . '/config/app.php',
    __DIR__ . '/config/database.php',
    __DIR__ . '/config/path.php',
    __DIR__ . '/include/functions.php',
    __DIR__ . '/include/queries.php',
    __DIR__ . '/include/cookies.php',
];

// Vérification de la présence des fichiers essentiels
foreach ($autoload_files as $file) {
    if (file_exists($file)) {
        require_once $file;
    } else {
        exit(sprintf('Critical file missing: %s', $file));
    }
}

// Gestion du routage
$url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$routes = [
    'home' => 'views/pages/home.php',
    'login' => 'views/layouts/loginform.php',
    'logout' => 'views/layouts/loginform.php',
    'user_dashboard' => 'views/pages/user_dashboard.php',
    'admin_dashboard' => 'views/pages/admin_dashboard.php',
];

// Récupération de l'action dans l'URL
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS) ?: 'home';

// Détection des requêtes API (si nécessaire)
$is_api_request = isset($_GET['api']) && $_GET['api'] == '1';

// Inclusion directe pour les tableaux de bord
if ($url === 'admin_dashboard.php') {
    include __DIR__ . '/views/pages/admin_dashboard.php';
    exit;
}
if ($url === 'user_dashboard.php') {
    include __DIR__ . '/views/pages/user_dashboard.php';
    exit;
}

// Gestion des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'submit_login') {
    // Connexion utilisateur
    session_start();

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Email et mot de passe requis.';
        header('Location: index.php?action=login');
        exit;
    }

    $response = authenticate_user($email, $password);
    if ($response['success']) {
        // Assurez-vous que les variables de session sont définies ici
        $_SESSION['user_id'] = $response['user']['id'];
        $_SESSION['user_role'] = $response['user']['role'];
        header('Location: ' . $response['redirect']);
        exit;
    } else {
        $_SESSION['error'] = $response['error'];
        header('Location: index.php?action=login');
        exit;
    }
    // Gestion du delog
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'logout') {
    logout();
}
}


// Affichage des pages selon les routes définies
if ($routeFile = $routes[$action] ?? null) {
    if (file_exists($routeFile)) {
        include $routeFile;
    } else {
        error_log("Route not found: {$action}", 3, __DIR__ . '/logs/errors.log');
        http_response_code(404);
        include __DIR__ . '/views/pages/error_404.php';
    }
    exit;
}
