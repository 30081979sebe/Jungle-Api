/*
Requete AJAX pour l'appel du formlogin via API-Jungle
*/
$(document).ready(function() {
    // gestionnaire d'événements au clic sur le bouton
    $("#login-btn").on("click", function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du bouton

        // Vérifier si le contenu est déjà affiché
        const contentDiv = $("#dynamic-content");

        if (contentDiv.is(":visible") && contentDiv.html().trim() !== "") {
            // Si déjà visible et non vide, on le cache
            contentDiv.empty().hide();
        } else {
            // Charger dynamiquement le composant loginform via l'API
            $.ajax({
                url: "index.php", // URL API
                method: "GET",
                data: {
                    action: "login" // Action définie dans  API-jungle pour appeler le composant
                },
                success: function(response) {
                    // Injecter le contenu dans la div #dynamic-content et l'afficher
                    contentDiv.html(response).show();
                },
                error: function(xhr) {
                    // Gestion des erreurs
                    contentDiv.html("<p>Erreur lors du chargement du composant.</p>").show();
                }
            });
        }
    });
});


