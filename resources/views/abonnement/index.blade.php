@extends('layouts.app')

@section('pageTitle', __('subscription.page_title'))

@section('content')
    <div class="max-w-7xl mx-auto py-6 ">
        @include('abonnement.partials.etat-souscription')
    </div>

    {{-- tabs --}}
    <div x-data="{ tab: 'historiques' }" class="mb-8">
        <div class="flex space-x-4 border-b border-gray-200">
            <button @click="tab = 'historiques'"
                :class="tab === 'historiques' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                class="flex items-center px-4 py-2 focus:outline-none transition">
                <i class="ti ti-history mr-2"></i>
                {{ __('subscription.tabs.history') }}
            </button>
            <button @click="tab = 'code'"
                :class="tab === 'code' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                class="flex items-center px-4 py-2 focus:outline-none transition">
                <i class="ti ti-key mr-2"></i>
                {{ __('subscription.tabs.code') }}
            </button>
            <button @click="tab = 'soucrire'"
                :class="tab === 'soucrire' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500'"
                class="flex items-center px-4 py-2 focus:outline-none transition">
                <i class="ti ti-credit-card mr-2"></i>
                {{ __('subscription.tabs.subscribe') }}
            </button>
        </div>
        <div class="mt-6">
            <div x-show="tab === 'historiques'">
                {{-- Contenu de l'onglet Historiques --}}
                <div class="bg-white w-full rounded-lg p-4">
                    <h6 class="text-lg font-semibold mb-0">{{ __('subscription.history_heading') }}</h6>
                    <p class="mb-2 text-sm text-gray-700">{{ __('subscription.history_subheading') }}</p>
                    <table class="min-w-full divide-y divide-gray-200 mt-4 border rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                    {{ __('subscription.table.plan') }}</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                    {{ __('subscription.table.amount') }}</th>

                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                    {{ __('subscription.table.start') }}</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                    {{ __('subscription.table.end') }}</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                    {{ __('subscription.table.status') }}</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                    {{ __('subscription.table.access_code') }}</th>
                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($souscriptions as $souscription)
                                <tr>
                                    <td class="px-4 py-2">{{ $souscription->plan_id }}</td>
                                    <td class="px-4 py-2">{{ money($souscription->Montant) }} {{ $souscription->Devise }}
                                    </td>

                                    <td class="px-4 py-2">{{ $souscription->DateHeureDebut }}</td>
                                    <td class="px-4 py-2">{{ $souscription->DateHeureFin }}</td>
                                    <td class="px-4 py-2">
                                        @php
                                            $statusClassMap = [
                                                'active' => 'bg-green-100 text-green-800',
                                                'expired' => 'bg-red-100 text-red-800',
                                            ];
                                            $statusClasses =
                                                $statusClassMap[$souscription->Status] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="px-2 py-1 rounded text-xs {{ $statusClasses }}">
                                            {{ ucfirst($souscription->Status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">{{ $souscription->AccessCode }}</td>
                                    <td class="px-4 py-2">
                                        {{-- href="{{ route('souscriptions.recu', $souscription->id) }}" --}}
                                        @php
                                            $payment = $souscription->paiements->first();
                                        @endphp
                                        @if ($payment)
                                            <a href="{{ route('payments.download', $payment->id) }}"
                                                class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 transition">
                                                <i class="ti ti-download mr-1"></i> {{ __('subscription.table.receipt') }}
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-4 text-center text-gray-500 font-bold">
                                        {{ __('subscription.table.none') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div x-show="tab === 'code'">
                <div class="bg-white w-full rounded-lg">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold !mb-1">{{ __('subscription.access_code.have_code') }}</h2>
                        <p class="mb-2 text-sm text-gray-700">{{ __('subscription.access_code.enter_code') }} </p>
                        <form action="{{ route('souscription.store-code') }}" method="post">
                            @csrf
                            <input type="text" name="code"
                                class="mt-2 w-full border border-gray-300 rounded-lg p-2 mb-5"
                                placeholder="{{ __('subscription.access_code.placeholder') }}" required minlength="3">
                            <button class="bg-[#12141D] text-white px-4 py-2 rounded-lg hover:bg-blue-900" type="submit">
                                {{ __('subscription.access_code.submit') }}
                            </button>
                        </form>

                    </div>
                </div>

            </div>
            <div x-show="tab === 'soucrire'">
                {{-- Contenu de l'onglet Souscrire --}}
                <div class="bg-white w-full rounded-lg p-4">

                    <x-pricing-section-app class="mt-2" />
                </div>

            </div>
        </div>
    </div>
    <div class="">
    </div>
@endsection
