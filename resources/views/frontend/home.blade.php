<x-frontend-layout>

    @push('css')
        <style>
            .form-input:focus {
                outline: none;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            }

            .section-bg {
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            }

            .form-card {
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            .feature-item {
                transition: all 0.3s ease;
            }

            .feature-item:hover {
                transform: translateX(5px);
            }
        </style>
    @endpush

    <!-- Client Request Form Section -->
    <section class="section-bg rounded-2xl overflow-hidden py-16">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Partner With Us</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Join our platform and grow your restaurant or store
                business. Fill out the form below to get started.</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 container m-auto">
            <!-- Left Side: Image & Content -->
            <div class="flex flex-col justify-center">
                <div class="mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Expand Your Business Reach</h2>
                    <p class="text-gray-700 mb-8 text-lg">Join hundreds of successful restaurants and stores already on
                        our platform. We provide the tools, audience, and support you need to grow your business online.
                    </p>

                    <div class="space-y-6 mb-10">
                        <div class="feature-item flex items-start p-4 bg-white rounded-lg">
                            <div class="shrink-0 bg-(--primary)/30 p-3 rounded-full mr-4">
                                <i class="fas fa-users text-(--primary) text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Access to Thousands of Customers</h3>
                                <p class="text-gray-600">Reach a wider audience and increase your sales with our
                                    platform.</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start p-4 bg-white rounded-lg">
                            <div class="shrink-0 bg-green-100 p-3 rounded-full mr-4">
                                <i class="fas fa-chart-line text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Business Analytics Dashboard</h3>
                                <p class="text-gray-600">Track your performance with detailed insights and analytics.
                                </p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start p-4 bg-white rounded-lg">
                            <div class="shrink-0 bg-purple-100 p-3 rounded-full mr-4">
                                <i class="fas fa-headset text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">24/7 Support</h3>
                                <p class="text-gray-600">Our dedicated support team is always ready to help you succeed.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                    <div class="text-center p-4 bg-white rounded-lg">
                        <div class="text-2xl font-bold text-(--primary)">500+</div>
                        <div class="text-sm text-gray-600">Partners</div>
                    </div>
                    <div class="text-center p-4 bg-white rounded-lg">
                        <div class="text-2xl font-bold text-(--primary)">50K+</div>
                        <div class="text-sm text-gray-600">Customers</div>
                    </div>
                    <div class="text-center p-4 bg-white rounded-lg">
                        <div class="text-2xl font-bold text-(--primary)">24/7</div>
                        <div class="text-sm text-gray-600">Support</div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="bg-white p-8 md:p-12 lg:p-16 form-card">
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Request Form</h3>
                    <p class="text-gray-600">Fill out the form below and our team will contact you within 24 hours.</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-200 text-red-600 px-4 py-2 rounded-lg">
                        <ul class="list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('client.request') }}" method="POST">
                    @csrf
                    <!-- Client Name -->
                    <div class="mb-6">
                        <label for="client_name" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-user text-(--primary) mr-2"></i>Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="client_name" name="client_name" required
                            value="{{ old('client_name') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:border-(--primary)"
                            placeholder="Enter your full name">
                        <p class="text-sm text-gray-500 mt-1">Please enter the business owner/manager's name</p>
                    </div>

                    <!-- Shop Name -->
                    <div class="mb-6">
                        <label for="shop_name" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-store text-(--primary) mr-2"></i>Business Name <span
                                class="text-red-500">*</span>
                        </label>
                        <input type="text" id="shop_name" name="shop_name" required value="{{ old('shop_name') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:border-(--primary)"
                            placeholder="Enter your restaurant/store name">
                        <p class="text-sm text-gray-500 mt-1">Official registered name of your business</p>
                    </div>

                    <!-- Contact & Email in one row for larger screens -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Contact -->
                        <div>
                            <label for="contact" class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-phone text-(--primary) mr-2"></i>Phone Number <span
                                    class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="contact" name="contact" required value="{{ old('contact') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:border-(--primary)"
                                placeholder="+977-98XXXXXXXX">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">
                                <i class="fas fa-envelope text-(--primary) mr-2"></i>Email Address <span
                                    class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:border-(--primary)"
                                placeholder="you@example.com">
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mb-8">
                        <label for="address" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-map-marker-alt text-(--primary) mr-2"></i>Business Address <span
                                class="text-red-500">*</span>
                        </label>
                        <textarea id="address" name="address" rows="3" required value="{{ old('address') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input focus:border-(--primary)"
                            placeholder="Enter your complete business address"></textarea>
                        <p class="text-sm text-gray-500 mt-1">Include street, city, state, and zip code</p>
                    </div>

                    <!-- Terms & Submit -->
                    <div class="mb-6">
                        <div class="flex items-start">
                            <input type="checkbox" id="terms" name="terms" required class="mt-1 mr-3"
                                value="1">
                            <label for="terms" class="text-gray-700">
                                I agree to the <a href="#"
                                    class="text-(--primary) hover:text-(--primary) font-medium">Terms of Service</a> and <a
                                    href="#" class="text-(--primary) hover:text-(--primary) font-medium">Privacy
                                    Policy</a>. I understand that my data will be processed as described in the privacy
                                policy.
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit"
                            class="flex-1 bg-(--primary) hover:bg-(--primary) text-white py-3 px-6 rounded-lg font-medium transition-colors flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i> Submit Request
                        </button>
                    </div>

                    <p class="text-sm text-gray-500 mt-6 text-center">
                        <i class="fas fa-info-circle mr-1"></i> Our team typically responds within 24 hours on business
                        days.
                    </p>
                </form>
            </div>
        </div>
    </section>
</x-frontend-layout>
