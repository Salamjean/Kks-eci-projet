@extends('vendor.agent.layouts.template')

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

         {{-- Deuxième tableau --}}
         <div class="col-md-12">
            <div class="card shadow mb-0 center-card">
                <div class="card-header py-2" style="background-color: #6777ef; display: flex; justify-content: space-between; align-items: center;">
                    <h6 class="font-weight-bold text-white text-center" style="font-size: 15px">Demande d'êxtrait avec certificat</h6>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <input type="text" id="search2" class="form-control" placeholder="Rechercher dans ce tableau...">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="searchHistoryTable2" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Demandeur</th>
                                    <th>Hôpital</th>
                                    <th>Nom Du Nouveau Né</th>
                                    <th>Date De Naissance Né</th>
                                    <th>Nom-mère</th>
                                    <th>Nom-père</th>
                                    <th>Date-père</th>
                                    <th>Pièce-père</th>
                                    <th>CMN</th>
                                    <th>Pièce-mère</th>
                                    <th>Agent</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="tableBody2">
                                @forelse($taskendnaissances as $naissance)
                                    <tr class="text-center">
                                        <td>{{ $naissance->user->name.' '.$naissance->user->prenom }}</td>
                                        <td>{{ $naissance->nomHopital }}</td>
                                        <td>{{ $naissance->nom .' '.$naissance->prenom }}</td>
                                        <td>{{ $naissance->lieuNaiss }}</td>
                                        <td>{{ $naissance->nomDefunt }}</td>
                                        <td>{{ $naissance->nompere.' '.$naissance->prenompere }}</td>
                                        <td>{{ $naissance->datepere}}</td>
                                        <td>
                                            @if($naissance->identiteDeclarant)
                                                @php
                                                    $identiteDeclarantPath = asset('storage/' . $naissance->identiteDeclarant);
                                                    $isIdentiteDeclarantPdf = strtolower(pathinfo($identiteDeclarantPath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                @if ($isIdentiteDeclarantPdf)
                                                    <a href="{{ $identiteDeclarantPath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                    </a>
                                                @else
                                                    <img src="{{ $identiteDeclarantPath }}" 
                                                        alt="Pièce du parent" 
                                                        width="50" 
                                                        height=50
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#imageModal" 
                                                        onclick="showImage(this)" 
                                                        onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                                @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                         <td>
                                            @if($naissance->cdnaiss)
                                                @php
                                                    $cdnaissPath = asset('storage/' . $naissance->cdnaiss);
                                                    $isCdnaissPdf = strtolower(pathinfo($cdnaissPath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                @if ($isCdnaissPdf)
                                                    <a href="{{ $cdnaissPath }}" target="_blank">
                                                       <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                    </a>
                                                @else
                                                    <img src="{{ $cdnaissPath }}" 
                                                        alt="Certificat de déclaration" 
                                                        width="50" 
                                                        height=50
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#imageModal" 
                                                        onclick="showImage(this)" 
                                                        onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                                @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                        
                                        @if($naisshop && $naisshop->CNI_mere)
                                            @php
                                                $cniMerePath = asset('storage/' . $naisshop->CNI_mere);
                                                $isCniMerePdf = strtolower(pathinfo($cniMerePath, PATHINFO_EXTENSION)) === 'pdf';
                                            @endphp
                                            <td>
                                                @if ($isCniMerePdf)
                                                    <a href="{{ $cniMerePath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                    </a>
                                                @else
                                                    <img src="{{ $cniMerePath }}"
                                                        alt="Certificat de déclaration" 
                                                        width="50" 
                                                        height=50
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#imageModal" 
                                                        onclick="showImage(this)" 
                                                        onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                                @endif
                                            </td>
                                        @else
                                             <td><span>Aucune image disponible</span></td>
                                        @endif
                                        <td>{{ $naissance->agent->name ?? 'N/A' }} {{ $naissance->agent->prenom ?? '' }}</td>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Aucune naissance trouvée</td>
                                    </tr>
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
                    <h6 class="font-weight-bold text-white text-center" style="font-size: 15px">Demande d'êxtrait simple</h6>
                    <nav aria-label="Page navigation">
                        <div class="pagination">
                            {{ $taskendnaissanceDs->links('partials.custom_pagination') }}
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
                                    <th>Demandeur</th>
                                    <th>Type de demande</th>
                                    <th>Nom sur l'extrait</th>
                                    <th>Numéro de régistre</th>
                                    <th>Date de régistre</th>
                                    <th>Pièce d'identité</th>
                                    <th>Agent</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody1">
                                @forelse($taskendnaissanceDs as $naissanceD)
                                    <tr class="text-center">
                                        <td>{{ $naissanceD->user ? $naissanceD->user->name.' '.$naissanceD->user->prenom : 'Demandeur inconnu' }}</td>
                                        <td>{{ $naissanceD->type }}</td>
                                        <td>{{ $naissanceD->name.' '.$naissanceD->prenom }}</td>
                                        <td>{{ $naissanceD->number }}</td>
                                        <td>{{ $naissanceD->DateR }}</td>
                                        <td>
                                            @if($naissanceD->CNI)
                                                @php
                                                    $CNIPath = asset('storage/' . $naissanceD->CNI);
                                                    $isCNIPdf = strtolower(pathinfo($CNIPath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                @if ($isCNIPdf)
                                                    <a href="{{ $CNIPath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                    </a>
                                                @else
                                                    <img src="{{ $CNIPath }}" width="50" height="50" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)" onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                                @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                        <td>{{ $naissanceD->agent->name ?? 'N/A' }} {{ $naissanceD->agent->prenom ?? '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Aucune donnée trouvée</td>
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
