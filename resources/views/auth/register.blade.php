<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Register • Modern Design</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .glass { background: linear-gradient(135deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02)); backdrop-filter: blur(6px); }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-800 text-slate-100">

  <div class="container mx-auto px-4 py-10 lg:py-16">
    <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">

      <!-- Left: Illustration / Message -->
      <div class="flex flex-col gap-6 items-start">
        <div class="w-full rounded-2xl overflow-hidden shadow-2xl">
          <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1600&auto=format&fit=crop"
               alt="Register illustration"
               class="w-full h-56 sm:h-72 lg:h-96 object-cover">
        </div>
        <div class="text-left">
          <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">
            Create your <span class="text-indigo-400">YourStore</span> account
          </h1>
          <p class="mt-2 text-slate-300">
            Join our community to shop exclusive collections and manage your wishlist.
          </p>
        </div>
      </div>

      <!-- Right: Register Form -->
      <main class="glass rounded-3xl p-6 sm:p-8 md:p-10 shadow-xl border border-white/6" aria-labelledby="registerHeading">
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-lg">Y</div>
            <div>
              <div class="font-semibold">YourStore</div>
              <div class="text-xs text-slate-400">Start your journey</div>
            </div>
          </div>
          <div class="text-xs text-slate-400 hidden sm:block">Need help? <a href="#" class="underline">Contact support</a></div>
        </div>

        <h2 id="registerHeading" class="sr-only">Create your YourStore account</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4" novalidate>
          @csrf

          <!-- Name -->
          <div>
            <label for="name" class="text-sm font-medium text-slate-200">Name</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
              class="mt-2 w-full rounded-lg border border-white/6 bg-transparent px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-rose-400" />
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="text-sm font-medium text-slate-200">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
              class="mt-2 w-full rounded-lg border border-white/6 bg-transparent px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-rose-400" />
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="text-sm font-medium text-slate-200">Password</label>
            <div class="mt-2 relative">
              <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full rounded-lg border border-white/6 bg-transparent px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
              <button type="button" id="togglePassword"
                      class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-300 text-sm px-2 py-1 rounded-md focus:outline-none">
                Show
              </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-rose-400" />
          </div>

          <!-- Confirm Password -->
          <div>
            <label for="password_confirmation" class="text-sm font-medium text-slate-200">Confirm Password</label>
            <div class="mt-2 relative">
              <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full rounded-lg border border-white/6 bg-transparent px-4 py-3 pr-12 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
              <button type="button" id="togglePasswordConfirm"
                      class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-300 text-sm px-2 py-1 rounded-md focus:outline-none">
                Show
              </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-rose-400" />
          </div>

          <div class="pt-2">
            <button type="submit"
              class="w-full py-3 rounded-lg bg-gradient-to-r from-indigo-500 to-violet-500 font-medium hover:from-indigo-600 hover:to-violet-600 focus:outline-none focus:ring-4 focus:ring-indigo-500/30">
              Register
            </button>
          </div>

          <!-- Login link -->
          <div class="text-center mt-4 text-sm text-slate-300">
            Already registered?
            <a href="{{ route('login') }}" class="text-indigo-400 underline hover:text-indigo-300">Login here</a>.
          </div>
        </form>
      </main>

    </div>
  </div>

  <!-- Password toggle -->
  <script>
    (function(){
      const pw = document.getElementById('password');
      const togglePw = document.getElementById('togglePassword');
      const pwc = document.getElementById('password_confirmation');
      const togglePwc = document.getElementById('togglePasswordConfirm');

      if (togglePw && pw) {
        togglePw.addEventListener('click', () => {
          pw.type = pw.type === 'password' ? 'text' : 'password';
          togglePw.textContent = pw.type === 'password' ? 'Show' : 'Hide';
        });
      }
      if (togglePwc && pwc) {
        togglePwc.addEventListener('click', () => {
          pwc.type = pwc.type === 'password' ? 'text' : 'password';
          togglePwc.textContent = pwc.type === 'password' ? 'Show' : 'Hide';
        });
      }
    })();
  </script>

</body>
</html>
