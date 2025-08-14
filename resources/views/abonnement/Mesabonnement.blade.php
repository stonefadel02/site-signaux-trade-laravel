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
    .flex-row {
        display: flex;
        gap: 20px;
        width: 100%;
    }
    .status-box,
    .plan-box,
    .info-box {
        border-radius: 8px;
        padding: 40px;
        font-size: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex: 1;
        box-sizing: border-box;
    }
    .status-box {
        background-color: #b9f6cc;
        color: #010311;
        border: 4px solid #21db5c;
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
        color: #4ac859;
        font-weight: bold;
        font-size: 25px;
        border: 4px solid #4ac859;
    }
    .plan-box {
        background-color: #bbcaf9;
        color: #04081c;
        border: 4px solid #0c2dd5;
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

@section('content')



<div class="container-fullwidth">

    <div class="flex-row">
        <div class="status-box">
            <div class="status-text">
                <div style="font-size: 20px; color: #4f4f4f; margin-bottom: 7px;">Statut de l'abonnement</div>
                @if ($subscription)
                    <div style="font-weight: 600;">{{ $subscription->Status }}</div> 
                @else
                    <div style="font-weight: 600;">Inactif</div> 
                @endif
            </div>
            <div class="status-icon">&#10003;</div>
        </div>

        <div class="plan-box">
            <div class="plan-text">
                <div style="margin-bottom: 7px; font-size: 20px; color: #0c2dd5;">Plan Journalier</div>
                <div style="font-weight: 600;">15 USDT</div>
            </div>
            <div class="plan-icon" style="color: #0c2dd5; font-size: 60px;">₿</div>
        </div>

        <div class="info-box">
            <ul>
                <li>10 signaux par session</li>
                <li>Accès immédiat après paiement</li>
                <li>Code unique valable 24h</li>
            </ul>
        </div>
    </div>

    <div class="footer-box mb-3" >
        <div>
            <div class="expire-text">Expire le :</div>
            <div style="font-weight: 600;">28 Juillet 2025</div>
        </div>
        <div>
            <button 
                class="btn-primary-custom" 
                type="button"
                onclick="window.location.href=''">
                Renouveler
            </button>

            <button 
                class="btn-outline-primary-custom" 
                type="button"
                onclick="window.location.href=''">
                Changer de Plan
            </button>
        </div>
    </div>

    <div class="container" style="margin-top: 40px; width: 100%; max-width: none; padding: 40px; box-sizing: border-box;">
        <div class="header d-flex align-items-center mb-4">
            <i class="fab fa-bitcoin-sign icon mr-3" style="font-size: 24px;"></i>
            <h2 class="mb-0">Mes Paiements</h2>
            <div class="nav-links ml-auto d-flex gap-3">
                <a href="#" class="active">Paiements</a>
                <a href="#"><i class="fas fa-receipt icon mr-1"></i>Récents</a>
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
                    <div class="dropdown ml-3">
                        <button 
                            class="btn btn-outline-primary dropdown-toggle"
                            type="button"
                            id="dropdownMenuButton{{ $paiement->id }}"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Télécharger PDF
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $paiement->id }}">
                            <li>
                                <a class="dropdown-item" href="{{ route('payments.download', ['id' => $paiement->id, 'format' => 'a4']) }} " target="out_blank">
                                    
                                    Format A4
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('payments.download', ['id' => $paiement->id, 'format' => 'a6']) }}"target="out_blank">
                                    
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
