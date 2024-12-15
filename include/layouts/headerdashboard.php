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
        <script src="public/assets/main.js"></script>
<style scoped>
.navbar {
    background: rgba(255, 255, 255, 0.15) !important;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.14);
    padding: 15px 0;
}

.brand-name {
    font-family: 'Palatino', serif;
    font-size: 32px;
    color: #FCC737 !important;
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
    background: linear-gradient(145deg, #020024, #064da6);
    min-height: 100vh;
}


.login-btn {
    background: #FCC737;
    border: none;
    padding: 10px;
    transition: all 0.3s ease;
}

.login-btn:hover {
    transform: scale(1.1) rotate(5deg);
}

.role-btn {
    border: 2px solid #064da6;
    background: rgba(255, 255, 255, 0.1);
    padding: 25px;
    margin: 10px;
    border-radius: 15px;
    transition: all 0.4s ease;
    width: 200px;
}


.role-btn svg {
    margin-bottom: 15px;
    transition: all 0.4s ease;
}

.role-btn:hover svg {
    fill: white;
}

</style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand brand-name" href="#">Jungle</a>
        
        <button id="login-btn" class="login-btn rounded-circle">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="#064da6">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </button>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>