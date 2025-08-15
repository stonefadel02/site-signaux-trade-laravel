@extends('layouts.app')

@section('style')
    <style>
        .dashboard-container {
            width: 100%;           /* Prend toute la largeur possible */
            max-width: 1200px;     /* Tu peux ajuster selon ton écran */
            margin: 0 auto;        /* Centrer horizontalement */
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;         /* Padding pour que le contenu ne colle pas aux bords */
        }

        .card {
            width: 100%;
            background-color: #fff;
            padding: 30px 20px; /* padding vertical plus grand */
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            min-height: 180px; /* optionnel : force une hauteur minimum */
        }

        .card-header {
            background-color: transparent; /* Supprime tout fond */
            color: #212529;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Subscription Status Card */
        .status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 600;
            color: #28a745;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #28a745;
            
        }
    

        .progress-bar-container {
            width: 100%;
            height: 8px;
            background-color: #e9ecef;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .progress-bar {
            height: 100%;
            background-color: #dc3545; /* Rouge pour la barre */
            border-radius: 4px;
        }

        .expiry-date {
            font-size: 14px;
            color: #6c757d;
        }

        .date-text {
            font-weight: 600;
            color: #212529;
        }

        /* Next Signal Session Card */
        .session-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .session-icon {
            width: 20px;
            height: 20px;
            object-fit: contain;
            opacity: 0.5;
        }

        .session-time {
            background-color: #e9ecef;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #212529;
        }

        .timer {
            font-size: 14px;
            color: #6c757d;
            margin-top: 5px;
        }

        .countdown {
            font-size: 24px;
            font-weight: 600;
            color: #212529;
        }

        /* Signal Access Table Card */
        .access-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .access-button:hover {
            background-color: #0056b3;
        }

        .signals-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
            margin-top: 10px;
        }

        .signals-table th, .signals-table td {
            padding: 12px 0;
            border-bottom: none;
            color: #495057;
        }

        .signals-table th {
            font-weight: 600;
            color: #6c757d;
        }

        .action-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .action-button:hover {
            background-color: #0056b3;
        }

        /* Responsive léger */
        @media (max-width: 576px) {
            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .session-info {
                flex-wrap: wrap;
            }
        }

        .expiry-container {
            display: flex;
            justify-content: space-between; /* met le texte à gauche et la date à droite */
            align-items: flex-end;          /* aligne verticalement vers le bas */
            margin-top: 10px;               /* un peu d’espace par rapport à la barre */
            font-size: 14px;
            color: #6c757d;
        }

        .expiry-container .date-text {
            font-weight: 600;
            color: #212529;
        }

        .timer-container {
            display: flex;
            justify-content: space-between; /* gauche / droite */
            align-items: flex-end;          /* aligne verticalement en bas */
            margin-top: 10px;               /* espace par rapport au contenu au-dessus */
            font-size: 14px;
            color: #6c757d;
        }

        .timer-container .countdown {
            font-size: 20px;
            font-weight: 600;
            color: #212529;
        }


    </style>
@endsection

@section('content')
@php
use Carbon\Carbon;
@endphp
    <div class="dashboard-container">

        <!-- Subscription Status Card -->
      @if($souscription)
    <div class="card">
        <div class="card-header">
            <span>Statut de l'abonnement</span>
            <span class="status">
                <span class="status-dot" style="background-color:
                    @switch($souscription->Status)
                        @case('ACTIVE') #28a745 @break
                        @case('INACTIVE') #ffc107 @break
                        @case('EXPIRE') #dc3545 @break
                        @default #6c757d
                    @endswitch
                "></span>
                {{ ucfirst(strtolower($souscription->Status)) }}
            </span>
        </div>
        <div class="progress-bar-container">
            @php
                $total = strtotime($souscription->DateHeureFin) - strtotime($souscription->DateHeureDebut);
                $remaining = max(strtotime($souscription->DateHeureFin) - time(), 0);
                $progress = 100 - ($remaining / $total * 100);
            @endphp
            <div class="progress-bar" style="width: {{ $progress }}%;"></div>
        </div>
        <div class="expiry-container">
            <span>Expire le :</span>
            <span class="date-text">{{ \Carbon\Carbon::parse($souscription->DateHeureFin)->format('d F Y') }}</span>
        </div>
    </div>
@else
    <p>Aucune souscription active pour le moment.</p>
@endif


        <!-- Next Signal Session Card -->
        <div class="card">
            <div class="card-header">
                Prochaine session de signaux
                <div class="session-info">
                    <img src="crypto-icon.png" alt="Icon" class="session-icon">
                    <span class="session-time">14h00 (GMT+1)</span>
                </div>
            </div>
            <div class="timer-container">
                <span>Temps restant :</span>
                <span class="countdown">19h 46m 54s</span>
            </div>
        </div>

        <!-- Signal Access Table Card -->
        <div class="card">
            <div class="card-header">
                Accès aux signaux
                <button class="access-button">Accéder aux Signaux</button>
            </div>
            <table class="signals-table">
                <thead>
                    <tr>
                        <th>Paire</th>
                        <th>Direction</th>
                        <th>Durée</th>
                        <th>Probabilité</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>EUR/USD OTC</td>
                        <td>Haut Ciel</td>
                        <td>24h</td>
                        <td>50%</td>
                        <td>
                            <button class="action-button">Go!</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection