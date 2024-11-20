<x-guest-layout>
    <p class="text-center text-gray-700 text-2xl my-3 font-bold">Iniciar Sesión</p>
    <p class="text-center text-gray-500 text-md mb-3">Inicie sesión con su Correo Electrónico y Contraseña</p>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo Elctrónico')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Ejemplo@gmail.com"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Constraseña. (Min. 10 caracteres)')" />

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Incluir Números y Caráctres Espciales"
                            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                <span class="text-sm text-gray-600 ms-2">{{ __('Mantener mi sesión abierta') }}</span>
            </label>
        </div>

        <div class="mt-1 flex justify-end">
            <x-primary-button class="ms-3 p-4">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-between gap-5 mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm rounded-md text-gray-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Olvidé mi Contraseña') }}
                </a>
                @endif
                <a class="text-sm text-gray-600 rounded-md hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    {{ __('Crear una Cuenta') }}
                </a>
        </div>
    </form>
</x-guest-layout>
