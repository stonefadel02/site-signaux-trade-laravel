<x-auth-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Vous avez oublié votre mot de passe ? Aucun problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra d\'en choisir un nouveau.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        
    <div class="mt-4 flex items-center justify-between">
        <div>
            <x-primary-button>
                {{ __('Lien de réinitialisation du mot de passe par e-mail') }}
            </x-primary-button>
         </div>

              <a href="{{ route('login') }}" 
            class="text-lg text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Se connecter') }}
            </a>
      

    </div>


  

        
    </form>
</x-auth-layout>