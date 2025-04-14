<x-guest-layout>
@section('home_title')
WebAge - Log In
@endsection
    <div class="min-h-screen flex flex-col md:flex-row bg-white">
        <!-- Left side - Graphic/Image -->
        <div class="hidden md:block md:w-1/2 bg-black">
            <div class="h-full flex items-center justify-center p-12">
                <div class="text-white text-center">
                    <h1 class="text-4xl font-light mb-4">Welcome Back</h1>
                    <p class="text-gray-300 max-w-md mx-auto">Explore amazing products on out platform!</p>
                </div>
            </div>
        </div>

        <!-- Right side - Login Form -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Session Status -->
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-light text-gray-900">Sign In</h2>
                    <p class="mt-2 text-sm text-gray-600">Access your account to continue</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                        <x-text-input 
                            id="email" 
                            class="block mt-1 w-full border-gray-300 focus:border-black focus:ring-black" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                        <x-text-input 
                            id="password" 
                            class="block mt-1 w-full border-gray-300 focus:border-black focus:ring-black"
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                class="rounded border-gray-300 text-black focus:ring-black" 
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-black" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <div>
                        <x-primary-button class="w-full justify-center bg-black hover:bg-gray-800 focus:bg-gray-800">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>

                @if (Route::has('register'))
                    <div class="mt-6 text-center text-sm text-gray-600">
                        <p>Don't have an account? 
                            <a href="{{ route('register') }}" class="text-black hover:underline">Register</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>