@extends('utilisateur.layouts.template')

@section('content')

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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

    button {
        border: none;
        background: none;
        cursor: pointer;
        font-size: 16px;
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
</style>

<div class="row flex-grow form-background">
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
                        <button class="nav-link" id="table2-tab" data-bs-toggle="tab" data-bs-target="#table2" type="button" role="tab" aria-controls="table2" aria-selected="false">Demande de copie intégrale</button>
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
                                        <th class="text-center">Supprimer</th>
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
                                        <td>
                                            <button style="margin-left:30px" onclick="confirmDelete('{{ route('mariage.delete', $mariage->id) }}')" class="btn btn-danger btn-sm">Supprimer</button>
                                       </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucune déclaration trouvée</td>
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
                                        <th class="text-center">Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mariagesComplets as $mariage)
                                    <tr class="text-center" style="font-size: 12px">
                                        <td>{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
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
                                        <td>
                                            <button style="margin-left:30px" onclick="confirmDelete('{{ route('mariage.delete', $mariage->id) }}')" class="btn btn-danger btn-sm">Supprimer</button>
                                        </td>
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