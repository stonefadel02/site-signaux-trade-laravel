@extends('layouts.app')

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 <script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch("{{ route('admin.signal-stats') }}")
            .then(response => response.json())
            .then(apiData => {
                const ctx = document.getElementById('accessChart').getContext('2d');
                if (ctx) { 
                    const accessChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: apiData.labels,
                            datasets: [{
                                label: 'Nombre de signaux créés',
                                data: apiData.data,
                                borderColor: '#00FF7F',
                                borderWidth: 2,
                                fill: false,
                                tension: 0.4
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                            },
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                }
            });
    });
</script>
@endsection

@section('style')
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: auto;
            padding-top: 30px;
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Grid pour largeur égale */
        .header-widgets {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .widget {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 130px;
        }

        .icon-text {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: 600;
            /* Texte en gras */
            color: #212529;
        }

        .icon-text i {
            font-size: 30px;
            color: #e5e5e5;
            /* Gris clair qui tend vers blanc */
        }

        .number {
            font-size: 32px;
            font-weight: 700;
            /* Gras */
            color: #212529;
        }

        .chart-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            font-size: 16px;
            font-weight: 700;
            /* Gras */
            color: #212529;
            margin-bottom: 20px;
        }

        .chart-placeholder {
            height: 300px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .header-widgets {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .header-widgets {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-container">
        <div class="header-widgets">
            <div class="widget">
                <div class="icon-text">
                    <i class="ti ti-users-group"></i>
                    <span>Utilisateurs</span>
                </div>
                <div class="number">{{ $users }}</div>
            </div>
            <div class="widget">
                <div class="icon-text">
                    <i class="ti ti-wallet"></i>
                    <span>Abonnements actifs</span>
                </div>
                <div class="number">{{ $abonnements }}</div>
            </div>
            <div class="widget">
                <div class="icon-text">
                    <i class="ti ti-currency-bitcoin"></i>
                    <span>Revenus mensuels</span>
                </div>
                <div class="number">{{ $revenuMensuel }} USDT</div>
            </div>
            <div class="widget">
                <div class="icon-text">
                    <i class="ti ti-activity-heartbeat"></i> {{-- J'ai changé l'icône pour être plus pertinente --}}
                    <span>Signaux (7 derniers jours)</span>
                </div>
                <div class="number">{{ $signaux7DerniersJours }}</div>
            </div>

        </div>

        <div class="chart-card">
            <div class="card-header">
                Statistique d'accès aux signaux
            </div>
            <div style="height: 300px;">
                <canvas id="accessChart"></canvas>
            </div>
        </div>
    </div>
@endsection
