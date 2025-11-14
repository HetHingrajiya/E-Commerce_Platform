<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Profile') }}
            </h2>
            <div class="text-sm text-gray-500 dark:text-balck-400">
                Manage your account details, password, and settings.
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- SIDEBAR -->
                <aside class="lg:col-span-1 space-y-6">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 flex flex-col items-center text-center border border-blue-100 dark:border-gray-700">
                        <!-- Avatar -->
                        <div class="relative">
                            <img
                                src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'User') }}"
                                alt="{{ Auth::user()->name }}"
                                class="h-28 w-28 rounded-full object-cover border-4 border-blue-100 dark:border-gray-700 shadow-sm"
                            />
                            <a href="{{ route('profile.edit') }}" title="Edit avatar"
                               class="absolute -bottom-1 -right-1 bg-blue-600 hover:bg-blue-500 p-2 rounded-full shadow-md text-white focus-ring">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6 6L21 11l-6-6-6 6z"/>
                                </svg>
                            </a>
                        </div>

                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>

                        <div class="mt-4 flex gap-2 flex-wrap justify-center">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-medium dark:bg-blue-900/30 dark:text-blue-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Verified
                            </span>

                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-medium dark:bg-gray-700 dark:text-gray-200">
                                Member since
                                <span class="ml-1 text-xs text-gray-400">{{ Auth::user()->created_at ? Auth::user()->created_at->diffForHumans() : '' }}</span>
                            </span>
                        </div>

                        <div class="mt-6 w-full">
                            <a href="{{ route('home') }}"
                               class="w-full inline-flex justify-center items-center gap-2 px-4 py-2 rounded-md bg-blue-600 text-white text-sm font-medium hover:bg-blue-500 shadow focus-ring">
                                Dashboard
                            </a>
                            <a href="{{ route('products.index') }}"
                               class="mt-3 w-full inline-flex justify-center items-center gap-2 px-4 py-2 rounded-md border border-blue-200 text-blue-700 text-sm hover:bg-blue-50 dark:border-gray-600 dark:text-blue-300 dark:hover:bg-gray-700">
                                Browse Products
                            </a>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 p-4">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3 uppercase tracking-wide">Quick actions</h4>
                        <ul class="space-y-2 text-sm">
                            <li>
                                <a href="#profile-info" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Edit profile info
                                </a>
                            </li>
                            <li>
                                <a href="#change-password" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c.667 0 2 .333 2 1v2H8v-2c0-.667 1.333-1 2-1zM7 11V8a5 5 0 0110 0v3"/>
                                    </svg>
                                    Change password
                                </a>
                            </li>
                            <li>
                                <a href="#danger-zone" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-red-50 dark:hover:bg-gray-700 text-red-600 dark:text-red-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M5 20h14l-1-9H6l-1 9z"/>
                                    </svg>
                                    Delete account
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>

                <!-- MAIN CONTENT -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Profile info -->
                    <section id="profile-info" class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-blue-100 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 border-b pb-2">Profile Information</h3>
                        <div class="max-w-2xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </section>

                    <!-- Password -->
                    <section id="change-password" class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-blue-100 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 border-b pb-2">Change Password</h3>
                        <div class="max-w-2xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </section>

                    <!-- Danger zone -->
                    <section id="danger-zone" class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-red-100 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-semibold text-red-700 dark:text-red-400 mb-3 flex items-center justify-between border-b border-red-200 pb-2">
                            <span>Danger Zone</span>
                            <span class="text-sm text-gray-400">Handle with care</span>
                        </h3>
                        <div class="max-w-2xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
