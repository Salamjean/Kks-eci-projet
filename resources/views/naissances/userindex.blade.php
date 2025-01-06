@extends('utilisateur.layouts.template')

@section('content')

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
                                            <img src="{{ asset('storage/' . $naissance->identiteDeclarant) }}" 
                                                 alt="Pièce du parent" 
                                                 width="100" 
                                                 height="auto" 
                                                 onclick="showImage(this)" 
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $naissance->cdnaiss) }}" 
                                                 alt="Certificat de déclaration" 
                                                 width="100" 
                                                 height="auto" 
                                                 onclick="showImage(this)" 
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <span class="badge {{ $naissance->etat == 'en attente' ? 'badge-opacity-warning' : ($naissance->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}">
                                                {{ $naissance->etat }}
                                            </span>
                                        </td>
                                        <td>{{ $naissance->agent ? $naissance->agent->name . ' ' . $naissance->agent->prenom : 'Non attribué' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Aucune demande effectuée</td>
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
                                        <th>Type de demande</th>
                                        <th>Nom sur l'extrait</th>
                                        <th>Numéro de régistre</th>
                                        <th>Date de régistre</th>
                                        <th>Numéro CMU</th>
                                        <th>Pièce d'identité du demandeur</th>
                                        <th>Etat Actuel</th>
                                        <th>Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($naissancesD as $naissanceD)
                                    <tr class="text-center">
                                        <td>{{ $naissanceD->user ? $naissanceD->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $naissanceD->type }}</td>
                                        <td>{{ $naissanceD->name.' '.$naissanceD->prenom }}</td>
                                        <td>{{ $naissanceD->number }}</td>
                                        <td>{{ $naissanceD->DateR }}</td>
                                        <td>{{ $naissanceD->CMU }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $naissanceD->CNI) }}" 
                                                 alt="Certificat de déclaration" 
                                                 width="100" 
                                                 height="auto" 
                                                 onclick="showImage(this)" 
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <span class="badge {{ $naissanceD->etat == 'en attente' ? 'badge-opacity-warning' : ($naissanceD->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}">
                                                {{ $naissanceD->etat }}
                                            </span>
                                        </td>
                                        <td>{{ $naissanceD->agent ? $naissanceD->agent->name . ' ' . $naissanceD->agent->prenom : 'Non attribué' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucune demande effectuée</td>
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

<script>
    function showImage(imageElement) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageElement.src;
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }
</script>

@endsection
