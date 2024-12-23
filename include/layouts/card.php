
<style>
.glass-card {
  backdrop-filter: blur(16px) saturate(180%);
  -webkit-backdrop-filter: blur(16px) saturate(180%);
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 12px;
  border: 1px solid rgba(209, 213, 219, 0.3);
  transition: all 0.3s ease-in-out;
}

.glass-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.gradient-bg {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  animation: gradientBG 15s ease infinite;
  background-size: 400% 400%;
}

@keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.icon-rotate {
  animation: rotate 20s linear infinite;
}

@keyframes rotate {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}
</style>



<div class="flex flex-col md:flex-row gap-6 max-w-6xl p-12 rounded-xl">
    <!-- Card 2 -->
    <div class="glass-card p-8 max-w-sm w-full">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Features</h2>
        <svg class="w-8 h-8 text-purple-600 icon-rotate" fill="currentColor" viewBox="0 0 24 24">
          <path d="M13 2l-2 2h-2l-2 2v2l-2 2 2 2v2l2 2h2l2 2 2-2h2l2-2v-2l2-2-2-2v-2l-2-2h-2l-2-2z"/>
        </svg>
      </div>
      <p class="text-gray-600 mb-6">
        Powerful features that enhance your experience and productivity.
      </p>
      <div class="space-y-4">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span class="text-gray-700">Smart integration</span>
        </div>
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span class="text-gray-700">Advanced tools</span>
        </div>
      </div>
      <button class="mt-8 w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition-colors duration-200">
        See Features
      </button>
    </div>
    <!-- Card 2 -->
    <div class="glass-card p-8 max-w-sm w-full">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Design</h2>
        <svg class="w-8 h-8 text-indigo-600 icon-rotate" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm0-2a8 8 0 100-16 8 8 0 000 16zm0-3a5 5 0 110-10 5 5 0 010 10z"/>
        </svg>
      </div>
      <p class="text-gray-600 mb-6">
        Beautiful aesthetics with modern design principles and attention to detail.
      </p>
      <div class="space-y-4">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span class="text-gray-700">Modern aesthetics</span>
        </div>
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span class="text-gray-700">Clean layout</span>
        </div>
      </div>
      <button class="mt-8 w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-200">
        Explore Design
      </button>
    </div>
    <!-- Card 3 -->
    <div class="glass-card p-8 max-w-sm w-full">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Support</h2>
        <svg class="w-8 h-8 text-pink-600 icon-rotate" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
        </svg>
      </div>
      <p class="text-gray-600 mb-6">
        24/7 dedicated support to help you succeed with your goals.
      </p>
      <div class="space-y-4">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span class="text-gray-700">24/7 assistance</span>
        </div>
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <span class="text-gray-700">Expert guidance</span>
        </div>
      </div>
      <button class="mt-8 w-full bg-pink-600 text-white py-2 px-4 rounded-lg hover:bg-pink-700 transition-colors duration-200">
        Get Support
      </button>
    </div>
</div>