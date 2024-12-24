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

<!-- Composant HTML -->
<div class="glass-card p-8 w-full max-w-md rounded-xl">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-white">Bienvenue</h2>
      <p class="text-white mt-2">Se Connecter</p>
    </div>
    <div id="login-error" class="text-red-500 mt-4 text-center hidden"><!-- Le message d'erreur s'affichera ici --></div>
    <form class="space-y-6" method="post" action="index.php?action=submit_login">
      <div>
        <label class="block text-white text-sm font-semibold mb-2" for="email">
          Email
        </label>
        <input 
          class="input-style w-full px-4 py-3 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
          type="email"
          id="email"
          name="email"
          placeholder="Votre@email.com"
          required
        />
      </div>

      <div>
        <label class="block text-white text-sm font-semibold mb-2" for="password">
          Mot de passe
        </label>
        <input class="input-style w-full px-4 py-3 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600"  type="password"  id="password"  name="password"  placeholder="••••••••" required/>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input 
            type="checkbox" 
            id="remember"
            name="remember"
            class="h-4 w-4 text-white focus:ring-blue-600 border-gray-300 rounded"
          />
          <label for="remember" class="ml-2 block text-sm text-white">
            Remember me
          </label>
        </div>
      </div>

      <button 
      type="submit" 
      id="submit-login" 
      name="action" 
      value="submit_login" 
      class="elegant-button w-full text-white py-3 px-4 rounded-lg font-semibold"><!-- Ajout pour faciliter l'identification côté JS -->
    Connexion
</button>

      <div class="text-center mt-4">
        <a href="https://example.com/signup" class="text-yellow-400 hover:text-md text-sm font-semibold ml-1">
          S'inscrire
        </a>
      </div>
    </form>
</div>

<!-- Script jQuery/AJAX -->
