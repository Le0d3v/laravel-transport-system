<x-guest-layout>
    <p class="text-center text-gray-700 text-2xl my-3 font-bold">Autenticación en dos Factores</p>
    <p class="text-center text-gray-500 text-md mb-3">Compruebe su identidad ingresando el código que se envió a su email</p>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('two-factor.verify.post') }}" autocomplete="off">
        @csrf
        @error('code')
           <div class="py-5">
                <span class="text-sm text-red-700 space-y-1 p-3 bg-red-300 border-l-4 border-red-700 font-bold rounded">
                    {{ $message }}
                </span>
           </div>
        @enderror
        <div>
            <x-input-label for="code" :value="__('Código de Verificación')" />
            <x-text-input id="code" class="block w-full mt-1" type="tel" name="code" required autofocus  placeholder="5 digitos"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mt-4 flex justify-end">
            <x-primary-button class="ms-3 p-4">
                {{ __('Comprobar Código') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>