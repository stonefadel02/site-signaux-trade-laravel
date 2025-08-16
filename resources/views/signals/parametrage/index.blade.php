@extends('layouts.app')

@section('pageTitle', 'Paramétrage des Signaux')

@section('content')

    @php
        $activeTab = 'actifs'; // Tab par défaut
        if (
            request()->has('tab') &&
            in_array(strtolower(request()->get('tab')), ['actifs', 'marche', 'timeframes', 'sessions'])
        ) {
            $activeTab = strtolower(request()->get('tab'));
        }
    @endphp
    {{-- tabs --}}
    <div x-data="{ tab: '{{ $activeTab }}' }" class="mb-8 mt-5">
        <div class="flex space-x-4 border-b border-gray-200">
            <button @click="tab = 'actifs'"
                :class="tab === 'actifs' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                class="flex items-center px-4 py-2 focus:outline-none transition">
                <i class="ti ti-history mr-2"></i>
                Actifs
            </button>
            <button @click="tab = 'marche'"
                :class="tab === 'marche' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                class="flex items-center px-4 py-2 focus:outline-none transition">
                <i class="ti ti-key mr-2"></i>
                Type de marché d'accès
            </button>
            <button @click="tab = 'timeframes'"
                :class="tab === 'timeframes' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                class="flex items-center px-4 py-2 focus:outline-none transition">
                <i class="ti ti-credit-card mr-2"></i>
                Timeframes
            </button>
            <button @click="tab = 'sessions'"
                :class="tab === 'sessions' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                class="flex items-center px-4 py-2 focus:outline-none transition">
                <i class="ti ti-credit-card mr-2"></i>
                Sessions
            </button>
        </div>
        <div class="mt-6">
            <div x-show="tab === 'actifs'">
                {{-- Contenu de l'onglet Actifs --}}
                <x-actif-crud />
            </div>
            <div x-show="tab === 'marche'">
                {{-- Contenu de l'onglet Type de marché --}}
                <x-type-marche-crud />
            </div>
            <div x-show="tab === 'timeframes'">
                {{-- Contenu de l'onglet Souscrire --}}
                <x-timeframe-crud />
            </div>
            <div x-show="tab === 'sessions'">
                {{-- Contenu de l'onglet Souscrire --}}
                <x-session-crud />
            </div>
        </div>
    </div>
    <div class="">
    </div>
@endsection
