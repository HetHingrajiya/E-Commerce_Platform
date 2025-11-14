<x-app-layout>

    {{-- Ensure x-cloak hides elements before Alpine initializes --}}
    <style>
        body {
            background: linear-gradient(135deg, rgba(126, 206, 164, 0.85) 0%, rgba(74, 129, 216, 0.85) 100%);
        }

        [x-cloak] {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes glow-border {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.5), inset 0 0 20px rgba(99, 102, 241, 0.1);
            }

            50% {
                box-shadow: 0 0 40px rgba(99, 102, 241, 0.8), inset 0 0 30px rgba(99, 102, 241, 0.2);
            }
        }

        @keyframes gradient-shift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes shine {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        @keyframes rotate-subtle {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .animate-slide-in-up {
            animation: slideInUp 0.6s ease-out;
        }

        .animate-fade-in-scale {
            animation: fadeInScale 0.5s ease-out;
        }

        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-glow-border {
            animation: glow-border 3s ease-in-out infinite;
        }

        .animate-gradient-shift {
            animation: gradient-shift 8s ease infinite;
            background-size: 200% 200%;
        }

        .animate-shine {
            animation: shine 3s linear infinite;
            background-size: 1000px 100%;
        }

        .animate-rotate-subtle {
            animation: rotate-subtle 20s linear infinite;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-effect-dark {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>

    {{-- Make bannerCarousel available globally before Alpine initializes --}}
    <script>
        window.bannerCarousel = function({
            banners = [],
            interval = 3000
        } = {}) {
            return {
                defaultBanners: [{
                        title: 'New Season • Fresh Styles',
                        subtitle: 'Discover trending styles and exclusive collections with up to 50% off.',
                        image: '/storage/image/banner_1.png',
                        cta_text: 'Shop Now',
                        cta_url: '/products'
                    },
                    {
                        title: 'Exclusive Deals Weekly',
                        subtitle: 'Limited-time offers on your favorite items.',
                        image: '/storage/image/banner_2.png',
                        cta_text: 'Grab Deal',
                        cta_url: '/products'
                    },
                    {
                        title: 'Premium Quality Picks',
                        subtitle: 'Trusted brands and premium products only.',
                        image: '/storage/image/banner_3.png',
                        cta_text: 'Shop Premium',
                        cta_url: '/products'
                    },
                    {
                        title: 'Fast Delivery Worldwide',
                        subtitle: 'Track your orders instantly and get updates.',
                        image: '/storage/image/banner_4.png',
                        cta_text: 'Track Now',
                        cta_url: '/products'
                    },
                    {
                        title: 'Bestsellers of The Month',
                        subtitle: 'Top-rated products loved by our customers.',
                        image: '/storage/image/banner_5.png',
                        cta_text: 'See Bestsellers',
                        cta_url: '/products'
                    },
                    {
                        title: 'New Customer Offer',
                        subtitle: 'Get flat 10% OFF on your first order.',
                        image: '/storage/image/banner_3.png',
                        cta_text: 'Get Offer',
                        cta_url: '/products'
                    }
                ],
                banners: [],
                active: 0,
                timer: null,
                interval,
                isAutoPlay: true,

                init() {
                    const dynamic = Array.isArray(banners) ? banners : [];
                    this.banners = [...dynamic, ...this.defaultBanners].slice(0, 6);
                    if (!this.banners.length) this.banners = this.defaultBanners.slice(0, 6);

                    // start autoplay after a tiny delay so Alpine finishes init
                    setTimeout(() => this.play(), 50);

                    // keyboard navigation
                    window.addEventListener('keydown', (e) => {
                        if (e.key === 'ArrowLeft') this.prev();
                        if (e.key === 'ArrowRight') this.next();
                    });
                },

                play() {
                    if (!this.isAutoPlay) return;
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
                    this.play();
                },

                prev() {
                    this.active = (this.active - 1 + this.banners.length) % this.banners.length;
                    this.play();
                },

                goTo(i) {
                    this.active = i;
                    this.play();
                }
            };
        };
    </script>

    <!-- HERO / CAROUSEL BANNER -->
    <section class="w-full px-3 sm:px-4 md:px-6 lg:px-0 py-6 md:py-10">
        <div class="w-full max-w-7xl mx-auto" x-data="bannerCarousel({ banners: {!! json_encode($banners ?? []) !!}, interval: 4000 })" x-init="init()" x-cloak>
            <div class="relative w-full overflow-hidden shadow-2xl rounded-2xl sm:rounded-3xl border border-indigo-400/20 dark:border-indigo-600/30 animate-glow-border"
                @mouseenter="pause()" @mouseleave="play()"
                style="min-height: 300px; height: auto; aspect-ratio: 16/9; max-height: 500px; background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);">

                <!-- Slides -->
                <template x-for="(banner, idx) in banners" :key="idx">
                    <div class="absolute inset-0 w-full h-full grid grid-cols-1 md:grid-cols-2 items-center transition-all duration-1000 ease-in-out"
                        :class="active === idx ? 'opacity-100 z-10' : 'opacity-0 pointer-events-none z-0'">

                        <!-- Left Side - Text Content (Modern Gradient Background) -->
                        <div
                            class="relative p-5 sm:p-6 md:p-10 lg:p-12 text-white order-2 md:order-1 flex flex-col justify-center h-full bg-gradient-to-br from-indigo-600 via-purple-600 to-indigo-700 dark:from-indigo-900 dark:via-purple-900 dark:to-indigo-950 overflow-hidden">
                            <!-- Animated background elements -->
                            <div
                                class="absolute top-0 right-0 w-72 h-72 bg-gradient-to-br from-pink-400 to-purple-500 rounded-full -mr-36 -mt-36 blur-3xl opacity-20 animate-float">
                            </div>
                            <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-cyan-400 to-indigo-500 rounded-full -ml-32 -mb-32 blur-3xl opacity-20 animate-float"
                                style="animation-delay: 1s;"></div>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>

                            <div class="relative z-10 transform transition-all duration-700"
                                :class="active === idx ? 'translate-x-0 opacity-100' : '-translate-x-12 opacity-0'">


                                <h2 x-text="banner.title"
                                    class="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-black leading-tight mb-3 sm:mb-4 text-white drop-shadow-xl bg-gradient-to-r from-white via-indigo-50 to-purple-100 bg-clip-text text-transparent">
                                </h2>

                                <p x-text="banner.subtitle"
                                    class="text-xs sm:text-sm md:text-base text-indigo-100 max-w-sm leading-relaxed mb-6 sm:mb-8 font-medium hidden sm:block">
                                </p>

                                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                                    <a :href="banner.cta_url"
                                        class="group/btn relative bg-gradient-to-r from-white to-indigo-50 hover:from-indigo-50 hover:to-white dark:from-indigo-100 dark:to-gray-100 dark:hover:from-gray-100 dark:hover:to-indigo-100 text-indigo-700 dark:text-indigo-900 px-6 sm:px-8 py-2.5 sm:py-3.5 rounded-lg shadow-xl font-bold transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 active:scale-95 text-center text-xs sm:text-sm inline-block hover:shadow-2xl border border-white/30 overflow-hidden"
                                        x-text="banner.cta_text ?? 'Shop Now'">
                                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/40 to-transparent -skew-x-12 group-hover/btn:skew-x-12 transition-all duration-500"
                                            style="left: -100%; group-hover:left: 100%;"></div>
                                    </a>

                                    <a href="#features"
                                        class="group/btn2 glass-effect px-6 sm:px-8 py-2.5 sm:py-3.5 rounded-lg text-white font-bold transition-all duration-300 transform hover:scale-110 hover:-translate-y-1 active:scale-95 text-center text-xs sm:text-sm hidden sm:inline-block hover:glass-effect backdrop-blur-md">
                                        Learn More →
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Image (Modern Gradient) -->
                        <div
                            class="relative h-full hidden md:flex justify-center items-center order-1 md:order-2 bg-gradient-to-bl from-indigo-50 via-purple-50 to-pink-50 dark:from-indigo-500/40 dark:via-purple-500/40 dark:to-pink-500/40 overflow-hidden p-4 sm:p-5 md:p-6 lg:p-8">
                            <!-- Animated background pattern -->
                            <div class="absolute inset-0 opacity-40">
                                <div
                                    class="absolute top-10 right-10 w-32 h-32 bg-gradient-to-br from-indigo-300 to-purple-300 rounded-full blur-2xl animate-float">
                                </div>
                                <div class="absolute bottom-10 left-10 w-40 h-40 bg-gradient-to-tr from-pink-300 to-indigo-300 rounded-full blur-3xl animate-float"
                                    style="animation-delay: 1.5s;"></div>
                            </div>

                            <div
                                class="w-full h-full max-h-100 md:max-h-80 lg:max-h-96 flex items-center justify-center relative z-10">
                                <div class="relative w-full h-full">
                                    <img :src="banner.image" :alt="banner.title"
                                        class="w-full h-full object-contain transform transition-all duration-1000 rounded-2xl shadow-2xl "
                                        :class="active === idx ? 'scale-100 opacity-100' : 'scale-110 opacity-0'"
                                        loading="lazy" />
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Mobile Image Display (Modern) -->
                <div
                    class="md:hidden w-full flex items-center justify-center max-h-64 sm:max-h-72 overflow-hidden relative">
                    <template x-for="(banner, idx) in banners" :key="idx">
                        <img :src="banner.image" :alt="banner.title"
                            :class="active === idx ? 'opacity-25' : 'opacity-0'"
                            class="relative w-full h-auto object-contain transition-opacity duration-700 max-h-64 sm:max-h-72"
                            loading="lazy" />
                    </template>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-indigo-950/95 via-indigo-900/70 via-purple-900/50 to-transparent">
                    </div>
                </div>

                <!-- Slide Indicators (Modern Glass - Small) -->
                <div
                    class="absolute bottom-3 sm:bottom-4 md:bottom-5 left-1/2 -translate-x-1/2 flex gap-1.5 sm:gap-2 z-20 glass-effect px-2.5 py-2 rounded-full">
                    <template x-for="(b, i) in banners" :key="i">
                        <button @click="goTo(i)" :aria-label="'Go to slide ' + (i + 1)" type="button"
                            class="cursor-pointer transition-all duration-300 transform hover:scale-125 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                            :class="active === i ?
                                'w-7 h-2 sm:w-8 sm:h-2 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full shadow-lg shadow-indigo-400/50 animate-pulse' :
                                'w-2 h-2 sm:w-2 sm:h-2 bg-white/60 hover:bg-white rounded-full transition-all'">
                        </button>
                    </template>
                </div>


                <!-- Progress Bar (Small) -->
                <div class="absolute bottom-0 left-0 h-0.5 z-30 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-bl-2xl sm:rounded-bl-3xl transition-all duration-200"
                    :style="`width: ${(100 / interval) * (interval * (banners.length - active) / banners.length) || 0}%`">
                </div>


            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section id="features" class="w-full px-3 sm:px-4 md:px-6 lg:px-0 py-8 md:py-16">
        <div class="w-full max-w-7xl mx-auto">
            <h2
                class="text-2xl sm:text-3xl md:text-4xl font-bold text-center text-gray-900 dark:text-gray-100 mb-8 md:mb-12">
                Why Choose Us</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-5 md:gap-6">
                @php
                    $featureColors = [
                        [
                            'icon_bg' => 'from-blue-100 to-cyan-100 dark:from-blue-900/40 dark:to-cyan-900/40',
                            'icon_color' => 'text-blue-600 dark:text-blue-400',
                            'hover_border' => 'hover:border-blue-300 dark:hover:border-blue-700',
                        ],
                        [
                            'icon_bg' => 'from-emerald-100 to-teal-100 dark:from-emerald-900/40 dark:to-teal-900/40',
                            'icon_color' => 'text-emerald-600 dark:text-emerald-400',
                            'hover_border' => 'hover:border-emerald-300 dark:hover:border-emerald-700',
                        ],
                        [
                            'icon_bg' => 'from-orange-100 to-amber-100 dark:from-orange-900/40 dark:to-amber-900/40',
                            'icon_color' => 'text-orange-600 dark:text-orange-400',
                            'hover_border' => 'hover:border-orange-300 dark:hover:border-orange-700',
                        ],
                    ];
                @endphp
                @foreach ([['icon' => 'M3 7h18M3 12h18M3 17h18', 'title' => 'Wide Selection', 'text' => 'Explore thousands of quality products from trusted brands worldwide.'], ['icon' => 'M3 12h18M12 3v18', 'title' => 'Secure Checkout', 'text' => 'Your payments are protected with bank-level SSL encryption & security.'], ['icon' => 'M12 8v4l3 3', 'title' => 'Fast Delivery', 'text' => 'Quick shipping with real-time tracking & support available 24/7.']] as $i => $f)
                    <div
                        class="group bg-white/40 dark:bg-gray-700  p-5 sm:p-6 md:p-8 rounded-xl shadow-md hover:shadow-xl {{ $featureColors[$i]['hover_border'] }} transition-all duration-300 transform hover:-translate-y-2">
                        <div
                            class="flex-shrink-0 p-3 sm:p-4 bg-gradient-to-br {{ $featureColors[$i]['icon_bg'] }} rounded-lg w-fit mb-4 transition-all duration-300">
                            <svg class="h-6 w-6 sm:h-8 sm:w-8 {{ $featureColors[$i]['icon_color'] }} transition-transform duration-300 group-hover:scale-110"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <path d="{{ $f['icon'] }}" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            {{ $f['title'] }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-xs sm:text-sm leading-relaxed">
                            {{ $f['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PRODUCTS GRID -->
    <section class="w-full px-3 sm:px-4 md:px-6 lg:px-0 py-8 md:py-16">
        <div class="w-full max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 md:mb-8 gap-4">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100">Popular Products
                </h2>
                <a href="{{ route('products.index') }}"
                    class="text-indigo-600 dark:text-indigo-400 text-sm font-bold hover:underline transition">View all
                    products →</a>
            </div>

            <div
                class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 sm:gap-6 md:gap-7">
                @forelse ($products as $product)
                    <a href="{{ route('products.show', $product->id) }}"
                        class="group relative h-full flex flex-col rounded-xl overflow-hidden transition-all duration-500 transform hover:scale-105">

                        <!-- Card Background with Gradient -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-400 to-pink-200 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-xl">
                        </div>

                        <!-- White Card Container -->
                        <div
                            class="relative bg-white/60 dark:bg-gray-700 rounded-xl overflow-hidden h-full flex flex-col shadow-lg hover:shadow-2xl transition-all duration-500">

                            <!-- Image Section (ADDED BORDER HERE) -->
                            <div
                                class="relative w-full h-56 sm:h-64 overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 dark:from-gray-800 dark:to-gray-700 rounded-xl p-4 sm:p-5 border-2 border-transparent group-hover:border-indigo-400/50 dark:group-hover:border-indigo-600/50 duration-500">

                                <img src="{{ $product->image }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                    loading="lazy" alt="{{ $product->name }}">

                                <!-- Overlay Gradient -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                </div>

                            </div>

                            <!-- Content Section -->
                            <div class="flex-1 p-5 sm:p-6 flex flex-col justify-between">
                                <!-- Title & Rating -->
                                <div>
                                    <h3
                                        class="text-base sm:text-lg font-bold text-gray-900 dark:text-gray-100 line-clamp-2 mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                        {{ $product->name }}
                                    </h3>
                                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-3">
                                        {{ Str::limit($product->short_description, 50) }}
                                    </p>
                                </div>

                                <!-- Divider -->
                                <div
                                    class="h-px bg-gradient-to-r from-transparent via-indigo-300 to-transparent dark:via-indigo-700 my-3">
                                </div>

                                <!-- Price & CTA -->
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-2xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400 bg-clip-text text-transparent">
                                                ${{ number_format($product->price, 2) }}
                                            </span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 line-through">
                                                ${{ number_format($product->price * 1.25, 2) }}
                                            </span>
                                        </div>

                                    </div>

                                    <!-- Add to Cart Button -->
                                    <button type="button" onclick="event.preventDefault()"
                                        class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 opacity-0 group-hover:opacity-100 transform group-hover:translate-y-0 translate-y-2">
                                        🛒 Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="inline-block">
                            <p class="text-gray-400 dark:text-gray-500 text-lg font-semibold">📦 No products yet</p>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Check back soon for amazing deals!
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>


    <!-- CTA -->
    <section
        class="w-full px-3 sm:px-4 md:px-6 lg:px-0 py-8 md:py-16 dark:from-indigo-900/30 dark:via-purple-900/30 dark:to-pink-900/30">
        <div class="w-full max-w-7xl mx-auto">
            <div
                class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-600 dark:via-purple-600 dark:to-pink-600 border border-indigo-400/30 dark:border-indigo-600/30 p-6 sm:p-8 md:p-10 lg:p-12 rounded-2xl shadow-2xl backdrop-blur-sm">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -mr-20 -mt-20 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-white/5 rounded-full -ml-20 -mb-20 blur-2xl"></div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:justify-between lg:items-center gap-6 md:gap-8">
                    <div class="flex-1 text-white">
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-extrabold mb-2 sm:mb-3 leading-tight">✨ Never
                            miss exclusive deals!</h3>
                        <p class="text-sm sm:text-base text-indigo-100/90 leading-relaxed">Join thousands of happy
                            customers and get early access to sales, exclusive discounts, and new product launches
                            straight to your inbox.</p>
                    </div>

                    <form method="POST" action="#"
                        class="flex flex-col sm:flex-row gap-2 sm:gap-3 w-full lg:w-auto flex-shrink-0">
                        @csrf
                        <div class="relative flex-1 sm:flex-none">
                            <input type="email" placeholder="your@email.com" required
                                class="w-full sm:w-64 px-4 sm:px-6 py-3 sm:py-4 rounded-lg border-0 bg-white/95 backdrop-blur-sm hover:bg-white dark:bg-gray-100 dark:hover:bg-gray-200 text-gray-800 dark:text-gray-900 text-sm sm:text-base focus:outline-none focus:ring-4 focus:ring-white/50 dark:focus:ring-gray-300/50 placeholder-gray-400 transition-all duration-300">
                        </div>
                        <button type="submit"
                            class="px-6 sm:px-8 py-3 sm:py-4 bg-white hover:bg-gray-50 dark:bg-gray-100 dark:hover:bg-gray-200 text-indigo-600 dark:text-indigo-800 rounded-lg shadow-lg font-bold transition-all duration-300 transform hover:scale-105 active:scale-95 text-sm sm:text-base whitespace-nowrap hover:shadow-xl">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Additional scripts (kept minimal since bannerCarousel is global) --}}
    @push('scripts')
        <script>
            // optional: small sanity check after page loads
            document.addEventListener('alpine:init', () => {
                // console.log('Alpine initialized');
            });
        </script>
    @endpush

</x-app-layout>
