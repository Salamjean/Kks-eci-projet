@extends('utilisateur.layouts.template')

@section('content')
<style>
    /* Styles personnalisés */
    .dashboard-card {
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
        margin-bottom: 20px;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
    }
    
    .chart-container {
        position: relative;
        height: 500px;
        width: 100%;
    }
    
    .stats-image {
        height: 150%;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }
    
    .stat-card {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .chart-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #2c3e50;
    }
    
    .chart-subtitle {
        font-size: 0.9rem;
        color: #7f8c8d;
        margin-bottom: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .chart-container {
            height: 250px;
        }
        
        .stat-card {
            margin-bottom: 15px;
        }
    }
</style>

<div class="content-wrapper">
    <!-- Section de bienvenue -->
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">
                        Bienvenue, Mlle/Mme/M. 
                        <span class="text-black fw-bold">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</span>
                    </h3>
                    <h6 class="font-weight-normal mb-0">
                        Vous pouvez maintenant effectuer <span class="text-primary">une demande!</span>
                    </h6>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="d-flex justify-content-end">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-home"></i> Mairie de {{ strtoupper(Auth::user()->commune) }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques en haut -->
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card dashboard-card" style="height:100%">
                <img src="{{ asset('assets/images/profiles/bande.jpg') }}" class="stats-image"  alt="Demandes">
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card card-tale dashboard-card" style="background-color: #1a76d1">
                        <div class="card-body text-center">
                            <p class="mb-3">Extrait de naissance</p>
                            <h2 class="mb-2">{{ $naissancesCount + $naissanceDCount }}</h2>
                            <p class="text-white">demandes</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card">
                    <div class="card dashboard-card " style="background-color:" >
                        <div class="card-body text-center">
                            <p class="mb-3">Extrait de décès</p>
                            <h2 class="mb-2">{{ $decesCount + $decesdejaCount }}</h2>
                            <p class="text-black">demandes</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card">
                    <div class="card card-light-danger dashboard-card " style="background-color:#008000">
                        <div class="card-body text-center">
                            <p class="mb-3">Extrait de mariage</p>
                            <h2 class="mb-2">{{ $mariageCount }}</h2>
                            <p class="text-white">demandes</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="card dashboard-card" style="background-color: #ffa500">
                        <div class="card-body text-center">
                            <p class="mb-3 text-white">Total de demandes</p>
                            <h2 class="mb-2 text-white">{{ $naissancesCount + $naissanceDCount + $decesCount + $mariageCount + $decesdejaCount }}</h2>
                            <p class="text-white">demandes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques en dessous -->
    <div class="row">
        <!-- Graphique en barres -->
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card dashboard-card">
                <div class="card-body">
                    <h4 class="chart-title">Répartition des demandes</h4>
                    <p class="chart-subtitle">Nombre de demandes par type</p>
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Graphique circulaire -->
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card dashboard-card">
                <div class="card-body">
                    <h4 class="chart-title">Pourcentage des demandes</h4>
                    <p class="chart-subtitle">Répartition en pourcentages</p>
                    <div class="chart-container">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Données communes
    const labels = ['Naissances', 'Décès', 'Mariages'];
    const dataValues = [
        {{ intval($naissancesCount + $naissanceDCount) }},
        {{ intval($decesCount + $decesdejaCount) }},
        {{ intval($mariageCount) }}
    ];
    const backgroundColors = [
        'rgba(75, 192, 192, 0.7)',
        'rgba(153, 102, 255, 0.7)',
        'rgba(255, 99, 132, 0.7)'
    ];
    const borderColors = [
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 99, 132, 1)'
    ];

    // Graphique en barres
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de demandes',
                data: dataValues,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 2,
                borderRadius: 6,
                hoverBackgroundColor: [
                    'rgba(75, 192, 192, 0.9)',
                    'rgba(153, 102, 255, 0.9)',
                    'rgba(255, 99, 132, 0.9)'
                ],
                hoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        callback: function(value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                        }
                    }
                }
            }
        }
    });

    // Graphique circulaire
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: dataValues,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 1,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 12,
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const value = context.raw;
                            const percentage = Math.round((value / total) * 100);
                            return `${context.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>

@endsection