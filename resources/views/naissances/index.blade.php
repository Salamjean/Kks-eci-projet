@extends('vendor.layouts.template')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Listes des demandes d'extrait de Naissance</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active" aria-current="page">DataTables</li>
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
            <table class="table align-items-center table-flush" id="dataTable">
              <thead class="bg-navbar text-white">
                  <tr style="font-size: 12px">
                      <th>Hôpital</th>
                      <th>Nom Du Nouveau Né</th>
                      <th>Date De Naissance</th>
                      <th>Lieu De Naissance</th>
                      <th>Pièce Du Parent</th>
                      <th>Certificat De Déclaration</th>
                      <th>Acte De Mariage</th>
                  </tr>
              </thead>
              
              <tbody>
                @forelse ($naissances as $naissance)
                <tr style="font-size: 12px">
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
                    <td>
                      <div style="position: relative; width: 100px; height: 100px;">
                          <img src="{{ asset('storage/' . $naissance->acteMariage) }}" 
                               alt="Acte de mariage" 
                               width="100" 
                               height=auto
                               data-bs-toggle="modal" 
                               data-bs-target="#imageModal" 
                               onclick="showImage(this)" 
                               onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                          <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                              Aucun fichier
                          </span>
                      </div>
                  </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Aucune demande effectué</td>
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

    <div class="row">
      <!-- Datatables -->
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Les extraits demandés</h6>
          </div>
          <div class="table-responsive p-3">
            <table class="table text-center align-items-center table-flush" id="dataTable">
              <thead class="bg-navbar text-white">
                  <tr style="font-size: 12px">
                      <th>Pièce Du Parent</th>
                      <th>Certificat De Déclaration</th>
                  </tr>
              </thead>
              
              <tbody>
                @forelse ($naissancesD as $naissanceD)
                <tr style="font-size: 12px">
                    <td>{{ $naissanceD->name }}</td>
                    <td>{{ $naissanceD->number }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Aucune demande effectuée</td>
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