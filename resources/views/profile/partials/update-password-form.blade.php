<form
  method="POST"
  action="{{ route('password.update') }}"
  class="space-y-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6"
  x-data="{
    submitting: false,
    showSuccess: {{ json_encode(session('status') === 'password-updated') }},
    curVisible: false,
    newVisible: false,
    confirmVisible: false,
    password: '',
    get strengthScore() {
      let s = 0;
      const pw = this.password || '';
      if (pw.length >= 8) s += 1;
      if (/[A-Z]/.test(pw)) s += 1;
      if (/[0-9]/.test(pw)) s += 1;
      if (/[^A-Za-z0-9]/.test(pw)) s += 1;
      return s; // 0..4
    },
    get strengthLabel() {
      const map = ['Very weak','Weak','Okay','Strong','Very strong'];
      return map[this.strengthScore] || 'Very weak';
    }
  }"
  x-init="$watch('showSuccess', v => { if (v) setTimeout(()=> showSuccess = false, 3500) })"
  x-on:submit="submitting = true"
  novalidate
>
  @csrf
  @method('PUT')

  <!-- Success notice -->
  <template x-if="showSuccess">
    <div x-cloak role="status" aria-live="polite"
         class="rounded-md bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 p-3 text-green-800 dark:text-green-200 text-sm flex items-center gap-3">
      <svg class="h-5 w-5 flex-shrink-0 text-green-600 dark:text-green-200" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414L9 13.414l4.707-4.707z" clip-rule="evenodd"/>
      </svg>
      <div>
        <p class="font-medium">Password updated.</p>
      </div>
    </div>
  </template>

  @if (session('status') === 'password-updated')
    <div role="status" aria-live="polite" class="rounded-md bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 p-3 text-green-800 dark:text-green-200 text-sm">
      Password updated.
    </div>
  @endif

  <!-- Current password -->
  <div>
    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Current password</label>
    <div class="mt-1 relative rounded-md shadow-sm">
      <input
        id="current_password"
        name="current_password"
        type="password"
        required
        aria-required="true"
        class="peer block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-indigo-500 pr-10"
        :type="curVisible ? 'text' : 'password'"
        autocomplete="current-password"
      />
      <button
        type="button"
        @click="curVisible = !curVisible"
        class="absolute inset-y-0 right-0 pr-2 flex items-center text-sm"
        :aria-label="curVisible ? 'Hide current password' : 'Show current password'"
        tabindex="-1"
      >
        <svg x-show="!curVisible" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        </svg>
        <svg x-show="curVisible" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.403-3.586M6.2 6.2l11.6 11.6" />
        </svg>
      </button>
    </div>
    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
  </div>

  <!-- New password -->
  <div>
    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">New password</label>
    <div class="mt-1 relative rounded-md shadow-sm">
      <input
        id="password"
        name="password"
        x-model="password"
        :type="newVisible ? 'text' : 'password'"
        required
        aria-required="true"
        autocomplete="new-password"
        class="peer block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-indigo-500 pr-10"
        placeholder="At least 8 characters"
      />
      <button
        type="button"
        @click="newVisible = !newVisible"
        class="absolute inset-y-0 right-0 pr-2 flex items-center text-sm"
        :aria-label="newVisible ? 'Hide new password' : 'Show new password'"
        tabindex="-1"
      >
        <svg x-show="!newVisible" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        </svg>
        <svg x-show="newVisible" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.403-3.586M6.2 6.2l11.6 11.6" />
        </svg>
      </button>
    </div>

    <!-- Strength meter -->
    <div class="mt-2">
      <div class="h-2 bg-gray-100 dark:bg-gray-700 rounded overflow-hidden">
        <div
          :class="{
            'w-0 bg-red-400 dark:bg-red-500': strengthScore === 0,
            'w-1/4 bg-red-400 dark:bg-red-500': strengthScore === 1,
            'w-2/4 bg-yellow-400 dark:bg-yellow-500': strengthScore === 2,
            'w-3/4 bg-indigo-400 dark:bg-indigo-500': strengthScore === 3,
            'w-full bg-green-500 dark:bg-green-500': strengthScore === 4
          }"
          class="h-full transition-all duration-200"
        ></div>
      </div>
      <p class="text-xs text-gray-500 dark:text-gray-300 mt-1">Strength: <span x-text="strengthLabel"></span></p>
    </div>

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
  </div>

  <!-- Confirm password -->
  <div>
    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Confirm password</label>
    <div class="mt-1 relative rounded-md shadow-sm">
      <input
        id="password_confirmation"
        name="password_confirmation"
        :type="confirmVisible ? 'text' : 'password'"
        required
        aria-required="true"
        autocomplete="new-password"
        class="peer block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-indigo-500 pr-10"
      />
      <button
        type="button"
        @click="confirmVisible = !confirmVisible"
        class="absolute inset-y-0 right-0 pr-2 flex items-center text-sm"
        :aria-label="confirmVisible ? 'Hide confirm password' : 'Show confirm password'"
        tabindex="-1"
      >
        <svg x-show="!confirmVisible" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        </svg>
        <svg x-show="confirmVisible" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.403-3.586M6.2 6.2l11.6 11.6" />
        </svg>
      </button>
    </div>
    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
  </div>

  <!-- Actions -->
  <div class="flex items-center justify-end gap-3">
    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-md text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
      Cancel
    </a>

    <button
      type="submit"
      class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 dark:bg-indigo-500 text-white rounded-md text-sm font-medium hover:bg-indigo-500 dark:hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 disabled:opacity-60"
      :disabled="submitting"
      aria-live="polite"
    >
      <svg x-show="submitting" x-cloak class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0h-2a6 6 0 10-12 0H4z"></path>
      </svg>

      <span x-text="submitting ? 'Saving...' : 'Change password'">Change password</span>
    </button>
  </div>
</form>
