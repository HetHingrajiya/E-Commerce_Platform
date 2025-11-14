<x-app-layout>

    <!-- HERO / CAROUSEL -->
    <section class="container mx-auto px-4 mt-10">
        <div x-data="bannerCarousel({ banners: {!! json_encode($banners ?? []) !!}, interval: 5000 })" x-init="init()" x-cloak
            class="relative overflow-hidden rounded-xl bg-white dark:bg-gray-900 shadow-lg dark:shadow-xl border border-gray-200 dark:border-gray-800"
            @mouseenter="pause()" @mouseleave="play()" style="min-height: 340px;">

            <!-- Slides -->
            <template x-for="(banner, idx) in banners" :key="idx">
                <a :href="banner.cta_url ?? '#'"
                    class="absolute inset-0 grid md:grid-cols-2 items-center transition-opacity duration-700"
                    :class="active === idx ? 'opacity-100 z-10' : 'opacity-0 pointer-events-none z-0'">
                    <div class="p-8">
                        <h2 x-text="banner.title"
                            class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-gray-50">
                        </h2>

                        <p x-text="banner.subtitle" class="mt-3 text-gray-600 dark:text-gray-300 max-w-md">
                        </p>

                        <div class="mt-6 flex gap-3">
                            <a :href="banner.cta_url"
                                class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg shadow font-semibold"
                                x-text="banner.cta_text ?? 'Shop Now'">
                            </a>

                            <a href="#features"
                                class="border border-gray-300 dark:border-gray-700 px-4 py-2 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                                Why Choose Us
                            </a>
                        </div>
                    </div>

                    <div class="p-6 hidden md:flex justify-center bg-gray-50 dark:bg-gray-800">
                        <img :src="banner.image" class="w-full max-w-md rounded-lg shadow object-cover h-64"
                            loading="lazy" />
                    </div>
                </a>
            </template>

            <!-- Controls -->
            <button @click="prev()"
                class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-gray-800/80 hover:bg-white dark:hover:bg-gray-700 p-3 rounded-full shadow">
                <svg class="h-6 w-6 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor">
                    <path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <button @click="next()"
                class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/90 dark:bg-gray-800/80 hover:bg-white dark:hover:bg-gray-700 p-3 rounded-full shadow">
                <svg class="h-6 w-6 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor">
                    <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <!-- Dots -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                <template x-for="(b, i) in banners" :key="i">
                    <div @click="goTo(i)" class="cursor-pointer transition-all"
                        :class="active === i ?
                            'w-8 h-2 bg-indigo-600 rounded-full' :
                            'w-3 h-3 bg-white dark:bg-gray-700 border border-gray-400 rounded-full'">
                    </div>
                </template>
            </div>

        </div>
    </section>

    <!-- FEATURES -->
    <section id="features" class="mt-10 grid md:grid-cols-3 gap-6">
        @foreach ([['icon' => 'M3 7h18M3 12h18M3 17h18', 'title' => 'Wide Selection', 'text' => 'Thousands of products.'], ['icon' => 'M3 12h18M12 3v18', 'title' => 'Secure Checkout', 'text' => 'Trusted payments & encryption.'], ['icon' => 'M12 8v4l3 3', 'title' => 'Fast Delivery', 'text' => 'Quick shipping & tracking.']] as $f)
            <div
                class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 p-6 rounded-lg shadow flex gap-4">
                <div class="p-3 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                    <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor">
                        <path d="{{ $f['icon'] }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $f['title'] }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $f['text'] }}</p>
                </div>
            </div>
        @endforeach
    </section>

    <!-- PRODUCTS GRID -->
    <section class="mt-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Popular Products</h2>
            <a href="{{ route('products.index') }}" class="text-indigo-600 dark:text-indigo-400 text-sm">View all</a>
        </div>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <a href="{{ route('products.show', $product->id) }}"
                    class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg shadow group overflow-hidden">

                    <div class="aspect-w-1 aspect-h-1 bg-gray-100 dark:bg-gray-800">
                        <img src="{{ $product->image }}"
                            class="object-cover w-full h-full group-hover:scale-105 transition" loading="lazy">
                    </div>

                    <div class="p-4">
                        <h3 class="text-gray-800 dark:text-gray-100 font-medium truncate">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            {{ Str::limit($product->short_description, 60) }}</p>

                        <div class="mt-3 flex justify-between items-center">
                            <span
                                class="text-indigo-600 dark:text-indigo-400 font-semibold">${{ number_format($product->price, 2) }}</span>
                            <span class="text-gray-400 text-sm">Free ship</span>
                        </div>
                    </div>

                </a>
            @empty
                <p class="text-gray-500 dark:text-gray-400">No products available.</p>
            @endforelse
        </div>
    </section>

    <!-- CTA -->
    <section
        class="mt-12 bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-900/30 p-6 rounded-lg flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Get updates on exclusive deals!</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300">Subscribe to our newsletter for early access.</p>
        </div>

        <form method="POST" action="#" class="flex gap-3">
            @csrf
            <input type="email" placeholder="Your email"
                class="px-4 py-2 rounded-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-400">
            <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-full shadow">
                Subscribe
            </button>
        </form>
    </section>

    <!-- CAROUSEL SCRIPT -->
    @push('scripts')
        <script>
            function bannerCarousel({
                banners = [],
                interval = 5000
            } = {}) {
                return {
                    // 6 fallback / default banners (pointing to public/storage/image/*)
                    defaultBanners: [{
                            title: 'New Season • Fresh Styles',
                            subtitle: 'Discover trending styles.',
                            image: '/storage/image/banner_1.jpg',
                            cta_text: 'Explore',
                            cta_url: '/products'
                        },
                        {
                            title: 'Exclusive Deals Weekly',
                            subtitle: 'Limited-time offers.',
                            image: '/storage/image/banner_2.jpg',
                            cta_text: 'Grab Deal',
                            cta_url: '/offers'
                        },
                        {
                            title: 'Premium Quality Picks',
                            subtitle: 'Trusted brands only.',
                            image: '/storage/image/banner_3.jpg',
                            cta_text: 'Shop Premium',
                            cta_url: '/products'
                        },
                        {
                            title: 'Fast Delivery Worldwide',
                            subtitle: 'Track orders instantly.',
                            image: '/storage/image/banner_4.jpg',
                            cta_text: 'Track Now',
                            cta_url: '/orders'
                        },
                        {
                            title: 'Bestsellers of The Month',
                            subtitle: 'Top-rated products.',
                            image: '/storage/image/banner_5.jpg',
                            cta_text: 'See Bestsellers',
                            cta_url: '/products'
                        },
                        {
                            title: 'New Customer Offer',
                            subtitle: 'Flat 10% OFF on first order.',
                            image: '/storage/image/banner_6.jpg',
                            cta_text: 'Get Offer',
                            cta_url: '/register'
                        }
                    ],

                    // merged banner array (this will be populated in init)
                    banners: [],
                    active: 0,
                    timer: null,
                    interval,

                    init() {
                        // dynamic is any banners passed from backend
                        const dynamic = Array.isArray(banners) ? banners : [];

                        // merge dynamic first, then defaults, limit to 6
                        this.banners = [...dynamic, ...this.defaultBanners].slice(0, 6);

                        // ensure there is at least one banner
                        if (!this.banners.length) {
                            this.banners = this.defaultBanners.slice(0, 6);
                        }

                        // start autoplay after a tiny delay so Alpine finishes init
                        setTimeout(() => this.play(), 50);

                        // keyboard navigation
                        window.addEventListener('keydown', (e) => {
                            if (e.key === 'ArrowLeft') this.prev();
                            if (e.key === 'ArrowRight') this.next();
                        });
                    },

                    play() {
                        this.clearTimer();
                        this.timer = setInterval(() => this.next(), this.interval);
                    },

                    pause() {
                        this.clearTimer();
                    },

                    clearTimer() {
                        if (this.timer) {
                            clearInterval(this.timer);
                            this.timer = null;
                        }
                    },

                    next() {
                        this.active = (this.active + 1) % this.banners.length;
                    },

                    prev() {
                        this.active = (this.active - 1 + this.banners.length) % this.banners.length;
                    },

                    goTo(i) {
                        this.active = i;
                        this.play();
                    }
                };
            }
        </script>
    @endpush


</x-app-layout>
