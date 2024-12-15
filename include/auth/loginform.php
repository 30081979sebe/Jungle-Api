<?php
defined('API_EXEC') or die(http_response_code(500));
?>

<!-- Styles spécifiques au composant -->
<style scoped>
#login-component {
    background: rgba(255, 255, 255, 0.23) !important;
    backdrop-filter: blur(10px);
    box-shadow: 0 6px 40px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    padding: 30px;
    max-width: 500px;
    margin: auto;
    color: #064da6 !important;
}
#login-component h2 {
    font-size: 1.8rem;
    color: #064da6;
    text-align: center;
    margin-bottom: 20px;
    font-weight: bold;
}
#login-component .form-label {
    font-weight: bold;
    color: #FCC737 !important;
    margin-bottom: 5px;
    display: block;
}
#login-component input[type="email"],
#login-component input[type="password"] {
    width: 100%;
    padding: 15px;
    border: 1px solid rgba(200, 200, 200, 0.5);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.9);
    color: #333;
    font-size: 1rem;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}
#login-component input[type="email"]:focus,
#login-component input[type="password"]:focus {
    border-color: #FCC737;
    box-shadow: 0 0 8px rgba(252, 199, 55, 0.7);
    outline: none;
}
#login-component .form-check-label {
    color: rgb(225, 219, 204) !important;
    font-size: 0.9rem;
    margin-left: 5px;
}
#login-component button {
    width: 100%;
    padding: 12px;
    font-size: 1rem;
    font-weight: bold;
    color: white;
    background-color: #064da6;
    border: none;
    border-radius: 8px;
    transition: transform 0.3s ease, background-color 0.3s ease;
}
#login-component button:hover {
    background-color: #8C3061;
    transform: scale(1.02);
}
</style>

<!-- Composant HTML -->
<div id="login-component" class="rounded-lg shadow-md p-4 max-w-lg w-full mx-auto bg-white">
    <h2 class="text-center mb-6 text-[#064da6] font-bold text-2xl">Connexion</h2>
    <form id="login-form" method="POST" class="space-y-6">
        <div>
            <label for="email" class="block  text-[#1E201E] mb-2">Adresse Email</label>
            <input 
                type="email" 
                class="p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FCC737]" 
                id="email" 
                name="email" 
                placeholder="Entrez votre email" 
                required
            >
        </div>
        <div>
            <label for="password" class="block  text-[#1E201E] mb-2">Mot de passe</label>
            <input 
                type="password" 
                class="p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FCC737]" 
                id="password" 
                name="password" 
                placeholder="Entrez votre mot de passe" 
                required
            >
        </div>
        <div class="flex items-center">
            <input 
                type="checkbox" 
                class="mr-2 accent-[#FCC737]" 
                id="remember-me" 
                name="remember-me"
            >
            <label for="remember-me" class="text-gray-700">Se souvenir de moi</label>
        </div>
        <div>
            <button 
                type="submit" 
                class="bg-[#FCC737] text-white  py-3 px-4 rounded-lg hover:bg-[#e0b835] transition-all"
            >
                Se Connecter
            </button>
        </div>
    </form>
</div>




<!-- Script jQuery/AJAX -->
