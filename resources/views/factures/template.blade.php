<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture Paiement #{{ $paiement->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .details p {
            margin: 6px 0;
        }
        .details strong {
            width: 120px;
            display: inline-block;
        }
        .footer {
            margin-top: 40px;
            font-size: 10px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>

<h2>Facture de paiement #{{ $paiement->id }}</h2>

<div class="details">
    <p><strong>Utilisateur :</strong> {{ optional($paiement->user)->name ?? 'N/A' }}</p>
    <p><strong>Date de paiement :</strong> {{ $paiement->DateHeurePaiement->format('d/m/Y') }}</p>
    <p><strong>Montant :</strong> {{ number_format($paiement->Montant, 4) }} {{ $paiement->Devise }}</p>
    <p><strong>Mode de paiement :</strong> {{ $paiement->ModeDePaiement }}</p>
    <p><strong>Statut :</strong> {{ $paiement->Status }}</p>

    @if ($paiement->souscription)
        <p><strong>Plan :</strong> {{ optional($paiement->souscription->plan)->Titre ?? 'N/A' }}</p>
        <p><strong>Date de début :</strong> {{ $paiement->souscription->DateHeureDebut->format('d/m/Y') }}</p>
        <p><strong>Date de fin :</strong> {{ $paiement->souscription->DateHeureFin->format('d/m/Y') }}</p>
    @endif
</div>

<div class="footer">
    Facture générée le {{ now()->format('d/m/Y H:i') }}.
</div>

</body>
</html>
