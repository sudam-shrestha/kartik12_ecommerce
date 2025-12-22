<x-frontend-layout>

    @php
        $discountedPrice = $product->discount > 0 ? $product->price * (1 - $product->discount / 100) : $product->price;
    @endphp

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                <!-- Product Images Gallery -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="relative overflow-hidden rounded-xl bg-white shadow-lg">
                        <img id="mainImage" src="{{ asset(Storage::url($product->images[0])) }}" alt="{{ $product->name }}"
                            class="w-full h-96 object-contain transition-transform duration-500">
                    </div>

                    <!-- Thumbnails -->
                    @if (count($product->images) > 1)
                        <div class="grid grid-cols-4 gap-3">
                            @foreach ($product->images as $index => $image)
                                <div
                                    class="cursor-pointer overflow-hidden rounded-lg border-2 {{ $index === 0 ? 'border-blue-500' : 'border-gray-200' }} hover:border-blue-500 transition">
                                    <img src="{{ asset(Storage::url($image)) }}" alt="{{ $product->name }} thumbnail"
                                        class="w-full h-24 object-cover" onclick="changeMainImage(this.src, this)">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="flex flex-col justify-between">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            {{ $product->name }}
                        </h1>

                        <!-- Price Section -->
                        <div class="flex items-baseline gap-4 mb-6">
                            <span class="text-4xl font-bold text-blue-600">
                                Rs {{ number_format($discountedPrice, 0) }}
                            </span>
                            @if ($product->discount > 0)
                                <span class="text-2xl text-gray-500 line-through">
                                    Rs {{ number_format($product->price, 0) }}
                                </span>
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                    -{{ $product->discount }}% OFF
                                </span>
                            @endif
                        </div>

                        <!-- Description -->
                        <div class="prose max-w-none text-gray-700 mb-8">
                            {!! $product->description !!}
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="{{route('cart')}}" method="POST" class="mt-8">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="flex items-center gap-6 mb-6">
                            <!-- Quantity Selector -->
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button type="button" onclick="decQty()"
                                    class="px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-l-lg transition">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" name="qty" value="1" min="1" id="qty" class="w-20 text-center py-3 focus:outline-none"
                                    required>
                                <button type="button" onclick="incQty()"
                                    class="px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-r-lg transition">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>

                            <!-- Add to Cart Button -->
                            <button type="submit" @if ($product->stock < 1) disabled @endif
                                class="flex-1 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-semibold py-4 px-8 rounded-lg transition flex items-center justify-center gap-3">
                                <i class="fas fa-shopping-cart"></i>
                                {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('js')
        <script>
            let qty = document.getElementById('qty');

            function incQty() {
                if (qty.value < 10) {
                    qty.value++;
                }
            }

            function decQty() {
                if (qty.value > 1) {
                    qty.value--;
                }
            }

            function changeMainImage(src, element) {
                // Change main image
                document.getElementById('mainImage').src = src;

                // Update thumbnail borders
                document.querySelectorAll('.grid-cols-4 img').forEach(img => {
                    img.parentElement.classList.remove('border-blue-500');
                    img.parentElement.classList.add('border-gray-200');
                });
                element.parentElement.classList.remove('border-gray-200');
                element.parentElement.classList.add('border-blue-500');
            }
        </script>
    @endpush

</x-frontend-layout>
