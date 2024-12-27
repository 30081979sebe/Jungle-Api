<?php

/**
 * Crée ou met à jour un cookie pour la fonctionnalité "Remember Me".
 *
 * @param string $email L'adresse e-mail de l'utilisateur à stocker dans le cookie.
 * @param bool $remember_me Indique si le cookie doit être créé ou supprimé.
 */
function set_remember_me_cookie(string $email, bool $remember_me): void {
    if ($remember_me) {
        setcookie('remember_me', $email, [
            'expires' => time() + (5* 60), // 5minutes
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict',
            'domain' => null
        ]);
    } else {
        clear_remember_me_cookie();
    }
}

/**
 * Efface le cookie "Remember Me".
 */
function clear_remember_me_cookie(): void {
    setcookie('remember_me', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict',
        'domain' => null
    ]);
}

/**
 * Récupère l'adresse e-mail stockée dans le cookie "Remember Me".
 *
 * @return string|null L'adresse e-mail si le cookie existe, null sinon.
 */
function get_remember_me_cookie(): ?string {
    return $_COOKIE['remember_me'] ?? null;
}

?>

