@extends('vendor.agent.layouts.template')

@section('content')

<!-- Section Principale : Les Demandes de Naissances Récentes -->
 <!-- Insertion de SweetAlert2 -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <div class="row" style="width:100%; justify-content:center">
  <div class="row" style="width:100%; justify-content:center">
      @if (Session::get('success1')) <!-- Pour la suppression -->
          <script>
              Swal.fire({
                  icon: 'success',
                  title: 'Suppression réussie',
                  text: '{{ Session::get('success1') }}',
                  showConfirmButton: true,  // Afficher le bouton OK
                  confirmButtonText: 'OK',  // Texte du bouton
                  background: '#ffcccc',   // Couleur de fond personnalisée
                  color: '#b30000'          // Texte rouge foncé
              });
          </script>
      @endif
  
      @if (Session::get('success')) <!-- Pour la modification -->
          <script>
              Swal.fire({
                  icon: 'success',
                  title: 'Action réussie',
                  text: '{{ Session::get('success') }}',
                  showConfirmButton: true,  // Afficher le bouton OK
                  confirmButtonText: 'OK',  // Texte du bouton
                  background: '#ccffcc',   // Couleur de fond personnalisée
                  color: '#006600'          // Texte vert foncé
              });
          </script>
      @endif
  
      @if (Session::get('error')) <!-- Pour une erreur générale -->
          <script>
              Swal.fire({
                  icon: 'error',
                  title: 'Erreur',
                  text: '{{ Session::get('error') }}',
                  showConfirmButton: true,  // Afficher le bouton OK
                  confirmButtonText: 'OK',  // Texte du bouton
                  background: '#f86750',    // Couleur de fond rouge vif
                  color: '#ffffff'          // Texte blanc
              });
          </script>
      @endif
  </div>
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
                                <th>Type de copie</th>
                                <th>Hôpital</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Action</th>
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
                                        <td>
                                            <form action="{{ route('naissance.traiter', $naissance->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-sm btn-primary">Récuperer</button>
                                            </form>
                                        </td>
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
&nbsp;&nbsp;&nbsp;
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentDeces as $deces)
                                <tr>
                                    <td>Décès</td>
                                    <td>{{ $deces->nomHopital }}</td>
                                    <td>{{ $deces->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $deces->created_at->format('H:i:s') }}</td>
                                    <td>
                                        <form action="{{ route('deces.traiter', $deces->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-sm btn-primary">Récuperer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Aucun décès récent</td></tr>
                            @endforelse

                            @forelse ($recentDecesdeja as $decesdeja)
                                <tr>
                                    <td>Décès</td>
                                    <td>{{ $decesdeja->nomHopital }}</td>
                                    <td>{{ $decesdeja->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $decesdeja->created_at->format('H:i:s') }}</td>
                                    <td>
                                        <form action="{{ route('deces.traiter', $decesdeja->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-sm btn-primary">Récuperer</button>
                                        </form>
                                    </td>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentMariages as $mariage)
                                <tr>
                                    <td>Mariage</td>
                                    <td>{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
                                    <td>{{ $mariage->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $mariage->created_at->format('H:i:s') }}</td>
                                    <td>
                                        <form action="{{ route('mariage.traiter', $mariage->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-sm btn-primary">Récuperer</button>
                                        </form>
                                    </td>
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