@extends('utilisateur.layouts.template')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<style>
    .form-background {
    background-image: url("{{ asset('assets/images/profiles/arriereP.jpg') }}"); /* Chemin de l'image */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 20px;
    border-radius: 8px;
}
</style>

{{-- Vérification de la session --}}
@if (Session::has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ Session::get('success') }}',
                timer: 3000,
                showConfirmButton: false,
            });
        });
    </script>
@endif

@if (Session::has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: '{{ Session::get('error') }}',
                timer: 3000,
                showConfirmButton: false,
            });
        });
    </script>
@endif

<div class="main-panel form-background">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Vos statistiques de demande</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                        <div class="row">
                            <!-- Section des statistiques de demande -->
                            <div class="col-lg-12 d-flex justify-content-between">
                                <!-- Extrait de naissance et décès -->
                                <div class="statistics-card">
                                    <p class="statistics-title">Extrait de naissance</p>
                                    <h3 class="rate-percentage">{{ $naissancesCount + $naissanceDCount }}</h3>
                                </div>
                                <div class="statistics-card">
                                    <p class="statistics-title">Extrait de décès</p>
                                    <h3 class="rate-percentage">{{ $decesCount + $decesdejaCount }}</h3>
                                </div>
                                <!-- Extrait de mariage -->
                                <div class="statistics-card">
                                    <p class="statistics-title">Extrait de mariage</p>
                                    <h3 class="rate-percentage">{{ $mariageCount }}</h3>
                                </div>
                                <!-- Total des demandes -->
                                <div class="statistics-card">
                                    <p class="statistics-title">Total de demandes</p>
                                    <h3 class="rate-percentage">{{ $naissancesCount + $naissanceDCount + $decesCount + $mariageCount + $decesdejaCount }}</h3>
                                </div>
                            </div>
                            <br>

                            <!-- Première colonne pour Market Overview -->
                            <div class="col-lg-8 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded" style="height: 470px;">
                                            <div class="card-body" style="height: 100%;">
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Vos demandes</h4>
                                                        <p class="card-subtitle card-subtitle-dash">Visualisation des demandes récentes</p>
                                                    </div>
                                                </div>
                                                <div class="chartjs-bar-wrapper mt-3" style="height: calc(100% - 80px);">
                                                    <canvas id="marketingOverview" style="height: 100%; width: 100%;"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <script>
                                // Récupérer les données du contrôleur
                                const labels = ['Naissances', 'Décès', 'Mariages'];
                                const data = {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Nombre de Demandes',
                                        data: [{{ $naissancesCount + $naissanceDCount }}, {{ $decesCount + $decesdejaCount }}, {{ $mariageCount }}],
                                        backgroundColor: [
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                        ],
                                        borderColor: [
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(255, 206, 86, 1)',
                                        ],
                                        borderWidth: 1
                                    }]
                                };
                            
                                const config = {
                                    type: 'bar',
                                    data: data,
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                };
                            
                                const myChart = new Chart(
                                    document.getElementById('marketingOverview'),
                                    config
                                );
                            </script>
                            
                            <!-- Deuxième colonne pour Demande Récentes -->
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded" style="height: 470px;"> <!-- Réduit la hauteur de la carte -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title card-title-dash">Demande Récentes</h4>
                                                                                                            
                                                                                                                                                                                                                         </div>
                                                        <div class="list-wrapper">
                                                            <ul class="todo-list todo-list-rounded" style="height: 390px; overflow-y: auto;"> <!-- Réduit la hauteur de la liste et active le scroll -->
                                                                @foreach($demandesRecente as $demande)
                                                                    <li class="d-block">
                                                                        <div class="form-check w-100">
                                                                            <label class="form-check-label">
                                                                                <input class="checkbox" type="checkbox"> 
                                                                                Demande d'extrait {{ $demande->type }} effectuée le {{ $demande->created_at->format('d M Y') }} <br> est   
                                                                                <span class="badge {{ $demande->etat == 'en attente' ? 'badge-opacity-warning' : ($demande->etat == 'réçu' ?'badge-opacity-success' : 'badge-opacity-danger') }}">
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
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div> <!-- Fin de la row -->
                    </div> <!-- Fin du tab-content-basic -->
                </div> <!-- Fin du tab-content -->
            </div> <!-- Fin de col-sm-12 -->
        </div> <!-- Fin de row -->
    </div> <!-- Fin de content-wrapper -->
</div> <!-- Fin de main-panel -->

<!-- Ajouter les scripts nécessaires pour Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Préparer les données pour le graphique
    const demandesCount = {
        naissances: {{ $totalNaissances }},
        deces: {{ $totalDeces }},
        mariages: {{ $mariageCount }},
    };

    const ctx = document.getElementById('marketingOverview').getContext('2d');
    
    const chart = new Chart(ctx, {
        type: 'line',  // Type de graphique : courbe (line)
        data: {
            labels: ['Naissances', 'Décès', 'Mariages'],  // Catégories (groupées)
            datasets: [{
                label: 'Nombre de demandes',
                data: [
                    demandesCount.naissances,  // Total Naissances et Naissances Différées
                    demandesCount.deces,       // Total Décès et Décès Déjà Déclarés
                    demandesCount.mariages     // Nombre de Mariages
                ],  // Données à afficher sur l'axe Y
                fill: false,  // Pas de remplissage sous la courbe
                borderColor: 'rgba(75, 192, 192, 1)',  // Couleur de la ligne
                tension: 0.1,  // Courbure de la ligne
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true  // Commencer l'axe Y à 0
                }
            }
        }
    });
</script>
@endsection
