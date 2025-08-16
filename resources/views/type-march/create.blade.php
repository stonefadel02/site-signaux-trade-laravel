@extends('layouts.app')

@section('pageTitle', 'Type March')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <div class="flex items-center justify-between mb-6">
            <div class="">
                <span>Formulaire d'ajout d'un Type Marché </span>
            </div>
            <a href="{{ route('parametrage-signaux', ['tab' => 'marche']) }}"
                class="inline-flex items-center px-3 py-1 bg-slate-700 text-white rounded-lg shadow hover:bg-blue-700 transition">
                <i class="ti ti-chevron-left mr-2"></i> Retour
            </a>
        </div>
        <div class="bg-white rounded-lg shadow p-8">

            <form action="{{ route('type-marches.store') }}" method="POST" class="space-y-5">
                @csrf
                @include('type-march.form')
            </form>
        </div>
    </div>
@endsection
