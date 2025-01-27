td@extends('vendor.agent.layouts.template')

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
                    <tr style="font-size: 12px">
                        <th>Demandeur</th>
                        <th>Hôpital</th>
                        <th>Nom Du Nouveau Né</th>
                        <th>Date De Naissance</th>
                        <th>Lieu De Naissance</th>
                        <th>Pièce Du Parent</th>
                        <th>Certificat De Déclaration</th>
                        <th>Pièce de la mère</th>
                        <th>Etat Actuel</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($naissances as $naissance)
                    <tr style="font-size: 12px">
                        <td>{{ $naissance->user ? $naissance->user->name : 'Demandeur inconnu' }}</td>
                        <td>{{ $naissance->nomHopital }}</td>
                        <td>{{ $naissance->nomDefunt }}</td>
                        <td>{{ $naissance->dateNaiss }}</td>
                        <td>{{ $naissance->lieuNaiss }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $naissance->identiteDeclarant) }}" 
                                 alt="Pièce du parent" 
                                 width="100" 
                                 height=auto
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal" 
                                 onclick="showImage(this)" 
                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $naissance->cdnaiss) }}" 
                                 alt="Certificat de déclaration" 
                                 width="100" 
                                 height=auto
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal" 
                                 onclick="showImage(this)" 
                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                        </td>
                        @if($naisshop)
                        <td>
                             <img src="{{ asset('storage/' . $naisshop->CNI_mere) }}"
                                 alt="Certificat de déclaration" 
                                 width="100" 
                                 height=auto
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal" 
                                 onclick="showImage(this)" 
                                 onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                        </td>
                       
                        @else
                            <span>Aucune image disponible</span>
                        @endif

                        <td class="{{ $naissance->etat == 'en attente' ? 'bg-warning' : ($naissance->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm" style="margin-top: 8px">
                            {{ $naissance->etat }}
                        </td>
                        <td>
                            <a href="{{ route('naissances.edit', $naissance->id) }}" class="btn btn-sm" style="size: 0.6rem">Mettre à jour l'état</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Aucune demande effectuée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($naissancesD as $naissanceD)
                                <tr style="font-size: 12px">
                                    <td>{{ $naissanceD->user ? $naissanceD->user->name .' '.$naissanceD->user->prenom : 'Demandeur inconnu' }}</td>
                                    <td>{{ $naissanceD->type }}</td>
                                    <td>{{ $naissanceD->name.' '.$naissanceD->prenom .' '.'('.($naissanceD->pour).')'}}</td>
                                    <td>{{ $naissanceD->number }}</td>
                                    <td>{{ $naissanceD->DateR }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $naissanceD->CNI) }}" 
                                        alt="Certificat de déclaration" 
                                        width="100" 
                                        height=auto
                                        data-bs-toggle="modal" 
                                        data-bs-target="#imageModal" 
                                        onclick="showImage(this)" 
                                        onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                    </td>
                                    <td class="{{ $naissanceD->etat == 'en attente' ? 'bg-warning' : ($naissanceD->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm" style="margin-top: 8px">
                                        {{ $naissanceD->etat }}
                                    </td>
                                    <td>
                                        <a href="{{ route('naissanced.edit', $naissanceD->id) }}" class="btn btn-sm" style="size: 0.6rem">Mettre à jour l'état</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucune demande effectuée</td>
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