@extends('utilisateur.layouts.template')

@section('content')

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
@if($naissances->contains(function ($naissance) { return $naissance->archived_at; }))
    @foreach($naissances as $naissance)
        @if($naissance->archived_at)
            <marquee behavior="" direction="left" style="font-size:30px; color:red; font-weight:bold">
                Motif d'annulation de demande pour l'extrait de {{ $naissance->nom.' '.$naissance->prenom  }} : 
                 {{ $naissance->autre_motif_text ?? $naissance->motif_annulation }}
            </marquee>
        @endif
    @endforeach
@endif
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
                            <button class="btn btn-lg text-white mb-0 me-0" type="button" style="background-color:#008000 ">Faire une nouvelle demande</button>
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
                           <table class="table select-table" style="border-collapse: collapse;">
                                <thead class="bg-navbar text-white">
                                    <tr class="text-center">
                                        <th style="border: 1px solid black;">Demandeur</th>
                                        <th style="border: 1px solid black;">Demandeur</th>
                                        <th style="border: 1px solid black;">Hôpital</th>
                                        <th style="border: 1px solid black;">Nom et Prénoms de la mère</th>
                                        <th style="border: 1px solid black;">Nom et Prénoms (choisir) du né</th>
                                        <th style="border: 1px solid black;">Nom et Prénoms du père</th>
                                        <th style="border: 1px solid black;">Date de Naissance de l'enfant</th>
                                        <th style="border: 1px solid black;">CNI du père</th>
                                        <th style="border: 1px solid black;">Certificat Médical de Naissance</th>
                                        <th style="border: 1px solid black;">Etat Actuel</th>
                                        <th style="border: 1px solid black;">Agent</th>
                                        <th style="border: 1px solid black;">Supprimer</th>
                                        <th style="border: 1px solid black;">Rétrait</th>
                                        @if($naissances->contains(function ($naissance) { return $naissance->archived_at; }))
                                            <th style="border: 1px solid black;">Modifier</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($naissances as $naissance)
                                    <tr class="text-center">
                                        <td style="border: 1px solid black;">{{ $naissance->user ? $naissance->user->name : 'Demandeur inconnu' }}</td>
                                        <td style="border: 1px solid black;">{{ $naissance->reference }}</td>
                                        <td style="border: 1px solid black;">{{ $naissance->nomHopital }}</td>
                                        <td style="border: 1px solid black;">{{ $naissance->nomDefunt }}</td>
                                        <td style="border: 1px solid black;">{{ $naissance->nom . ' ' . $naissance->prenom }}</td>
                                        <td style="border: 1px solid black;">{{ $naissance->nompere . ' ' . $naissance->prenompere }}</td>
                                        <td style="border: 1px solid black;">{{ $naissance->lieuNaiss }}</td>
                                        <td style="border: 1px solid black;">
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
                                        <td style="border: 1px solid black;">
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
                                        <td style="border: 1px solid black;">
                                            <span class="badge {{ $naissance->etat == 'en attente' ? 'badge-opacity-warning' : ($naissance->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}" style="color:#d19461">
                                                {{ $naissance->etat }}
                                            </span>
                                        </td>
                                        <td style="border: 1px solid black;">{{ $naissance->agent ? $naissance->agent->name . ' ' . $naissance->agent->prenom : 'Non attribué' }}</td>
                                        <td style="border: 1px solid black;">
                                            @if ($naissance->etat !== 'réçu' && $naissance->etat !== 'terminé')
                                                <button onclick="confirmDelete('{{ route('naissance.delete', $naissance->id) }}')" class="btn btn-sm text-center"><i class="fas fa-trash"></i></button>
                                            @else
                                                <button  class="btn btn-danger btn-sm disabled-btn text-center" onclick="showDisabledMessage()"><i class="fas fa-trash"></i></button>
                                            @endif
                                        </td>
                                        <td style="border: 1px solid black;"><div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $naissance->choix_option }}</div></td>
                                        <td style="border: 1px solid black;">
                                            @if($naissance->archived_at)
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifierModal{{ $naissance->id }}">
                                                    Modifier
                                                </button>
                                            @endif
                                        </td>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="modifierModal{{ $naissance->id }}" tabindex="-1" role="dialog" aria-labelledby="modifierModalLabel{{ $naissance->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modifierModalLabel{{ $naissance->id }}">Modifier le prénom</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="modifierForm{{ $naissance->id }}">
                                                            @csrf
                                                            @method('POST')
                                                            <div class="form-group">
                                                                <label for="newPrenom{{ $naissance->id }}">Nouveau prénom</label>
                                                                <input type="text" class="form-control" id="newPrenom{{ $naissance->id }}" name="newPrenom" required>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        <button type="button" class="btn btn-primary" onclick="submitForm({{ $naissance->id }})">Enregistrer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <script>
                                            function submitForm(naissanceId) {
                                                var newPrenom = $('#newPrenom' + naissanceId).val();
                                                console.log('ID:', naissanceId, 'Nouveau prénom:', newPrenom);

                                                var url = '{{ route("modifier.prenom", ["id" => ":id"]) }}';
                                                url = url.replace(':id', naissanceId);

                                                $.ajax({
                                                    url: url,
                                                    type: 'POST',
                                                    data: {
                                                        _token: $('input[name="_token"]').val(),
                                                        newPrenom: newPrenom
                                                    },
                                                    success: function(response) {
                                                        console.log('Réponse du serveur:', response);
                                                        if (response.success) {
                                                            alert('Prénom modifié avec succès !');
                                                            $('#modifierModal' + naissanceId).modal('hide');
                                                            location.reload();
                                                        } else {
                                                            alert('Erreur : ' + response.message);
                                                        }
                                                    },
                                                    error: function(xhr, status, error) {
                                                        console.error('Erreur AJAX:', xhr.responseText);
                                                        alert('Erreur lors de la communication avec le serveur. Détails : ' + xhr.responseText);
                                                    }
                                                });
                                            }
                                        </script>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="13" class="text-center" style="border: 1px solid black;">Aucune demande effectuée</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Onglet 2 : Partielles -->
                    <div class="tab-pane fade" id="partial" role="tabpanel" aria-labelledby="partial-tab">
                        <div class="table-responsive mt-4">
                            <table class="table select-table" style="border-collapse: collapse;">
                                <thead class="bg-navbar text-white">
                                    <tr class="text-center" style="font-size: 12px">
                                        <th style="border: 1px solid black;">Demandeur</th>
                                        <th style="border: 1px solid black;">Réference </th>
                                        <th style="border: 1px solid black;">Type de copie </th>
                                        <th style="border: 1px solid black;">Nom sur l'extrait </th>
                                        <th style="border: 1px solid black;">Numéro de régistre</th>
                                        <th style="border: 1px solid black;">Date de régistre</th>
                                        <th style="border: 1px solid black;">Numéro CMU</th>
                                        <th style="border: 1px solid black;">Pièce d'identité du demandeur</th>
                                        <th style="border: 1px solid black;">Etat Actuel</th>
                                        <th style="border: 1px solid black;">Agent</th>
                                        <th style="border: 1px solid black;">Supprimer</th>
                                        <th style="border: 1px solid black;">Rétrait</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($naissancesD as $naissanceD)
                                    <tr class="text-center">
                                        <td style="border: 1px solid black;">{{ $naissanceD->user ? $naissanceD->user->name : 'Demandeur inconnu' }}</td>
                                        <td style="border: 1px solid black;">{{ $naissanceD->reference }}</td>
                                        <td style="border: 1px solid black;">{{ $naissanceD->type }}</td>
                                        <td style="border: 1px solid black;">{{ $naissanceD->name.' '.$naissanceD->prenom.' '.'('.($naissanceD->pour).')'}}</td>
                                        <td style="border: 1px solid black;">{{ $naissanceD->number }}</td>
                                        <td style="border: 1px solid black;">{{ $naissanceD->DateR }}</td>
                                        <td style="border: 1px solid black;">{{ $naissanceD->CMU }}</td>
                                        <td style="border: 1px solid black;">
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
                                      
                                        <td style="border: 1px solid black;">
                                            <span class="badge {{ $naissanceD->etat == 'en attente' ? 'badge-opacity-warning' : ($naissanceD->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}" style="color:#d19461" >
                                                {{ $naissanceD->etat }}
                                            </span>
                                        </td>
                                        <td style="border: 1px solid black;">{{ $naissanceD->agent ? $naissanceD->agent->name . ' ' . $naissanceD->agent->prenom : 'Non attribué' }}</td>
                                        <td style="border: 1px solid black;">
                                            @if ($naissanceD->etat !== 'réçu' && $naissanceD->etat !== 'terminé')
                                                 <button onclick="confirmDelete('{{ route('naissanced.delete', $naissanceD->id) }}')" class="btn btn-sm text-center"><i class="fas fa-trash"></i></button>
                                            @else
                                                 <button  class="btn btn-danger btn-sm disabled-btn text-center" onclick="showDisabledMessage()"><i class="fas fa-trash"></i></button>
                                             @endif
                                        </td>
                                        <td style="border: 1px solid black;"><div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $naissanceD->choix_option }}</div></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="12" class="text-center">Aucune demande effectuée</td>
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