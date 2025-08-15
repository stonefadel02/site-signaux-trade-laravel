@extends('layouts.app')

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('accessChart').getContext('2d');
    const accessChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['0', '2025', '2026', '2027', '2028', '2029', '2030', '2031', '2032'],
            datasets: [{
                label: 'Nombre d\'accès',
                data: [70, 60, 100, 190, 200, 240, 180, 220, 210, 350, 360, 360, 180, 185, 170, 180, 280, 350, 300, 180, 180, 150, 190],
                borderColor: '#00FF7F',
                borderWidth: 2,
                fill: false,
                tension: 0.4
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false,
                    ticks: {
                        stepSize: 70,
                        callback: function(value) {
                            if ([30, 100, 200, 350, 500].includes(value)) {
                                return value;
                            }
                            return '';
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
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
            font-weight: 600; /* Texte en gras */
            color: #212529;
        }

        .icon-text i {
            font-size: 20px;
            color: #e5e5e5; /* Gris clair qui tend vers blanc */
        }

        .number {
            font-size: 32px;
            font-weight: 700; /* Gras */
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
            font-weight: 700; /* Gras */
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
                    <i class="fas fa-users"></i>
                    <span>Utilisateurs</span>
                </div>
                <div class="number">{{ $users }}</div>
            </div>
            <div class="widget">
                <div class="icon-text">
                    <i class="fas fa-wallet"></i>
                    <span>Abonnements actifs</span>
                </div>
                <div class="number">{{ $abonnements }}</div>
            </div>
            <div class="widget">
                <div class="icon-text" style="display:flex; align-items:center; gap:8px;">
                    <span style="color:#e5e5e5; font-size:25px; font-weight:bold; line-height:1;">₿</span>
                    <span style="font-weight:600; color:#212529;">Revenus mensuels</span>
                </div>
                <div class="number">{{ $revenuMensuel }} USDT</div>
            </div>
            <div class="widget">
                <div class="icon-text" style="display:flex; align-items:center; gap:8px;">
                    <span style="color:#e5e5e5; font-size:25px; font-weight:bold; line-height:1;">₿</span>
                    <span style="font-weight:600; color:#212529;">Accès signaux (7)</span>
                </div>
                <div class="number">0</div>
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
