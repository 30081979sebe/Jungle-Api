<?php
defined('API_EXEC') or die(http_response_code(500));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


     <!-- Tailwind CSS CDN -->
     <script src="https://cdn.tailwindcss.com"></script>
    <script src="public/assets/main.js"></script>
    <script src="public/assets/jquery.js"></script>
    <title>Accueil</title>

<style scoped>
    .full-screen {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center; 
        align-items: center; 
    }
</style>

</head>
<body>
<?php
include_layout('header');
?>
<div class="container full-screen bg-sky-900">
<div id="dynamic-card"><?php include_layout('card');?>
<div class="mt-4 text-center">
    <button id="clear-cookies-btn" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
        Effacer les cookies
    </button>
    <div id="cookie-message" class="hidden mt-2 p-4 rounded-lg text-center"></div>
</div>
<div id="ajax-message" class="hidden p-4 rounded-lg text-center"></div>
</div>
<div id="dynamic-content"></div> <!-- Conteneur pour le contenu dynamique -->
</div>

<?php
include_layout('footer');
?>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const messageDiv = document.getElementById('ajax-message');

        // Vérifier la connexion à la base de données via AJAX
        fetch('index.php?action=check_connection&api=1')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageDiv.textContent = data.message;
                    messageDiv.className = 'bg-green-100 text-green-700 p-4 rounded-lg text-center';
                    messageDiv.style.display = 'block';
                } else {
                    messageDiv.textContent = data.message;
                    messageDiv.className = 'bg-red-100 text-red-700 p-4 rounded-lg text-center';
                    messageDiv.style.display = 'block';
                }
            })
            .catch(error => {
                messageDiv.textContent = 'Erreur lors de la vérification de la connexion.';
                messageDiv.className = 'bg-red-100 text-red-700 p-4 rounded-lg text-center';
                messageDiv.style.display = 'block';
            });
    });
    //suppression des cookies
    document.addEventListener('DOMContentLoaded', function () {
        const clearCookiesBtn = document.getElementById('clear-cookies-btn');
        const messageDiv = document.getElementById('cookie-message');

        clearCookiesBtn.addEventListener('click', function () {
            fetch('index.php?action=clear_cookies&api=1', {
                method: 'POST'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        messageDiv.textContent = data.message;
                        messageDiv.className = 'bg-green-100 text-green-700 p-4 rounded-lg text-center';
                        messageDiv.style.display = 'block';
                    } else {
                        messageDiv.textContent = data.message;
                        messageDiv.className = 'bg-red-100 text-red-700 p-4 rounded-lg text-center';
                        messageDiv.style.display = 'block';
                    }
                })
                .catch(error => {
                    messageDiv.textContent = 'Erreur lors de la suppression des cookies.';
                    messageDiv.className = 'bg-red-100 text-red-700 p-4 rounded-lg text-center';
                    messageDiv.style.display = 'block';
                });
        });
    });
</script>
</html>