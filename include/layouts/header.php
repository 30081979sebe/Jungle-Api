<?php
defined('API_EXEC') or die(http_response_code(500));
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<link rel="shortcut icon" href="favicon.ico">

        <title><?php ?></title>
        <meta name="description" content="<?php ?>"
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<style>
.navbar {
    background: rgba(255, 255, 255, 0.15) !important;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    padding: 15px 0;
}

.brand-name {
    font-family: 'Palatino', serif;
    font-size: 32px;
    color: #1b5e20 !important;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.15);
    letter-spacing: 1px;
}

.leaf-icon {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-5px) rotate(5deg); }
    100% { transform: translateY(0px) rotate(0deg); }
}

body {
    background: linear-gradient(145deg, #43a047, #1b5e20);
    min-height: 100vh;
}

.modal-content {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(15px);
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.modal-header {
    border-bottom: 1px solid rgba(46, 125, 50, 0.2);
}

.modal-title {
    color: #1b5e20;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.login-btn {
    background: transparent;
    border: none;
    padding: 10px;
    transition: all 0.3s ease;
}

.login-btn:hover {
    transform: scale(1.1) rotate(5deg);
}

.role-btn {
    border: 2px solid #2e7d32;
    background: rgba(255, 255, 255, 0.1);
    padding: 25px;
    margin: 10px;
    border-radius: 15px;
    transition: all 0.4s ease;
    width: 200px;
}

.role-btn:hover {
    background: #2e7d32;
    color: white;
    transform: translateY(-8px);
    box-shadow: 0 8px 20px rgba(46, 125, 50, 0.3);
}

.role-btn svg {
    margin-bottom: 15px;
    transition: all 0.4s ease;
}

.role-btn:hover svg {
    fill: white;
}

.form-control {
    border: 2px solid rgba(46, 125, 50, 0.2);
    border-radius: 8px;
    padding: 12px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #2e7d32;
    box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.25);
}

.btn-success {
    background: #2e7d32;
    border: none;
    padding: 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-success:hover {
    background: #1b5e20;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(46, 125, 50, 0.4);
}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand brand-name" href="https://jungle.com">
            <svg class="leaf-icon" width="35" height="35" viewBox="0 0 24 24" fill="#1b5e20" style="margin-right: 10px;">
                <path d="M17,8C8,10,5.9,16.17,3.82,21.34L5.71,22l1-2.3A4.49,4.49,0,0,0,8,20C19,20,22,3,22,3,21,5,14,5.25,9,6.25S2,11.5,2,13.5a6.23,6.23,0,0,0,1.5,3.75"></path>
            </svg>
            Jungle
        </a>
        
        <button class="login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="#1b5e20">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </button>
    </div>
</nav>

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Choisir votre rôle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="d-flex justify-content-around flex-wrap">
                    <button class="role-btn" id="adminButton">
                        <svg width="45" height="45" viewBox="0 0 24 24" fill="#2e7d32">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 2.18l7 3.12v5.7c0 4.83-3.4 9.16-7 10.35-3.6-1.2-7-5.52-7-10.35V6.3l7-3.12z"/>
                            <path d="M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"/>
                        </svg>
                        <div>Administrateur</div>
                    </button>
                    <button class="role-btn" id="userButton">
                        <svg width="45" height="45" viewBox="0 0 24 24" fill="#2e7d32">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <div>Utilisateur</div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Clic sur le bouton "Administrateur"
    $('#adminButton').on('click', function() {
        // Fermer la modale
        $('#loginModal').modal('hide');

        // Charger dynamiquement le contenu pour l'administrateur
        $.ajax({
            url: 'index.php', // URL de gestion des routes
            method: 'POST',
            data: { action: 'loginform' }, // Action pour charger la vue administrateur
            success: function(response) {
                $('.container-fluid').html(response); // Injecter le contenu dans la div container-fluid
            },
            error: function() {
                alert('Une erreur est survenue.');
            }
        });
    });

});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>