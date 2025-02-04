@extends('vendor.layouts.template')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .etat-en-attente {
        background-color: orange;
        color: black;
        display: flex;
    }

    .etat-validee {
        background-color: green;
        color: white;
    }

    .etat-refusee {
        background-color: red;
        color: white;
    }

    .btn {
        background-color: rgb(199, 195, 195);
    }

    .form-background {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 20px;
        border-radius: 8px;
    }

    .modal-image {
        max-width: 100%;
        height: auto;
    }
</style>

<div class="container-fluid form-background" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Listes des demandes d'extraits de Mariage</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active" aria-current="page">DataTables</li>
        </ol>
    </div>

    <!-- Mariages avec fichiers seulement (champ manquants) -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Demande De Copie Simples</h6>
                </div>
                <div class="table-responsive p-3">
                    <!-- Champ de recherche -->
                    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Rechercher...">

                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="bg-navbar text-white">
                            <tr style="font-size: 12px" class="text-center">
                                <th class="text-center">Nom du demandeur</th>
                                <th class="text-center">Nom de l'Époux</th>
                                <th class="text-center">Prénom de l'Époux</th>
                                <th class="text-center">Date de Naissance</th>
                                <th class="text-center">Lieu de Naissance</th>
                                <th class="text-center">Pièce d'Identité</th>
                                <th class="text-center">Extrait de Mariage</th>
                                <th>Etat Actuel</th>
                                <th>Agent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mariages as $mariage)
                            <tr class="text-center" style="font-size: 12px">
                                <td>{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
                                <td>{{ $mariage->nomEpoux ?? 'Copie Simple' }}</td>
                                <td>{{ $mariage->prenomEpoux ?? 'Copie Simple' }}</td>
                                <td>{{ $mariage->dateNaissanceEpoux ?? 'Copie Simple' }}</td>
                                <td>{{ $mariage->lieuNaissanceEpoux ?? 'Copie Simple' }}</td>
                                <td class="text-center">
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
                                <td class="text-center">
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
                                <td class="{{ $mariage->etat == 'en attente' ? 'bg-warning' : ($mariage->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm" style="margin-top: 8px">
                                    {{ $mariage->etat }}
                                </td>
                                <td>{{ $mariage->agent ? $mariage->agent->name . ' ' . $mariage->agent->prenom : 'Non attribué' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Aucune déclaration trouvée</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                 <script>
                     document.getElementById('searchInput').addEventListener('keyup', function() {
                        const filter = this.value.toLowerCase();
                        const rows = document.querySelectorAll('#dataTable tbody tr');
                
                        rows.forEach(row => {
                            let match = false;
                            const cells = row.querySelectorAll('td');
        
                            const nomDemandeur = cells[0].textContent.toLowerCase();
                            const nomEpoux = cells[1].textContent.toLowerCase();
                            const prenomEpoux = cells[2].textContent.toLowerCase();
                             const dateNaissance = cells[3].textContent.toLowerCase();
                            const lieuNaissance = cells[4].textContent.toLowerCase();
                
                
                            if (nomDemandeur.includes(filter) || nomEpoux.includes(filter) ||
                                prenomEpoux.includes(filter) || dateNaissance.includes(filter) ||
                                lieuNaissance.includes(filter)) {
                                 match = true;
                             }
                            row.style.display = match ? '' : 'none';
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <!-- Modale -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img id="modalImage" class="modal-image" src="" alt="Image en grand">
                </div>
            </div>
        </div>
    </div>

    <script>
        function showImage(imageElement) {
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageElement.src;
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>
</div>

@endsection