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
    __DIR__ . '/config/app.php',          // Configuration générale
    __DIR__ . '/config/database.php',    // Paramètres de la base de données
    __DIR__ . '/config/path.php',        // Définition des chemins
    __DIR__ . '/include/functions.php',  // Fonctions globales
    __DIR__ . '/include/queries.php',    // Requêtes centralisées
    __DIR__ . '/include/cookies.php',    // Gestion des cookies
];
//verification de la presence des fichiers essentiels
foreach ($autoload_files as $file) {
    if (file_exists($file)) {
        require_once $file;
    } else {
        exit(sprintf('Critical file missing: %s', $file));
    }
}

// Vérification de l'existence des fichiers essentiels
$file_function = PATH_BASE . 'include/functions.php';
if (!is_dir(dirname($file_function)) || !file_exists($file_function)) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    exit(); // EXIT_CONFIG
}

// Gestion du routage
$url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$routes = [
    'home' => 'views/pages/home.php',
    'login' => 'views/layouts/loginform.php',
    'user_dashboard' => 'views/pages/user_dashboard.php',
    'admin_dashboard' => 'views/pages/admin_dashboard.php',
];

// Récupération de l'action dans l'URL
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS) ?: 'home';
$is_api_request = isset($_GET['api']) && $_GET['api'] == '1'; // Initialisation

if ($routeFile = $routes[$action] ?? null) {
    $routeFile = realpath(PATH_BASE . '/' . $routeFile);

    if (strpos($routeFile, realpath(PATH_BASE)) !== 0) {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Access denied']);
        exit;
    }
}

// Vérification de la connexion à la BDD
if ($action === 'check_connection' && $is_api_request) {
    header('Content-Type: application/json');
    try {
        $pdo = get_db_connection(); // Vérifie si la connexion est possible
        echo json_encode(['success' => true, 'message' => 'Connexion réussie à la base de données.']);
    } catch (PDOException $e) {
        error_log("Database connection error: " . $e->getMessage(), 3, __DIR__ . '/logs/errors.log');
        echo json_encode(['success' => false, 'message' => 'Échec de la connexion à la base de données.']);
    }
    exit;
}
//suppression des cookies
if ($action === 'clear_cookies' && $is_api_request) {
    header('Content-Type: application/json');
    try {
        clear_all_cookies(); // Fonction définie dans cookies.php
        echo json_encode(['success' => true, 'message' => 'Tous les cookies ont été supprimés avec succès.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression des cookies.']);
    }
    exit;
}

// Gestion des appels API
if ($is_api_request) {
    header('Content-Type: application/json');
    if ($routeFile && file_exists($routeFile)) {
        include $routeFile;
    } else {
        echo json_encode(['error' => 'Route not found']);
    }
    exit;
}

//Traitement backend
if ($action === 'submit_login') {
    header('Content-Type: application/json');

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'error' => 'Email et mot de passe requis.']);
        exit;
    }
    try {
        // Vérification dans la table admin
        $admin = get_admin_by_email($email);

        if ($admin && password_verify($password, $admin['mot_de_passe'])) {
            session_start();
            $_SESSION['user'] = ['id' => $admin['id'], 'role' => 'admin'];

            // Gérer le cookie Remember Me
            if ($remember) {
                set_cookie('remember_me', json_encode(['id' => $admin['id'], 'role' => 'admin']), 604800); // 7 jours
            }

            echo json_encode(['success' => true, 'redirect' => 'admin_dashboard.php']);
            exit;
        }

        // Vérification dans la table utilisateur
        $user = get_user_by_email($email);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            session_start();
            $_SESSION['user'] = ['id' => $user['id'], 'role' => 'user'];

            // Gérer le cookie Remember Me
            if ($remember) {
                set_cookie('remember_me', json_encode(['id' => $user['id'], 'role' => 'user']), 604800); // 7 jours
            }

            echo json_encode(['success' => true, 'redirect' => 'user_dashboard.php']);
            exit;
        }

        echo json_encode(['success' => false, 'error' => 'Email ou mot de passe incorrect.']);
    } catch (PDOException $e) {
        error_log("Database connection error: " . $e->getMessage(), 3, __DIR__ . '/logs/errors.log');
        echo json_encode(['success' => false, 'error' => 'Erreur de connexion. Réessayez plus tard.']);
    }
    exit;
}


if ($action === 'logout') {
    session_start();
    session_destroy(); // Détruit la session
    clear_all_cookies(); // Efface tous les cookies
    header('Location: index.php?action=login'); // Redirige vers la page de connexion
    exit;
}


// Inclusion du fichier de route
if ($routeFile && file_exists($routeFile)) {
    include $routeFile;
} else {
    error_log("Route not found: {$action}", 3, __DIR__ . '/logs/errors.log');
    http_response_code(404);
    include __DIR__ . '/views/pages/error_404.php';
    exit;
}
