<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900 relative">
        <!-- Imagen de fondo con overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80"
                 alt="Tecnología y agua"
                 class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 to-blue-800/50"></div>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white/90 backdrop-blur-sm shadow-xl overflow-hidden sm:rounded-lg relative z-10">
            <div class="flex justify-center mb-8">
                <a href="/">
                    <div class="text-3xl font-bold text-blue-600">Verify<span class="text-green-500">Water</span></div>
                </a>
            </div>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" class="text-gray-700" />
                    <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                             type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-gray-700" />
                    <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                             type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" class="text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-blue-600 hover:text-blue-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ms-4 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                        {{ __('Log in') }}
                    </x-button>
                </div>

                @if (Route::has('register'))
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            {{ __('Don\'t have an account?') }}
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ __('Register') }}
                            </a>
                        </p>
                    </div>
                @endif
            </form>
        </div>
    </div>
</x-guest-layout>