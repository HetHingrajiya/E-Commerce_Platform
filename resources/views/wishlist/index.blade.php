<x-app-layout>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800">My Wishlist</h1>

    @if(session('success'))
      <div class="mb-4 text-sm text-green-700 bg-green-100 p-3 rounded-md shadow-sm">
        {{ session('success') }}
      </div>
    @endif

    @if($products->count())
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
          <div class="group bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition transform hover:-translate-y-1">
            <div class="flex items-center gap-4 p-4">
              <!-- Product Image -->
              <div class="flex-shrink-0">
                <img
                  src="{{ $product->image ?? 'https://via.placeholder.com/150' }}"
                  alt="{{ $product->name }}"
                  class="w-24 h-24 object-cover rounded-lg border border-gray-200"
                />
              </div>

              <!-- Product Info -->
              <div class="flex-1 min-w-0">
                <h3 class="font-medium text-gray-800 truncate">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">${{ number_format($product->price, 2) }}</p>
              </div>

              <!-- Actions -->
              <div class="flex flex-col items-end gap-2">
                <a
                  href="{{ route('products.show', $product->id) }}"
                  class="text-sm text-indigo-600 hover:text-indigo-700 hover:underline"
                >
                  View
                </a>

                <form method="POST" action="{{ route('wishlist.toggle', $product->id) }}">
                  @csrf
                  <button
                    type="submit"
                    class="text-sm text-red-500 hover:text-red-600 hover:underline"
                  >
                    Remove
                  </button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-center py-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z" />
        </svg>
        <p class="text-gray-500 text-lg">Your wishlist is empty.</p>
        <a
          href="{{ route('products.index') }}"
          class="mt-4 inline-block bg-indigo-600 text-white px-5 py-2 rounded-full text-sm hover:bg-indigo-500 transition"
        >
          Browse Products
        </a>
      </div>
    @endif
  </div>
</x-app-layout>
