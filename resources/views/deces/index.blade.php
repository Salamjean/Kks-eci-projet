@extends('vendor.layouts.template')

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
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Liste des Déclarations de Décès</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Décès</li>
        </ol>
    </div>

    <form method="GET" action="{{ route('deces.index') }}" class="mb-4">
      <div class="row">
          <!-- Type de recherche -->
          <div class="col-md-4">
              <select id="searchType" name="searchType" class="form-control" onchange="updateInputPlaceholder()">
                  <option value="">Choisir un type de recherche</option>
                  <option value="nomDefunt" {{ request('searchType') == 'nomDefunt' ? 'selected' : '' }}>
                      Par nom du défunt
                  </option>
                  <option value="nomHopital" {{ request('searchType') == 'nomHopital' ? 'selected' : '' }}>
                      Par hôpital
                  </option>
              </select>
          </div>
  
          <!-- Champ de saisie -->
          <div class="col-md-6">
              <input type="text" id="searchInput" name="searchInput" class="form-control" 
                     placeholder="Entrez un critère de recherche" value="{{ request('searchInput') }}">
          </div>
  
          <!-- Bouton de recherche -->
          <div class="col-md-2">
              <button type="submit" class="btn btn-primary">Rechercher</button>
          </div>
      </div>
  </form>
  

    <!-- Row -->
    <div class="row">
        <!-- Datatables -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Les Décès Déclarés</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="bg-navbar text-white">
                            <tr style="font-size: 12px">
                                <th>Hôpital</th>
                                <th>Date de Décès</th>
                                <th>Nom du Défunt</th>
                                <th>Date de Naissance</th>
                                <th>Lieu de Naissance</th>
                                <th>Pièce du Déclarant</th>
                                <th>Acte de Mariage</th>
                                <th>Déclaration par la Loi</th>
                                <th>Action</th>
                                <th>Etat Actuel</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deces as $deces)
                            <tr style="font-size: 12px">
                                <td>{{ $deces->nomHopital }}</td>
                                <td>{{ $deces->dateDces }}</td>
                                <td>{{ $deces->nomDefunt }}</td>
                                <td>{{ $deces->dateNaiss }}</td>
                                <td>{{ $deces->lieuNaiss }}</td>
                                <td>
                                    <div style="position: relative; width: 100px; height: 100px;">
                                        <img src="{{ asset('storage/' . $deces->identiteDeclarant) }}" 
                                             alt="Pièce du déclarant" 
                                             width="100" 
                                             height="100" 
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal" 
                                             onclick="showImage(this)" 
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                            Aucun fichier
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div style="position: relative; width: 100px; height: 100px;">
                                        <img src="{{ asset('storage/' . $deces->acteMariage) }}" 
                                             alt="Acte de mariage" 
                                             width="100" 
                                             height="100" 
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal" 
                                             onclick="showImage(this)" 
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                            Aucun fichier
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div style="position: relative; width: 100px; height: 100px;">
                                        <img src="{{ asset('storage/' . $deces->deParLaLoi) }}" 
                                             alt="Déclaration par la loi" 
                                             width="100" 
                                             height="100" 
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal" 
                                             onclick="showImage(this)" 
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                            Aucun fichier
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('deces.edit', $deces->id) }}" class="btn btn-sm"  style="size: 0.6rem">Mettre à jour l'état </a>
                                  </td>
                                  <td class="{{ $deces->etat == 'en attente' ? 'bg-warning' : ($deces->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm " style="margin-top: 8px">
                                      {{ $deces->etat }}
                                  </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Aucune déclaration trouvée</td>
                            </tr>
                            @endforelse

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
    </div>
</div>
@endsection

<script>
function showImage(imageElement) {
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageElement.src;
}

function updateInputPlaceholder() {
    const searchType = document.getElementById('searchType').value;
    const searchInput = document.getElementById('searchInput');

    if (searchType === 'nomDefunt') {
        searchInput.placeholder = "Entrez le nom du défunt";
    } else if (searchType === 'nomHopital') {
        searchInput.placeholder = "Entrez le nom de l'hôpital";
    } else {
        searchInput.placeholder = "Entrez un critère de recherche";
    }
}

document.querySelector('form').addEventListener('submit', function(e) {
    const searchType = document.getElementById('searchType').value;
    const searchInput = document.getElementById('searchInput').value.trim();

    if (!searchType || !searchInput) {
        e.preventDefault();
        alert('Veuillez sélectionner un type de recherche et entrer un critère.');
    }
});

</script>

