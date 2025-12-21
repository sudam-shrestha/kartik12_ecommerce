<x-guest-layout>
    @section('title', 'Create Account')

    <!-- Register Form -->
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Full Name <span class="text-red-500">*</span>
            </label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="John Doe"
                class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
            />
            @if ($errors->has('name'))
                <p class="mt-2 text-sm text-red-600">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email Address <span class="text-red-500">*</span>
            </label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
                placeholder="you@example.com"
                class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
            />
            @if ($errors->has('email'))
                <p class="mt-2 text-sm text-red-600">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                Password <span class="text-red-500">*</span>
            </label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="••••••••"
                class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
            />
            @if ($errors->has('password'))
                <p class="mt-2 text-sm text-red-600">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Confirm Password <span class="text-red-500">*</span>
            </label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="••••••••"
                class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
            />
            @if ($errors->has('password_confirmation'))
                <p class="mt-2 text-sm text-red-600">{{ $errors->first('password_confirmation') }}</p>
            @endif
        </div>

        <!-- Terms & Privacy Agreement -->
        <div class="mt-6">
            <label class="flex items-start cursor-pointer">
                <input
                    type="checkbox"
                    name="terms"
                    required
                    class="mt-0.5 h-4 w-4 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 transition"
                />
                <span class="ml-3 text-sm text-gray-700">
                    I agree to the
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-700 underline-offset-2 hover:underline">
                        Terms of Service
                    </a>
                    and
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-700 underline-offset-2 hover:underline">
                        Privacy Policy
                    </a>.
                </span>
            </label>
            @if ($errors->has('terms'))
                <p class="mt-2 text-sm text-red-600">{{ $errors->first('terms') }}</p>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-6">
            <a href="{{ route('login') }}"
               class="text-center sm:text-left text-sm font-medium text-indigo-600 hover:text-indigo-700 underline-offset-2 hover:underline transition">
                Already have an account? Sign in
            </a>

            <button
                type="submit"
                class="w-full sm:w-auto px-8 py-3.5 text-base font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 rounded-xl shadow-lg transform hover:scale-[1.02] transition-all flex items-center justify-center gap-2"
            >
                <i class="fas fa-user-plus"></i>
                Create Account
            </button>
        </div>
    </form>
</x-guest-layout>
