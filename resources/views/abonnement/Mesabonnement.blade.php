@extends('layouts.app')

@section('styles')
<style>
    /* Vos styles ci-dessous... (je conserve vos styles précédents sans modification) */
    .container-fullwidth {
        width: 100%;
        padding: 80px 40px;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }
    .container-custom-width {
        max-width: 900px;
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
            flex: 1; /* Chacune prend égal largeur */
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
    .container {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        width: 100%;
        max-width: 800px;
        padding: 30px;
    }
    .header {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
    }
    .header h2 {
        margin: 0;
        font-size: 24px;
        color: #333;
        flex-grow: 1;
    }
    .header .nav-links {
        display: flex;
        gap: 25px;
        font-size: 16px;
    }
    .header .nav-links a {
        text-decoration: none;
        color: #555;
        padding-bottom: 5px;
        position: relative;
    }
    .header .nav-links a.active {
        font-weight: 500;
        color: #007bff;
    }
    .header .nav-links a.active::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 2px;
        background-color: #007bff;
    }
    .payment-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px 0;
        border-bottom: 1px solid #eee;
    }
    .payment-item:last-child {
        border-bottom: none;
    }
    .currency-btn {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 6px;
        font-weight: 700;
        min-width: 70px;
        text-align: center;
    }
    .payment-details {
        flex-grow: 1;
    }
    .payment-details p {
        margin: 0;
        font-size: 16px;
        color: #333;
    }
    .payment-details .date {
        font-size: 14px;
        color: #777;
        margin-bottom: 5px;
    }
    .btn-outline-primary {
        margin-left: 15px;
    }
</style>
@endsection

@section('content')



<div class="container-fullwidth">

    <div class="flex-row">
            @php
                $status = $subscription->Status ?? 'INACTIVE';

                $statusClasses = [
                    'ACTIVE' => [
                        'box' => 'status-active',
                        'icon' => 'icon-active'
                    ],
                    'INACTIVE' => [
                        'box' => 'status-inactive',
                        'icon' => 'icon-inactive'
                    ],
                    'EXPIRE' => [
                        'box' => 'status-expire',
                        'icon' => 'icon-expire'
                    ]
                ];
            @endphp

            <div class="status-box {{ $statusClasses[$status]['box'] }}">
                <div class="status-text">
                    <div style="font-size: 20px; color: #4f4f4f; margin-bottom: 7px;">Statut de l'abonnement</div>
                    <div style="font-weight: 600;">{{ $status }}</div>
                </div>
                <div class="status-icon {{ $statusClasses[$status]['icon'] }}">&#10003;</div>
            </div>


            <div class="plan-box">
                <div class="plan-text">
                    <div style="margin-bottom: 7px; font-size: 20px; color: #0c2dd5;">Plan {{$subscription->plan->Titre}}</div>
                    <div style="font-weight: 600;">{{$subscription->Montant}} {{$subscription->Devise}}</div>
                </div>
                <div class="plan-icon" style="color: #0c2dd5; font-size: 60px;">₿</div>
            </div>

            <div class="info-box">
                <ul>
                    @php
                        $avantages = json_decode($subscription->plan->AutresAvantages ?? '[]', true);
                    @endphp

                    @foreach($avantages as $avantage)
                        <li>{{ $avantage }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

    <div class="footer-box mb-3" >
        <div>

            <div class="expire-text">Expire le :</div>
            <div style="font-weight: 600;"> {{$subscription->DateHeureFin}}</div>
        </div>
        <div>
            <button 
                class="btn-primary-custom" 
                type="button"
                onclick="window.location.href='{{ route('souscription.create')}}'">
                Renouveler
            </button>

            <button 
                class="btn-outline-primary-custom" 
                type="button"
                onclick="window.location.href='{{ route('souscription.create') }}'">
                Changer de Plan
            </button>
        </div>
    </div>

    <div class="container" style="margin-top: 40px; width: 100%; max-width: none; padding: 40px; box-sizing: border-box;">
        <div class="header d-flex align-items-center mb-4">
                <i class="ti ti-currency-bitcoin p-4 text-5xl"></i>

            <h2 class="mb-0">Mes Paiements</h2>
            <div class="nav-links ml-auto d-flex gap-3">
                <a href="#"><i class="ti ti-filter-pause"></i>
Récents</a>
            </div>
        </div>

        <div class="payment-list">
            @forelse ($paiements as $paiement)
                <div class="payment-item">
                    <div class="currency-btn rounded px-3 py-2 font-weight-bold">
                        {{ $paiement->Devise }}
                    </div>
                    <div class="payment-details">
                        <p class="date mb-1 text-muted">{{ $paiement->DateHeurePaiement->format('d/m/Y') }}</p>
                        <p class="mb-0 font-weight-bold">{{ number_format($paiement->Montant, 4) }} {{ $paiement->Devise }}</p>
                    </div>

                    {{-- Statut avec icône outline --}}
                    @if ($paiement->Status === 'COMPLETED')
                        <i class="far fa-check-circle text-success" style="font-size: 28px;" title="Paiement complété"></i>
                    @elseif ($paiement->Status === 'PENDING')
                        <i class="far fa-clock text-warning" style="font-size: 28px;" title="Paiement en attente"></i>
                    @elseif ($paiement->Status === 'FAILED')
                        <i class="far fa-times-circle text-danger" style="font-size: 28px;" title="Paiement annulé"></i>
                    @else
                        <i class="far fa-question-circle text-secondary" style="font-size: 28px;" title="Statut inconnu"></i>
                    @endif

                    {{-- Dropdown menu pour téléchargement PDF --}}
                <div class="relative ml-3" x-data="{ open: false }" @keydown.escape="open = false" @click.away="open = false">
                    <button
                        @click.prevent="open = !open"
                        type="button"
                        class="border border-blue-500 text-blue-700 rounded px-4 py-2 text-lg hover:bg-blue-100 focus:outline-none focus:ring focus:ring-blue-300"
                        aria-haspopup="true"
                        :aria-expanded="open.toString()"
                        id="dropdownMenuButton{{ $paiement->id }}">
                        <i class="ti ti-download"></i>
                        Télécharger PDF
                    </button>

                    <ul
                        x-show="open"
                        x-transition
                        class="absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded shadow-lg z-50"
                        role="menu"
                        aria-labelledby="dropdownMenuButton{{ $paiement->id }}"
                        style="display:none;"
                    >
                        <li>
                            <a href="{{ route('payments.download', ['id' => $paiement->id, 'format' => 'a4']) }}" target="_blank"
                            class="block px-4 py-2 text-gray-700 hover:bg-blue-500 hover:text-black cursor-pointer"
                            role="menuitem">
                            Format A4
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('payments.download', ['id' => $paiement->id, 'format' => 'a6']) }}" target="_blank"
                            class="block px-4 py-2 text-gray-700 hover:bg-blue-500 hover:text-black cursor-pointer"
                            role="menuitem">
                            Format A6
                            </a>
                        </li>
                    </ul>
                </div>
                </div>
            @empty
                <p>Aucun paiement trouvé.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
