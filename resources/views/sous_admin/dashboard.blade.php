@extends('sous_admin.layouts.template')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<style>
    .card-gradient-custom {
        background: linear-gradient(to right, #4facfe, #00f2fe);
        border-radius: 10px;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 10px;
        margin: 15px 15px 0 15px;
    }

    .ms-icon-mr {
        font-size: 2rem;
    }

    .ms-content-wrapper {
        padding: 20px;
        font-family: Arial, sans-serif;
        margin: 15px 15px 0 15px;
    }

    .ms-panel {
        border: 1px solid #ddd;
        border-radius: 10px;
        background: #fff;
        margin: 15px ;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        gap: 10px;
    }

    .ms-panel-header {
        padding: 10px;
        background: #f7f7f7;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
    }

    .ms-panel-body {
        padding: 10px;
        
    }

    .shadow-box {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 10px;
        background: #fff;  
        margin: 0 100px;
        gap: 10px;
    }

    .graph-container {
        width: 80%;
        margin: 0 auto; 
        gap: 20px;
    }
</style>

<div class="ms-content-wrapper">
    <div class="row" style="justify-content: center">
        <!-- Cartes Statistiques -->
        <div class="col-xl-3 col-md-6 col-sm-6">
            <a href="#">
                <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                    <div class="ms-card-body media">
                        <div class="media-body">
                            <h6>Total Naissance</h6>
                            <p class="ms-card-change text-center">{{ $naisshop }}</p>
                        </div>
                    </div>
                    <i class="fas fa-user ms-icon-mr"></i>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-6">
            <a href="#">
                <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                    <div class="ms-card-body media">
                        <div class="media-body">
                            <h6>Total Décès</h6>
                            <p class="ms-card-change">{{ $deceshop }}</p>
                        </div>
                    </div>
                    <i class="fa fa-school ms-icon-mr"></i>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-6">
            <a href="#">
                <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                    <div class="ms-card-body media">
                        <div class="media-body">
                            <h6>Total Déclaration</h6>
                            <p class="ms-card-change">{{ $total }}</p>
                        </div>
                    </div>
                    <i class="fas fa-briefcase-medical ms-icon-mr"></i>
                </div>
            </a>
        </div>
    </div>

    <!-- Les déclarations récentes -->
    <div class="d-flex">
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6 class="text-center">Déclaration de naissance récentes</h6>
                </div>
                <div class="ms-panel-body" id="declarations-container" style="overflow-x: auto; display: flex;">
                    @if($declarationsRecents->isEmpty())
                        <p>Aucune déclaration récente.</p>
                    @else
                        @foreach($declarationsRecents as $declaration)
                            <div class="declaration-item" style="min-width: 200px; margin-right: 10px;">
                                <div class="border p-2">
                                    <p><strong>Date:</strong> {{ $declaration->created_at->format('d/m/Y') }}</p>
                                    <p><strong>Heure:</strong> {{ $declaration->created_at->format('H:i:s') }}</p>
                                    <p><strong>Nom-mère:</strong> {{ $declaration->NomM }}</p>
                                    <p><strong>Commune:</strong> {{ $declaration->commune }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6 class="text-center">Déclaration de décès récentes</h6>
                </div>
                <div class="ms-panel-body" id="deces-container" style="overflow-x: auto; display: flex;">
                    @if($decesRecents->isEmpty())
                        <p>Aucune déclaration récente.</p>
                    @else
                        @foreach($decesRecents as $deces)
                            <div class="declaration-item" style="min-width: 200px; margin-right: 10px;">
                                <div class="border p-2">
                                    <p><strong>Date:</strong> {{ $deces->created_at->format('d/m/Y') }}</p>
                                    <p><strong>Heure:</strong> {{ $deces->created_at->format('H:i:s') }}</p>
                                    <p><strong>Nom-défunt:</strong> {{ $deces->NomM }}</p>
                                    <p><strong>Commune:</strong> {{ $deces->commune }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

<!-- Graphiques -->
<div class="row" style="justify-content: center;">
    <div class="col-xl-6 col-md-12 shadow-box graph-container">
        <h2 class="text-center">Taux de Naissance</h2>
        <canvas id="naissanceChart" width="350" height="150"></canvas>
    </div>
    
    <div class="col-xl-6 col-md-12 shadow-box graph-container">
        <h2 class="text-center">Taux de Décès</h2>
        <canvas id="decesChart" width="350" height="150"></canvas>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
$(document).ready(function() {
    // Graphique des Taux de Déclarations de Naissance
    const ctxNaissance = document.getElementById('naissanceChart').getContext('2d');
    const naissanceChart = new Chart(ctxNaissance, {
        type: 'line',
        data: {
            labels: {!! json_encode($formattedMonths) !!}, // Utilise les mois formatés
            datasets: [{
                label: 'Taux de Déclarations de Naissance (%)',
                data: {!! json_encode($naisshopRates) !!},
                borderColor: 'rgba(0, 123, 255, 1)',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
                datalabels: {
                    display: true,
                    align: 'top',
                    formatter: (value) => value.toFixed(2) + '%',
                }
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                }
            },
            plugins: {
                legend: {
                    display: true,
                },
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    color: 'black',
                    backgroundColor: 'white',
                    borderRadius: 3,
                    padding: 4,
                },
            }
        }
    });

    // Graphique des Taux de Déclarations de Décès
    const ctxDeces = document.getElementById('decesChart').getContext('2d');
    const decesChart = new Chart(ctxDeces, {
        type: 'line',
        data: {
            labels: {!! json_encode($formattedMonths) !!}, // Utilise les mois formatés
            datasets: [{
                label: 'Taux de Déclarations de Décès (%)',
                data: {!! json_encode($deceshopRates) !!},
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                }
            },
            plugins: {
                legend: {
                    display: true,
                },
            }
        }
    });
});
</script>
</div>

@endsection
