@extends('vendor.layouts.template')

@section('content')

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <div class="font-semibold text-xl text-gray-800 text-center leading-tight" style="display: flex; text-align:center; font-weight:bold; font-size:20px;">
      Bienvenue sur la page de la mairie de {{ Auth::guard('vendor')->user()->name }}
    </div>
    <br>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </div>

  <div class="row mb-3">
    <!-- Total Demande Extrait Naissance -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body text-center">
          <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demande Extrait Naissance</div>
          <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $Naiss }}</div>
          <i class="fas fa-user fa-2x text-primary"></i>
        </div>
      </div>
    </div>
    <!-- Total Demande Extrait Décès -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body text-center">
          <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demande Extrait Décès</div>
          <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $decesdash }}</div>
          <i class="fas fa-skull fa-2x text-success"></i>
        </div>
      </div>
    </div>
    <!-- Total Demande Acte Mariage -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body text-center">
          <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demande Acte Mariage</div>
          <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $mariagedash }}</div>
          <i class="fas fa-ring fa-2x text-warning"></i>
        </div>
      </div>
    </div>
    <!-- Total Demandes -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body text-center">
          <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demandes</div>
          <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $totalData }}</div>
          <i class="fas fa-list fa-2x text-danger"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- Taux des Demandes -->
    <div class="col-xl-4 col-lg-5">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Taux des Demandes</h6>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <div class="small text-gray-500">Naissances
              <div class="small float-right"><b> {{ \App\Models\Naissance::count() + \App\Models\NaissanceD::count() }} sur {{ $totalData }} éléments</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $totalNaiss }}%;" aria-valuenow="{{ $totalNaiss }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="small text-gray-500">Décès
              <div class="small float-right"><b>{{ \App\Models\Deces::count() }} sur {{ $totalData }} éléments</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-success" role="progressbar" style="width: {{ $decesPercentage }}%;" aria-valuenow="{{ $decesPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="small text-gray-500">Mariages
              <div class="small float-right"><b>{{ \App\Models\Mariage::count() }} sur {{ $totalData }} éléments</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $mariagePercentage }}%;" aria-valuenow="{{ $mariagePercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Les Demandes les Plus Récentes -->
    <div class="col-xl-8 col-lg-7 mb-4">
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
          <h6 class="m-0 font-weight-bold text-white text-center">Les Demandes les Plus Récentes</h6>
        </div>
        <div class="table-responsive d-flex">
          <!-- Naissances Récentes -->
          <div>
            <h3 class="font-weight-bold text-primary text-center" style="font-size: 20px;">Naissances Récentes</h3>
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Type</th>
                  <th>Hôpital</th>
                  <th>Nom</th>
                  <th>Commune</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($recentNaissances as $naissance)
                <tr>
                  <td>Naissance</td>
                  <td>{{ $naissance->nomHopital }}</td>
                  <td>{{ $naissance->nomDefunt }}</td>
                  <td>{{ $naissance->lieuNaiss }}</td>
                  <td>{{ $naissance->created_at->format('d/m/Y') }}</td>
                  <td>
                    <a href="{{ route('naissance.show', $naissance->id) }}" class="btn btn-sm btn-primary">Détails</a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center">Aucune naissance récente</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Décès Récentes -->
          <div style="margin-left: 20px;">
            <h3 class="font-weight-bold text-primary text-center" style="font-size: 20px;">Décès Récentes</h3>
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Type</th>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Détail</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($recentDeces as $deces)
                <tr>
                  <td>Décès</td>
                  <td>{{ $deces->id }}</td>
                  <td>{{ $deces->nomDefunt }}</td>
                  <td>{{ $deces->détails }}</td>
                  <td>{{ $deces->created_at->format('d/m/Y') }}</td>
                  <td>
                    <a href="#" class="btn btn-sm btn-primary">Détails</a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center">Aucun décès récent</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Mariages Récentes -->
          <div style="margin-left: 20px;">
            <h3 class="font-weight-bold text-primary text-center" style="font-size: 20px;">Mariages Récentes</h3>
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Type</th>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Email</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($recentMariages as $mariage)
                <tr>
                  <td>Mariage</td>
                  <td>{{ $mariage->id }}</td>
                  <td>{{ $mariage->nom }}</td>
                  <td>{{ $mariage->email }}</td>
                  <td>{{ $mariage->created_at->format('d/m/Y') }}</td>
                  <td>
                    <a href="{{ route('mariage.show', $mariage->id) }}" class="btn btn-sm btn-primary">Détails</a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center">Aucun mariage récent</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour mettre à jour l'état du message
    function updateStatusMessage(status) {
        const statusElement = document.getElementById('status-message');
        if (statusElement) {
            statusElement.textContent = status;
        }
    }

    // Appel AJAX pour vérifier et mettre à jour le statut
    function fetchDemandeStatus(demandeId) {
        fetch(`/demande-status/${demandeId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    updateStatusMessage(data.status);
                }
            })
            .catch(error => console.error('Erreur:', error));
    }

    // Supposons que vous ayez un moyen de récupérer l'ID de la demande
    const demandeId = 123; // Id de la demande actuelle
    fetchDemandeStatus(demandeId);

    // Exécution lorsque l'admin ouvre la demande (simulé ici)
    document.getElementById('open-demande-btn').addEventListener('click', function() {
        // Vous pouvez ici appeler un backend pour mettre à jour le statut
        fetch(`/update-demande-status/${demandeId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    updateStatusMessage(data.status); // Mettre à jour le message
                }
            });
    });
});

</script>

@endsection