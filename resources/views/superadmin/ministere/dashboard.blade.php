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
</style>
<div class="dashboard-background">
    <div class="container col-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-center" style="font-size: 20px;">Nombre total d'agent</h3>
                                        <div class="text-center">
                                            <i class="fa fa-user d-block" style="font-size: 30px; color:#2797d6"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="display-4  text-center">{{ $ministereagent }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-center" style="font-size: 20px;">Total de déclaration-décès</h3>
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
                                        <h3 class="card-title text-center" style="font-size: 20px;">Total de déclaration-naissance</h3>
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
                        <div>
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
                                const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
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
                                                max: Math.max(...naissData), // Max égal au maximum de naissData
                                                ticks: {
                                                    stepSize: 1 // Ajustez le stepSize pour que chaque carré représente une unité
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
                                        },
                                        plugins: {
                                            datalabels: {
                                                anchor: 'end',
                                                align: 'end',
                                                formatter: function(value) {
                                                    return Math.floor(value); // Affiche les valeurs en entiers
                                                },
                                                color: '#fff',
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
                                                max: Math.max(...decesData), // Max égal au maximum de decesData
                                                ticks: {
                                                    stepSize: 1 // Ajustez le stepSize pour que chaque carré représente une unité
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
                                        },
                                        plugins: {
                                            datalabels: {
                                                anchor: 'end',
                                                align: 'end',
                                                formatter: function(value) {
                                                    return Math.floor(value); // Affiche les valeurs en entiers
                                                },
                                                color: '#fff',
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
</div>

<!-- Script pour actualiser la page toutes les minutes -->
<script>
    setTimeout(function() {
        window.location.reload();
    }, 30000); // 30000 millisecondes = 30 secondes
</script>
@endsection