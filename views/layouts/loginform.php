<?php
defined('API_EXEC') or die(http_response_code(500));
?>

<!-- Styles spécifiques au composant -->
<style scoped>
.glass-card {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
}
.elegant-button {
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}
.elegant-button:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.input-style {
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 0.3s ease;
}

.input-style:focus {
  background: rgba(255, 255, 255, 0.15);
  border: 1px solid rgba(255, 255, 255, 0.3);
}
</style>

<!-- Formulaire de connexion -->
<div class="glass-card p-8 w-full max-w-md rounded-xl">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white">Bienvenue</h2>
        <p class="text-white mt-2">Connectez-vous à votre compte</p>
    </div>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="text-red-500 text-center mb-4">
            <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="index.php?action=submit_login" method="post" class="space-y-6">
        <div>
            <label class="block text-white text-sm font-semibold mb-2" for="email">Email</label>
            <input
                class="input-style w-full px-4 py-3 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
                type="email"
                id="email"
                name="email"
                value="<?= htmlspecialchars(get_remember_me_cookie() ?? '', ENT_QUOTES, 'UTF-8') ?>"
                required
            />
        </div>

        <div>
            <label class="block text-white text-sm font-semibold mb-2" for="password">Mot de passe</label>
            <input
                class="input-style w-full px-4 py-3 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
                type="password"
                id="password"
                name="password"
                required
            />
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="remember_me"
                    name="remember_me"
                    class="h-4 w-4 text-white focus:ring-blue-600 border-gray-300 rounded"
                />
                <label for="remember_me" class="ml-2 block text-sm text-white">Se souvenir de moi</label>
            </div>
        </div>

        <button
            type="submit"
            class="elegant-button w-full text-white py-3 px-4 rounded-lg font-semibold">
            Connexion
        </button>

        <div class="text-center mt-4">
            <a href="index.php?action=signup" class="text-yellow-400 hover:text-md text-sm font-semibold ml-1">
                Créer un compte
            </a>
        </div>
    </form>
</div>

<!-- Script jQuery/AJAX -->
