<x-auth-layout>
    <div class="mb-4 text-sm text-gray-600">{{ __('auth.forgot.intro') }}</div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('auth.forgot.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>



        <div class="mt-4 flex items-center justify-between">
            <div>
                <x-primary-button>
                    {{ __('auth.forgot.send_link') }}
                </x-primary-button>
            </div>

            <a href="{{ route('login') }}"
                class="text-lg text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('auth.forgot.back_login') }}
            </a>


        </div>





    </form>
</x-auth-layout>
