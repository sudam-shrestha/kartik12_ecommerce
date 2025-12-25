<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order #{{ $order->id }} - Your Orders</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <!-- Optional: Add a favicon or custom styles -->
    <style>
        .status-pending {
            @apply bg-yellow-100 text-yellow-800;
        }

        .status-processing {
            @apply bg-blue-100 text-blue-800;
        }

        .status-on_delivery {
            @apply bg-purple-100 text-purple-800;
        }

        .status-completed {
            @apply bg-green-100 text-green-800;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">

        <!-- Order Header -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                    <p class="text-gray-600 mt-1">
                        Placed on {{ $order->created_at->format('d M Y \a\t h:i A') }}
                    </p>
                </div>

                <div class="text-right">
                    <span class="inline-flex px-5 py-2 rounded-full text-lg font-semibold
                       ">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Order Items (Main Content) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-xl font-semibold text-gray-800">Order Items</h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Qty</th>
                                    <th
                                        class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Unit Price</th>
                                    <th
                                        class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($order->order_items as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $item->product?->name ?? 'Product Deleted' }}
                                            @if ($item->product?->sku)
                                                <span class="text-xs text-gray-500 block">SKU:
                                                    {{ $item->product->sku }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm text-gray-600">
                                            {{ $item->qty }}
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm text-gray-600">
                                            ${{ number_format($item->amount / $item->qty, 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-right text-sm font-semibold text-gray-900">
                                            ${{ number_format($item->amount, 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">
                                            No items in this order.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">

                <!-- Order Summary -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between pt-3 border-t border-gray-200 font-bold text-lg">
                            <span>Total</span>
                            <span class="text-indigo-600">${{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Delivery Address -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Delivery Address</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $order->delivery_address }}
                    </p>
                </div>

                <!-- Payment Details -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Payment Details</h3>

                    <div class="border-b border-gray-200 pb-4 mb-4 last:border-0 last:mb-0">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Method</span>
                            <span
                                class="font-medium capitalize">{{ str_replace('_', ' ', $order->payment->payment_method) }}</span>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-gray-600">Amount</span>
                            <span class="font-semibold">${{ number_format($order->payment->amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-gray-600">Status</span>
                            <span
                                class="inline-flex px-3 py-1 rounded-full text-xs font-medium
                                        ">
                                {{ ucfirst($order->payment->status) }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-500 mt-2">
                            Paid on {{ $order->payment->created_at->format('d M Y h:i A') }}
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div>
                    <a href="{{ url()->previous() }}"
                        class="w-full inline-flex justify-center items-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        ← Back to My Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
