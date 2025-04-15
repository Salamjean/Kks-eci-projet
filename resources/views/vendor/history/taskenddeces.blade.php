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

         {{-- Deuxième tableau --}}
         <div class="col-md-12">
            <div class="card shadow mb-0 center-card">
                <div class="card-header py-2" style="background-color: #6777ef; display: flex; justify-content: space-between; align-items: center;">
                    <h6 class="font-weight-bold text-white text-center" style="font-size: 15px">Demande d'êxtrait avec certificat</h6>
                    <nav aria-label="Page navigation">
                        <div class="pagination">
                            {{ $taskenddeces->links('partials.custom_pagination') }}
                        </div>
                    </nav>
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
                                    <th>Date de Décès</th>
                                    <th>Nom du Défunt</th>
                                    <th>Date de Naissance</th>
                                    <th>Lieu de Naissance</th>
                                    <th>Pièce du Déclarant</th>
                                    <th>Acte de Mariage</th>
                                    <th>Déclaration par la Loi</th>
                                    <th>Agent</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody2">
                                @forelse($taskenddeces as $decesItem)
                                    <tr class="text-center">
                                        <td>{{ $decesItem->user->name.' '.$decesItem->user->prenom }}</td>
                                        <td>{{ $decesItem->nomHopital }}</td>
                                        <td>{{ $decesItem->dateDces }}</td>
                                        <td>{{ $decesItem->nomDefunt }}</td>
                                        <td>{{ $decesItem->dateNaiss }}</td>
                                        <td>{{ $decesItem->lieuNaiss }}</td>
                                        <td>
                                            @if($decesItem->identiteDeclarant)
                                                @php
                                                    $identiteDeclarantPath = asset('storage/' . $decesItem->identiteDeclarant);
                                                    $isIdentiteDeclarantPdf = strtolower(pathinfo($identiteDeclarantPath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isIdentiteDeclarantPdf)
                                                      <a href="{{ $identiteDeclarantPath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <div style="position: relative; width: 100px; height: 100px;">
                                                        <img src="{{ $identiteDeclarantPath }}" 
                                                            alt="Pièce du déclarant" 
                                                            width="50" height="50" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#imageModal" 
                                                            onclick="showImage(this)" 
                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                            Aucun fichier
                                                        </span>
                                                    </div>
                                                @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                         <td>
                                            @if($decesItem->acteMariage)
                                                @php
                                                    $acteMariagePath = asset('storage/' . $decesItem->acteMariage);
                                                    $isActeMariagePdf = strtolower(pathinfo($acteMariagePath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isActeMariagePdf)
                                                      <a href="{{ $acteMariagePath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <div style="position: relative; width: 100px; height: 100px;">
                                                        <img src="{{  $acteMariagePath }}" 
                                                            alt="Acte de mariage" 
                                                            width="50" height="50" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#imageModal" 
                                                            onclick="showImage(this)" 
                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                            Aucun fichier
                                                        </span>
                                                    </div>
                                                @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($decesItem->deParLaLoi)
                                                @php
                                                    $deParLaLoiPath = asset('storage/' . $decesItem->deParLaLoi);
                                                    $isDeParLaLoiPdf = strtolower(pathinfo($deParLaLoiPath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isDeParLaLoiPdf)
                                                      <a href="{{ $deParLaLoiPath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <div style="position: relative; width: 100px; height: 100px;">
                                                        <img src="{{ $deParLaLoiPath }}" 
                                                            alt="Déclaration par la loi" 
                                                            width="50" height="50" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#imageModal" 
                                                            onclick="showImage(this)" 
                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                            Aucun fichier
                                                        </span>
                                                    </div>
                                                 @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                        <td>{{ $decesItem->agent->name ?? 'N/A' }} {{ $decesItem->agent->prenom ?? '' }}</td>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Aucune naissance trouvée</td>
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
                            {{ $taskenddecedejas->links('partials.custom_pagination') }}
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
                                    <th>Nom et prénoms du défunt</th>
                                    <th>Numéro du registre</th>
                                    <th>Date du registre</th>
                                    <th>Numéro du CMU</th>
                                    <th>Certificat Médical de Décès</th>
                                    <th>CNI-défunt</th>
                                    <th>CNI-déclarant</th>
                                    <th>Document de Mariage</th>
                                    <th>Requisition de Police</th>
                                    <th>Agent</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody1">
                                @forelse($taskenddecedejas as $dece)
                                    <tr class="text-center">
                                        <td>{{ $dece->user ? $dece->user->name.' '.$dece->user->prenom : 'Demandeur inconnu' }}</td>
                                        <td>{{ $dece->name }}</td>
                                        <td>{{ $dece->numberR }}</td>
                                        <td>{{ \Carbon\Carbon::parse($dece->dateR)->format('d/m/Y') }}</td>
                                        <td>{{ $dece->CMU }}</td>
                                       <td>
                                            @if($dece->pActe)
                                                @php
                                                    $pActePath = asset('storage/' . $dece->pActe);
                                                    $isPActePdf = strtolower(pathinfo($pActePath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isPActePdf)
                                                      <a href="{{ $pActePath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <img src="{{  $pActePath }}" alt="Certificat de déclaration" 
                                                         width="50" height="50" 
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
                                            @if($dece->CNIdfnt)
                                                @php
                                                    $CNIdfntPath = asset('storage/' . $dece->CNIdfnt);
                                                    $isCNIdfntPdf = strtolower(pathinfo($CNIdfntPath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isCNIdfntPdf)
                                                      <a href="{{ $CNIdfntPath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                      <img src="{{ $CNIdfntPath }}" alt="CNIdfnt" 
                                                           width="50" height="50" 
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
                                            @if($dece->CNIdcl)
                                                @php
                                                    $CNIdclPath = asset('storage/' . $dece->CNIdcl);
                                                    $isCNIdclPdf = strtolower(pathinfo($CNIdclPath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isCNIdclPdf)
                                                      <a href="{{ $CNIdclPath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <img src="{{  $CNIdclPath }}" alt="CNIdcl" 
                                                         width="50" height="50" 
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
                                            @if($dece->documentMariage)
                                                @php
                                                    $documentMariagePath = asset('storage/' . $dece->documentMariage);
                                                    $isDocumentMariagePdf = strtolower(pathinfo($documentMariagePath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isDocumentMariagePdf)
                                                      <a href="{{ $documentMariagePath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <div style="position: relative; width: 100px; height: 100px;">
                                                        <img src="{{  $documentMariagePath }}" alt="Document de Mariage" 
                                                             width="50" height="50" 
                                                             data-bs-toggle="modal" 
                                                             data-bs-target="#imageModal" 
                                                             onclick="showImage(this)" 
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                            Aucun fichier
                                                        </span>
                                                    </div>
                                                 @endif
                                             @else
                                                <span>Le défunt(e) n'est pas marié(e)</span>
                                            @endif
                                        </td>
                                         <td>
                                           @if($dece->RequisPolice)
                                                @php
                                                    $RequisPolicePath = asset('storage/' . $dece->RequisPolice);
                                                    $isRequisPolicePdf = strtolower(pathinfo($RequisPolicePath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isRequisPolicePdf)
                                                      <a href="{{  $RequisPolicePath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <div style="position: relative; width: 100px; height: 100px;">
                                                        <img src="{{  $RequisPolicePath }}" alt="Requis de Police" 
                                                             width="50" height="50" 
                                                             data-bs-toggle="modal" 
                                                             data-bs-target="#imageModal" 
                                                             onclick="showImage(this)" 
                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                            Document non disponible
                                                        </span>
                                                    </div>
                                                 @endif
                                            @else
                                                <span>Document non disponible</span>
                                            @endif
                                        </td>
                                        <td>{{ $dece->agent->name ?? 'N/A' }} {{ $dece->agent->prenom ?? '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Aucune donnée trouvée</td>
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
