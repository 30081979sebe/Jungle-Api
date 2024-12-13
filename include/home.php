<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
include_header();
?>
<div class="container full-screen">
    <div id="dynamic-content"></div> <!-- Conteneur pour le contenu dynamique -->
</div>

<?php
include_footer();
?>

<script>
$(document).ready(function() {
    // Charger dynamiquement le composant login
    $.ajax({
        url: "https://monprojet.loc/", // URL principale
        method: "GET",
        data: {
            action: "login" // Action correspondante au composant login
        },
        success: function(response) {
            // Injecter le contenu dans la div
            $("#dynamic-content").html(response);
        },
        error: function(xhr) {
            // Gestion des erreurs
            $("#dynamic-content").html("<p>Erreur lors du chargement du composant.</p>");
        }
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>