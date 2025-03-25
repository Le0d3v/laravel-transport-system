<x-guest-layout>
    <div id="auth-container">
        <div id="login-form" class="auth-form hidden">
            <p class="text-center text-gray-700 text-2xl my-3 font-bold">Iniciar Sesión</p>
            <p class="text-center text-gray-500 text-md mb-3">Inicie sesión con su Correo Electrónico y Contraseña</p>
            @if ($errors->has('g-recaptcha-response'))
                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
            @endif

            <x-auth-session-status class="mb-4" :status="session('status')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf
                <div>
                    <x-input-label for="email" :value="__('Correo Electrónico')" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus placeholder="Ejemplo@gmail.com"/>
                </div>
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña (Min. 10 caracteres)')" />
                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" placeholder="Incluir Números y Caracteres Especiales" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="text-sm text-gray-600 ms-2">{{ __('Mantener mi sesión abierta') }}</span>
                    </label>
                </div>

                <div class="mt-2">
                    {!! NoCaptcha::renderJs() !!}
                    <div class="form-group">
                        {!! NoCaptcha::display() !!}
                    </div>
                </div>

                <div class="mt-1 flex justify-end">
                    <x-primary-button class="ms-3 p-4">{{ __('Iniciar Sesión') }}</x-primary-button>
                </div>
                <div class="flex items-center justify-between gap-5 mt-6">
                    @if (Route::has('password.request'))
                        <a 
                            class="text-sm rounded-md text-gray-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                            href="#"
                            onclick="toggleForms('forgot-password')"
                        >
                            {{ __('Olvidé mi Contraseña') }}
                        </a>
                    @endif
                    <a 
                        class="text-sm text-gray-600 rounded-md hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                        href="#" 
                        onclick="toggleForms('register')"
                    >
                        {{ __('Crear una Cuenta') }}
                    </a>
                </div>
            </form>
        </div>

        <div id="register-form" class="auth-form hidden">
            <p class="text-center text-gray-700 text-2xl my-1 font-bold">Crear Cuenta</p>
            <p class="text-center text-gray-500 text-md mb-3">Regístrese en Busify llenando el siguiente formulario</p>
            <form method="POST" action="{{ route('register') }}" autocomplete="off">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Nombre')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus placeholder="Incluir mínimo un apellido"/>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Correo Electrónico')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="ejemplo@correo.com"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Contraseña (Min. 10 caracteres)')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required placeholder="Incluir números y caracteres especiales"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirma tu Contraseña')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required placeholder="Su contraseña ingresada previamente"/>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <!-- Agregar reCAPTCHA al formulario de registro -->
                {!! NoCaptcha::renderJs() !!}
                <div class="form-group my-5">
                    {!! NoCaptcha::display() !!}
                </div>
                
                <div class="flex items-center justify-end mt-4">
                    <a 
                        class="text-sm text-gray-600 hover:text-blue-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                        href="#" 
                        onclick="toggleForms('login')"
                    >
                        {{ __('¿Ya tienes una cuenta? Iniciar Sesión') }}
                    </a>
                    <x-primary-button class="ms-4">{{ __('Crear Cuenta') }}</x-primary-button>
                </div>
            </form>
        </div>

        <div id="forgot-password-form" class="auth-form hidden">
            <p class="text-center text-gray-700 text-xl my-3 font-bold">¿Olvidaste tu Contraseña?</p>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('No hay problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña.') }}
            </div>
        
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
        
            <form method="POST" action="{{ route('password.email') }}" autocomplete="off">
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
                        <a 
                            class="text-sm rounded-md text-gray-600 hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                            href="#"
                            onclick="toggleForms('login')"
                        >
                            {{ __('¿Ya tienes una cuenta? Iniciar Sesión') }}
                        </a>
                        @endif
                        <a 
                            class="text-sm text-gray-600 rounded-md hover:text-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                            href="#"
                            onclick="toggleForms('register')"
                        >
                            {{ __('Crear una Cuenta') }}
                        </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleForms(form) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const forgotPasswordForm = document.getElementById('forgot-password-form')
            if (form === 'register') {
                loginForm.classList.add('hidden');
                forgotPasswordForm.classList.add('hidden')
                registerForm.classList.remove('hidden');
            } else if(form === 'login') {
                registerForm.classList.add('hidden');
                forgotPasswordForm.classList.add('hidden')
                loginForm.classList.remove('hidden');
            } else {
                registerForm.classList.add('hidden');
                loginForm.classList.add('hidden');
                forgotPasswordForm.classList.remove('hidden')
            }
        }

        function showInitialForm() {
            const urlParams = new URLSearchParams(window.location.search);
            const form = urlParams.get('form');
            if (form === 'register') {
                toggleForms('register');
            } else {
                toggleForms('login');
            }
        }

        window.onload = showInitialForm;
    </script>
</x-guest-layout>
