@extends('layouts.app')
@section('pageTitle', 'Nouveau signal')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <div class="flex items-center justify-between mb-6">
            <div class="">
                <span>Formulaire d'ajout d'un signal </span>
            </div>
            <a href="{{ route('signals.index') }}"
                class="inline-flex items-center px-3 py-1 bg-slate-700 text-white rounded-lg shadow hover:bg-blue-700 transition">

                <i class="ti ti-chevron-left mr-2"></i> Retour

            </a>
        </div>
        <div class="bg-white rounded-lg shadow p-8">
            @if ($errors->any())
                <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-200">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('signals.store') }}" method="POST" class="space-y-5">
                @csrf
                @include('signals.partials.form')
                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="inline-flex items-center px-3 py-1 bg-slate-700 text-white rounded-lg shadow hover:bg-blue-700 transition">Créer</button>
                    <a href="{{ route('signals.index') }}"
                        class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection
