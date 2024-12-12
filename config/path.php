<?php
// Chemin absolu du fichier index.php dans le répertoire de base
if (!defined('PATH_BASE')) {
    define('PATH_BASE', rtrim(str_replace('\\', '/', realpath(__DIR__ . '/..')), '/') . '/');
}

// Chemin absolu vers le répertoire racine du serveur web (racine publique)
if (!defined('PATH_SERVER')) {
    define('PATH_SERVER', rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/') . '/');
}

// Chemin absolu vers le répertoire parent (racine du projet)
if (!defined('PATH_ROOT')) {
    define('PATH_ROOT', rtrim(str_replace('\\', '/', realpath(__DIR__ . '/..')), '/') . '/');
}
?>

