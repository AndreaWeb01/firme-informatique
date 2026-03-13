<x-guest-layout>
    <form method="POST" action="{{ route('adminstore.register') }}">
        @csrf
        <input type="hidden" name="role" value="administrateur">

        <!-- Nom -->
        <div>
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus autocomplete="family-name" />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- Prénom -->
        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prénom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autocomplete="given-name" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div class="mt-4">
            <x-input-label for="motdepasse" :value="__('Mot de passe')" />
            <x-text-input id="motdepasse" class="block mt-1 w-full" type="password" name="motdepasse" required autocomplete="new-password" minlength="8" />
            <x-input-error :messages="$errors->get('motdepasse')" class="mt-2" />
        </div>

        <!-- Confirmation mot de passe -->
        <div class="mt-4">
            <x-input-label for="motdepasse_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="motdepasse_confirmation" class="block mt-1 w-full" type="password" name="motdepasse_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('motdepasse_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Créer le compte administrateur') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
