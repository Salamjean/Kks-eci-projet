@extends('vendor.ajoint.layouts.template')

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
  .btn{
    background-color: rgb(199, 195, 195);
  }
  
  </style>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Listes des demandes d'extraits de Mariage</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Accueil</a></li>
            <li class="breadcrumb-item">Tables</li>
        </ol>
    </div>

   

    <!-- Mariages avec fichiers seulement (champ manquants) -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Demande De Copie Simples</h6>
                </div>
                <div class="table-responsive p-3">
                    <!-- Champ de recherche -->
                    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Rechercher...">
                
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="bg-navbar text-white">
                            <tr style="font-size: 12px">
                                <th class="text-center">Nom du demandeur</th>
                                <th class="text-center">Nom du conjoint(e)</th>
                                <th class="text-center">Pièce d'Identité</th>
                                <th class="text-center">Extrait de Mariage</th>
                                <th>Etat Actuel</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mariagesAvecFichiersSeulement as $mariage)
                            <tr style="font-size: 12px">
                                <td>{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
                                <td class="text-center">{{ $mariage->nomEpoux }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $mariage->pieceIdentite) }}" 
                                         alt="Pièce d'identité" 
                                         width="100" 
                                         height="100" 
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal" 
                                         onclick="showImage(this)" 
                                         onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/default.jpg') }}'">
                                </td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $mariage->extraitMariage) }}" 
                                         alt="Extrait de mariage" 
                                         width="100" 
                                         height="100" 
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal" 
                                         onclick="showImage(this)" 
                                         onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/default.jpg') }}'">
                                </td>
                                <td class="{{ $mariage->etat == 'en attente' ? 'bg-warning' : ($mariage->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm" style="margin-top: 8px">
                                    {{ $mariage->etat }}
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
            </div>
        </div>
    </div>

    <!-- Mariages complets (tous les champs remplis) -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Demande De Copie Intégrale</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="bg-navbar text-white">
                            <tr  style="font-size: 12px">
                                <th class="text-center">Nom de l'Époux</th>
                                <th class="text-center">Prénom de l'Époux</th>
                                <th class="text-center">Date de Naissance</th>
                                <th class="text-center">Lieu de Naissance</th>
                                <th class="text-center">Pièce d'Identité</th>
                                <th class="text-center">Extrait de Mariage</th>
                                <th>Etat Actuel</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mariagesComplets as $mariage)
                            <tr class="text-center" style="font-size: 12px">
                                <td>{{ $mariage->nomEpoux }}</td>
                                <td>{{ $mariage->prenomEpoux }}</td>
                                <td>{{ $mariage->dateNaissanceEpoux }}</td>
                                <td>{{ $mariage->lieuNaissanceEpoux }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $mariage->pieceIdentite) }}" 
                                         alt="Pièce d'identité" 
                                         width="100" 
                                         height="100" 
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal" 
                                         onclick="showImage(this)" 
                                         onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/default.jpg') }}'">
                                </td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $mariage->extraitMariage) }}" 
                                         alt="Extrait de mariage" 
                                         width="100" 
                                         height="100" 
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal" 
                                         onclick="showImage(this)" 
                                         onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/default.jpg') }}'">
                                </td>
                                <td class="{{ $mariage->etat == 'en attente' ? 'bg-warning' : ($mariage->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm " style="margin-top: 8px">
                                    {{ $mariage->etat }}
                                </td>
                                <td>{{ $mariage->agent ? $mariage->agent->name . ' ' . $mariage->agent->prenom : 'Non attribué' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Aucune déclaration trouvée</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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

<script>
    function showImage(imageElement) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageElement.src;
    }
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
