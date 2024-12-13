<?php

/**
 * @software		API Jungle
 * @company     	SEB DEV
 * @copyright		Copyright (C) SEB .inc
 * @license     	Licences Open Source
 * @author      	Sébastien Béguin
 * @version_crm 	1.0 version beta
 * @version_php		min 7.4+
 */
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['_token'])) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'CSRF token mismatch']);
        exit;
    }
}
// Empêche l'accès direct au fichier si la constante EXEC n'est pas définie
define('API_EXEC', 1) or die('No direct access allowed');
// Configure PHP pour éviter les problèmes de caractères spéciaux
ini_set('default_charset', 'UTF-8');
// Utiliser microtime(true) pour calculer le temps d'exécution
define('TIME_START', microtime(true));
// Configure le fuseau horaire par défaut à 'Europe/Paris'
if (!defined('API_DEFAULT_TIMEZONE')) {
    define('API_DEFAULT_TIMEZONE', 'Europe/Paris');
    date_default_timezone_set(API_DEFAULT_TIMEZONE);
}
/**
 * Vérifie que la version de PHP est suffisante (7.4 ou supérieure)
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
 * Autoload : Charger les fichiers essentiels
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
 * Vérification de l'existence des fichiers essentiels
 */
$file_function = PATH_BASE .'include/functions.php';

//Indique si le nom de fichier est un répertoire et verifie qu'il existe
if (!is_dir(dirname($file_function)) || !file_exists($file_function)) {
    header('HTTP/1.1 503 Service Indisponible.', true, 503);
    //var_dump($file_function);
    exit(); // EXIT_CONFIG
}


/**
 * Gestion du routage
 */
$url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$routes = [
    'home' => 'include/home.php',
    'user' => 'include/components/user_dashboard.php',
    'login' => 'include/auth/loginform.php',
    'admin' => 'include/components/admin_dashboard.php',
];

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?: 'home'; 
$routeFile = $routes[$action] ?? null;

// Validation de la route pour éviter l'accès à des fichiers non autorisés
if ($routeFile) {
    $routeFile = realpath(PATH_BASE . '/' . $routeFile);
    if (strpos($routeFile, realpath(PATH_BASE)) !== 0) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Access denied']);
        exit;
    }
}

/**
 * Détection des appels API
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
 * Inclure le composant correspondant/Gestion dynamique du contenu
 */
if ($routeFile && file_exists($routeFile)) {
    include $routeFile; 
} else {
    echo "<p>Page not found: {$action}</p>";
}

?>


