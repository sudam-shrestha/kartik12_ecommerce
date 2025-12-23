<x-frontend-layout>
    <section class="py-16 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Checkout</h1>
                <p class="text-lg text-gray-600">Complete your order from <span
                        class="font-semibold">{{ $client->shop_name }}</span></p>
            </div>

            @php
                $cartItems = auth()
                    ->user()
                    ->carts()
                    ->with('product')
                    ->whereHas('product', function ($q) use ($client) {
                        $q->where('client_id', $client->id);
                    })
                    ->get();

                $subtotal = $cartItems->sum(function ($cart) {
                    $discountedPrice = $cart->product->price - ($cart->product->price * $cart->product->discount) / 100;
                    return $discountedPrice * $cart->qty;
                });
            @endphp

            @if ($cartItems->isEmpty())
                <div class="text-center py-20 bg-white rounded-2xl shadow-lg">
                    <p class="text-xl text-gray-600 mb-6">No items in your cart from this store.</p>
                    <a href="{{ route('home') }}"
                        class="inline-block bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Continue Shopping
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- Left: Checkout Form -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Delivery Address -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 form-card">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-600 mr-3"></i>
                                Delivery Address
                            </h2>

                            <form id="checkoutForm" action="{{ route('order.place', $client->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_method" id="paymentMethodInput" value="cod">

                                <div class="mb-6">
                                    <label for="delivery_address" class="block text-gray-700 font-medium mb-2">
                                        Full Delivery Address <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="delivery_address" name="delivery_address" rows="4" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:shadow-lg transition"
                                        placeholder="House no., Street, Area, City (e.g., Koteshwor-32, Kathmandu)">{{ old('delivery_address', auth()->user()->address ?? '') }}</textarea>
                                    <p class="text-sm text-gray-500 mt-2">We'll deliver your order to this address</p>
                                </div>
                            </form>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 form-card">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-credit-card text-blue-600 mr-3"></i>
                                Payment Method
                            </h2>

                            <div class="space-y-4">
                                <!-- Cash on Delivery -->
                                <label
                                    class="payment-option flex items-center p-5 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition">
                                    <input type="radio" name="payment_method_radio" value="cod" checked
                                        class="text-blue-600 focus:ring-blue-500 h-5 w-5">
                                    <span class="ml-4 flex items-center">
                                        <i class="fas fa-money-bill-wave text-green-600 text-2xl mr-4"></i>
                                        <div>
                                            <div class="font-semibold text-gray-900">Cash on Delivery (COD)</div>
                                            <div class="text-sm text-gray-600">Pay with cash when your order arrives
                                            </div>
                                        </div>
                                    </span>
                                </label>

                                <!-- Khalti -->
                                <label
                                    class="payment-option flex items-center p-5 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-purple-500 hover:bg-purple-50 transition">
                                    <input type="radio" name="payment_method_radio" value="khalti"
                                        class="text-purple-600 focus:ring-purple-500 h-5 w-5">
                                    <span class="ml-4 flex items-center">
                                        <!-- Khalti Logo (SVG) -->
                                        <svg class="w-10 h-10 mr-4" viewBox="0 0 100 100"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="100" height="100" rx="15" fill="#5E2CED" />
                                            <path d="M50 20 L70 50 L50 80 L30 50 Z" fill="white" />
                                            <text x="50" y="58" font-size="28" text-anchor="middle" fill="white"
                                                font-weight="bold">K</text>
                                        </svg>
                                        <div>
                                            <div class="font-semibold text-gray-900">Khalti Digital Wallet</div>
                                            <div class="text-sm text-gray-600">Pay instantly using Khalti, eSewa via
                                                Khalti, cards & banking</div>
                                        </div>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-6 form-card">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <i class="fas fa-shopping-bag text-blue-600 mr-3"></i>
                                Order Summary
                            </h2>

                            <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                                @foreach ($cartItems as $cart)
                                    @php
                                        $product = $cart->product;
                                        $discountedPrice =
                                            $product->price - ($product->price * $product->discount) / 100;
                                        $itemTotal = $discountedPrice * $cart->qty;
                                    @endphp

                                    <div class="flex gap-4 py-4 border-b border-gray-100 last:border-0">
                                        <img src="{{ asset(Storage::url($product->images[0])) }}" alt="{{ $product->name }}"
                                            class="w-16 h-16 object-cover rounded-lg shadow">

                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900">{{ $product->name }}</h4>
                                            <p class="text-sm text-gray-600">Qty: {{ $cart->qty }}</p>
                                            <p class="text-sm font-semibold text-green-600 mt-1">
                                                Rs.{{ number_format($itemTotal, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t-2 border-gray-200 pt-6 mt-6">
                                <div class="flex justify-between text-lg font-semibold text-gray-900 mb-2">
                                    <span>Subtotal ({{ $cartItems->sum('qty') }} items)</span>
                                    <span>Rs.{{ number_format($subtotal, 2) }}</span>
                                </div>

                                <div class="flex justify-between text-xl font-bold text-gray-900 mt-4">
                                    <span>Total Amount</span>
                                    <span class="text-blue-600">Rs.{{ number_format($subtotal, 2) }}</span>
                                </div>
                            </div>

                            <button type="submit" form="checkoutForm" id="placeOrderBtn"
                                class="w-full mt-8 bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl font-bold text-lg transition transform hover:scale-105 shadow-lg flex items-center justify-center">
                                <i class="fas fa-lock mr-3"></i>
                                <span id="btnText">Place Order</span>
                            </button>

                            <p class="text-sm text-gray-500 text-center mt-6">
                                <i class="fas fa-shield-alt mr-1"></i>
                                Secure checkout. Your information is safe with us.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @push('js')
        <script>
            document.querySelectorAll('input[name="payment_method_radio"]').forEach((elem) => {
                elem.addEventListener('change', function() {
                    const method = this.value;
                    const btnText = document.getElementById('btnText');
                    const hiddenInput = document.getElementById('paymentMethodInput');

                    hiddenInput.value = method;

                    if (method === 'khalti') {
                        btnText.textContent = 'Pay with Khalti';
                        document.getElementById('placeOrderBtn').classList.remove('bg-blue-600',
                            'hover:bg-blue-700');
                        document.getElementById('placeOrderBtn').classList.add('bg-purple-600',
                            'hover:bg-purple-700');
                    } else {
                        btnText.textContent = 'Place Order';
                        document.getElementById('placeOrderBtn').classList.remove('bg-purple-600',
                            'hover:bg-purple-700');
                        document.getElementById('placeOrderBtn').classList.add('bg-blue-600',
                            'hover:bg-blue-700');
                    }
                });
            });
        </script>
    @endpush

    @push('css')
        <style>
            .form-card {
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                transition: all 0.3s ease;
            }

            .form-card:hover {
                box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
            }

            textarea:focus,
            input:focus {
                outline: none;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            }

            /* Selected payment option highlight */
            .payment-option input:checked+span {
                font-weight: 600;
            }

            .payment-option input:checked~span::before {
                content: '';
                position: absolute;
                inset: 0;
                border: 2px solid;
                border-radius: 1rem;
                pointer-events: none;
            }

            .payment-option:has(input[value="cod"]:checked) {
                border-color: #3b82f6 !important;
                background-color: #eff6ff !important;
            }

            .payment-option:has(input[value="khalti"]:checked) {
                border-color: #5E2CED !important;
                background-color: #f5f0ff !important;
            }
        </style>
    @endpush
</x-frontend-layout>
