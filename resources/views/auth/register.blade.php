<x-auth-layout>
    <div class="container mx-auto px-4 max-w-md">
        <h4 class="text-2xl font-bold text-[#03122F] sm:text-[30px] mb-2">{{ __('auth.register.title') }}</h4>
        <p class="mb-4 text-[15px] text-[#B6B6B6]">{{ __('auth.register.subtitle') }}</p>

        <hr class="border-gray-300" />

        <div class="mt-4">
            <button
                class="flex w-full items-center justify-start bg-[#4285F4] gap-1 rounded-md border border-gray-300  text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-[#040507]">
                <span class="py-2 ml-1 mt-1 mb-1 rounded px-3 bg-[#EFF0F1]">
                    <img src="{{ asset('log/google-icon.svg') }}" alt="Google" class="h-5 w-5" />
                </span>
                <span class="py-2 px-3 text-white text-base">
                    <p>{{ __('auth.google_login') }}</p>
                </span>
            </button>

            <div class="relative mt-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="bg-white px-2 text-gray-500">{{ __('auth.or') }}</span>
                </div>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-4">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('auth.register.name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" :value="__('auth.register.email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('auth.register.password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('auth.register.password_confirm')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="w-full">
                        {{ __('auth.register.submit') }}
                    </x-primary-button>
                </div>
            </form>

            <p class="mt-2 text-[15px] text-[#B6B6B6]">{{ __('auth.register.terms_text') }}</p>

            <p class="mt-2 text-[17px] text-[#B6B6B6]">
                {{ __('auth.register.have_account') }}
                <a class="font-medium text-cyan-600 hover:underline" href="{{ route('login') }}">
                    {{ __('auth.register.login_link') }}
                </a>
            </p>
        </div>
    </div>
</x-auth-layout>
