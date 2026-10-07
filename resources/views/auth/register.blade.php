<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Selecione a Função (Role) com Radio Buttons -->
        <div class="mt-4">
            <x-input-label :value="__('Selecione a Função (Role)')" />

            <div class="mt-2 space-y-2">
                <!-- Opção Photographer -->
                <div class="flex items-center">
                    <input id="role_photographer" type="radio" name="role" value="photographer"
                        {{ old('role') == 'photographer' ? 'checked' : '' }}
                        class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required>
                    <label for="role_photographer" class="ms-2 text-sm font-medium text-gray-900 dark:text-black-300">
                        Photographer
                    </label>
                </div>

                <!-- Opção User -->
                <div class="flex items-center">
                    <input id="role_user" type="radio" name="role" value="user"
                        {{ old('role') == 'user' ? 'checked' : '' }}
                        class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                    <label for="role_user" class="ms-2 text-sm font-medium text-gray-900 dark:text-black-300">
                        User
                    </label>
                </div>
            </div>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Foto de Perfil Super Simples -->
        <div class="mt-4">
            <x-input-label for="path_photo" :value="__('Foto de Perfil')" />

            <input id="path_photo" name="path_photo" type="file" accept="image/*"
                class="block mt-1 w-full text-sm text-black-800 dark:text-black-200 font-medium
                file:mr-4 file:py-2 file:px-4
                file:rounded-md file:border-0
                file:text-sm file:font-bold
                file:bg-indigo-600 file:text-white
                dark:file:bg-indigo-500
                hover:file:bg-indigo-700 dark:hover:file:bg-indigo-600
                active:file:scale-95
                cursor-pointer transition duration-150" />

            <x-input-error :messages="$errors->get('path_photo')" class="mt-2" />
        </div>


        <!-- Ações do Formulário (Link e Botão) -->
        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
