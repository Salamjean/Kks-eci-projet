@extends('utilisateur.layouts.template')

@section('content')

<div class="row flex-grow">
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
                                    <tr class="text-center" style="font-size: 12px">
                                        <th>Demandeur</th>
                                        <th>Hôpital</th>
                                        <th>Nom Du Nouveau Né</th>
                                        <th>Date De Naissance</th>
                                        <th>Lieu De Naissance</th>
                                        <th>Pièce Du Parent</th>
                                        <th>Certificat De Déclaration</th>
                                        <th>Acte De Mariage</th>
                                        <th>Etat Actuel</th>
                                        <th>Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($naissances as $naissance)
                                    <tr class="text-center" style="font-size: 12px">
                                        <td>{{ $naissance->user ? $naissance->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $naissance->nomHopital }}</td>
                                        <td>{{ $naissance->nomDefunt }}</td>
                                        <td>{{ $naissance->dateNaiss }}</td>
                                        <td>{{ $naissance->lieuNaiss }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $naissance->identiteDeclarant) }}" alt="Pièce du parent" width="100" height="auto" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)" onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $naissance->cdnaiss) }}" alt="Certificat de déclaration" width="100" height="auto" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)" onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $naissance->acteMariage) }}" alt="Acte de mariage" width="100" height="auto" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)" onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <span style="display: none; color: gray;">Aucun fichier</span>
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
                                        <td colspan="10" class="text-center">Aucune demande effectuée</td>
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
                                        <th>numéro du registre</th>
                                        <th>Etat Actuel</th>
                                        <th>Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($naissancesD as $naissanceD)
                                    <tr class="text-center" style="font-size: 12px">
                                        <td>{{ $naissanceD->user ? $naissanceD->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $naissanceD->type }}</td>
                                        <td>{{ $naissanceD->name }}</td>
                                        <td>{{ $naissanceD->number }}</td>
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

@endsection

<script>
    function showImage(imageElement) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageElement.src.includes('assets/images/profiles/bébé.jpg') ? imageElement.src : imageElement.src;
    }
</script>
