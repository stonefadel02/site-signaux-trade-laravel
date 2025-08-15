@extends('layouts.app')

@section('pageTitle', 'Access Code')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <div class="flex items-center justify-between mb-6">
            <div class="">
                <span>Formulaire d'ajout d'un Access Code </span>
            </div>
            <a href="{{ route('access-codes.index') }}"
                class="inline-flex items-center px-3 py-1 bg-slate-700 text-white rounded-lg shadow hover:bg-blue-700 transition">
                <i class="ti ti-chevron-left mr-2"></i> Retour
            </a>
        </div>
        <div class="bg-white rounded-lg shadow p-8">
           
            <form action="{{ route('access-codes.store') }}" method="POST" class="space-y-5">
                @csrf
                @include('access-code.form')
            </form>
        </div>
    </div>
@endsection
