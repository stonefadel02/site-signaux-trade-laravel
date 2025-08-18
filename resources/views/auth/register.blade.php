<x-auth-layout>
  <div class="container mx-auto px-4 max-w-md">
    <h4 class="text-2xl font-bold text-[#03122F] sm:text-[30px] mb-2">Inscription</h4>
    <p class="mb-4 text-[15px] text-[#B6B6B6]">
      Vous voulez plus d'accès? Inscrivez-vous pour continuer.
    </p>

    <hr class="border-gray-300" />

    <div class="mt-4">
      <button class="flex w-full items-center justify-start bg-[#4285F4] gap-1 rounded-md border border-gray-300  text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-[#040507]">
        <span class="py-2 ml-1 mt-1 mb-1 rounded px-3 bg-[#EFF0F1]">
          <img src="{{ asset('log/google-icon.svg') }}" alt="Google" class="h-5 w-5" />
        </span>
        <span class="py-2 px-3 text-white text-base">
          <p>Se connecter avec Google</p>
        </span>
      </button>

      <div class="relative mt-8">
        <div class="absolute inset-0 flex items-center">
          <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
          <span class="bg-white px-2 text-gray-500">OU</span>
        </div>
      </div>

      <form method="POST" action="{{ route('register') }}" class="mt-4">
        @csrf

        <!-- Name -->
        <div>
          <x-input-label for="name" :value="__('Nom')" />
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
          <x-input-label for="password" :value="__('Mot de passe')" />
          <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
          <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
          <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
          <x-primary-button class="w-full">
            {{ __("S'inscrire") }}
          </x-primary-button>
        </div>
      </form>

      <p class="mt-2 text-[15px] text-[#B6B6B6]">
        En cliquant sur "S'inscrire", vous acceptez nos Conditions d'utilisation
        et nos Conditions de licence. Dans notre Politique de confidentialité, nous expliquons comment nous traitons vos données personnelles et quels droits vous avez.
      </p>

      <p class="mt-2 text-[17px] text-[#B6B6B6]">
        Avez-vous un compte?
        <a class="font-medium text-cyan-600 hover:underline" href="{{ route('login') }}">
          {{ __('connectez-vous') }}
        </a>
      </p>
    </div>
  </div>
</x-auth-layout>
