@extends('layouts.app')
@section('pageTitle', 'Sessions de signaux')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <div class="flex items-center justify-between mb-6">
            <div class="">
                <span>Formulaire de modification d'une session </span>
            </div>
            <a href="{{ route('session-signals.index') }}"
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
            <form action="{{ route('session-signals.update', $sessionSignal) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                @include('session_signals.form')

            </form>
        </div>
    </div>
@endsection
