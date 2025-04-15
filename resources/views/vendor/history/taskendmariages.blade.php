@extends('vendor.layouts.template')

@section('content')

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

<h1 class="text-center" style="margin: 30px 0">Historiques de toutes les tâches effectuées par les agents</h1>

<div class="container col-12">
    <div class="row justify-content-center">
        {{-- Premier tableau --}}
        <div class="col-md-12">
            <div class="card shadow center-card">
                <div class="card-header py-2" style="background-color: #6777ef; display: flex; justify-content: space-between; align-items: center;">
                    <h6 class="font-weight-bold text-white text-center" style="font-size: 15px">Demande d'êxtrait simple</h6>
                    <nav aria-label="Page navigation">
                        <div class="pagination">
                            {{ $taskendmariages->links('partials.custom_pagination') }}
                        </div>
                    </nav>
                </div>

                <div class="card-body">
                    <div>
                        <input type="text" id="search1" class="form-control" placeholder="Rechercher dans ce tableau...">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="searchHistoryTable1" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center">Demandeur</th>
                                    <th class="text-center">Nom du conjoint(e)</th>
                                    <th class="text-center">Prénoms du conjoint(e)</th>
                                    <th class="text-center">Date de Naissance du conjoint(e)</th>
                                    <th class="text-center">Lieu de Naissance du conjoint(e)</th>
                                    <th class="text-center">Pièce d'Identité du conjoint(e)</th>
                                    <th class="text-center">Extrait de Mariage</th>
                                    <th>Agent</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody1">
                                @forelse($taskendmariages as $mariage)
                                    <tr class="text-center">
                                        <td>{{ $mariage->user ? $mariage->user->name.' '.$mariage->user->prenom : 'Demandeur inconnu' }}</td>
                                        <td>{{ $mariage->nomEpoux ? $mariage->nomEpoux :'Copie-simple'}}</td>
                                        <td>{{ $mariage->prenomEpoux  ? $mariage->prenomEpoux:'Copie-simple' }}</td>
                                        <td>{{ $mariage->dateNaissanceEpoux  ? $mariage->dateNaissanceEpoux :'Copie-simple' }}</td>
                                        <td>{{ $mariage->lieuNaissanceEpoux  ? $mariage->lieuNaissanceEpoux:'Copie-simple'}}</td>
                                        <td>
                                            @if($mariage->pieceIdentite)
                                                @php
                                                    $pieceIdentitePath = asset('storage/' . $mariage->pieceIdentite);
                                                    $isPieceIdentitePdf = strtolower(pathinfo($pieceIdentitePath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isPieceIdentitePdf)
                                                      <a href="{{ $pieceIdentitePath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                        <img src="{{ $pieceIdentitePath }}"
                                                            alt="Pièce d'identité"
                                                            width="50"
                                                            height="50"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#imageModal"
                                                            onclick="showImage(this)"
                                                            onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/default.jpg') }}'">
                                                @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($mariage->extraitMariage)
                                                  @php
                                                      $extraitMariagePath = asset('storage/' . $mariage->extraitMariage);
                                                      $isExtraitMariagePdf = strtolower(pathinfo($extraitMariagePath, PATHINFO_EXTENSION)) === 'pdf';
                                                  @endphp
                                                  @if ($isExtraitMariagePdf)
                                                        <a href="{{ $extraitMariagePath }}" target="_blank">
                                                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                        </a>
                                                    @else
                                                        <img src="{{ $extraitMariagePath }}"
                                                            alt="Extrait de mariage"
                                                            width="50" 
                                                            height="50" 
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#imageModal"
                                                            onclick="showImage(this)"
                                                            onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/default.jpg') }}'">
                                                    @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                        <td>{{ $dece->mariage->name ?? 'N/A' }} {{ $dece->mariage->prenom ?? '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Aucune donnée trouvée</td>
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
