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
                        <h4 class="card-title card-title-dash">Listes des demandes d'extrait effectuée</h4>
                    </div>
                    <div>
                        <a href="{{ route('naissance.create') }}">
                            <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">Faire une nouvelle demande</button>
                        </a>
                    </div>
                </div>
                <!-- Onglets -->
                <ul class="nav nav-tabs mt-4" id="naissanceTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="complete-tab" data-bs-toggle="tab" data-bs-target="#complete" type="button" role="tab" aria-controls="complete" aria-selected="true">
                            Demandes d'extrait avec certificat
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="partial-tab" data-bs-toggle="tab" data-bs-target="#partial" type="button" role="tab" aria-controls="partial" aria-selected="false">
                            Demandes d'extrait pour moi/une tierce personne 
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="naissanceTabsContent">
                    <!-- Onglet 1 : Complètes -->
                    <div class="tab-pane fade show active" id="complete" role="tabpanel" aria-labelledby="complete-tab">
                        <div class="table-responsive mt-4">
                            <table class="table select-table">
                                <thead class="bg-navbar text-white">
                                    <tr class="text-center">
                                        <th>Demandeur</th>
                                        <th>Hôpital</th>
                                        <th>Nom et Prénoms de la mère</th>
                                        <th>Nom et Prénoms (choisir) du né</th>
                                        <th>Nom et Prénoms du père</th>
                                        <th>Date de Naissance de l'enfant</th>
                                        <th>CNI du père</th>
                                        <th>Certificat Médical de Naissance</th>
                                        <th>Etat Actuel</th>
                                        <th>Agent</th>
                                        <th>Supprimer</th>
                                        <th>Rétrait</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($naissances as $naissance)
                                    <tr class="text-center">
                                        <td>{{ $naissance->user ? $naissance->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $naissance->nomHopital }}</td>
                                        <td>{{ $naissance->nomDefunt }}</td>
                                        <td>{{ $naissance->nom . ' ' . $naissance->prenom }}</td>
                                        <td>{{ $naissance->nompere . ' ' . $naissance->prenompere }}</td>
                                        <td>{{ $naissance->lieuNaiss }}</td>
                                        <td>
                                            @if (pathinfo($naissance->identiteDeclarant, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $naissance->identiteDeclarant) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $naissance->identiteDeclarant) }}" 
                                                     alt="Pièce du parent" 
                                                     width="100" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        <td>
                                            @if (pathinfo($naissance->cdnaiss, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $naissance->cdnaiss) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $naissance->cdnaiss) }}" 
                                                     alt="Pièce du parent" 
                                                     width="100" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $naissance->etat == 'en attente' ? 'badge-opacity-warning' : ($naissance->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}" style="color:#d19461">
                                                {{ $naissance->etat }}
                                            </span>
                                        </td>
                                        <td>{{ $naissance->agent ? $naissance->agent->name . ' ' . $naissance->agent->prenom : 'Non attribué' }}</td>
                                        <td>
                                            @if ($naissance->etat !== 'réçu' && $naissance->etat !== 'terminé')
                                                <button onclick="confirmDelete('{{ route('naissance.delete', $naissance->id) }}')" class="btn btn-sm text-center"><i class="fas fa-trash"></i></button>
                                            @else
                                                <button class="btn btn-danger btn-sm disabled-btn" onclick="showDisabledMessage()">Supprimer</button>
                                            @endif
                                        </td>
                                        <td ><div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $naissance->choix_option }}</div></td>
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

                    <!-- Onglet 2 : Partielles -->
                    <div class="tab-pane fade" id="partial" role="tabpanel" aria-labelledby="partial-tab">
                        <div class="table-responsive mt-4">
                            <table class="table select-table">
                                <thead class="bg-navbar text-white">
                                    <tr class="text-center" style="font-size: 12px">
                                        <th>Demandeur</th>
                                        <th>Type de copie</th>
                                        <th>Nom sur l'extrait</th>
                                        <th>Numéro de régistre</th>
                                        <th>Date de régistre</th>
                                        <th>Numéro CMU</th>
                                        <th>Pièce d'identité du demandeur</th>
                                        <th>Etat Actuel</th>
                                        <th>Agent</th>
                                        <th>Supprimer</th>
                                        <th>Rétrait</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($naissancesD as $naissanceD)
                                    <tr class="text-center">
                                        <td>{{ $naissanceD->user ? $naissanceD->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $naissanceD->type }}</td>
                                        <td>{{ $naissanceD->name.' '.$naissanceD->prenom.' '.'('.($naissanceD->pour).')'}}</td>
                                        <td>{{ $naissanceD->number }}</td>
                                        <td>{{ $naissanceD->DateR }}</td>
                                        <td>{{ $naissanceD->CMU }}</td>
                                        <td>
                                            @if (pathinfo($naissanceD->CNI, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $naissanceD->CNI) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $naissanceD->CNI) }}" 
                                                     alt="Pièce du parent" 
                                                     width="100" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                      
                                        <td>
                                            <span class="badge {{ $naissanceD->etat == 'en attente' ? 'badge-opacity-warning' : ($naissanceD->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}" style="color:#d19461" >
                                                {{ $naissanceD->etat }}
                                            </span>
                                        </td>
                                        <td>{{ $naissanceD->agent ? $naissanceD->agent->name . ' ' . $naissanceD->agent->prenom : 'Non attribué' }}</td>
                                        <td>
                                            @if ($naissanceD->etat !== 'réçu' && $naissanceD->etat !== 'terminé')
                                                 <button onclick="confirmDelete('{{ route('naissanced.delete', $naissanceD->id) }}')" class="btn btn-sm text-center"><i class="fas fa-trash"></i></button>
                                            @else
                                                <button style="margin-left:30px" class="btn btn-danger btn-sm disabled-btn" onclick="showDisabledMessage()">Supprimer</button>
                                            @endif
                                        </td>
                                        <td ><div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $naissanceD->choix_option }}</div></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Aucune demande effectuée</td>
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
            title: 'Action impossible',
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