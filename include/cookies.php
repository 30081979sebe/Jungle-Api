<?php

/**
 * Définit un cookie sécurisé.
 *
 * @param string $name Le nom du cookie.
 * @param string $value La valeur du cookie.
 * @param int $expiry Durée en secondes avant l'expiration (par défaut : 7 jours).
 */
function set_cookie($name, $value, $expiry = 604800) {
    setcookie($name, $value, time() + $expiry, '/', $_SERVER['HTTP_HOST'], isset($_SERVER['HTTPS']), true);
}

/**
 * Récupère un cookie.
 *
 * @param string $name Le nom du cookie.
 * @return string|null La valeur du cookie ou null si le cookie n'existe pas.
 */
function get_cookie($name) {
    return $_COOKIE[$name] ?? null;
}

/**
 * Supprime un cookie.
 *
 * @param string $name Le nom du cookie.
 */
function delete_cookie($name) {
    setcookie($name, '', time() - 3600, '/');
    setcookie($name, '', time() - 3600, '/', $_SERVER['HTTP_HOST']);
}

/**
 * Efface tous les cookies existants.
 */
function clear_all_cookies() {
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            delete_cookie($name); // Utilise la fonction delete_cookie
        }
    }
}
