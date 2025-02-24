@extends('vendor.ajoint.layouts.template')
@section('content')

<div class="container-fluid" id="container-wrapper">
    <div >
      <div class="font-semibold text-xl text-gray-800 text-center" style="display: flex;justify-content:center; text-align:center; font-weight:bold; font-size:20px;">
        L'huissier d'état civil M. {{ Auth::guard('ajoint')->user()->name }} vous êtes a la mairie de  {{ Auth::guard('ajoint')->user()->communeM }}
      </div>
      <br><br>
    </div>
  
    <div class="row mb-0">
      <!-- Total Demande Extrait Naissance -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demande Extrait Naissance</div>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $Naiss }}</div>
            <i class="fas fa-user fa-2x text-primary"></i>
          </div>
        </div>
      </div>
      
      <!-- Total Demande Extrait Décès -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demande Extrait Décès</div>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $decesdash + $decesdejadash }}</div>
            <i class="fas fa-school fa-2x text-success"></i>
          </div>
        </div>
      </div>
  
      <!-- Total Demande Acte Mariage -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demande Acte Mariage</div>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $mariagedash }}</div>
            <i class="fas fa-ring fa-2x text-warning"></i>
          </div>
        </div>
      </div>
  
      <!-- Total Demandes -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demandes</div>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $totalData }}</div>
            <i class="fas fa-list fa-2x text-danger"></i>
          </div>
        </div>
      </div>
    </div>

    <br><br>

    <!-- Section Principale : Les Demandes de Naissances Récentes -->
<div class="row mb-4">
    <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white text-center">Naissances Récentes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Type</th>
                                <th>Hôpital</th>
                                <th>Date</th>
                                <th>Heure</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ([$recentNaissances, $recentNaissancesd] as $naissancesGroup)
                                @forelse ($naissancesGroup as $naissance)
                                    <tr>
                                        <td>{{ $loop->parent->index === 0 ? 'Nouveau né' : $naissance->type }}</td>
                                        <td>{{ $loop->parent->index === 0 ? ($naissance->nomHopital ?: 'Extrait Simple/Integral') : 'N/A' }}</td>
                                        <td>{{ $naissance->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $naissance->created_at->format('H:i:s') }}</td>
                                    </tr>
                                @empty
                                    @if ($loop->first)
                                        <tr><td colspan="5" class="text-center">Aucune naissance récente</td></tr>
                                    @endif
                                    @if ($loop->last)
                                        <tr><td colspan="5" class="text-center">Aucune naissance existante</td></tr>
                                    @endif
                                @endforelse
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section : Décès Récents -->
<div class="row mb-4">
    <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white text-center">Décès Récents</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Type</th>
                                <th>Hôpital</th>
                                <th>Date</th>
                                <th>Heure</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentDeces as $deces)
                                <tr>
                                    <td>Décès</td>
                                    <td>{{ $deces->nomHopital }}</td>
                                    <td>{{ $deces->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $deces->created_at->format('H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center">Aucun décès récent</td></tr>
                            @endforelse

                            @forelse ($recentDecesdeja as $decesdeja)
                                <tr>
                                    <td>Décès</td>
                                    <td>{{ $decesdeja->nomHopital }}</td>
                                    <td>{{ $decesdeja->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $decesdeja->created_at->format('H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Aucun décès existant</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section : Mariages Récents -->
<div class="row mb-4">
    <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white text-center">Mariages Récents</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Type</th>
                                <th>Demandeur</th>
                                <th>Date</th>
                                <th>Heure</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentMariages as $mariage)
                                <tr>
                                    <td>Mariage</td>
                                    <td>{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
                                    <td>{{ $mariage->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $mariage->created_at->format('H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Aucun mariage récent</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
  
@endsection