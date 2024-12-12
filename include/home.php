<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Accueil</title>

    <style>
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
<div class="container-fluid bg-success full-screen vh-100 d-flex align-items-center justify-content-center">
</div>

<?php
include_footer();
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>