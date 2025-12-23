<x-frontend-layout>
    <div class="container mx-auto py-10 px-4 max-w-6xl">
        <h1 class="text-4xl font-bold text-gray-800 mb-10 text-center md:text-left">My Cart</h1>

        @if ($cartItems->isEmpty())
            <div class="text-center py-20 bg-gray-50 rounded-xl">
                <p class="text-xl text-gray-600 mb-6">Your cart is currently empty.</p>
                <a href="{{ route('home') }}"
                    class="inline-block bg-purple-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-purple-700 transition duration-300 shadow-md">
                    Continue Shopping
                </a>
            </div>
        @else
            @foreach ($cartItems as $clientId => $items)
                @php
                    $client = $items->first()->product->client;

                    $subtotal = $items->sum(function ($cart) {
                        $product = $cart->product;
                        $discountedPrice = $product->price - ($product->price * $product->discount) / 100;
                        return $discountedPrice * $cart->qty;
                    });
                @endphp

                <div class="bg-white rounded-2xl shadow-lg mb-12 overflow-hidden border border-gray-200">
                    <!-- Shop Header -->
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-5 border-b border-gray-200">
                        <div class="flex items-center gap-5">
                            @if ($client->logo)
                                <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->shop_name }}"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-white shadow">
                            @else
                                <div
                                    class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center text-white text-2xl font-bold shadow">
                                    {{ strtoupper(substr($client->shop_name, 0, 2)) }}
                                </div>
                            @endif
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">{{ $client->shop_name }}</h2>
                                <p class="text-gray-600">Seller: {{ $client->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Items -->
                    <div class="divide-y divide-gray-200">
                        @foreach ($items as $cart)
                            @php
                                $product = $cart->product;
                                $discountedPrice = $product->price - ($product->price * $product->discount) / 100;
                                $itemTotal = $discountedPrice * $cart->qty;
                            @endphp

                            <div class="p-6 hover:bg-gray-50 transition duration-200">
                                <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset(Storage::url($product->images[0])) }}" alt="{{ $product->name }}"
                                            class="w-28 h-28 md:w-36 md:h-36 object-cover rounded-xl shadow-md">
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-grow">
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h3>
                                        <p class="text-gray-600 mt-1 line-clamp-2">
                                            {{ Str::limit($product->description, 100) }}</p>

                                        <div class="mt-4 flex flex-wrap items-center gap-4">
                                            <span class="text-2xl font-bold text-green-600">
                                                Rs.{{ number_format($discountedPrice, 2) }}
                                            </span>
                                            @if ($product->discount > 0)
                                                <span class="text-lg text-gray-500 line-through">
                                                    Rs.{{ number_format($product->price, 2) }}
                                                </span>
                                                <span
                                                    class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">
                                                    -{{ $product->discount }}% OFF
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Quantity & Actions -->
                                    <div class="flex flex-col items-end gap-4">
                                        <div class="text-right">
                                            <p class="text-gray-600">Quantity:</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $cart->qty }}</p>
                                            <p class="text-lg font-semibold text-gray-700 mt-2">
                                                Rs.{{ number_format($itemTotal, 2) }}
                                            </p>
                                        </div>

                                        <div class="flex gap-4">
                                            <!-- Remove Item -->
                                            <form action="" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 font-medium transition"
                                                    onclick="return confirm('Remove this item from cart?')">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Subtotal & Checkout for this shop only -->
                    <div
                        class="bg-gradient-to-r from-purple-50 to-indigo-50 px-8 py-6 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div>
                            <p class="text-xl font-semibold text-gray-700">Subtotal ({{ $items->sum('qty') }} items)
                            </p>
                            <p class="text-3xl font-bold text-gray-800">
                                Rs.{{ number_format($subtotal, 2) }}
                            </p>
                        </div>

                        <a href="{{ route('checkout', $client->id) }}"
                            class="inline-block bg-purple-600 text-white px-10 py-4 rounded-xl text-lg font-bold hover:bg-purple-700 transition shadow-lg transform hover:scale-105">
                            Checkout from {{ $client->shop_name }}
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-frontend-layout>
