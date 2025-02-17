@extends('vendor.agent.layouts.template')

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
    </style>
     <!-- Insertion de SweetAlert2 -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <div class="row" style="width:100%; justify-content:center">
  <div class="row" style="width:100%; justify-content:center">
      @if (Session::get('success1')) <!-- Pour la suppression -->
          <script>
              Swal.fire({
                  icon: 'success',
                  title: 'Suppression réussie',
                  text: '{{ Session::get('success1') }}',
                  showConfirmButton: true,  // Afficher le bouton OK
                  confirmButtonText: 'OK',  // Texte du bouton
                  background: '#ffcccc',   // Couleur de fond personnalisée
                  color: '#b30000'          // Texte rouge foncé
              });
          </script>
      @endif
  
      @if (Session::get('success')) <!-- Pour la modification -->
          <script>
              Swal.fire({
                  icon: 'success',
                  title: 'Action réussie',
                  text: '{{ Session::get('success') }}',
                  showConfirmButton: true,  // Afficher le bouton OK
                  confirmButtonText: 'OK',  // Texte du bouton
                  background: '#ccffcc',   // Couleur de fond personnalisée
                  color: '#006600'          // Texte vert foncé
              });
          </script>
      @endif
  
      @if (Session::get('error')) <!-- Pour une erreur générale -->
          <script>
              Swal.fire({
                  icon: 'error',
                  title: 'Erreur',
                  text: '{{ Session::get('error') }}',
                  showConfirmButton: true,  // Afficher le bouton OK
                  confirmButtonText: 'OK',  // Texte du bouton
                  background: '#f86750',    // Couleur de fond rouge vif
                  color: '#ffffff'          // Texte blanc
              });
          </script>
      @endif
  </div>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listes des demandes d'extraits de Mariage</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Accueil</a></li>
                <li class="breadcrumb-item">Tables</li>
            </ol>
        </div>

        <!--  Tableau de mariages combiné -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Demandes d'Extraits de Mariage</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <!-- Champ de recherche -->
                        <div class="input-group mb-3">
                            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                        </div>
                        
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="bg-navbar text-white">
                                <tr style="font-size: 12px">
                                    <th class="text-center">Demandeur</th>
                                    <th class="text-center">Nom du conjoint(e)</th>
                                    <th class="text-center">Prénoms du conjoint(e)</th>
                                    <th class="text-center">Date de Naissance du conjoint(e)</th>
                                    <th class="text-center">Lieu de Naissance du conjoint(e)</th>
                                    <th class="text-center">Pièce d'Identité du conjoint(e)</th>
                                    <th class="text-center">Extrait de Mariage</th>
                                    <th>Etat Actuel</th>
                                    <th class="text-center">Action</th>
                                    <th class="text-center">Mode de rétrait</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mariages as $mariage)
                                    <tr class="text-center" style="font-size: 12px">
                                        <td>
                                         @if($mariage->user)
                                             <a href="#" data-bs-toggle="modal" data-bs-target="#userModal" onclick="showUserModal({{ json_encode($mariage->user) }})">
                                                {{ $mariage->user->name .' '. $mariage->user->prenom}}
                                             </a>
                                         @else
                                          Demandeur inconnu
                                         @endif
                                         </td>
                                          <td>{{ $mariage->nomEpoux ? $mariage->nomEpoux :'Copie-simple'}}</td>
                                        <td>{{ $mariage->prenomEpoux  ? $mariage->prenomEpoux:'Copie-simple' }}</td>
                                        <td>{{ $mariage->dateNaissanceEpoux  ? $mariage->dateNaissanceEpoux :'Copie-simple' }}</td>
                                        <td>{{ $mariage->lieuNaissanceEpoux  ? $mariage->lieuNaissanceEpoux:'Copie-simple'}}</td>
                                        <td>
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
                                        <td>
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
                                        <td>
                                            <a href="{{ route('mariage.edit', $mariage->id) }}" class="btn btn-sm" style="size: 0.6rem">Mettre à jour l'état</a>
                                        </td>
                                        <td ><div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $mariage->choix_option }}</div></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Aucune déclaration trouvée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $mariages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour afficher les images -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Aperçu de l'image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="{{ asset('assets/images/profiles/default.jpg') }}" alt="Image prévisualisée" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
     <!-- Modal pour les informations de l'utilisateur -->
     <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #6777ef; color:white; text-align:center">
              <h5 class="modal-title" id="userModalLabel">Informations du demandeur</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="userDetails"></div>
            </div>
          </div>
        </div>
      </div>
    <script>
        function showImage(imageElement) {
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageElement.src;
        }
         document.getElementById('searchInput').addEventListener('keyup', function() {
             const filter = this.value.toLowerCase();
             const rows = document.querySelectorAll('#dataTable tbody tr');
     
             rows.forEach(row => {
                 let match = false;
                 const cells = row.querySelectorAll('td');
                
                     const nomEpoux = cells[1].textContent.toLowerCase();
                     const nomEpouse = cells[1].textContent.toLowerCase();
                     const prenomEpoux = cells[2].textContent.toLowerCase();
                     const prenomEpouse = cells[2].textContent.toLowerCase();
                     const lieuNaissance = cells[4].textContent.toLowerCase();
                 if (nomEpoux.includes(filter) || nomEpouse.includes(filter) ||
                     prenomEpoux.includes(filter) || prenomEpouse.includes(filter) ||
                     lieuNaissance.includes(filter))
                 {
                            match = true;
                 }
                 row.style.display = match ? '' : 'none';
             });
         });
         function showUserModal(user) {
             const userDetailsDiv = document.getElementById('userDetails');
              userDetailsDiv.innerHTML = `
                    <p style="text-align:center"><strong>Nom:</strong> ${user.name}</p>
                    <p style="text-align:center"><strong>Prénom(s):</strong> ${user.prenom}</p>
                    <p style="text-align:center"><strong>Email:</strong> ${user.email}</p>
                    <p style="text-align:center"><strong>Commune:</strong> ${user.commune}</p>
                    <p style="text-align:center"><strong>N°CMU:</strong> ${user.CMU}</p>
                `;
           }
    </script>
@endsection