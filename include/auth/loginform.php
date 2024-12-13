<?php
defined('API_EXEC') or die(http_response_code(500));
?>

<!-- Styles spécifiques au composant -->
<style>
#login-component .bg-light {
    background-color: #f8f9fa !important;
}
#login-component .form-label {
    font-weight: bold;
}
</style>

<!-- Composant HTML -->
<div id="login-component" class="bg-light p-4 rounded shadow" style="max-width: 400px; width: 100%;">
    <h2 class="text-center mb-3">Formulaire</h2>
    <form id="login-form" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Soumettre</button>
        </div>
    </form>
</div>

<!-- Script jQuery/AJAX -->
<script>
$(document).ready(function() {
    $("#login-form").on("submit", function(e) {
        e.preventDefault(); // Empêche le rechargement de la page

        const email = $("#email").val();
        const password = $("#password").val();

        $.ajax({
            url: BASE_URL + "/?action=login",
            method: "POST",
            data: {
                action: "login", // Correspond à la clé du routeur
                email: email,
                password: password
            },
            success: function(response) {
                // Gérer la réponse
                alert("Connexion réussie : " + response.message);
            },
            error: function(xhr) {
                // Gérer les erreurs
                alert("Erreur : " + xhr.responseText);
            }
        });
    });
});
</script>
