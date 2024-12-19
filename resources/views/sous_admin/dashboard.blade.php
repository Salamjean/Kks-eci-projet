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
        margin: 15px 0;
    }

    .ms-icon-mr {
        font-size: 2rem;
    }

    .ms-content-wrapper {
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .ms-panel {
        border: 1px solid #ddd;
        border-radius: 10px;
        background: #fff;
        margin: 15px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .ms-panel-header {
        padding: 10px;
        background: #f7f7f7;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    .ms-panel-body {
        padding: 10px;
        overflow-x: auto;
        display: flex;
        flex-wrap: wrap;
    }

    .declaration-item {
        min-width: 200px;
        margin-right: 10px;
    }

    .border {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
    }

    .graph-container {
        width: 80%;
        margin: 0 auto; 
        gap: 20px;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="ms-content-wrapper">
    {{-- Les cartes de statistiques --}}
<div class="ms-content-wrapper">
    <div class="row" style="justify-content: center">
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
                            <p class="ms-card-change text-center">{{ $deceshop }}</p>
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
                            <p class="ms-card-change text-center">{{ $total }}</p>
                        </div>
                    </div>
                    <i class="fas fa-briefcase-medical ms-icon-mr"></i>
                </div>
            </a>
        </div>
    </div>
</div>
    <!-- Les déclarations récentes -->
    <div class="row">
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    Déclaration de naissance récentes
                </div>
                <div class="ms-panel-body" id="declarations-container">
                    @if($declarationsRecents->isEmpty())
                        <p>Aucune déclaration récente.</p>
                    @else
                        @foreach($declarationsRecents as $declaration)
                            <div class="declaration-item">
                                <div class="border">
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

        <div class="col-xl-6 col-md-12 mb-4">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    Déclaration de décès récentes
                </div>
                <div class="ms-panel-body" id="deces-container">
                    @if($decesRecents->isEmpty())
                        <p>Aucune déclaration récente.</p>
                    @else
                        @foreach($decesRecents as $deces)
                            <div class="declaration-item">
                                <div class="border">
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

    {{-- Les graphiques --}}
    <div class="row mb-3">
        <div class="col-md-6 mb-4">
            <div class="card">
                <h6 class="m-0 font-weight-bold text-primary ">Graphique des Naissances</h6>
                <canvas id="lineChart1"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <h6 class="m-0 font-weight-bold text-primary ">Graphique des Décès</h6>
                <canvas id="lineChart2"></canvas>
            </div>
        </div>
    </div>

    <script>
        const naissData = @json(array_values($naissData));
        const decesData = @json(array_values($decesData));

        // Labels pour les mois de l'année en français
        const allLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jui', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];

        // Configurer le graphique des naissances
        const ctx1 = document.getElementById('lineChart1').getContext('2d');
        const lineChart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: allLabels,
                datasets: [{
                    label: 'Naissances',
                    data: naissData,
                    backgroundColor: 'rgba(173, 216, 230, 0.2)',
                    borderColor: 'rgba(70, 130, 180, 1)',
                    borderWidth: 2,
                    pointRadius: 5,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Configurer le graphique des décès
        const ctx2 = document.getElementById('lineChart2').getContext('2d');
        const lineChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: allLabels,
                datasets: [{
                    label: 'Décès',
                    data: decesData,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    pointRadius: 5,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</div>
@endsection