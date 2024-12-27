@extends('utilisateur.layouts.template')

@section('content')
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start mb-4">
                    <h4 class="card-title card-title-dash">Listes des demandes d'extrait effectuée</h4>
                    <a href="{{ route('mariage.create') }}">
                        <button class="btn btn-primary btn-lg text-white" type="button">Faire une nouvelle demande</button>
                    </a>
                </div>

                <!-- Onglets -->
                <ul class="nav nav-tabs" id="tableTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="table1-tab" data-bs-toggle="tab" data-bs-target="#table1" type="button" role="tab" aria-controls="table1" aria-selected="true">Demande de copie simples</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="table2-tab" data-bs-toggle="tab" data-bs-target="#table2" type="button" role="tab" aria-controls="table2" aria-selected="false">Demande de copie integrale</button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="tableTabsContent">
                    <!-- Tableau 1 -->
                    <div class="tab-pane fade show active" id="table1" role="tabpanel" aria-labelledby="table1-tab">
                        <div class="table-responsive">
                            <table class="table select-table">
                                <thead class="bg-navbar text-white">
                                    <tr style="font-size: 12px">
                                        <th class="text-center">Nom du demandeur</th>
                                        <th class="text-center">Pièce d'Identité</th>
                                        <th class="text-center">Extrait de Mariage</th>
                                        <th class="text-center">Etat Actuel</th>
                                        <th class="text-center">Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mariagesAvecFichiersSeulement as $mariage)
                                    <tr class="text-center" style="font-size: 12px">
                                        <td>{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $mariage->pieceIdentite) }}" 
                                                 alt="Pièce d'identité" 
                                                 width="100" 
                                                 height="100" 
                                                 onclick="showImage(this)" 
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/default.jpg') }}'">
                                        </td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $mariage->extraitMariage) }}" 
                                                 alt="Extrait de mariage" 
                                                 width="100" 
                                                 height="100" 
                                                 onclick="showImage(this)" 
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/default.jpg') }}'">
                                        </td>
                                        <td>
                                          <span class="badge {{ $mariage->etat == 'en attente' ? 'badge-opacity-warning' : ($mariage->etat == 'réçu' ?  'badge-opacity-success' : 'badge-opacity-danger') }}">
                                              {{ $mariage->etat }}
                                          </span>
                                      </td>
                                        <td>{{ $mariage->agent ? $mariage->agent->name . ' ' . $mariage->agent->prenom : 'Non attribué' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Aucune déclaration trouvée</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tableau 2 -->
                    <div class="tab-pane fade" id="table2" role="tabpanel" aria-labelledby="table2-tab">
                        <div class="table-responsive">
                            <table class="table select-table">
                                <thead class="bg-navbar text-white">
                                    <tr style="font-size: 12px">
                                        <th class="text-center">Nom du demandeur</th>
                                        <th class="text-center">Nom de l'Époux</th>
                                        <th class="text-center">Prénom de l'Époux</th>
                                        <th class="text-center">Date de Naissance</th>
                                        <th class="text-center">Lieu de Naissance</th>
                                        <th class="text-center">Pièce d'Identité</th>
                                        <th class="text-center">Extrait de Mariage</th>
                                        <th class="text-center">Etat Actuel</th>
                                        <th class="text-center">Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mariagesComplets as $mariage)
                                    <tr class="text-center" style="font-size: 12px">
                                        <td >{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
                                        <td>{{ $mariage->nomEpoux }}</td>
                                        <td>{{ $mariage->prenomEpoux }}</td>
                                        <td>{{ $mariage->dateNaissanceEpoux }}</td>
                                        <td>{{ $mariage->lieuNaissanceEpoux }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $mariage->pieceIdentite) }}" 
                                                 alt="Pièce d'identité" 
                                                 width="100" 
                                                 height="100" 
                                                 onclick="showImage(this)" 
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/default.jpg') }}'">
                                        </td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $mariage->extraitMariage) }}" 
                                                 alt="Extrait de mariage" 
                                                 width="100" 
                                                 height="100" 
                                                 onclick="showImage(this)" 
                                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/default.jpg') }}'">
                                        </td>
                                        <td>
                                          <span class="badge {{ $mariage->etat == 'en attente' ? 'badge-opacity-warning' : ($mariage->etat == 'réçu' ?  'badge-opacity-success' : 'badge-opacity-danger') }}">
                                              {{ $mariage->etat }}
                                          </span>
                                        </td>
                                        <td>{{ $mariage->agent ? $mariage->agent->name . ' ' . $mariage->agent->prenom : 'Non attribué' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Aucune déclaration trouvée</td>
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

<script>
    function showImage(imageElement) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageElement.src.includes('default.jpg') ? imageElement.src : imageElement.src;
    }
</script>
@endsection
