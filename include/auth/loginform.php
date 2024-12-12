<?php
defined('API_EXEC') or die(http_response_code(500));
?>

<div class="bg-light p-4 rounded shadow" style="max-width: 400px; width: 100%;">
    <h2 class="text-center mb-3">Formulaire</h2>
        <form method="POST">
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