<?php

/**
 * Recherche un utilisateur dans la table admin par email.
 *
 * @param string $email L'email de l'utilisateur.
 * @return array|null Les données de l'utilisateur ou null si introuvable.
 */
function get_admin_by_email(string $email): ?array {
    $pdo = get_db_connection();
    $query = $pdo->prepare("SELECT * FROM admin WHERE email = :email");
    $query->execute(['email' => $email]);
    return $query->fetch() ?: null;
}

/**
 * Recherche un utilisateur dans la table utilisateur par email.
 *
 * @param string $email L'email de l'utilisateur.
 * @return array|null Les données de l'utilisateur ou null si introuvable.
 */
function get_user_by_email(string $email): ?array {
    $pdo = get_db_connection();
    $query = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
    $query->execute(['email' => $email]);
    return $query->fetch() ?: null;
}
