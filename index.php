<?php

/**
 * @software       API Jungle
 * @company        SEB DEV
 * @copyright      Copyright (C) SEB .inc
 * @license        Licences Open Source
 * @author         Sébastien Béguin
 * @version_crm    1.0 version beta
 * @version_php    min 7.4+
 */

session_start();

/**
 * Protection contre les attaques CSRF.
 * Vérifie que la méthode HTTP est POST et que le token CSRF est valide.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['_token'])) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'CSRF token mismatch']);
        exit;
    }
}

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

/**
 * Vérifie la version minimale requise de PHP.
 * Si la version est insuffisante, arrête l'exécution avec un message explicatif.
 */
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

/**
 * Autoload : Charger les fichiers essentiels.
 * Charge les fichiers de configuration et de fonctions nécessaires au fonctionnement de l'application.
 * Arrête l'exécution si un fichier essentiel est manquant.
 */
$autoload_files = [
    __DIR__ . '/config/app.php',          // Configuration générale
    __DIR__ . '/config/database.php',    // Paramètres de la base de données
    __DIR__ . '/config/path.php',        // Définition des chemins
    __DIR__ . '/include/functions.php',  // Fonctions globales
];

foreach ($autoload_files as $file) {
    if (file_exists($file)) {
        require_once $file;
    } else {
        exit(sprintf('Critical file missing: %s', $file));
    }
}

/**
 * Vérification de l'existence des fichiers essentiels.
 * Arrête l'exécution si un fichier ou un répertoire requis est manquant.
 */
$file_function = PATH_BASE . 'include/functions.php';
if (!is_dir(dirname($file_function)) || !file_exists($file_function)) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    exit(); // EXIT_CONFIG
}

/**
 * Gestion du routage.
 * Détermine le fichier à inclure en fonction de l'action passée dans l'URL.
 * Protège contre l'accès non autorisé à des fichiers en dehors des routes définies.
 */
$url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$routes = [
    'home' => 'include/home.php',
    'login' => 'include/auth/loginform.php',
    'user' => 'include/components/user_dashboard.php',
    'admin' => 'include/components/admin_dashboard.php',
];

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS) ?: 'home';
$routeFile = $routes[$action] ?? null;

if ($routeFile) {
    $routeFile = realpath(PATH_BASE . '/' . $routeFile);
    if (strpos($routeFile, realpath(PATH_BASE)) !== 0) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Access denied']);
        exit;
    }
}

/**
 * Détection des appels API.
 * Si l'appel est une API (paramètre `api=1`), retourne un contenu JSON.
 * Si aucune route API n'est trouvée, retourne une erreur.
 */
$is_api_request = isset($_GET['api']) && $_GET['api'] == '1';

if ($is_api_request) {
    header('Content-Type: application/json');
    if ($routeFile && file_exists($routeFile)) {
        include $routeFile; // Logique API retourne du JSON
    } else {
        echo json_encode(['error' => 'Route not found']);
    }
    exit;
}

/**
 * Inclusion du composant correspondant pour les requêtes non-API.
 * Affiche une erreur si la route n'existe pas.
 */
if ($routeFile && file_exists($routeFile)) {
    include $routeFile;
} else {
    echo "<p>Page not found: {$action}</p>";
}



