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
                $(this).empty('slow'); // Vider le contenu dynamique

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

/*
Requete AJAX pour verifier la connexion a la base de données
*/
document.addEventListener('DOMContentLoaded', function () {
    const messageDiv = document.getElementById('ajax-message');

    // Vérifier la connexion à la base de données
    fetch('index.php?action=check_connection&api=1')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Connexion réussie
                messageDiv.textContent = data.message;
                messageDiv.className = 'bg-green-100 text-black p-4 rounded-lg text-center';
                messageDiv.style.display = 'block';
            } else {
                // Connexion échouée
                messageDiv.textContent = data.message;
                messageDiv.className = 'bg-red-100 text-red-700 p-4 rounded-lg text-center';
                messageDiv.style.display = 'block';
            }
        })
        .catch(error => {
            // Erreur de la requête AJAX
            messageDiv.textContent = 'Erreur lors de la vérification de la connexion.';
            messageDiv.className = 'bg-red-100 text-red-700 p-4 rounded-lg text-center';
            messageDiv.style.display = 'block';
        });
});

// gestion de la case à cocher remember lors de la soumission du formulaire :
document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');
    const messageDiv = document.getElementById('login-error');

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault(); // Empêche le rechargement de la page

        // Récupération des données
        const formData = new FormData(loginForm);

        // Appel AJAX
        fetch('index.php?action=submit_login', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Connexion réussie
                    messageDiv.textContent = 'Connexion réussie. Redirection...';
                    messageDiv.className = 'bg-green-100 text-green-700 p-4 rounded-lg text-center';
                    messageDiv.style.display = 'block';

                    // Redirection après 2 secondes
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 2000);
                } else {
                    // Échec de connexion
                    messageDiv.textContent = data.error;
                    messageDiv.className = 'bg-red-100 text-red-700 p-4 rounded-lg text-center';
                    messageDiv.style.display = 'block';
                }
            })
            .catch(error => {
                messageDiv.textContent = 'Une erreur est survenue. Veuillez réessayer.';
                messageDiv.className = 'bg-red-100 text-red-700 p-4 rounded-lg text-center';
                messageDiv.style.display = 'block';
            });
    });
});









