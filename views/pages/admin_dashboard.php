<?php
defined('API_EXEC') or die(http_response_code(500));
?>


<!-- Styles spécifiques au composant -->
<style scoped>

</style>

<body>
<?php
include_layout('header');
?>
<div class="container full-screen bg-sky-900">
    <div id="dynamic-content"></div> <!-- Conteneur pour le contenu dynamique -->
</div>

<?php
include_layout('footer');
?>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="public/assets/main.js"></script>
    <script src="public/assets/jquery.js"></script>
</body>
</html>
