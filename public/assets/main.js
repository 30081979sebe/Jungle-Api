

$(document).ready(function() {
    // Clic sur le bouton "Administrateur"
    $('#adminButton').on('click', function() {
        // Fermer la modale
        $('#loginModal').modal('hide');

        // Charger dynamiquement le contenu pour l'administrateur
        $.ajax({
            url: 'index.php', // URL de gestion des routes
            method: 'POST',
            data: { action: 'login'}, // Action pour charger la vue administrateur
            success: function(response) {
                $('.container-fluid').html(response); // Injecter le contenu dans la div container-fluid
            },
            error: function() {
                alert('Une erreur est survenue.');
            }
        });
    });

});