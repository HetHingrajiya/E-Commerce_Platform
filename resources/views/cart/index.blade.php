<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if(empty($cart))
                    <p class="text-gray-500 dark:text-gray-400">Your cart is empty.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2">Product</th>
                                <th class="py-2">Price</th>
                                <th class="py-2">Qty</th>
                                <th class="py-2">Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                                <tr class="border-b">
                                    <td class="py-2">{{ $item['name'] }}</td>
                                    <td>${{ number_format($item['price'], 2) }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove', $id) }}">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:underline">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-6 flex justify-between items-center">
                        <form method="POST" action="{{ route('cart.clear') }}">
                            @csrf
                            <button type="submit" class="text-sm bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                Clear Cart
                            </button>
                        </form>
                        <div class="text-right font-semibold text-lg text-indigo-600">
                            Total: $
                            {{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 2) }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
