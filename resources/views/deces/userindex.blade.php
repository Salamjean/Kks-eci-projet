@extends('utilisateur.layouts.template')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
                                        <th>Demandeur</th>
                                        <th>Hôpital</th>
                                        <th>Nom du défunt</th>
                                        <th>Date de Naissance</th>
                                        <th>Date de Décès</th>
                                        <th>Pièce du Défunt</th>
                                        <th>Certificat de Déclaration</th>
                                        <th>De par la Loi</th>
                                        <th>Etat Actuel</th>
                                        <th>Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($deces as $deceD)
                                    <tr class="text-center" style="font-size: 12px">
                                        <td>{{ $deceD->user ? $deceD->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $deceD->nomHopital }}</td>
                                        <td>{{ $deceD->nomDefunt }}</td>
                                        <td>{{ $deceD->dateNaiss }}</td>
                                        <td>{{ $deceD->dateDces }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $deceD->identiteDeclarant) }}" alt="Pièce du parent" width="100" height="auto" onclick="showImage(this)" onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $deceD->acteMariage) }}" alt="Certificat de déclaration" width="100" height="auto" onclick="showImage(this)" onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $deceD->deParLaLoi) }}" alt="De par la Loi" width="100" height="auto" onclick="showImage(this)" onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <span class="badge {{ $deceD->etat == 'en attente' ? 'badge-opacity-warning' : ($deceD->etat == 'réçu' ?'badge-opacity-success' : 'badge-opacity-danger') }}">{{ $deceD->etat }}</span>
                                        </td>
                                        <td>{{ $deceD->agent ? $deceD->agent->name . ' ' . $deceD->agent->prenom : 'Non attribué' }}</td>
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

                    <!-- Deuxième Onglet -->
                    <div class="tab-pane fade" id="partielles" role="tabpanel" aria-labelledby="partielles-tab">
                        <div class="table-responsive mt-5">
                            <table class="table select-table">
                                <thead class="bg-navbar text-white">
                                    <tr class="text-center" style="font-size: 12px">
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
                                        <th>État Actuel</th>
                                        <th>Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($decesdeja as $dece)
                                    <tr class="text-center" style="font-size: 12px">
                                        <td>{{ $dece->user ? $dece->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $dece->name }}</td>
                                        <td>{{ $dece->numberR }}</td>
                                        <td>{{ \Carbon\Carbon::parse($dece->dateR)->format('d/m/Y') }}</td>
                                        <td>{{ $dece->CMU }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $dece->pActe) }}" alt="Certificat de déclaration" 
                                                 width="100" height="auto" 
                                                 onclick="showImage(this)" 
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $dece->CNIdfnt) }}" alt="CNIdfnt" 
                                                 width="100" height="auto" 
                                                 onclick="showImage(this)" 
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $dece->CNIdcl) }}" alt="CNIdcl" 
                                                 width="100" height="auto" 
                                                 onclick="showImage(this)" 
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $dece->documentMariage) }}" alt="Le défunt(e) n'est pas marié(e)" 
                                                 width="100" height="auto" 
                                                 onclick="showImage(this)" 
                                                 >
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $dece->RequisPolice) }}" alt="Décédé à l'hôpital" 
                                                 width="100" height="auto" 
                                                 onclick="showImage(this)" 
                                                >
                                        </td>
                                        <td>
                                            <span class="badge {{ $dece->etat == 'en attente' ? 'badge-opacity-warning' : ($dece->etat == 'réçu' ? 
                                            'badge-opacity-success' : 'badge-opacity-danger') }}">
                                                {{ ucfirst($dece->etat) }}
                                            </span>
                                        </td>
                                        <td>{{ $dece->agent ? $dece->agent->name . ' ' . $dece->agent->prenom : 'Non attribué' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="12" class="text-center">Aucune déclaration trouvée</td>
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
