<?php
defined('API_EXEC') or die(http_response_code(500));
?>

<!-- Styles spécifiques au composant -->
<style scoped>
.glass-card {
  backdrop-filter: blur(16px) saturate(180%);
  -webkit-backdrop-filter: blur(16px) saturate(180%);
  background-color: rgba(255, 255, 255, 0.75);
  border-radius: 12px;
  border: 1px solid rgba(209, 213, 219, 0.3);
  transition: all 0.3s ease-in-out;
}

.glass-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.input-style {
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 0.3s ease;
}

.input-style:focus {
  background: rgba(255, 255, 255, 0.15);
  border: 1px solid rgba(255, 255, 255, 0.3);
}
</style>

<!-- Composant HTML -->
<div class="glass-card p-8 w-full max-w-md">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
      <p class="text-gray-600 mt-2">Please sign in to continue</p>
    </div>

    <form class="space-y-6" method="post" action="https://example.com/login">
      <div>
        <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
          Email Address
        </label>
        <input 
          class="input-style w-full px-4 py-3 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500"
          type="email"
          id="email"
          name="email"
          placeholder="your@email.com"
          required
        />
      </div>

      <div>
        <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
          Password
        </label>
        <input 
          class="input-style w-full px-4 py-3 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500"
          type="password"
          id="password"
          name="password"
          placeholder="••••••••"
          required
        />
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input 
            type="checkbox" 
            id="remember"
            name="remember"
            class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
          />
          <label for="remember" class="ml-2 block text-sm text-gray-700">
            Remember me
          </label>
        </div>
        <a href="https://example.com/forgot-password" class="text-sm text-purple-600 hover:text-purple-500">
          Forgot password?
        </a>
      </div>

      <button 
        type="submit" 
        class="w-full bg-purple-600 text-white py-3 px-4 rounded-lg hover:bg-purple-700 transition-colors duration-200 font-semibold"
      >
        Sign In
      </button>

      <div class="text-center mt-4">
        <span class="text-gray-600 text-sm">Don't have an account?</span>
        <a href="https://example.com/signup" class="text-purple-600 hover:text-purple-500 text-sm font-semibold ml-1">
          Sign up
        </a>
      </div>
    </form>
</div>




<!-- Script jQuery/AJAX -->
