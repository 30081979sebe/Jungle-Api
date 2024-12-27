$(document).ready(function () {
    // Stockage du contenu initial pour restauration
    let initialCardContent = $("#dynamic-card").html();

    // Gestion de l'affichage dynamique du formulaire
    $("#login-btn").on("click", function (e) {
        e.preventDefault();

        const contentDiv = $("#dynamic-content");
        let cardDiv = $("#dynamic-card");

        if (contentDiv.is(":visible") && contentDiv.html().trim() !== "") {
            // Fermer le formulaire et restaurer la carte initiale
            contentDiv.fadeOut(200, function () {
                $(this).empty(); // Vide le contenu

                if ($("#dynamic-card").length === 0) {
                    $(".container.full-screen").prepend(`
                        <div id="dynamic-card" style="display: none;">
                            ${initialCardContent}
                        </div>
                    `);
                    $("#dynamic-card").fadeIn(200);
                }
            });
        } else {
            // Charger le formulaire via AJAX
            $.ajax({
                url: "index.php",
                method: "GET",
                data: { action: "login" },
                success: function (response) {
                    if (cardDiv.length > 0) {
                        cardDiv.fadeOut(5, function () {
                            $(this).remove();
                        });
                    }
                    contentDiv.html(response).fadeIn(200);
                },
                error: function () {
                    contentDiv.html("<p>Erreur lors du chargement du formulaire. Veuillez réessayer.</p>").fadeIn(500);
                },
            });
        }
    });
});


