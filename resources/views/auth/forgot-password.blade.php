<x-guest-layout>
    <p class="text-center text-gray-700 text-xl my-3 font-bold">¿Olvidaste tu Contraseña?</p>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('No hay problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="ejemplo@correo.com"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Enviar Enlace') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-between gap-5 mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm rounded-md text-gray-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('¿Ya tienes una cuenta? Iniciar Sesión') }}
                </a>
                @endif
                <a class="text-sm text-gray-600 rounded-md hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    {{ __('Crear una Cuenta') }}
                </a>
        </div>
    </form>
</x-guest-layout>
