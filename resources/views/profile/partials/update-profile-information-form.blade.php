<!-- MAIN PROFILE UPDATE FORM -->
<form
  method="POST"
  action="{{ route('profile.update') }}"
  class="space-y-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6"
  x-data="{ submitting: false, showSuccess: {{ json_encode(session('status') === 'profile-updated') }} }"
  x-init="if (showSuccess) setTimeout(()=> showSuccess = false, 3000)"
  x-on:submit="submitting = true"
  novalidate
>
  @csrf
  @method('PATCH')

  <!-- Success notice (Alpine-controlled for auto-hide) -->
  <template x-if="showSuccess">
    <div x-cloak role="status" aria-live="polite"
         class="rounded-md bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 p-3 text-green-800 dark:text-green-200 text-sm flex items-start gap-3">
      <svg class="h-5 w-5 flex-shrink-0 text-green-600 dark:text-green-200" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414L9 13.414l4.707-4.707z" clip-rule="evenodd"/>
      </svg>
      <div>Profile updated.</div>
    </div>
  </template>

  <!-- Name -->
  <div>
    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
    <div class="mt-1 relative rounded-md shadow-sm">
      <input
        id="name"
        name="name"
        type="text"
        value="{{ old('name', $user->name) }}"
        required
        autofocus
        aria-required="true"
        aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
        class="peer block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 placeholder-gray-400 text-sm leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500"
        placeholder="Your full name"
      />
    </div>
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
  </div>

  <!-- Email -->
  <div>
    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
    <div class="mt-1 relative rounded-md shadow-sm">
      <input
        id="email"
        name="email"
        type="email"
        value="{{ old('email', $user->email) }}"
        required
        aria-required="true"
        aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
        class="peer block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 placeholder-gray-400 text-sm leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500"
        placeholder="you@example.com"
      />
    </div>
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
  </div>

  <!-- Email verification NOTE (no nested form) -->
  @if (method_exists($user, 'hasVerifiedEmail') && ! $user->hasVerifiedEmail())
    <div class="text-sm text-gray-600 dark:text-gray-300 flex items-center gap-3">
      <span>Your email is not verified.</span>

      <!-- Visible button that submits the hidden resend form (no nesting) -->
      <button
        type="button"
        class="ml-2 text-blue-600 dark:text-blue-400 hover:text-blue-500 underline text-sm"
        @click="$el.nextElementSibling.querySelector('form#resend-verification-form').submit()"
      >
        Resend verification
      </button>
    </div>
  @endif

  <!-- Actions -->
  <div class="flex items-center justify-end gap-3">
    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-md text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
      Cancel
    </a>

    <button
      type="submit"
      class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded-md text-sm font-medium hover:bg-blue-500 dark:hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-60"
      :disabled="submitting"
      :aria-disabled="submitting ? 'true' : 'false'"
      aria-live="polite"
    >
      <svg x-show="submitting" x-cloak class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0116 0h-2a6 6 0 10-12 0H4z"></path>
      </svg>

      <span x-text="submitting ? 'Saving...' : 'Save'">Save</span>
    </button>
  </div>
</form>

<!-- HIDDEN resend-verification form placed OUTSIDE the main form (prevents nesting) -->
@if (method_exists($user, 'hasVerifiedEmail') && ! $user->hasVerifiedEmail())
  <div aria-hidden="true" class="hidden">
    <form id="resend-verification-form" method="POST" action="{{ route('verification.send') }}">
      @csrf
    </form>
  </div>
@endif
