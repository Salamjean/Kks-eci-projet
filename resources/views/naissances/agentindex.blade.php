@extends('vendor.agent.layouts.template')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<style>
  .etat-en-attente {
    background-color: orange;
    color: black;
}

.etat-validee {
    background-color: green;
    color: white;
}

.etat-refusee {
    background-color: red;
    color: white;
}
.btn{
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
      <h1 class="h3 mb-0 text-gray-800">Listes des demandes d'extrait de Naissance</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Accueil</a></li>
        <li class="breadcrumb-item">Listes </li>
      </ol>
    </div>

    <!-- Row -->
    <div class="row">
      <!-- Datatables -->
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Les extraits demandés avec certificat</h6>
          </div>
          <div class="table-responsive p-3">
            <!-- Champ de recherche -->
            <input type="text" id="searchInput" class="form-control mb-3" placeholder="Rechercher...">
        
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="bg-navbar text-white">
                    <tr style="font-size: 12px" class="text-center">
                        <th>Demandeur</th>
                        <th>Hôpital</th>
                        <th>Nom Du Nouveau Né</th>
                        <th>Date De Naissance Né</th>
                        <th>Nom-mère</th>
                        <th>Nom-père</th>
                        <th>Date-père</th>
                        <th>Pièce-père</th>
                        <th>CMN</th>
                        <th>Pièce-mère</th>
                        <th>Etat Actuel</th>
                        <th>Modifier l'etat</th>
                        <th>Mode de rétrait</th>
                        <th>Annuler</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($naissances as $naissance)
                    <tr style="font-size: 12px" class="text-center">
                        <td>
                          @if($naissance->user)
                              <a href="#" data-bs-toggle="modal" data-bs-target="#userModal" onclick="showUserModal({{ json_encode($naissance->user) }})">
                                  {{ $naissance->user->name.' '.$naissance->user->prenom }}
                              </a>
                             @else
                                 Demandeur inconnu
                           @endif
                          </td>
                        <td>{{ $naissance->nomHopital }}</td>
                        <td>{{ $naissance->nom .' '.$naissance->prenom }}</td>
                        <td>{{ $naissance->lieuNaiss }}</td>
                        <td>{{ $naissance->nomDefunt }}</td>
                        <td>{{ $naissance->nompere.' '.$naissance->prenompere }}</td>
                        <td>{{ $naissance->datepere}}</td>
                        <td>
                            @if($naissance->identiteDeclarant)
                                @php
                                    $identiteDeclarantPath = asset('storage/' . $naissance->identiteDeclarant);
                                    $isIdentiteDeclarantPdf = strtolower(pathinfo($identiteDeclarantPath, PATHINFO_EXTENSION)) === 'pdf';
                                @endphp
                                @if ($isIdentiteDeclarantPdf)
                                    <a href="{{ $identiteDeclarantPath }}" target="_blank">
                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                    </a>
                                @else
                                    <img src="{{ $identiteDeclarantPath }}" 
                                        alt="Pièce du parent" 
                                        width="50" 
                                        height=50
                                        data-bs-toggle="modal" 
                                        data-bs-target="#imageModal" 
                                        onclick="showImage(this)" 
                                        onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                @endif
                            @else
                                <p>Non disponible</p>
                            @endif
                        </td>
                         <td>
                            @if($naissance->cdnaiss)
                                @php
                                    $cdnaissPath = asset('storage/' . $naissance->cdnaiss);
                                    $isCdnaissPdf = strtolower(pathinfo($cdnaissPath, PATHINFO_EXTENSION)) === 'pdf';
                                @endphp
                                @if ($isCdnaissPdf)
                                    <a href="{{ $cdnaissPath }}" target="_blank">
                                       <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                    </a>
                                @else
                                    <img src="{{ $cdnaissPath }}" 
                                        alt="Certificat de déclaration" 
                                        width="50" 
                                        height=50
                                        data-bs-toggle="modal" 
                                        data-bs-target="#imageModal" 
                                        onclick="showImage(this)" 
                                        onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                @endif
                            @else
                                <p>Non disponible</p>
                            @endif
                        </td>
                        
                        @if($naisshop && $naisshop->CNI_mere)
                            @php
                                $cniMerePath = asset('storage/' . $naisshop->CNI_mere);
                                $isCniMerePdf = strtolower(pathinfo($cniMerePath, PATHINFO_EXTENSION)) === 'pdf';
                            @endphp
                            <td>
                                @if ($isCniMerePdf)
                                    <a href="{{ $cniMerePath }}" target="_blank">
                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                    </a>
                                @else
                                    <img src="{{ $cniMerePath }}"
                                        alt="Certificat de déclaration" 
                                        width="50" 
                                        height=50
                                        data-bs-toggle="modal" 
                                        data-bs-target="#imageModal" 
                                        onclick="showImage(this)" 
                                        onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                @endif
                            </td>
                        @else
                             <td><span>Aucune image disponible</span></td>
                        @endif
                         
                        <td class="{{ $naissance->etat == 'en attente' ? 'bg-warning' : ($naissance->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm" style="margin-top: 8px">
                            {{ $naissance->etat }}
                        </td>
                        <td>
                            <a href="{{ route('naissances.edit', $naissance->id) }}" class="btn btn-sm" style="size: 0.6rem">Modifier</a>
                        </td>
                        <td>
                            @if($naissance->choix_option == 'livraison')
                                <a href="#" data-bs-toggle="modal" data-bs-target="#livraisonModal" onclick="showLivraison1Modal({{ json_encode($naissance) }})">
                                    <div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $naissance->choix_option }}</div>
                                </a>
                            @else
                                <div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $naissance->choix_option }}</div>
                            @endif
                        </td>                       
                        <td>
                            <button type="button" class="btn btn-sm btn-danger" style="size: 0.6rem" data-bs-toggle="modal" data-bs-target="#annulationModal" data-demande-id="{{ $naissance->id }}">Annuler</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="14" class="text-center">Aucune demande effectuée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="annulationModal" tabindex="-1" aria-labelledby="annulationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="annulationModalLabel">Motif d'annulation de la demande</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <form id="annulationForm" method="POST" action="{{ route('annuler.demande', 'demandeId') }}">
                            @csrf
                            @method('post') {{-- Ou vous pouvez utiliser POST si vous préférez --}}
                            <input type="hidden" name="demande_id" id="demande_id_input" value=""> {{-- Input caché pour stocker l'ID de la demande --}}
        
                            <div class="mb-3">
                                <label for="motif_annulation" class="form-label">Motif d'annulation:</label>
                                <select class="form-select" id="motif_annulation" name="motif_annulation" required>
                                    <option value="" selected disabled>Sélectionner un motif</option>
                                    <option value="Une erreur du demandeur">Erreur de la part du demandeur</option>
                                    <option value="Document Incomplet ou Incorret">Document incomplet ou incorrect</option>
                                    <option value="Demande dupliquée">Demande dupliquée</option>
                                    <option value="autre">Autre motif (à préciser)</option>
                                </select>
                            </div>
                            <div class="mb-3" id="autreMotifDiv" style="display: none;">
                                <label for="autre_motif_text" class="form-label">Précisez le motif:</label>
                                <textarea class="form-control" id="autre_motif_text" name="autre_motif_text" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-danger" onclick="submitAnnulationForm()">Annuler la demande</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const annulationModal = document.getElementById('annulationModal');
                annulationModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const demandeId = button.getAttribute('data-demande-id');
                    document.getElementById('demande_id_input').value = demandeId; // Définir l'ID de la demande dans l'input caché
        
                    // Mettre à jour l'action du formulaire avec l'ID de la demande correct (le placeholder sera remplacé)
                    let formAction = "{{ route('annuler.demande', 'demandeId') }}";
                    formAction = formAction.replace('demandeId', demandeId);
                    document.getElementById('annulationForm').action = formAction;
                });
        
                const motifSelect = document.getElementById('motif_annulation');
                const autreMotifDiv = document.getElementById('autreMotifDiv');
        
                motifSelect.addEventListener('change', function() {
                    if (this.value === 'autre') {
                        autreMotifDiv.style.display = 'block';
                        document.getElementById('autre_motif_text').setAttribute('required', 'required'); // Rendre le textarea 'autre motif' obligatoire
                    } else {
                        autreMotifDiv.style.display = 'none';
                        document.getElementById('autre_motif_text').removeAttribute('required'); // Retirer l'attribut 'required' si ce n'est pas 'autre'
                    }
                });
            });
        
            function submitAnnulationForm() {
                document.getElementById('annulationForm').submit();
            }
        </script>
        
        <script>
            document.getElementById('searchInput').addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('#dataTable tbody tr');
        
                rows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const match = Array.from(cells).some(cell => 
                        cell.textContent.toLowerCase().includes(filter)
                    );
                    row.style.display = match ? '' : 'none';
                });
            });
        </script>
               
                
                <!-- Modal -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageModalLabel">Aperçu de l'image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="modalImage" src="{{ asset('assets/images/profiles/bébé.jpg') }}" alt="Image prévisualisée" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                
                
              </tbody>
          </table>
          
          </div>
        </div>
      </div>

    <div class="row">
      <!-- Datatables -->
      <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Les extraits demandés</h6>
                </div>
                <div class="table-responsive p-3">
                    <!-- Champ de recherche -->
                    
    
                    <table class="table text-center align-items-center table-flush" id="dataTable">
                        <thead class="bg-navbar text-white">
                            <tr style="font-size: 12px">
                                <th>Demandeur</th>
                                <th>Type de copie</th>
                                <th>Nom sur l'extrait</th>
                                <th>Numéro de régistre</th>
                                <th>Date de régistre</th>
                                <th>CNI-Demandeur</th>
                                <th>Etat Actuel</th>
                                <th>Action</th>
                                <th>Mode de rétrait</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($naissancesD as $naissanceD)
                                <tr style="font-size: 12px">
                                    <td>
                                      @if($naissanceD->user)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#userModal" onclick="showUserModal({{ json_encode($naissanceD->user) }})">
                                           {{ $naissanceD->user->name .' '.$naissanceD->user->prenom }}
                                        </a>
                                      @else
                                          Demandeur inconnu
                                      @endif
                                    </td>
                                    <td>{{ $naissanceD->type }}</td>
                                    <td>{{ $naissanceD->name.' '.$naissanceD->prenom .' '.'('.($naissanceD->pour).')'}}</td>
                                    <td>{{ $naissanceD->number }}</td>
                                    <td>{{ $naissanceD->DateR }}</td>
                                    <td>
                                         @if($naissanceD->CNI)
                                            @php
                                                $CNIPath = asset('storage/' . $naissanceD->CNI);
                                                $isCNIPdf = strtolower(pathinfo($CNIPath, PATHINFO_EXTENSION)) === 'pdf';
                                            @endphp
                                            @if ($isCNIPdf)
                                                <a href="{{ $CNIPath }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                </a>
                                            @else
                                                <img src="{{ $CNIPath }}"
                                                     alt="Certificat de déclaration" 
                                                     width="100" 
                                                     height=auto
                                                     data-bs-toggle="modal" 
                                                     data-bs-target="#imageModal" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        @else
                                            <p>Non disponible</p>
                                        @endif
                                    </td>
                                    <td class="{{ $naissanceD->etat == 'en attente' ? 'bg-warning' : ($naissanceD->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm" style="margin-top: 8px">
                                        {{ $naissanceD->etat }}
                                    </td>
                                    <td>
                                        <a href="{{ route('naissanced.edit', $naissanceD->id) }}" class="btn btn-sm" style="size: 0.6rem">Mettre à jour l'état</a>
                                    </td>
                                    <td>
                                        @if($naissanceD->choix_option == 'livraison')
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#livraisonModal" onclick="showLivraisonModal({{ json_encode($naissanceD) }})">
                                                <div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $naissanceD->choix_option }}</div>
                                            </a>
                                        @else
                                            <div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $naissanceD->choix_option }}</div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Aucune demande effectuée</td>
                                </tr>
                            @endforelse
                        </tbody>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#dataTable tbody tr');
    
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const match = Array.from(cells).some(cell => 
                    cell.textContent.toLowerCase().includes(filter)
                );
                row.style.display = match ? '' : 'none';
            });
        });
    </script>

    <!-- Modal pour les informations de livraison -->
<div class="modal fade" id="livraisonModal" tabindex="-1" aria-labelledby="livraisonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #6777ef; color:white; text-align:center">
                <h5 class="modal-title" style="text-align: center" id="livraisonModalLabel">Informations de livraison</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="livraisonDetails"></div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal pour les informations de l'utilisateur -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #6777ef; color:white; text-align:center">
              <h5 class="modal-title" style="text-align: center" id="userModalLabel">Informations du demandeur</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="userDetails"></div>
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

  function showUserModal(user) {
    const userDetailsDiv = document.getElementById('userDetails');
    userDetailsDiv.innerHTML = `
        <p style="text-align:center"><strong>Nom:</strong> ${user.name}</p>
        <p style="text-align:center"><strong>Prénom(s):</strong> ${user.prenom}</p>
        <p style="text-align:center"><strong>Email:</strong> ${user.email}</p>
        <p style="text-align:center"><strong>Contact:</strong> ${user.contact}</p>
        <p style="text-align:center"><strong>Commune:</strong> ${user.commune}</p>
        <p style="text-align:center"><strong>N°CMU:</strong> ${user.CMU}</p>
    `;
  }

  function showLivraisonModal(naissanceD) {
    const livraisonDetailsDiv = document.getElementById('livraisonDetails');
    livraisonDetailsDiv.innerHTML = `
        <p style="text-align:center"><strong>Nom et prénoms du destinataire:</strong> ${naissanceD.nom_destinataire} ${naissanceD.prenom_destinataire}</p>
        <p style="text-align:center"><strong>Email du destinataire:</strong> ${naissanceD.email_destinataire}</p>
        <p style="text-align:center"><strong>Contact du destinataire:</strong> ${naissanceD.contact_destinataire}</p>
        <p style="text-align:center"><strong>Adresse de livraison:</strong> ${naissanceD.adresse_livraison}</p>
        <p style="text-align:center"><strong>Ville:</strong> ${naissanceD.ville}</p>
        <p style="text-align:center"><strong>Commune:</strong> ${naissanceD.commune}</p>
        <p style="text-align:center"><strong>Quartier:</strong> ${naissanceD.quartier}</p>
        <p style="text-align:center"><strong>Code postal:</strong> ${naissanceD.code_postal}</p>
        <p style="text-align:center"><strong>Choisissez un livreur </strong> <a href="{{ route('agent.livraison') }}">maintenant</a> </p>
    `;
  }

  function showLivraison1Modal(naissance) {
    const livraisonDetailsDiv = document.getElementById('livraisonDetails');
    livraisonDetailsDiv.innerHTML = `
        <p style="text-align:center"><strong>Nom et prénoms du destinataire:</strong> ${naissance.nom_destinataire} ${naissance.prenom_destinataire}</p>
        <p style="text-align:center"><strong>Email du destinataire:</strong> ${naissance.email_destinataire}</p>
        <p style="text-align:center"><strong>Contact du destinataire:</strong> ${naissance.contact_destinataire}</p>
        <p style="text-align:center"><strong>Adresse de livraison:</strong> ${naissance.adresse_livraison}</p>
        <p style="text-align:center"><strong>Ville:</strong> ${naissance.ville}</p>
        <p style="text-align:center"><strong>Commune:</strong> ${naissance.commune}</p>
        <p style="text-align:center"><strong>Quartier:</strong> ${naissance.quartier}</p>
        <p style="text-align:center"><strong>Code postal:</strong> ${naissance.code_postal}</p>
        <p style="text-align:center"><strong>Choisissez un livreur </strong> <a href="{{ route('agent.livraison') }}">maintenant</a> </p>
    `;
  }
</script>