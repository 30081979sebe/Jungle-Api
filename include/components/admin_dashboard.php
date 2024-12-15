<?php
defined('API_EXEC') or die(http_response_code(500));
?>


<body>
<?php
include_headerdashboard();
?>
<div class="container full-screen">
    <div id="dynamic-content"></div> <!-- Conteneur pour le contenu dynamique -->
</div>

<?php
include_footer();
?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>