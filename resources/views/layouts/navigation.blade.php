<header
  x-data="{
    mobileOpen: false,
    profileOpen: false,
    darkMode: false,
    initTheme() {
      const saved = localStorage.getItem('theme');
      if (saved === 'dark') this.darkMode = true;
      else if (saved === 'light') this.darkMode = false;
      else this.darkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
      this.applyTheme(this.darkMode);
    },
    applyTheme(isDark) {
      if (isDark) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
      } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
      }
    },
    toggleTheme() {
      this.darkMode = !this.darkMode;
      this.applyTheme(this.darkMode);
    }
  }"
  x-init="initTheme()"
  @keydown.escape.window="profileOpen = false; mobileOpen = false"
  class="sticky top-0 z-50 bg-white/60 dark:bg-gray-700/90 backdrop-blur-sm border-b border-gray-100/60 dark:border-gray-800/60"
>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center gap-4 py-3 md:py-4">

      <!-- LOGO -->
      <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0" aria-label="Home">
        <div class="flex items-center gap-3">
          <div class="rounded-lg p-2 bg-indigo-600 shadow-md flex items-center justify-center">
            <span class="text-white font-extrabold tracking-tight">SP</span>
          </div>
          <div class="hidden sm:block">
            <span class="text-lg font-semibold text-gray-800 dark:text-gray-100">Scipy</span>
            <div class="text-xs text-gray-500 dark:text-gray-400 -mt-1">Shop • Discover</div>
          </div>
        </div>
      </a>

      <!-- MOBILE HAMBURGER -->
      <button
        @click="mobileOpen = !mobileOpen"
        :aria-expanded="mobileOpen"
        aria-controls="mobile-nav"
        class="md:hidden ml-1 p-2 rounded-md focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"
        aria-label="Toggle navigation"
        type="button"
      >
        <svg x-show="!mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>

      <!-- SEARCH (center on md+) -->
      <div class="flex-1 hidden md:block">
        <form action="{{ Route::has('products.index') ? route('products.index') : url('/products') }}" method="GET" role="search" aria-label="Search products">
          <label for="site-search" class="sr-only">Search products, brands</label>
          <div class="relative">
            <input
              id="site-search"
              name="q"
              type="search"
              placeholder="Search products, brands..."
              value="{{ request('q') }}"
              class="w-full rounded-full py-3 pl-4 pr-12 text-sm border border-gray-200 shadow-sm bg-white/80 backdrop-blur-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300 transition dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100"
              autocomplete="off"
            />
            <button
              type="submit"
              class="absolute right-1 top-1/2 -translate-y-1/2 inline-flex items-center gap-2 px-3 py-1 rounded-full text-indigo-600 hover:bg-indigo-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-200 dark:hover:bg-indigo-900/30"
              aria-label="Search"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
              </svg>
              <span class="hidden lg:inline text-sm font-medium text-gray-700 dark:text-gray-200">Search</span>
            </button>
          </div>
        </form>
      </div>

      <!-- ACTIONS -->
      <nav class="flex items-center gap-3 ml-auto" aria-label="Top Navigation">

        <!-- Cart -->
        <a
          href="{{ Route::has('cart.index') ? route('cart.index') : url('/cart') }}"
          class="relative group flex items-center gap-2 px-2 py-1 rounded-md focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"
          aria-label="Cart"
          title="Cart"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 group-hover:text-indigo-600 dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <circle cx="7" cy="20" r="1" />
            <circle cx="17" cy="20" r="1" />
          </svg>
          <span class="hidden sm:inline text-sm text-gray-700 group-hover:text-indigo-600 dark:text-gray-200">Cart</span>
          <span aria-live="polite" class="absolute -top-1 -right-0.5 inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold leading-none text-white bg-indigo-600 rounded-full">
            {{ $cartCount ?? 0 }}
          </span>
        </a>

        <!-- Wishlist -->
        <a
          href="{{ Route::has('wishlist.index') ? route('wishlist.index') : url('/wishlist') }}"
          class="relative group flex items-center gap-2 px-2 py-1 rounded-md focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-200"
          aria-label="Wishlist"
          title="Wishlist"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 group-hover:text-pink-600 dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z" />
          </svg>
          <span class="hidden sm:inline text-sm text-gray-700 group-hover:text-pink-600 dark:text-gray-200">Wishlist</span>
          <span aria-live="polite" class="absolute -top-1 -right-0.5 inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold leading-none text-white bg-pink-600 rounded-full">
            {{ $wishlistCount ?? 0 }}
          </span>
        </a>

        <!-- Dark mode toggle -->
        <button
          type="button"
          @click="toggleTheme()"
          :aria-pressed="darkMode.toString()"
          class="p-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"
          title="Toggle dark mode"
        >
          <svg x-show="!darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-9H21M3 12H4.34M18.36 18.36l-.7.7M6.34 6.34l-.7.7M18.36 5.64l-.7-.7M6.34 17.66l-.7-.7M12 7a5 5 0 100 10 5 5 0 000-10z"/>
          </svg>
          <svg x-show="darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-200" viewBox="0 0 20 20" fill="currentColor">
            <path d="M17.293 13.293A8 8 0 116.707 2.707 7 7 0 0017.293 13.293z"/>
          </svg>
        </button>

        <!-- Authentication / Profile -->
        @guest
          <div class="hidden sm:flex items-center gap-2">
            @if (Route::has('login'))
              <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-indigo-600 dark:text-gray-200">Log in</a>
            @endif
            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="ml-1 inline-block bg-indigo-600 text-white px-3 py-1 rounded-full text-sm hover:bg-indigo-500">Sign up</a>
            @endif
          </div>
        @else
          <div class="relative" @click.away="profileOpen = false">
            <button
              @click.stop="profileOpen = !profileOpen"
              @keydown.escape="profileOpen = false"
              type="button"
              class="flex items-center gap-2 px-2 py-1 rounded-full hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"
              aria-haspopup="true"
              :aria-expanded="profileOpen"
              aria-label="Open profile menu"
            >
              <img
                src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'U') }}"
                alt="Profile"
                class="h-8 w-8 rounded-full object-cover border border-gray-200 dark:border-gray-700"
              />
              <span class="hidden md:inline text-sm text-gray-700 dark:text-gray-200 truncate max-w-[8rem]">{{ Auth::user()->name ?? 'You' }}</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>

            <div
              x-show="profileOpen"
              x-cloak
              x-transition:enter="transition ease-out duration-150"
              x-transition:enter-start="opacity-0 translate-y-1"
              x-transition:enter-end="opacity-100 translate-y-0"
              x-transition:leave="transition ease-in duration-100"
              x-transition:leave-start="opacity-100 translate-y-0"
              x-transition:leave-end="opacity-0 translate-y-1"
              class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-md shadow-lg py-1 text-sm"
              style="display: none;"
            >
              @if (Route::has('dashboard'))
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 dark:text-gray-100">Dashboard</a>
              @endif

              @if (Route::has('profile.edit'))
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 dark:text-gray-100">Profile</a>
              @endif

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 dark:text-gray-100">Logout</button>
              </form>
            </div>
          </div>
        @endguest
      </nav>
    </div>
  </div>

  <!-- MOBILE NAV (slide down) -->
  <div id="mobile-nav" x-show="mobileOpen" x-cloak class="md:hidden border-t border-gray-100 dark:border-gray-800 bg-white/95 dark:bg-gray-900/90 backdrop-blur-sm">
    <div class="px-4 py-3 space-y-3">
      <form action="{{ Route::has('products.index') ? route('products.index') : url('/products') }}" method="GET" role="search" aria-label="Search products">
        <label for="mobile-search" class="sr-only">Search</label>
        <div class="relative">
          <input id="mobile-search" name="q" type="search" placeholder="Search products, brands..." value="{{ request('q') }}" class="w-full rounded-full py-2 pl-4 pr-10 text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 dark:text-gray-100" />
          <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 p-1 rounded-full" aria-label="Search" @click="mobileOpen = false">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700 dark:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
          </button>
        </div>
      </form>

      <div class="flex flex-col gap-1">
        <a href="{{ Route::has('cart.index') ? route('cart.index') : url('/cart') }}" class="px-3 py-2 rounded-md hover:bg-gray-50 dark:hover:bg-gray-800" @click="mobileOpen = false">Cart</a>
        <a href="{{ Route::has('wishlist.index') ? route('wishlist.index') : url('/wishlist') }}" class="px-3 py-2 rounded-md hover:bg-gray-50 dark:hover:bg-gray-800" @click="mobileOpen = false">Wishlist</a>

        @guest
          @if (Route::has('login')) <a href="{{ route('login') }}" class="px-3 py-2 rounded-md hover:bg-gray-50 dark:hover:bg-gray-800" @click="mobileOpen = false">Log in</a> @endif
          @if (Route::has('register')) <a href="{{ route('register') }}" class="px-3 py-2 rounded-md hover:bg-gray-50 dark:hover:bg-gray-800" @click="mobileOpen = false">Sign up</a> @endif
        @else
          @if (Route::has('dashboard')) <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md hover:bg-gray-50 dark:hover:bg-gray-800" @click="mobileOpen = false">Dashboard</a> @endif
          @if (Route::has('profile.edit')) <a href="{{ route('profile.edit') }}" class="px-3 py-2 rounded-md hover:bg-gray-50 dark:hover:bg-gray-800" @click="mobileOpen = false">Profile</a> @endif

          <form method="POST" action="{{ route('logout') }}" class="px-3 py-2" @submit="mobileOpen = false">
            @csrf
            <button type="submit" class="w-full text-left">Logout</button>
          </form>
        @endguest
      </div>
    </div>
  </div>
</header>

<!-- pre-CSS script (keeps page from flashing wrong theme) -->
<script>
  (function() {
    try {
      const theme = localStorage.getItem('theme');
      if (theme === 'dark' || (!theme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    } catch (e) { /* ignore */ }
  })();
</script>
