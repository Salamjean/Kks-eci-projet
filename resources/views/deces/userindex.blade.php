@extends('utilisateur.layouts.template')

@section('content')

<div class="row flex-grow">
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
                        <a class="nav-link active" id="completes-tab" data-bs-toggle="tab" href="#completes" role="tab" aria-controls="completes" aria-selected="true">Demandes avec informations complètes</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="partielles-tab" data-bs-toggle="tab" href="#partielles" role="tab" aria-controls="partielles" aria-selected="false">Demandes avec informations partielles</a>
                    </li>
                </ul>

                <!-- Contenu des Onglets -->
                <div class="tab-content" id="decesTabsContent">
                    <!-- Premier Onglet : Demandes complètes -->
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
                                    <tr style="font-size: 12px" class="text-center">
                                        <td>{{ $deceD->user ? $deceD->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $deceD->nomHopital }}</td>
                                        <td>{{ $deceD->nomDefunt }}</td>
                                        <td>{{ $deceD->dateNaiss }}</td>
                                        <td>{{ $deceD->dateDces }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $deceD->identiteDeclarant) }}" alt="Pièce du parent" width="100" height="auto" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)" onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $deceD->cdnaiss) }}" alt="Certificat de déclaration" width="100" height="auto" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)" onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                        </td>
                                        <td>
                                            <div style="position: relative; width: 100px; height: 100px;">
                                                <img src="{{ asset('storage/' . $deceD->acteMariage) }}" alt="Acte de mariage" width="100" height="auto" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">Aucun fichier</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $deceD->etat == 'en attente' ? 'badge-opacity-warning' : ($deceD->etat == 'réçu' ?'badge-opacity-success' : 'badge-opacity-danger') }}">
                                                {{ $deceD->etat }}
                                            </span>
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

                    <!-- Deuxième Onglet : Demandes partielles -->
                    <div class="tab-pane fade" id="partielles" role="tabpanel" aria-labelledby="partielles-tab">
                        <div class="table-responsive mt-5">
                            <table class="table select-table">
                                <thead class="bg-navbar text-white">
                                    <tr class="text-center" style="font-size: 12px">
                                        <th>Demandeur</th>
                                        <th>Nom et prénoms du défunt</th>
                                        <th>Numéro du régistre</th>
                                        <th>Date du régistre</th>
                                        <th>Certificat Médical de Décès</th>
                                        <th>Premier Acte de décès</th>
                                        <th>Etat Actuel</th>
                                        <th>Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($decesdeja as $dece)
                                    <tr style="font-size: 12px" class="text-center">
                                        <td>{{ $dece->user ? $dece->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $dece->name }}</td>
                                        <td>{{ $dece->numberR }}</td>
                                        <td>{{ $dece->dateR }}</td>
                                        <td>{{ $dece->CMD }}</td>
                                        <td>
                                            <div style="position: relative; width: 100px; height: 100px;">
                                                <img src="{{ asset('storage/' . $dece->pActe) }}" alt="Pièce du déclarant" width="100" height="100" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this)" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">Aucun fichier</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $dece->etat == 'en attente' ? 'badge-opacity-warning' : ($dece->etat == 'réçu' ?'badge-opacity-success' : 'badge-opacity-danger') }}">
                                                {{ $dece->etat }}
                                            </span>
                                        </td>
                                        <td>{{ $dece->agent ? $dece->agent->name . ' ' . $dece->agent->prenom : 'Non attribué' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Aucune déclaration trouvée</td>
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

        // Vérifier si l'image utilise déjà la valeur de remplacement (image par défaut)
        if (imageElement.src.includes('assets/images/profiles/bébé.jpg')) {
            modalImage.src = imageElement.src; // Utiliser l'image par défaut
        } else {
            modalImage.src = imageElement.src; // Utiliser l'image actuelle (valide)
        }
    }
</script>
