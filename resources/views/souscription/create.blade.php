@extends('layouts.app')

@section('script')
    <script>
        function openPlanModal(planId, titre, prix, duree, avantages) {
            document.getElementById('modalPlanId').value = planId;
            document.getElementById('modalPlanTitre').innerText = titre;
            document.getElementById('modalPlanPrix').innerText = prix;
            document.getElementById('modalPlanDuree').innerText = duree;

            const ul = document.getElementById('modalPlanAvantages');
            ul.innerHTML = '';
            avantages.forEach(av => {
                const li = document.createElement('li');
                li.innerText = av;
                ul.appendChild(li);
            });

            document.getElementById('planModal').classList.remove('hidden');
        }

        // Fermeture du modal
        document.getElementById('closePlanModal').addEventListener('click', () => {
            document.getElementById('planModal').classList.add('hidden');
        });
        document.getElementById('closePlanModalBtn').addEventListener('click', () => {
            document.getElementById('planModal').classList.add('hidden');
        });
        document.getElementById('planModalOverlay').addEventListener('click', () => {
            document.getElementById('planModal').classList.add('hidden');
        });
    </script>
@endsection

@section('style')
    <style>
        /* Conteneur principal en full width avec padding */
        .container-fullwidth {
            width: 100%;
            padding: 80px 40px;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: none;
            /* POUR PRENDRE TOUTE LA LARGEUR */
            padding: 80px 40px;
            box-sizing: border-box;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }


        /* Flex horizontal, boîtes qui prennent toute la place disponible également */
        .flex-row {
            display: flex;
            gap: 20px;
            /* pour que les boîtes s'étendent */
            width: 100%;
        }

        /* Boîtes avec flex-grow */
        .status-box,
        .plan-box,
        .info-box {
            border-radius: 20px;
            padding: 40px;
            font-size: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex: 1;
            /* Chacune prend égal largeur */
            box-sizing: border-box;
        }

        .status-box {
            display: flex;
            align-items: center;
            padding: 40px;
            border-radius: 20px;
        }

        /* ACTIVE */
        .status-active {
            background-color: #b9f6cc;
            border: 4px solid #4ac859;
        }

        .icon-active {
            color: #4ac859;
            border: 4px solid #4ac859;
        }

        /* INACTIVE */
        .status-inactive {
            background-color: #fff3cd;
            border: 4px solid #ffb84d;
        }

        .icon-inactive {
            color: #ffb84d;
            border: 4px solid #ffb84d;
        }

        /* EXPIRE */
        .status-expire {
            background-color: #ffcccc;
            border: 4px solid #e60000;
        }

        .icon-expire {
            color: #e60000;
            border: 4px solid #e60000;
        }

        .status-text {
            flex-grow: 1;
        }

        .status-icon {
            background-color: transparent;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 25px;
        }

        .plan-box {
            background-color: #bbcaf9;
            color: #04081c;
            border: 4px solid #0c2dd5;

        }

        .plan-boxe {
            background-color: #bbcaf9;
            color: #0c2dd5;
        }

        .plan-text {
            flex-grow: 1;
        }

        .plan-icon {
            font-weight: bold;
            font-size: 28px;
        }

        .info-box {
            background-color: #becbf4;
            color: #171a2c;
            flex-direction: column;
            justify-content: center;
            font-size: 18px;
            border: 4px solid #0c2dd5;
        }

        .info-box ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-box li {
            margin-bottom: 6px;
            position: relative;
            padding-left: 20px;
        }

        .info-box li::before {
            content: "✓";
            color: #0c2dd5;
            font-weight: bold;
            position: absolute;
            left: 0;
            top: 0;
        }

        .footer-box {
            margin-top: 30px;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            width: 100%;
            box-sizing: border-box;
        }

        .expire-text {
            color: #81828c;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .btn-primary-custom {
            background-color: #0051ff;
            border: none;
            padding: 8px 16px;
            font-size: 18px;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-outline-primary-custom {
            background-color: #bbcaff;
            border: none;
            padding: 8px 14px;
            font-size: 18px;
            color: #2c61ff;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }


        .status-box .status-text div:last-child {
            font-weight: 600;
            color: #000000;
            /* texte noir */
        }

        .container {
            max-width: 1000px;
            /* même que flex-row */
            margin: 40px auto 0 auto;
            /* descend un peu et centre */
            padding: 40px;
        }

        h2 {
            color: #333;
            margin-bottom: 5px;
            font-size: 24px;
        }

        .subtitle {
            color: #888;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .plans-grid {
            display: flex;
            gap: 30px;
            /* espace entre les cards */
            flex-wrap: wrap;
            justify-content: center;
            /* centre les cards horizontalement */
        }

        .plan-card {
            flex: 1 1 30%;
            /* prend environ 30% de la ligne, s’adapte si nécessaire */
            min-width: 250px;
            /* largeur minimale pour que la card ne devienne pas trop petite */
            max-width: 320px;
            /* largeur maximale */
            background: linear-gradient(135deg, #1a2332 0%, #0f1419 100%);
            color: #fff;
            padding: 35px 25px;
            border-radius: 5px;
            min-height: 350px;
            display: flex;
            flex-direction: column;
            position: relative;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .plan-card h3 {
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .price {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .price-period {
            font-size: 14px;
            color: #888;
            margin-bottom: 10px;
        }

        .discount {
            font-size: 12px;
            color: #4a9eff;
            margin-bottom: 20px;
        }

        .features {
            list-style: none;
            margin-bottom: 30px;
            flex-grow: 1;
        }

        .features li {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            font-size: 13px;
            color: #ccc;
        }

        .features li::before {
            content: "✓";
            color: #ffd700;
            font-weight: bold;
            margin-right: 10px;
            font-size: 14px;
        }

        .choose-btn {
            background-color: #1e3a5f;
            color: #4a9eff;
            border: 1px solid #2d4a6b;
            padding: 8px 16px;
            /* réduit le bouton */
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 12px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            align-self: flex-start;
            /* bouton à gauche */
        }

        .choose-btn:hover {
            background-color: #4a9eff;
            color: white;
            transform: translateY(-2px);
        }

        .choose-btn.recommended {
            background-color: #4a9eff;
            color: white;
            border-color: #4a9eff;
        }

        .plan-card.recommended {
            border: 2px solid #4a9eff;
            transform: scale(1.02);
        }

        .choose-btn:hover~.plan-card,
        .choose-btn:hover {
            /* ça ne fonctionne pas pour le parent, donc on utilise cette méthode */
        }

        /* Solution correcte : utiliser le parent .plan-card:hover sur tout le card */
        .plan-card:hover {
            border: 2px solid #4a9eff;
            /* même que card "recommandée" */
            transform: scale(1.02);
            transition: all 0.3s ease;
        }

        /* Modal custom avec fond blanc */
        .modal-content {
            border-radius: 15px;
            background-color: #ffffff;
            /* fond blanc */
            color: #1a1a1a;
            /* texte sombre */
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            /* ombre douce */
            padding: 20px;
        }

        .modal-header {
            border-bottom: none;
            padding-bottom: 10px;
        }

        .modal-title {
            font-size: 22px;
            font-weight: 600;
            color: #4a9eff;
            /* titre bleu */
        }

        .modal-body p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .modal-body ul {
            list-style: none;
            padding-left: 0;
        }

        .modal-body ul li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 8px;
            font-size: 15px;
            color: #333;
        }

        .modal-body ul li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #4a9eff;
            /* coche bleu */
            font-weight: bold;
        }

        .modal-footer {
            border-top: none;
            padding-top: 15px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .modal-footer .btn-primary {
            background-color: #4a9eff;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
            color: white;
        }

        .modal-footer .btn-primary:hover {
            background-color: #4a9eff;
        }

        .modal-footer .btn-secondary {
            background-color: #969191;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            transition: 0.3s;
            color: #333;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #e0e0e0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fullwidth">

        <div class="flex-row">
            @php
                $status = $souscription->Status ?? 'INACTIVE';

                $statusClasses = [
                    'ACTIVE' => [
                        'box' => 'status-active',
                        'icon' => 'icon-active',
                    ],
                    'INACTIVE' => [
                        'box' => 'status-inactive',
                        'icon' => 'icon-inactive',
                    ],
                    'EXPIRE' => [
                        'box' => 'status-expire',
                        'icon' => 'icon-expire',
                    ],
                ];
            @endphp

        </div>
        <div class="container" style="margin-top: 40px; width: 100%; max-width: none; padding: 40px; box-sizing: border-box;">
            <h2>Changer de Plan</h2>
            <p class="subtitle">Choisissez votre nouveau Plan</p>

            <div x-data="{ openPlanModal: false, planId: '', planTitre: '', planPrix: '', planDuree: '', planAvantages: [] }">

                <div class="plans-grid">
                    @forelse ($plans as $plan)
                        <div class="plan-card" data-plan-id="{{ $plan->id }}">
                            <h3>{{ $plan->Titre }}</h3>
                            <div class="price">{{ $plan->Prix }} {{ $plan->Devise }}<span
                                    class="price-period">/{{ $plan->DureeEnJours }} J</span></div>
                            <div class="discount">(+30% sur signal)</div>

                            <hr style="border: none; height: 2px; background-color: #007bff; margin: 8px 0;">

                            <ul class="features my-2">
                                @php
                                    $avantages = json_decode($plan->AutresAvantages, true) ?? [];
                                @endphp
                                @foreach ($avantages as $avantage)
                                    <li>{{ $avantage }}</li>
                                @endforeach
                            </ul>

                            <button class="choose-btn"
                                onclick="openPlanModal({{ $plan->id }}, '{{ $plan->Titre }}', '{{ $plan->Prix }} {{ $plan->Devise }}', '{{ $plan->DureeEnJours }}', {{ json_encode(json_decode($plan->AutresAvantages, true) ?? []) }})">
                                CHOISIR
                            </button>
                        </div>
                    @empty
                        <p class="text-center">Aucun plan disponible.</p>
                    @endforelse
                </div>

                @include('souscription.recapitulatifmodal')

            </div>

        </div>

    </div>
@endsection
