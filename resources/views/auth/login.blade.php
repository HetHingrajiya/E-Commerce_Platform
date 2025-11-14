<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login • Modern Design</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    .glass {
      background: linear-gradient(135deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
      backdrop-filter: blur(6px);
    }
  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-800 text-slate-100">
  <div class="container mx-auto px-4 py-10 lg:py-16">
    <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

      <!-- Left: Illustration / Brand -->
      <div class="flex flex-col gap-6 items-start">
        <div class="w-full rounded-2xl overflow-hidden shadow-2xl">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1600&auto=format&fit=crop"
               alt="Welcome"
               class="w-full h-56 sm:h-72 lg:h-96 object-cover">
        </div>
        <div class="text-left">
          <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">
            Welcome back to <span class="text-indigo-400">YourStore</span>
          </h1>
          <p class="mt-2 text-slate-300">
            Sign in to access your dashboard, orders, and wishlist.
            New here? <a class="text-indigo-300 underline" href="{{ route('register') }}">Create an account</a>.
          </p>
        </div>
      </div>

      <!-- Right: Login Card -->
      <main class="glass rounded-3xl p-6 sm:p-8 md:p-10 shadow-xl border border-white/10" aria-labelledby="loginHeading">

        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-lg">Y</div>
            <div>
              <div class="font-semibold">YourStore</div>
              <div class="text-xs text-slate-400">Secure sign in</div>
            </div>
          </div>
          <div class="text-xs text-slate-400 hidden sm:block">
            Need help? <a href="#" class="underline">Contact support</a>
          </div>
        </div>

        <h2 id="loginHeading" class="sr-only">Login to YourStore</h2>

        <!-- Social login -->
        <div class="grid grid-cols-3 gap-3 mb-5">
          <a href="#"
             class="flex items-center justify-center gap-2 py-2 rounded-lg border border-white/10 text-sm bg-white/5 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-400/50"
             aria-label="Sign in with Google">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 48 48" fill="none">
              <path d="M44 24.5c0-1.4-.1-2.8-.4-4.1H24v7.9h11.9c-.5 3-2.5 5.6-5.2 7.3v6h8.4c4.9-4.5 7.9-11 7.9-17.1z" fill="#4285F4"/>
              <path d="M24 44c5.9 0 10.8-1.9 14.4-5.1l-8.4-6c-2.3 1.6-5.1 2.6-8 2.6-6.2 0-11.4-4.1-13.3-9.6H2.8v6.1C6.5 38.8 14.7 44 24 44z" fill="#34A853"/>
              <path d="M10.7 27.9c-.6-1.8-1-3.7-1-5.9s.4-4 1-5.9V9.9H2.8C.9 13 0 17.4 0 22c0 4.6.9 9 2.8 12.1l7.9-6.2z" fill="#FBBC05"/>
              <path d="M24 9.6c3.2 0 6 .9 8.3 2.7l6.2-6.1C34.7 3 29.8 0 24 0 14.7 0 6.5 5.2 2.8 12.9l7.9 6.1C12.6 13.7 17.8 9.6 24 9.6z" fill="#EA4335"/>
            </svg>
            <span class="hidden sm:inline">Google</span>
          </a>

          <a href="#"
             class="flex items-center justify-center gap-2 py-2 rounded-lg border border-white/10 text-sm bg-white/5 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-400/50"
             aria-label="Sign in with Facebook">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07c0 4.84 3.44 8.86 8 9.77v-6.92H7.47v-2.85h2.53V9.41c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.85h-2.34V21.8c4.56-.91 8-4.93 8-9.73z"/></svg>
            <span class="hidden sm:inline">Facebook</span>
          </a>

          <a href="#"
             class="flex items-center justify-center gap-2 py-2 rounded-lg border border-white/10 text-sm bg-white/5 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-indigo-400/50"
             aria-label="Other sign in options">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zM8.5 15.5l.7-2.1 1.5 1.1 3.2-4.9 1 1.1-4.2 6.5-2.2-1.2z"/></svg>
            <span class="hidden sm:inline">More</span>
          </a>
        </div>

        <div class="relative my-3 text-center">
          <span class="inline-block w-full border-t border-white/10"></span>
          <span class="absolute left-1/2 -translate-x-1/2 bg-slate-900/60 px-3 text-xs text-slate-300">or continue with email</span>
        </div>

        {{-- ✅ Error / status message area --}}
        @if(session('status') || session('error') || $errors->any())
          <div class="mb-4 space-y-2">
            @if(session('status'))
              <div class="rounded-md bg-green-50 p-3 text-sm text-green-700 border border-green-100">
                {{ session('status') }}
              </div>
            @endif

            @if(session('error'))
              <div class="rounded-md bg-rose-50 p-3 text-sm text-rose-700 border border-rose-100">
                {{ session('error') }}
              </div>
            @endif

            @if($errors->any())
              <div class="rounded-md bg-rose-50 p-3 text-sm text-rose-700 border border-rose-100">
                {{ $errors->first() }}
              </div>
            @endif
          </div>
        @endif

        <!-- Email/Password Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4" novalidate aria-describedby="formHelp">
          @csrf

          <div>
            <label for="email" class="text-sm font-medium text-slate-200">Email</label>
            <input id="email" name="email" type="email" required autofocus autocomplete="username"
                   value="{{ old('email') }}"
                   class="mt-2 w-full rounded-lg border border-white/10 bg-transparent px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-rose-400" />
          </div>

          <div>
            <label for="password" class="text-sm font-medium text-slate-200">Password</label>
            <div class="mt-2 relative">
              <input id="password" name="password" type="password" required autocomplete="current-password"
                     class="w-full rounded-lg border border-white/10 bg-transparent px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
              <button type="button" id="togglePassword"
                      class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-300 text-sm px-2 py-1 rounded-md focus:outline-none">
                Show
              </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-rose-400" />
          </div>

          <div class="flex items-center justify-between">
            <label class="inline-flex items-center text-sm text-slate-300">
              <input id="remember_me" type="checkbox" name="remember"
                     class="rounded text-indigo-500 focus:ring-indigo-500" />
              <span class="ml-2">Remember me</span>
            </label>

            @if (Route::has('password.request'))
              <a class="text-sm text-indigo-300 underline" href="{{ route('password.request') }}">
                Forgot your password?
              </a>
            @endif
          </div>

          <div>
            <button type="submit"
                    class="w-full py-3 rounded-lg bg-gradient-to-r from-indigo-500 to-violet-500 font-medium hover:from-indigo-600 hover:to-violet-600 focus:outline-none focus:ring-4 focus:ring-indigo-500/30">
              Log in
            </button>
          </div>

          <!-- Signup Link -->
          <div class="text-center mt-4 text-sm text-slate-300">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-indigo-400 underline hover:text-indigo-300">
              Sign up here
            </a>.
          </div>
        </form>

        <div id="formHelp" class="mt-6 text-center text-xs text-slate-400">
          By continuing you agree to our
          <a href="#" class="underline">Terms</a> and
          <a href="#" class="underline">Privacy Policy</a>.
        </div>

      </main>
    </div>
  </div>

  <script>
    // Toggle show/hide password
    (function() {
      const btn = document.getElementById('togglePassword');
      const pw = document.getElementById('password');
      if (!btn || !pw) return;
      btn.addEventListener('click', () => {
        if (pw.type === 'password') {
          pw.type = 'text';
          btn.textContent = 'Hide';
        } else {
          pw.type = 'password';
          btn.textContent = 'Show';
        }
      });
    })();
  </script>

</body>
</html>
