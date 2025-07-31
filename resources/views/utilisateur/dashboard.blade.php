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
                            <button class="btn btn-sm btn-light bg-white " type="button">
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
                <img src="{{ asset('assets/images/profiles/bande.jpg') }}" class="stats-image" alt="Demandes">
            </div>
        </div>
        <div class="col-md-6">
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
                    <div class="card dashboard-card">
                        <div class="card-body text-center">
                            <p class="mb-3">Extrait de décès</p>
                            <h2 class="mb-2">{{ $decesCount + $decesdejaCount }}</h2>
                            <p class="text-black">demandes</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card">
                    <div class="card card-light-danger dashboard-card" style="background-color:#008000">
                        <div class="card-body text-center">
                            <p class="mb-3">Extrait de mariage</p>
                            <h2 class="mb-2">{{ $mariageCount }}</h2>
                            <p class="text-white">demandes</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
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
        <!-- Liste des demandes récentes -->
       <div class="col-lg-8 grid-margin stretch-card">
            <div class="card card-rounded" style="height: 500px"> <!-- Supprimer la hauteur fixe ici -->
                <div class="card-body d-flex flex-column p-0"> <!-- Ajout flex-column et padding 0 -->
                    <div class="p-3 border-bottom"> <!-- Ajout de padding pour le titre -->
                        <h4 class="card-title card-title-dash m-0">Demandes Récentes</h4>
                    </div>
                    <div class="list-wrapper flex-grow-1" style="overflow-y: auto;"> <!-- Flex-grow pour occuper l'espace -->
                        <ul class="todo-list todo-list-rounded">
                            @foreach($demandesRecente as $demande)
                                <li class="d-block p-3 border-bottom"> <!-- Ajout de padding et bordure -->
                                    <div class="form-check w-100 m-0">
                                        <label class="form-check-label d-block">
                                            <input class="checkbox" type="checkbox"> 
                                            Demande d'extrait {{ $demande->type }} effectuée le {{ $demande->created_at->format('d M Y') }}<br>
                                            Statut : <span style="color:#ff91a9">{{ $demande->etat }}</span>
                                            <span class="badge {{ $demande->etat == 'en attente' ? 'badge-opacity-warning' : ($demande->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}">
                                                {{ $demande->etat }}
                                            </span>
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
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
    // Données pour le graphique
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