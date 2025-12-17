  @push('css')
      <style>
          .search-input:focus {
              outline: none;
              box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
          }

          .mobile-menu {
              transition: all 0.3s ease;
          }

          @media (max-width: 768px) {
              .topbar-info {
                  display: none;
              }
          }
      </style>
  @endpush
  <!-- Header Container -->
  <header class="shadow-md bg-white">
      <!-- Topbar with contact info and social links -->
      <div class="bg-(--primary) text-white py-2 px-4">
          <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
              <!-- Contact Info -->
              <div class="topbar-info flex flex-wrap items-center space-x-4 text-sm mb-2 md:mb-0">
                  <div class="flex items-center">
                      <i class="fas fa-envelope mr-2"></i>
                      <span>contact@example.com</span>
                  </div>
                  <div class="flex items-center">
                      <i class="fas fa-phone mr-2"></i>
                      <span>+1 (555) 123-4567</span>
                  </div>
                  <div class="flex items-center">
                      <i class="fas fa-clock mr-2"></i>
                      <span>Mon-Fri: 9AM-6PM</span>
                  </div>
              </div>

              <!-- Social Links -->
              <div class="flex items-center space-x-4">
                  <a href="#" class="transition-colors" aria-label="Facebook">
                      <i class="fab fa-facebook-f"></i>
                  </a>
                  <a href="#" class="transition-colors" aria-label="Twitter">
                      <i class="fab fa-twitter"></i>
                  </a>
                  <a href="#" class="transition-colors" aria-label="Instagram">
                      <i class="fab fa-instagram"></i>
                  </a>
                  <a href="#" class="transition-colors" aria-label="LinkedIn">
                      <i class="fab fa-linkedin-in"></i>
                  </a>
                  <a href="#" class="transition-colors" aria-label="YouTube">
                      <i class="fab fa-youtube"></i>
                  </a>
              </div>
          </div>
      </div>

      <!-- Main Header -->
      <div class="container mx-auto px-4 py-4">
          <div class="flex flex-col md:flex-row justify-between items-center">
              <!-- Logo -->
              <div class="flex items-center mb-4 md:mb-0">
                  <div class="flex items-center space-x-3">
                      <div class="bg-(--primary) text-white p-3 rounded-lg">
                          <i class="fas fa-cube text-2xl"></i>
                      </div>
                      <div>
                          <h1 class="text-2xl font-bold text-(--primary)">BrandLogo</h1>
                          <p class="text-sm text-gray-600">Premium Solutions</p>
                      </div>
                  </div>
              </div>

              <!-- Search Bar -->
              <div class="w-full md:w-1/3 mb-4 md:mb-0 relative">
                  <div class="relative">
                      <input type="text" placeholder="Search products, articles, and more..."
                          class="w-full py-3 pl-12 pr-4 rounded-full border border-gray-300 search-input focus:border-(--primary)">
                      <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                          <i class="fas fa-search"></i>
                      </div>
                      <button
                          class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-(--primary) text-white py-1 px-4 rounded-full text-sm transition-colors">
                          Search
                      </button>
                  </div>
              </div>

              <!-- Login and User Actions -->
              <div class="flex items-center space-x-4">
                  <!-- Login Button -->
                  <button id="loginBtn"
                      class="bg-white border border-(--primary) text-(--primary) hover:bg-(--primary)/20 py-2 px-6 rounded-full font-medium transition-colors flex items-center">
                      <i class="fas fa-user-circle mr-2"></i>
                      <span>Login</span>
                  </button>

                  <!-- Cart Icon -->
                  <div class="relative">
                      <button class="bg-gray-100 hover:bg-gray-200 p-3 rounded-full transition-colors">
                          <i class="fas fa-shopping-cart text-gray-700"></i>
                      </button>
                      <span
                          class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                  </div>

                  <!-- Mobile Menu Button -->
                  <button id="mobileMenuBtn"
                      class="md:hidden bg-gray-100 hover:bg-gray-200 p-3 rounded-lg transition-colors">
                      <i class="fas fa-bars text-gray-700"></i>
                  </button>
              </div>
          </div>

          <!-- Mobile Menu (Hidden by default) -->
          <div id="mobileMenu" class="mobile-menu md:hidden mt-4 py-4 border-t border-gray-200 hidden">
              <div class="flex flex-col space-y-4">
                  <a href="#" class="text-gray-700 hover:text-(--primary) py-2 border-b border-gray-100">
                      <i class="fas fa-home mr-3"></i> Home
                  </a>
                  <a href="#" class="text-gray-700 hover:text-(--primary) py-2 border-b border-gray-100">
                      <i class="fas fa-box mr-3"></i> Products
                  </a>
                  <a href="#" class="text-gray-700 hover:text-(--primary) py-2 border-b border-gray-100">
                      <i class="fas fa-info-circle mr-3"></i> About
                  </a>
                  <a href="#" class="text-gray-700 hover:text-(--primary) py-2 border-b border-gray-100">
                      <i class="fas fa-envelope mr-3"></i> Contact
                  </a>
                  <div class="pt-2">
                      <div class="flex items-center space-x-4">
                          <a href="#" class="text-gray-500 hover:text-(--primary)">
                              <i class="fab fa-facebook-f"></i>
                          </a>
                          <a href="#" class="text-gray-500 hover:text-(--primary)">
                              <i class="fab fa-twitter"></i>
                          </a>
                          <a href="#" class="text-gray-500 hover:text-(--primary)">
                              <i class="fab fa-instagram"></i>
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </header>


  <!-- JavaScript for interactivity -->
  <script>
      const mobileMenuBtn = document.getElementById('mobileMenuBtn');
      const mobileMenu = document.getElementById('mobileMenu');

      mobileMenuBtn.addEventListener('click', () => {
          mobileMenu.classList.toggle('hidden');
      });
  </script>
