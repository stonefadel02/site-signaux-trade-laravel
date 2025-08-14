@extends('layouts.app')
@section('pageTitle', 'Nouveau signal')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-xl font-bold mb-6 text-gray-800">Créer un signal</h1>
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
                <button type="submit"
                    class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition">Créer</button>
            </form>
        </div>
    </div>
@endsection
