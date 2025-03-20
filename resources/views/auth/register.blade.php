<x-guest-layout>
    <p class="text-center text-gray-700 text-2xl my-1 font-bold">Crear Cuenta</p>
    <p class="text-center text-gray-500 text-md mb-3">Registrese en Busify llenando el siguiente formulario</p>
    <form method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Incluir mínimo un apellido"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Elecrtónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required  placeholder="ejemplo@correo.com"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña (Min. 10 caracteres)')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required 
                            placeholder="Incluir números y carácteres especiales"
                            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirma tu Contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required 
                            placeholder="Su contraseña ingresada previamente"
                            />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <!-- Confirm Password -->
        <div class="mt-4">
            

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="hidden"
                            value="0"
                            />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gray-600 hover:text-blue-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya tienes una cuenta? Iniciar Sesión') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Crear Cuenta') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
