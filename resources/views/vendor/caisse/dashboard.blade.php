@extends('vendor.caisse.layouts.template')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  :root {
    --primary-color: #6777ef;
    --secondary-color: #6777ef;
    --success-color: #4cc9f0;
    --danger-color: #f72585;
    --warning-color: #f8961e;
    --light-color: #f8f9fa;
    --dark-color: #212529;
    --border-radius: 8px;
    --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fb;
  }

  .welcome-card {
    background: linear-gradient(135deg, #6777ef 0%, #6777ef 100%);
    color: white;
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: var(--box-shadow);
  }

  .stat-card {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    transition: var(--transition);
    height: 100%;
  }

  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  }

  .stat-card .card-body {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .stat-card .icon-container {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    font-size: 1.5rem;
  }

  .stat-card .icon-primary {
    background-color: rgba(67, 97, 238, 0.1);
    color: var(--primary-color);
  }

  .stat-card .icon-success {
    background-color: rgba(76, 201, 240, 0.1);
    color: var(--success-color);
  }

  .stat-card .icon-danger {
    background-color: rgba(247, 37, 133, 0.1);
    color: var(--danger-color);
  }

  .stat-card .icon-warning {
    background-color: rgba(248, 150, 30, 0.1);
    color: var(--warning-color);
  }

  .stat-card .stat-value {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
  }

  .stat-card .stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
  }

  .stat-card .stat-currency {
    font-size: 1rem;
    color: var(--dark-color);
    font-weight: 500;
  }

  .chart-card {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-bottom: 2rem;
  }

  .chart-card .card-header {
    background-color: var(--primary-color);
    color: white;
    border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
    padding: 2rem 1.5rem;
    font-weight: 600;
  }

  .chart-container {
    position: relative;
    height: 515px;
    padding: 1rem;
  }

  .badge {
    font-weight: 500;
    padding: 0.5em 0.75em;
    border-radius: 20px;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .badge-primary {
    background-color: var(--primary-color);
    color: white;
  }

  .badge-success {
    background-color: var(--success-color);
    color: white;
  }

  .badge-danger {
    background-color: var(--danger-color);
    color: white;
  }

  .badge-warning {
    background-color: var(--warning-color);
    color: white;
  }
</style>

<div class="container-fluid py-4">
  <!-- Welcome Card -->
  <div class="welcome-card">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h2 class="mb-2">Caisse N° {{ Auth::guard('caisse')->user()->id }}</h2>
        <p class="mb-0">Gérée par {{ Auth::guard('caisse')->user()->name }} {{ Auth::guard('caisse')->user()->prenom }}</p>
      </div>
      <div class="col-md-4 text-md-end">
        <i class="bi bi-cash-stack fa-4x opacity-75"></i>
      </div>
    </div>
  </div>

  <!-- Statistics Cards -->
  <div class="row mb-4">
    <!-- Total Requests -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card">
        <div class="card-body">
          <div class="icon-container icon-primary">
            <i class="bi bi-list-check"></i>
          </div>
          <div class="stat-value text-primary">{{ $total }}</div>
          <div class="stat-label">Nombre de demandes</div>
        </div>
      </div>
    </div>

    <!-- Provided Balance -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card">
        <div class="card-body">
          <div class="icon-container icon-success">
            <i class="bi bi-cash-coin"></i>
          </div>
          <div class="stat-value text-success">{{ number_format($soldeActuel, 0, ',', ' ') }}</div>
          <div class="stat-currency">FCFA</div>
          <div class="stat-label">Solde fourni</div>
        </div>
      </div>
    </div>

    <!-- Debited Balance -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card">
        <div class="card-body">
          <div class="icon-container icon-danger">
            <i class="bi bi-cash-stack"></i>
          </div>
          <div class="stat-value text-danger">{{ number_format($soldeDebite, 0, ',', ' ') }}</div>
          <div class="stat-currency">FCFA</div>
          <div class="stat-label">Solde débité</div>
        </div>
      </div>
    </div>

    <!-- Remaining Balance -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card">
        <div class="card-body">
          <div class="icon-container icon-warning">
            <i class="bi bi-wallet2"></i>
          </div>
          <div class="stat-value text-warning">{{ number_format($soldeRestant, 0, ',', ' ') }}</div>
          <div class="stat-currency">FCFA</div>
          <div class="stat-label">Solde restant</div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-12">
        <div class="chart-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-graph-up me-2"></i>Évolution des demandes</span>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary active" id="btn-week">7 jours</button>
                    <button class="btn btn-outline-primary" id="btn-month">30 jours</button>
                    <button class="btn btn-outline-primary" id="btn-year">1 an</button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="chart-container">
                    <canvas id="evolutionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Récupérer les données passées depuis le contrôleur
    const weeklyData = {
        labels: {!! json_encode([
            Carbon\Carbon::now()->subDays(6)->format('D'),
            Carbon\Carbon::now()->subDays(5)->format('D'),
            Carbon\Carbon::now()->subDays(4)->format('D'),
            Carbon\Carbon::now()->subDays(3)->format('D'),
            Carbon\Carbon::now()->subDays(2)->format('D'),
            Carbon\Carbon::now()->subDays(1)->format('D'),
            Carbon\Carbon::now()->format('D')
        ]) !!},
        naissances: {!! json_encode($weeklyData['naissances']) !!},
        deces: {!! json_encode($weeklyData['deces']) !!},
        mariages: {!! json_encode($weeklyData['mariages']) !!}
    };

    const monthlyData = {
        labels: {!! json_encode(array_map(function($i) {
            return Carbon\Carbon::now()->subDays(29 - $i)->format('j M');
        }, range(0, 29))) !!},
        naissances: {!! json_encode($monthlyData['naissances']) !!},
        deces: {!! json_encode($monthlyData['deces']) !!},
        mariages: {!! json_encode($monthlyData['mariages']) !!}
    };

    const yearlyData = {
        labels: {!! json_encode(array_map(function($i) {
            return Carbon\Carbon::now()->subMonths(11 - $i)->format('M Y');
        }, range(0, 11))) !!},
        naissances: {!! json_encode($yearlyData['naissances']) !!},
        deces: {!! json_encode($yearlyData['deces']) !!},
        mariages: {!! json_encode($yearlyData['mariages']) !!}
    };

    const ctx = document.getElementById('evolutionChart').getContext('2d');
    let evolutionChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: weeklyData.labels,
            datasets: [
                {
                    label: 'Naissances',
                    data: weeklyData.naissances,
                    borderColor: 'rgba(67, 97, 238, 1)',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Décès',
                    data: weeklyData.deces,
                    borderColor: 'rgba(247, 37, 133, 1)',
                    backgroundColor: 'rgba(247, 37, 133, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Mariages',
                    data: weeklyData.mariages,
                    borderColor: 'rgba(248, 150, 30, 1)',
                    backgroundColor: 'rgba(248, 150, 30, 0.1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: true,
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        drawOnChartArea: false
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.parsed.y} demande(s)`;
                        }
                    }
                }
            }
        }
    });

    // Gestion des boutons de période
    document.getElementById('btn-week').addEventListener('click', function() {
        updateChart(weeklyData);
        setActiveButton(this);
    });

    document.getElementById('btn-month').addEventListener('click', function() {
        updateChart(monthlyData);
        setActiveButton(this);
    });

    document.getElementById('btn-year').addEventListener('click', function() {
        updateChart(yearlyData);
        setActiveButton(this);
    });

    function updateChart(data) {
        evolutionChart.data.labels = data.labels;
        evolutionChart.data.datasets[0].data = data.naissances;
        evolutionChart.data.datasets[1].data = data.deces;
        evolutionChart.data.datasets[2].data = data.mariages;
        evolutionChart.update();
    }

    function setActiveButton(activeBtn) {
        document.querySelectorAll('#evolutionChart ~ .card-header .btn').forEach(btn => {
            btn.classList.remove('active');
        });
        activeBtn.classList.add('active');
    }
});
</script>
@endsection