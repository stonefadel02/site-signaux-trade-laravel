@extends('layouts.app')

@section('pageTitle', 'Signaux de Trading')

@section('content')
    <div class="max-w-7xl mx-auto py-6 ">
        @include('souscription.partials.etatAbonnementActuel')
    </div>
@endsection
