<?php
defined('API_EXEC') or die(http_response_code(500));
?>

<!-- Styles spécifiques au composant -->
<style scoped>
#login-component {
    background: rgba(255, 255, 255, 0.23) !important;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    padding: 15px 0;
    color: #FCC737 !important;
}
#login-component .form-label  {
    font-weight: bold;
    color: #FCC737 !important;
}
.form-check-label{
    color:rgb(225, 219, 204) !important; 
}
</style>

<!-- Composant HTML -->
<div id="login-component" class="bg-light p-4 rounded shadow" style="max-width: 400px; width: 100%;">
    <h2 class="text-center mb-3">Connexion</h2>
    <form id="login-form" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember-me" name="remember-me">
            <label class="form-check-label" for="remember-me">Se souvenir de moi</label>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Se Connecter</button>
        </div>
    </form>
</div>

<!-- Script jQuery/AJAX -->
