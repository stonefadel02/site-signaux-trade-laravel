<x-auth-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />




    <div class="container mx-auto px-4 max-w-md">
        <h4 class="text-2xl font-bold text-[#03122F] sm:text-[30px]">{{ __('auth.login.title') }}</h4>

        <p class="mt-2 text-[15px] text-[#B6B6B6]">{{ __('auth.login.subtitle') }}</p>
        <div class="mt-8">
            <button
                class="flex w-full items-center justify-left bg-[#4285F4] gap-1 rounded-md border border-gray-300   text-sm
             font-medium text-gray-700 shadow-sm transition-all hover:bg-[#040507FF]">
                <span class="py-2 ml-1 mt-1 mb-1 rounded-2 px-3 bg-[#EFF0F1FF]">
                    <img src="{{ asset('log/google-icon.svg') }}" alt="Google" class="h-5 w-5">
                </span>
                <span class="py-2 px-3 text-white fs-5">
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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('auth.login.email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <div class="flex items-center justify-between">
                        <x-input-label for="password" :value="__('auth.login.password')" />



                        @if (Route::has('password.request'))
                            <a class=" text-sm text-gray-600 text-success link-dark fs-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('password.request') }}">
                                {{ __('auth.login.forgot') }}
                            </a>
                        @endif
                    </div>


                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('auth.login.remember') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end w-full mt-4">


                    <x-primary-button class="w-full ">
                        {{ __('auth.login.submit') }}
                    </x-primary-button>
                </div>

                <p class="mt-2 text-[15px] text-[#B6B6B6]">
                    {{ __('auth.login.no_account') }}
                    <a href="{{ route('register') }}" class="font-medium text-cyan-600 hover:underline">
                        {{ __('auth.login.register_link') }}
                    </a>
                </p>
            </form>

        </div>
    </div>
</x-auth-layout>
