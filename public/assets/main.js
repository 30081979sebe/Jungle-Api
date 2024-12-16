/*
Requete AJAX pour l'appel du formlogin via API-Jungle
*/
$(document).ready(function() {
    // Variable pour stocker le contenu initial de dynamic-card
    let initialCardContent = $("#dynamic-card").html();

    // événements au clic sur le bouton
    $("#login-btn").on("click", function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du bouton

        // Sélection des éléments
        const contentDiv = $("#dynamic-content");
        let cardDiv = $("#dynamic-card"); // Récupère l'élément si présent

        if (contentDiv.is(":visible") && contentDiv.html().trim() !== "") {
            // Si le formulaire est affiché, fermer le formulaire et restaurer la carte
            contentDiv.fadeOut(200, function() {
                $(this).empty(); // Vider le contenu dynamique

                // Réinsérer et afficher la div #dynamic-card
                if ($("#dynamic-card").length === 0) {
                    $(".container.full-screen").prepend(`
                        <div id="dynamic-card" style="display: none;">
                            ${initialCardContent}
                        </div>
                    `);
                    $("#dynamic-card").fadeIn(200); // Affiche la carte avec une animation
                }
            });
        } else {
            // Sinon, charger le formulaire de connexion et supprimer la carte
            $.ajax({
                url: "index.php", // URL API
                method: "GET",
                data: {
                    action: "login" // Action définie pour appeler le formulaire
                },
                success: function(response) {
                    // Supprimer la div #dynamic-card si elle existe
                    if (cardDiv.length > 0) {
                        cardDiv.fadeOut(5, function() {
                            $(this).remove(); // Supprimer complètement du DOM
                        });
                    }

                    // Injecter le contenu dans la div #dynamic-content et l'afficher
                    contentDiv.html(response).fadeIn(20);
                },
                error: function(xhr) {
                    // Gestion des erreurs
                    contentDiv.html("<p>Erreur lors du chargement du composant.</p>").fadeIn(500);
                }
            });
        }
    });
});







