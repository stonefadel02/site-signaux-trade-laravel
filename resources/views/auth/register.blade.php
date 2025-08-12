{{-- resources/views/auth/register.blade.php --}}
<x-auth-layout>
    <div class="w-full">
        <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">Créer un compte</h2>
        <p class="mt-2 text-[17px] text-[#B6B6B6]">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="font-medium text-cyan-600 hover:underline">
                Connectez-vous
            </a>
        </p>

        <div class="mt-8">
            <button class="flex w-full items-center justify-center gap-3 rounded-md border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 shadow-sm transition-all hover:bg-gray-50">
                <img src="{{ asset('ico3.png') }}" alt="Google" class="h-5 w-5">
                S'inscrire avec Google
            </button>

            <div class="relative mt-8"></div>

            <form action="#" method="POST" class="mt-8 space-y-6">
                @csrf
                <div>
                    <label for="name" class="sr-only">Nom</label>
                    <input id="name" name="name" type="text" required class="block w-full rounded-md border-0 py-2.5 px-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-cyan-600 sm:text-sm" placeholder="Nom">
                </div>
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-2.5 px-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-cyan-600 sm:text-sm" placeholder="Email">
                </div>
                <div>
                    <label for="password" class="sr-only">Mot de passe</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required class="block w-full rounded-md border-0 py-2.5 px-4 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-cyan-600 sm:text-sm" placeholder="Mot de passe">
                </div>
                <p class="text-[12px] text-[#9092A2]">
                    En cliquant sur `Créer un compte`, vous acceptez nos Conditions d'utilisation...
                </p>
                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-[#03194A] px-3 py-4 text-sm font-semibold text-white shadow-sm hover:bg-gray-800">
                        S'inscrire
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-auth-layout>