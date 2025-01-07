@extends('vendor.caisse.layouts.template')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid" id="container-wrapper">
    <div class="text-center mb-4">
        <h2 class="font-semibold text-xl text-gray-800">
            Caisse N° {{ Auth::guard('caisse')->user()->id }}, Visualisé par : {{ Auth::guard('caisse')->user()->name }} {{ Auth::guard('caisse')->user()->prenom }}
        </h2>
    </div>
  
    <div class="row mb-4">
      <!-- Total Demande Extrait Naissance -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Nombre de demande</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $total }}</div>
            <i class="fas fa-list fa-2x text-primary"></i>
          </div>
        </div>
      </div>

      <!-- Total Demande Extrait Décès -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Solde Fourni</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $soldeActuel }} FCFA</div>
            <i class="fas fa-money-bill fa-2x text-success"></i>
          </div>
        </div>
      </div>

      <!-- Total Demande Acte Mariage -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Solde débité</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $soldeDebite }} FCFA</div>
            <i class="fas fa-money-bill fa-2x text-danger"></i>
          </div>
        </div>
      </div>

      <!-- Total Demandes -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Solde restant</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $soldeRestant }} FCFA</div>
            <i class="fas fa-money-bill-wave fa-2x text-warning"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Trois tables séparées pour afficher les demandes récentes -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="text-xl font-weight-bold text-uppercase mb-4 text-center">Demandes Récentes - Naissance</h5>
                    <ul class="text-center">
                        @foreach($demandesNaissance as $demande)
                            <li>La demande d'extrait de naissance pour {{ $demande->name .' '. $demande->prenom ?? $demande->nom .' '. $demande->prenom}}
                              est <button style="background-color: rgba(255, 206, 86, 0.2)" class="badge {{ $demande->etat == 'en attente' ? 'badge-opacity-warning' : 
                                ($demande->etat == 'réçu' ?'badge-opacity-success' : 'badge-opacity-danger') }}">
                                  {{ $demande->etat }}
                              </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="text-xl font-weight-bold text-uppercase mb-4 text-center">Demandes Récentes - Décès</h5>
                    <ul class="text-center">
                        @foreach($demandesDeces as $demande)
                            <li>La demande d'extrait du défunt {{ $demande->name ?? $demande->nomDefunt }} est 
                              <button style="background-color: rgba(255, 206, 86, 0.2)" class="badge {{ $demande->etat == 'en attente' ? 'badge-opacity-warning' : 
                                  ($demande->etat == 'réçu' ?'badge-opacity-success' : 'badge-opacity-danger') }}">
                                    {{ $demande->etat }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="text-xl font-weight-bold text-uppercase mb-4 text-center">Demandes Récentes - Mariage</h5>
                    <ul class="text-center">
                        @foreach($demandesMariage as $demande)
                            <li>Demande d'extrait de mariage effectué pour le conjoint(e) {{ $demande->nomEpoux }} est 
                              <button style="background-color: rgba(255, 206, 86, 0.2)" class="badge {{ $demande->etat == 'en attente' ? 'badge-opacity-warning' : 
                                ($demande->etat == 'réçu' ?'badge-opacity-success' : 'badge-opacity-danger') }}">
                                  {{ $demande->etat }}
                              </button>  
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique des demandes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="text-xl font-weight-bold text-uppercase mb-4 text-center">Demandes en Temps Réel</h5>
                    <canvas id="demandesChart" style="height: 500px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('demandesChart').getContext('2d');
        const demandesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Naissance', 'Décès', 'Mariage'], // Labels dynamiques
                datasets: [
                    {
                        label: 'Naissances', // Légende pour Naissance
                        data: [{{ $naissancenombre + $naissanceDnombre }}, 0, 0], // Données dynamiques
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: true,
                    },
                    {
                        label: 'Décès', // Légende pour Décès
                        data: [0, {{ $decesnombre + $decesdejanombre }}, 0], // Données dynamiques
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        fill: true,
                    },
                    {
                        label: 'Mariages', // Légende pour Mariage
                        data: [0, 0, {{ $mariagenombre }}], // Données dynamiques
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 2,
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Définit les intervalles de graduation à 1
                        }
                    }
                }
            }
        });
    </script>

@endsection