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
                  background: 'white',   // Couleur de fond personnalisée
                  color: 'black'          // Texte rouge foncé
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
                  background: 'white',   // Couleur de fond personnalisée
                  color: 'black'          // Texte rouge foncé
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
                  color: 'black'          // Texte blanc
              });
          </script>
      @endif
  </div>
<style>
.row {
    background-size: 30%;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    padding: 10px 0px 20px 40px;
    border-radius: 10px;
}
.center-card {
    margin: 20px 10px;
    float: none;
}
.pagination {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 10px;
}
.pagination a {
    color: #333;
    padding: 8px 12px;
    text-decoration: none;
    border: 1px solid #ddd;
    margin: 0 4px;
    border-radius: 4px;
    transition: background-color 0.3s;
}
.pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
}
.pagination a:hover:not(.active) {
    background-color: #ddd;
}
.pagination a.disabled {
    color: #ccc;
    pointer-events: none;
}
.pagination a.arrow {
    font-weight: bold;
}
.pagination a.arrow.disabled {
    font-weight: normal;
}
.pagination ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
}
.pagination li {
    margin: 0;
}
</style>

<h1 class="text-center" style="margin: 30px 0">Les demandes effectuées récemment</h1>

<div class="container col-12">
    <div class="row justify-content-center">

         {{-- Deuxième tableau --}}
         <div class="col-md-12">
            <div class="card shadow mb-0 center-card">
                <div class="card-header py-2" style="background-color: #6777ef; display: flex; justify-content: space-between; align-items: center;">
                    <h6 class="font-weight-bold text-white text-center" style="font-size: 15px">Demande d'extrait de naissance recente</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="searchHistoryTable2" width="100%" cellspacing="0">
                            <thead >
                                <tr style="background-color:antiquewhite; color:black; text-align:center">
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
                                        <tr style="text-align:center">
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
         {{-- Deuxième tableau --}}
         <div class="col-md-12">
            <div class="card shadow mb-0 center-card">
                <div class="card-header py-2" style="background-color: #6777ef; display: flex; justify-content: space-between; align-items: center;">
                    <h6 class="font-weight-bold text-white text-center" style="font-size: 15px">Demande d'extrait de décès recente</h6>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" id="search2" class="form-control" placeholder="Rechercher dans ce tableau...">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="searchHistoryTable2" width="100%" cellspacing="0">
                            <thead>
                                <tr style="background-color:antiquewhite; color:black;text-align:center">
                                    <th>Type</th>
                                    <th>Hôpital</th>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentDeces as $deces)
                                    <tr style="text-align:center">
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
                                    <tr style="text-align:center">
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

        {{-- Premier tableau --}}
        <div class="col-md-12">
            <div class="card shadow center-card">
                <div class="card-header py-2" style="background-color: #6777ef; display: flex; justify-content: space-between; align-items: center;">
                    <h6 class="font-weight-bold text-white text-center" style="font-size: 23px; text-align:center">Demande d'extrait de mariage recente</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="searchHistoryTable1" width="100%" cellspacing="0">
                            <thead>
                                <tr style="background-color:antiquewhite; color:black; text-align:center">
                                    <th>Type</th>
                                    <th>Demandeur</th>
                                    <th>Date</th> 
                                    <th>Heure</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentMariages as $mariage)
                                    <tr style="text-align:center">
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
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function addSearchFilter(inputId, tableBodyId) {
        $('#' + inputId).on('keyup', function () {
            var searchTerm = $(this).val().toLowerCase();
            $('#' + tableBodyId + ' tr').each(function () {
                var rowText = $(this).text().toLowerCase();
                $(this).toggle(rowText.indexOf(searchTerm) > -1);
            });
        });
    }

    $(document).ready(function () {
        addSearchFilter('search1', 'tableBody1');
        addSearchFilter('search2', 'tableBody2');
    });
</script>

@endsection
