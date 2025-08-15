@extends('layouts.app')

@section('pageTitle', 'Mes souscriptions')

@section('content')
    <div class="max-w-7xl mx-auto py-6 ">
        @include('abonnement.partials.etat-souscription')
    </div>
@endsection
