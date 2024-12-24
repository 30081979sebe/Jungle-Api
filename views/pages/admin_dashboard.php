<?php
defined('API_EXEC') or die(http_response_code(500));
?>


<!-- Styles spécifiques au composant -->
<style scoped>

</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


     <!-- Tailwind CSS CDN -->
     <script src="https://cdn.tailwindcss.com"></script>
    <script src="public/assets/main.js"></script>
    <script src="public/assets/jquery.js"></script>
    <title>Bienvenue Admin</title>
</head>
<body>
<?php
include_layout('header');
?>
<div class="w-screen h-screen bg-sky-900">
    <div id="dynamic-content"></div> <!-- Conteneur pour le contenu dynamique -->
</div>

<?php
include_layout('footer');
?>
</body>
</html>
