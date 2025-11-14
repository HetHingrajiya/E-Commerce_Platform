<form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
    @csrf
    @method('DELETE')

    <div class="text-sm text-gray-600 mb-3">
        Once your account is deleted, all of its resources and data will be permanently deleted.
    </div>

    <div class="flex items-center gap-3">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-400">
            Delete Account
        </button>
    </div>
</form>
