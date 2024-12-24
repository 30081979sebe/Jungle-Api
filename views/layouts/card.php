<?php
defined('API_EXEC') or die(http_response_code(500));
?>

<style scoped>
.glass-card {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
}

.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.45);
}

.elegant-button {
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.elegant-button:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}
</style>


<div class="flex items-center justify-center min-h-screen p-6">
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl">
        <!-- Card 1 -->
  <div class="glass-card card-hover rounded-xl p-6 text-white">
    <div class="text-4xl mb-4">
      <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
      <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zm-2.207 2.207L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
      </svg>
    </div>
    <h3 class="text-xl font-semibold mb-2">Excellence Artistique</h3>
    <p class="text-gray-200 mb-4">
    Notre expertise en design crée des expériences élégantes et raffinées qui subliment votre identité.
    </p>
    <a href="https://example.com/contact" class="elegant-button inline-block px-6 py-2 rounded-lg text-white text-sm hover:shadow-lg">
    En savoir plus
    </a>
  </div>

        <!-- Card 2 -->
  <div class="glass-card card-hover rounded-xl p-6 text-white">
    <div class="text-4xl mb-4">
      <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zm0 16a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
      </svg>
    </div>
    <h3 class="text-xl font-semibold mb-2">Savoir-Faire</h3>
    <p class="text-gray-200 mb-4">
    Notre approche sophistiquée allie tradition et modernité pour des résultats exceptionnels.
    </p>
    <a href="https://example.com/services" class="elegant-button inline-block px-6 py-2 rounded-lg text-white text-sm hover:shadow-lg">
    Découvrir
    </a>
</div>

        <!-- Card 3 -->
  <div class="glass-card card-hover rounded-xl p-6 text-white">
    <div class="text-4xl mb-4">
        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
      <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
        </svg>
    </div>
    <h3 class="text-xl font-semibold mb-2">Sur Mesure</h3>
    <p class="text-gray-200 mb-4">
        Chaque projet est unique. Nous créons des solutions personnalisées adaptées à vos besoins.
    </p>
    <a href="https://example.com/custom" class="elegant-button inline-block px-6 py-2 rounded-lg text-white text-sm hover:shadow-lg">
        Commencer
    </a>
  </div>
</div>

</div>
