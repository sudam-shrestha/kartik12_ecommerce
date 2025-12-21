@props(['product'])

<a href="{{route('product', $product->id)}}"
    class="group relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-3">
    <div class="relative overflow-hidden">
        @if ($product->discount > 0)
            <span
                class="absolute top-4 left-4 z-10 bg-red-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-md">-{{ $product->discount }}%</span>
        @endif
        <img src="{{ asset(Storage::url($product->images[0])) }}" alt="{{ $product->name }}"
            class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity">
        </div>
    </div>
    <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-900 mb-3">
            {{ $product->name }}
        </h3>
        <div class="flex items-center justify-between">
            <div>
                <span class="text-2xl font-bold text-blue-600">Rs.
                    {{ $product->price - ($product->price * $product->discount) / 100 }}</span>
                @if ($product->discount > 0)
                    <span class="text-lg text-gray-400 line-through ml-3">Rs. {{ $product->price }}</span>
                @endif
            </div>
        </div>
    </div>
</a>
