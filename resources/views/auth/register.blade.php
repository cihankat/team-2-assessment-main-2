<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="firstname" :value="__('Voornaam')" />
            <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
        </div>


        <!-- Prefix -->
        <div class="mt-4">
            <x-input-label for="prefix" :value="__('Tussenvoegsel')" />
            <x-text-input id="prefix" class="block mt-1 w-full" type="text" name="prefix" :value="old('prefix')" autocomplete="prefix" />
            <x-input-error :messages="$errors->get('prefix')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="lastname" :value="__('Achternaam')" />
            <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autocomplete="lastname" />
            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
        </div>

        

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Gender Dropdown -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Geslacht')" />

            <select id="gender" class="block mt-1 w-full" name="gender" :value="old('gender')" required>
                <option value="" disabled selected>{{ __('Kies geslacht') }}</option>
                <option value="Man" {{ old('gender') == 'Man' ? 'selected' : '' }}>Man</option>
                <option value="Vrouw" {{ old('gender') == 'Vrouw' ? 'selected' : '' }}>Vrouw</option>
                <option value="Anders" {{ old('gender') == 'Anders' ? 'selected' : '' }}>Anders</option>
            </select>

            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="usernumber" :value="__('Studenten nummer & Docenten nummer')" />
            <x-text-input id="usernumber" class="block mt-1 w-full" type="text" name="usernumber" :value="old('usernumber')" required autocomplete="usernumber" />
            <x-input-error :messages="$errors->get('usernumber')" class="mt-2" />
        </div>

        <!-- Hidden Role Field -->
        <input type="hidden" name="role" value="Student" />

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Wachtwoord')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Bevestig Wachtwoord')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
