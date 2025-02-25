@extends('utilisateur.layouts.template')

@section('content')

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .form-background {
        background-image: url("{{ asset('assets/images/profiles/arriereP.jpg') }}");
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

    .btn-danger {
        color: white;
        background-color: #dc3545;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-danger:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    .disabled-btn {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: all; /* Permet au bouton de recevoir des événements de clic */
    }
</style>

<div class="row flex-grow form-background">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="card-title card-title-dash">Listes des demandes d'extrait effectuées</h4>
                    </div>
                    <div>
                        <a href="{{ route('deces.create') }}">
                            <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">Faire une nouvelle demande</button>
                        </a>
                    </div>
                </div>

                <!-- Onglets -->
                <ul class="nav nav-tabs" id="decesTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="completes-tab" data-bs-toggle="tab" href="#completes" role="tab" aria-controls="completes" aria-selected="true">Demandes d'extrait avec certificat</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="partielles-tab" data-bs-toggle="tab" href="#partielles" role="tab" aria-controls="partielles" aria-selected="false">Demandes d'extrait pour moi/une tierce personne</a>
                    </li>
                </ul>

                <!-- Contenu des Onglets -->
                <div class="tab-content" id="decesTabsContent">
                    <!-- Premier Onglet -->
                    <div class="tab-pane fade show active" id="completes" role="tabpanel" aria-labelledby="completes-tab">
                        <div class="table-responsive mt-4">
                            <table class="table select-table">
                                <thead class="bg-navbar text-white">
                                    <tr class="text-center" style="font-size: 12px">
                                        <th>|Demandeur|</th>
                                        <th>|Réference|</th>
                                        <th>|Hôpital|</th>
                                        <th>|Nom du défunt|</th>
                                        <th>|Date de Naissance|</th>
                                        <th>|Date de Décès|</th>
                                        <th>|Pièce du Défunt|</th>
                                        <th>|Certificat de Déclaration|</th>
                                        <th>|De par la Loi|</th>
                                        <th>|Etat Actuel|</th>
                                        <th>|Agent|</th>
                                        <th>|Supprimer|</th>
                                        <th>|Rétrait|</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($deces as $deceD)
                                    <tr class="text-center" style="font-size: 12px">
                                        <td>{{ $deceD->user ? $deceD->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $deceD->reference }}</td>
                                        <td>{{ $deceD->nomHopital }}</td>
                                        <td>{{ $deceD->nomDefunt }}</td>
                                        <td>{{ $deceD->dateNaiss }}</td>
                                        <td>{{ $deceD->dateDces }}</td>
                                        <td>
                                            @if (pathinfo($deceD->identiteDeclarant, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $deceD->identiteDeclarant) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $deceD->identiteDeclarant) }}" 
                                                     alt="Pièce du parent" 
                                                     width="100" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        
                                        <td>
                                            @if (pathinfo($deceD->acteMariage, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $deceD->acteMariage) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $deceD->acteMariage) }}" 
                                                     alt="Pièce du parent" 
                                                     width="100" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        
                                                                                
                                        <td>
                                            @if (pathinfo($deceD->deParLaLoi, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $deceD->deParLaLoi) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $deceD->deParLaLoi) }}" 
                                                     alt="Pièce du parent" 
                                                     width="100" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $deceD->etat == 'en attente' ? 'badge-opacity-warning' : ($deceD->etat == 'réçu' ?'badge-opacity-success' : 'badge-opacity-danger') }}" style="color:#d19461" >{{ $deceD->etat }}</span>
                                        </td>
                                        <td>{{ $deceD->agent ? $deceD->agent->name . ' ' . $deceD->agent->prenom : 'Non attribué' }}</td>
                                        <td>
                                            @if ($deceD->etat !== 'réçu' && $deceD->etat !== 'terminé')
                                                <button onclick="confirmDelete('{{ route('deces.delete', $deceD->id) }}')" class="btn btn-sm text-center"><i class="fas fa-trash"></i></button>
                                            @else
                                                <button  class="btn btn-danger btn-sm disabled-btn text-center" onclick="showDisabledMessage()"><i class="fas fa-trash"></i></button>
                                            @endif
                                        </td>
                                        <td ><div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $deceD->choix_option }}</div></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Aucune demande effectuée</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Deuxième Onglet -->
                    <div class="tab-pane fade" id="partielles" role="tabpanel" aria-labelledby="partielles-tab">
                        <div class="table-responsive mt-5">
                            <table class="table select-table">
                                <thead class="bg-navbar text-white">
                                    <tr class="text-center" style="font-size: 12px">
                                        <th>Demandeur |</th>
                                        <th>Réference|</th>
                                        <th>Nom et prénoms du défunt |</th>
                                        <th>Numéro du registre |</th>
                                        <th>Date du registre |</th>
                                        <th>Numéro du CMU |</th>
                                        <th>Certificat Médical de Décès |</th>
                                        <th>CNI-défunt |</th>
                                        <th>CNI-déclarant |</th>
                                        <th>Document de Mariage |</th>
                                        <th>Requisition de Police |</th>
                                        <th>État Actuel |</th>
                                        <th>Agent |</th>
                                        <th>Supprimer |</th>
                                        <th>Rétrait</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($decesdeja as $dece)
                                    <tr class="text-center" style="font-size: 12px">
                                        <td>{{ $dece->user ? $dece->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $dece->reference }}</td>
                                        <td>{{ $dece->name }}</td>
                                        <td>{{ $dece->numberR }}</td>
                                        <td>{{ \Carbon\Carbon::parse($dece->dateR)->format('d/m/Y') }}</td>
                                        <td>{{ $dece->CMU }}</td>
                                        <td>
                                            @if (pathinfo($dece->pActe, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $dece->pActe) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $dece->pActe) }}" 
                                                     alt="Pièce du parent" 
                                                     width="100" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        <td>
                                            @if (pathinfo($dece->CNIdfnt, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $dece->CNIdfnt) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $dece->CNIdfnt) }}" 
                                                     alt="Pièce du parent" 
                                                     width="100" 
                                                     height="auto" 
                                                     onclick="showImage(this)">
                                            @endif
                                        </td>
                                        <td>
                                            @if (pathinfo($dece->CNIdcl, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $dece->CNIdcl) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $dece->CNIdcl) }}" 
                                                     alt="Pièce du parent" 
                                                     width="100" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        <td>
                                            @if (pathinfo($dece->documentMariage, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $dece->documentMariage) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $dece->documentMariage) }}" 
                                                     alt="Pièce du parent" 
                                                     width="100" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        <td>
                                            @if (pathinfo($dece->RequisPolice, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $dece->RequisPolice) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $dece->RequisPolice) ? 'eee':'eee' }}" 
                                                     alt="Pas de Requisition" 
                                                     width="100" 
                                                     height="auto" 
                                                     onclick="showImage(this)">
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $dece->etat == 'en attente' ? 'badge-opacity-warning' : ($dece->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}" style="color:#d19461">
                                                {{ ucfirst($dece->etat) }}
                                            </span>
                                        </td>
                                        <td>{{ $dece->agent ? $dece->agent->name . ' ' . $dece->agent->prenom : 'Non attribué' }}</td>
                                        <td>
                                            @if ($dece->etat !== 'réçu' && $dece->etat !== 'terminé')
                                            <button onclick="confirmDelete('{{ route('deces.deletedeja', $dece->id) }}')" class="btn btn-sm text-center"><i class="fas fa-trash"></i></button>
                                            @else
                                                <button  class="btn btn-danger btn-sm disabled-btn text-center" onclick="showDisabledMessage()"><i class="fas fa-trash"></i></button>
                                            @endif
                                        </td>
                                        <td ><div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $dece->choix_option }}</div></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="13" class="text-center">Aucune déclaration trouvée</td>
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

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function showImage(imageElement) {
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageElement.src;
    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
    imageModal.show();
}

function confirmDelete(url) {
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Vous ne pourrez pas revenir en arrière !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url; // Rediriger vers l'URL de suppression
        }
    });
}

function showDisabledMessage() {
    Swal.fire({
        title: 'Impossible de supprimer',
        text: 'Vous ne pouvez pas supprimer cette demande car elle est en cours de traitement ou déjà terminée.',
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
}

// Afficher un pop-up de succès après la suppression
@if(session('success'))
    Swal.fire({
        title: 'Succès !',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
@endif

// Afficher un pop-up d'erreur en cas d'échec de la suppression
@if(session('error'))
    Swal.fire({
        title: 'Erreur !',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
@endif
</script>

@endsection