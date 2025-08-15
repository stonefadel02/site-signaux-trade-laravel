{{-- resources/views/access_codes/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Générer un code d\'accès') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white p-8 shadow-sm sm:rounded-lg">
                <form action="{{ route('access-codes.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @include('access_codes.form', ['isUpdate' => false])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>