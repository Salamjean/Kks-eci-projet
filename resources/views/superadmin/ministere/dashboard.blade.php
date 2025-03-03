@extends('superadmin.ministere.layouts.template')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .dashboard-background {
        background-image: url("{{ asset('assets/images/profiles/sante.jpg') }}");
        background-size: 30%;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
        padding: 20px 20px 20px 40px;
        border-radius: 10px;
    }

    .marquee-container {
        background-color: #f0f0f0; /* Couleur de fond pour la section défilante */
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px; /* Espacement en dessous de la section défilante */
    }

    .marquee-text {
        font-size: 18px;
        font-weight: bold;
        color: red; /* Couleur du texte défilant */
        margin-right: 30px; /* Espacement entre les éléments défilants */
    }
</style>
<div class="dashboard-background">
    <div class="container col-12">
        <div class="row justify-content-center">

            <!-- Section défilante pour les communes dominantes -->
<div class="col-md-12">
    <div class="marquee-container">
        <marquee behavior="scroll" direction="left" scrollamount="7">
            <span class="marquee-text">
                @foreach($naissByCommunePerMonth as $month => $data)
                    {{ ucfirst(\Carbon\Carbon::createFromFormat('!m', $month)->locale('fr')->translatedFormat('F')) }} - Commune avec plus de naissance : {{ $data->first()->commune }} ({{ $data->first()->total }})
                    @if(!$loop->last)   |   @endif {{-- Séparateur sauf pour le dernier --}}
                @endforeach
            </span>
            <span class="marquee-text">
                @foreach($decesByCommunePerMonth as $month => $data)
                    {{ ucfirst(\Carbon\Carbon::createFromFormat('!m', $month)->locale('fr')->translatedFormat('F')) }} - Commune avec plus de décès : {{ $data->first()->commune }} ({{ $data->first()->total }})
                    @if(!$loop->last)   |   @endif {{-- Séparateur sauf pour le dernier --}}
                @endforeach
            </span>
        </marquee>
    </div>
</div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-center" style="font-size: 20px;">Nombre total d'agents</h3>
                                        <div class="text-center">
                                            <i class="fa fa-user d-block" style="font-size: 30px; color:#2797d6"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="display-4 text-center">{{ $ministereagent }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-center" style="font-size: 20px;">Total des déclarations décès</h3>
                                        <div class="text-center">
                                            <i class="fa fa-church d-block" style="font-size: 30px; color:#2797d6"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="display-4 text-center">{{ $deceshops }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-center" style="font-size: 20px;">Total des déclarations naissance</h3>
                                        <div class="text-center">
                                            <i class="fa fa-baby d-block" style="font-size: 30px; color:#2797d6"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="display-4 text-center">{{ $naisshops }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Graphiques -->
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <div class="card shadow">
                                    <canvas id="naissChart"></canvas>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card shadow">
                                    <canvas id="decesChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <script>
                            const naissData = @json(array_values($naissData));
                            const decesData = @json(array_values($decesData));
                            const months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                            const naissCtx = document.getElementById('naissChart').getContext('2d');
                            const decesCtx = document.getElementById('decesChart').getContext('2d');

                            // Créer le graphique des naissances
                            const naissChart = new Chart(naissCtx, {
                                type: 'bar',
                                data: {
                                    labels: months,
                                    datasets: [{
                                        label: 'Naissances',
                                        data: naissData,
                                        backgroundColor: 'rgba(75, 192, 192, 1)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                stepSize: 1
                                            },
                                            title: {
                                                display: true,
                                                text: 'Nombre de Naissances'
                                            }
                                        },
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Mois'
                                            }
                                        }
                                    }
                                }
                            });

                            // Créer le graphique des décès
                            const decesChart = new Chart(decesCtx, {
                                type: 'bar',
                                data: {
                                    labels: months,
                                    datasets: [{
                                        label: 'Décès',
                                        data: decesData,
                                        backgroundColor: 'rgba(255, 99, 132, 1)',
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                stepSize: 1
                                            },
                                            title: {
                                                display: true,
                                                text: 'Nombre de Décès'
                                            }
                                        },
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Mois'
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script pour actualiser la page toutes les minutes -->
<script>
    setTimeout(function() {
        window.location.reload();
    }, 30000); // 30000 millisecondes = 30 secondes
</script>
@endsection