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
        <meta name="description" content="<?php ?>">

         <!-- Tailwind CSS CDN -->
         <script src="https://cdn.tailwindcss.com"></script>
        <script src="public/assets/main.js"></script>
        <script src="public/assets/jquery.js"></script>

<style scoped>
.glass-nav {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
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

.role-btn svg {
    transition: all 0.4s ease;
}

.role-btn:hover svg {
    fill: white;
}
</style>
</head>
<body class="min-h-screen">
<nav class="glass-nav py-4 sticky top-0 z-10 text-white">
    <div class="container mx-auto flex justify-between items-center px-4">
        <a class="text-white text-2xl font-serif font-bold tracking-wider flex items-center" href="#">
            <svg class="leaf-icon w-9 h-9 mr-2" fill="#118B50" viewBox="0 0 24 24">
                <path d="M17,8C8,10,5.9,16.17,3.82,21.34L5.71,22l1-2.3A4.49,4.49,0,0,0,8,20C19,20,22,3,22,3,21,5,14,5.25,9,6.25S2,11.5,2,13.5a6.23,6.23,0,0,0,1.5,3.75"></path>
            </svg>
            Jungle
        </a>
        
        <button id="login-btn" class="bg-teal-600 hover:scale-110 transform transition-all duration-300 p-2 rounded-full">
            <svg class="w-7 h-7" fill="#064da6" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </button>
    </div>
</nav>
</body>
</html>
