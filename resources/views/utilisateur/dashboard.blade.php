@extends('utilisateur.layouts.template')

@section('content')
<!-- Styles personnalisés modernes -->
<style>
    :root {
        --primary: #1a76d1;
        --secondary: #6c757d;
        --success: #198754;
        --warning: #ffc107;
        --danger: #dc3545;
        --light: #f8f9fa;
        --dark: #212529;
        --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    body {
        background-color: #f5f7fb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .dashboard-card {
        border: none;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        overflow: hidden;
        background: white;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.15);
    }

    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    .stats-image {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 16px;
    }

    .stat-card {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 1.5rem;
        color: white;
        border-radius: 16px;
    }

    .stat-card h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0.5rem 0;
    }

    .stat-card p {
        margin: 0;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .card-tale { background: linear-gradient(135deg, #1a76d1 0%, #4a9bf7 100%); }
    .card-light-blue { background: linear-gradient(135deg, #008000 0%, #00c300 100%); }
    .card-light-danger { background: linear-gradient(135deg, #ffa500 0%, #ffca4d 100%); }
    .card-dark-blue { background: linear-gradient(135deg, #0f4c75 0%, #3282b8 100%); }

    .chart-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0.5rem;
        color: #2c3e50;
    }

    .chart-subtitle {
        font-size: 0.9rem;
        color: #7f8c8d;
        margin: 0.5rem;
    }

    .welcome-section {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--card-shadow);
    }

    .todo-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .todo-list li {
        padding: 1rem;
        border-bottom: 1px solid #eee;
        transition: var(--transition);
    }

    .todo-list li:hover {
        background-color: #f8f9fa;
    }

    .todo-list li:last-child {
        border-bottom: none;
    }

    .badge {
        padding: 0.5rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-opacity-warning {
        background-color: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }

    .badge-opacity-success {
        background-color: rgba(25, 135, 84, 0.2);
        color: #198754;
    }

    .badge-opacity-danger {
        background-color: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }

    .dropdown-btn {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .dropdown-btn:hover {
        background: #f8f9fa;
    }

    @media (max-width: 768px) {
        .chart-container {
            height: 250px;
        }
        
        .stat-card {
            margin-bottom: 15px;
        }
        
        .stat-card h2 {
            font-size: 2rem;
        }
    }

    /* Animation pour les cartes de statistiques */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .stats-animation {
        animation: fadeIn 0.6s ease forwards;
    }

    .stats-animation:nth-child(1) { animation-delay: 0.1s; }
    .stats-animation:nth-child(2) { animation-delay: 0.2s; }
    .stats-animation:nth-child(3) { animation-delay: 0.3s; }
    .stats-animation:nth-child(4) { animation-delay: 0.4s; }
</style>

<div class="content-wrapper">
    <!-- Section de bienvenue -->
    <div class="welcome-section">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="fw-bold mb-2">
                    Bienvenue, Mlle/Mme/M. 
                    <span class="text-primary">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</span>
                </h3>
                <p class="text-muted mb-0">
                    Vous pouvez maintenant effectuer <span class="text-primary fw-semibold">une demande!</span>
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <button class="dropdown-btn">
                    <i class="mdi mdi-home me-1"></i> Mairie de {{ strtoupper(Auth::user()->commune) }}
                </button>
            </div>
        </div>
    </div>

    <!-- Statistiques en haut -->
    <div class="row mb-4">
        <div class="col-md-6 mb-4">
            <div class="dashboard-card h-100">
                <img src="{{ asset('assets/images/profiles/bande.jpg') }}" class="stats-image" alt="Demandes">
            </div>
        </div>
        <div class="col-md-6">
            <div class="row h-100">
                <div class="col-md-6 mb-4 stats-animation">
                    <div class="dashboard-card stat-card card-tale h-100">
                        <i class="fas fa-baby fa-2x mb-2"></i>
                        <p class="mb-1">Extrait de naissance</p>
                        <h2>{{ $naissancesCount + $naissanceDCount }}</h2>
                        <p>demandes</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stats-animation">
                    <div class="dashboard-card stat-card card-light-blue h-100">
                        <i class="fas fa-cross fa-2x mb-2"></i>
                        <p class="mb-1">Extrait de décès</p>
                        <h2>{{ $decesCount + $decesdejaCount }}</h2>
                        <p>demandes</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stats-animation">
                    <div class="dashboard-card stat-card card-light-danger h-100">
                        <i class="fas fa-ring fa-2x mb-2"></i>
                        <p class="mb-1">Extrait de mariage</p>
                        <h2>{{ $mariageCount }}</h2>
                        <p>demandes</p>
                    </div>
                </div>
                <div class="col-md-6 stats-animation">
                    <div class="dashboard-card stat-card card-dark-blue h-100">
                        <i class="fas fa-file-alt fa-2x mb-2"></i>
                        <p class="mb-1">Total de demandes</p>
                        <h2>{{ $naissancesCount + $naissanceDCount + $decesCount + $mariageCount + $decesdejaCount }}</h2>
                        <p>demandes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques en dessous -->
    <div class="row">
        <!-- Liste des demandes récentes -->
        <div class="col-lg-8 mb-4">
            <div class="dashboard-card h-100">
                <div class="card-body d-flex flex-column p-0">
                    <div class="p-3 border-bottom bg-light">
                        <h4 class="m-0 fw-semibold">Demandes Récentes</h4>
                    </div>
                    <div class="flex-grow-1" style="max-height: 400px; overflow-y: auto;">
                        <ul class="todo-list">
                            @foreach($demandesRecente as $demande)
                                <li class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <p class="mb-1 fw-medium">Demande d'extrait {{ $demande->type }}</p>
                                            <p class="mb-0 text-muted small">Effectuée le {{ $demande->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="badge {{ $demande->etat == 'en attente' ? 'badge-opacity-warning' : ($demande->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}">
                                        {{ $demande->etat }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Graphique circulaire -->
        <div class="col-lg-4">
            <div class="dashboard-card h-100">
                <div class="card-body">
                    <h4 class="chart-title">Répartition des demandes</h4>
                    <p class="chart-subtitle">Pourcentage par type d'extrait</p>
                    <div class="chart-container">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Données pour le graphique
        const labels = ['Naissances', 'Décès', 'Mariages'];
        const dataValues = [
            {{ intval($naissancesCount + $naissanceDCount) }},
            {{ intval($decesCount + $decesdejaCount) }},
            {{ intval($mariageCount) }}
        ];
        
        const backgroundColors = [
            'rgba(26, 118, 209, 0.8)',
            'rgba(0, 128, 0, 0.8)',
            'rgba(255, 165, 0, 0.8)'
        ];
        
        const borderColors = [
            'rgba(26, 118, 209, 1)',
            'rgba(0, 128, 0, 1)',
            'rgba(255, 165, 0, 1)'
        ];

        // Graphique circulaire
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 2,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
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

        // Animation pour les éléments de la liste
        const todoItems = document.querySelectorAll('.todo-list li');
        todoItems.forEach((item, index) => {
            item.style.opacity = "0";
            item.style.transform = "translateX(-20px)";
            setTimeout(() => {
                item.style.transition = "opacity 0.5s ease, transform 0.5s ease";
                item.style.opacity = "1";
                item.style.transform = "translateX(0)";
            }, 100 + (index * 100));
        });
    });
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@endsection