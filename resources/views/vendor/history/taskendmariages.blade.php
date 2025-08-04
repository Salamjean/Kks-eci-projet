@extends('vendor.layouts.template')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  :root {
    --primary-color: #6777ef;
    --secondary-color: #6777ef;;
    --success-color: #2ecc71;
    --warning-color: #f39c12;
    --danger-color: #e74c3c;
    --light-color: #ecf0f1;
    --dark-color: #34495e;
    --border-radius: 8px;
    --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
    --maroon-color: #9ca6ec;;
    --gold-color: black;
  }

  body {
    background-color: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .card {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    transition: var(--transition);
    margin-bottom: 25px;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  }

  .card-header {
    background-color: var(--secondary-color);
    color: white;
    border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
    padding: 15px 20px;
    font-weight: 600;
  }

  .table-responsive {
    border-radius: var(--border-radius);
    overflow: hidden;
  }

  .table {
    margin-bottom: 0;
  }

  .table thead th {
    background-color: var(--maroon-color);
    color: white;
    font-weight: 600;
    border: none;
    padding: 12px 15px;
    vertical-align: middle;
  }

  .table tbody tr {
    transition: var(--transition);
  }

  .table tbody tr:hover {
    background-color: rgba(128, 0, 0, 0.05);
  }

  .table tbody td {
    padding: 12px 15px;
    vertical-align: middle;
    border-top: 1px solid #e9ecef;
  }

  .status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    display: inline-block;
    min-width: 100px;
    text-align: center;
  }

  .status-en-attente {
    background-color: var(--warning-color);
    color: white;
  }

  .status-validee {
    background-color: var(--success-color);
    color: white;
  }

  .status-refusee {
    background-color: var(--danger-color);
    color: white;
  }

  .search-box {
    position: relative;
    margin-bottom: 20px;
    max-width: 300px;
  }

  .search-box input {
    padding-left: 40px;
    border-radius: 20px;
    border: 1px solid #ddd;
    box-shadow: none;
  }

  .search-box i {
    position: absolute;
    left: 15px;
    top: 10px;
    color: #aaa;
  }

  .img-thumbnail {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 4px;
    cursor: pointer;
    transition: var(--transition);
    border: 1px solid #ddd;
  }

  .img-thumbnail:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .pdf-icon {
    width: 30px;
    height: 30px;
    cursor: pointer;
  }

  .breadcrumb {
    background-color: transparent;
    padding: 0;
    font-size: 14px;
  }

  .breadcrumb-item a {
    color: var(--maroon-color);
    text-decoration: none;
  }

  .breadcrumb-item.active {
    color: var(--secondary-color);
  }

  .page-title {
    color: var(--secondary-color);
    font-weight: 700;
    margin-bottom: 20px;
  }

  .modal-content {
    border-radius: var(--border-radius);
    border: none;
  }

  .modal-header {
    background-color: var(--maroon-color);
    color: white;
    border-radius: var(--border-radius) var(--border-radius) 0 0;
  }

  .modal-body img {
    max-height: 70vh;
    width: auto;
    margin: 0 auto;
    display: block;
  }

  .empty-state {
    text-align: center;
    padding: 40px 0;
    color: #7f8c8d;
  }

  .empty-state i {
    font-size: 50px;
    margin-bottom: 15px;
    color: #bdc3c7;
  }

  .badge-agent {
    background-color: var(--secondary-color);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
  }

  .document-container {
    position: relative;
    width: 60px;
    height: 60px;
    margin: 0 auto;
  }

  .document-placeholder {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 12px;
    color: gray;
    text-align: center;
    width: 100%;
  }

  .copy-simple {
    color: var(--gold-color);
    font-weight: 600;
  }

  @media (max-width: 768px) {
    .table-responsive {
      border: 1px solid #ddd;
    }
    
    .table thead {
      display: none;
    }
    
    .table tbody tr {
      display: block;
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: var(--border-radius);
    }
    
    .table tbody td {
      display: block;
      text-align: right;
      padding-left: 50%;
      position: relative;
      border-top: 1px solid #e9ecef;
    }
    
    .table tbody td::before {
      content: attr(data-label);
      position: absolute;
      left: 15px;
      width: 45%;
      padding-right: 10px;
      font-weight: 600;
      text-align: left;
      color: var(--secondary-color);
    }
    
    .img-thumbnail {
      float: right;
    }
  }
</style>

<div class="container-fluid">
  <!-- Notifications SweetAlert -->
  <div class="row" style="width:100%; justify-content:center">
    @if (Session::get('success1'))
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Suppression réussie',
          text: '{{ Session::get('success1') }}',
          showConfirmButton: true,
          confirmButtonText: 'OK',
          customClass: {
            popup: 'custom-swal-popup'
          }
        });
      </script>
    @endif

    @if (Session::get('success'))
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Action réussie',
          text: '{{ Session::get('success') }}',
          showConfirmButton: true,
          confirmButtonText: 'OK',
          customClass: {
            popup: 'custom-swal-popup'
          }
        });
      </script>
    @endif

    @if (Session::get('error'))
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Erreur',
          text: '{{ Session::get('error') }}',
          showConfirmButton: true,
          confirmButtonText: 'OK',
          customClass: {
            popup: 'custom-swal-popup'
          }
        });
      </script>
    @endif
  </div>

  <!-- En-tête de page -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="page-title"><i class="fas fa-ring me-2"></i>Liste des demandes d'extraits de Mariage</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i class="fas fa-home"></i> Accueil</a></li>
      <li class="breadcrumb-item active">Mariages</li>
    </ol>
  </div>

  <!-- Tableau des demandes -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold"><i class="fas fa-file-contract me-2"></i>Demandes d'acte de mariage</h6>
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center" id="dataTable">
            <thead>
              <tr class="text-center">
                <th>Demandeur</th>
                <th>Nom époux</th>
                <th>Prénom époux</th>
                <th>Date naissance</th>
                <th>Lieu naissance</th>
                <th>Pièce identité</th>
                <th>Extrait mariage</th>
                <th>État</th>
                <th>Agent</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($taskendmariages as $mariage)
                <tr class="text-center">
                  <td>{{ $mariage->user ? $mariage->user->name : 'Inconnu' }}</td>
                  <td>
                    @if($mariage->nomEpoux)
                      {{ $mariage->nomEpoux }}
                    @else
                      <span class="copy-simple">Copie Simple</span>
                    @endif
                  </td>
                  <td>
                    @if($mariage->prenomEpoux)
                      {{ $mariage->prenomEpoux }}
                    @else
                      <span class="copy-simple">Copie Simple</span>
                    @endif
                  </td>
                  <td>
                    @if($mariage->dateNaissanceEpoux)
                      {{ $mariage->dateNaissanceEpoux }}
                    @else
                      <span class="copy-simple">Copie Simple</span>
                    @endif
                  </td>
                  <td>
                    @if($mariage->lieuNaissanceEpoux)
                      {{ $mariage->lieuNaissanceEpoux }}
                    @else
                      <span class="copy-simple">Copie Simple</span>
                    @endif
                  </td>
                  <td>
                    @if($mariage->pieceIdentite)
                      @php
                        $pieceIdentitePath = asset('storage/' . $mariage->pieceIdentite);
                        $isPieceIdentitePdf = strtolower(pathinfo($pieceIdentitePath, PATHINFO_EXTENSION)) === 'pdf';
                      @endphp
                      @if ($isPieceIdentitePdf)
                        <a href="{{ $pieceIdentitePath }}" target="_blank">
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" class="pdf-icon" alt="PDF">
                        </a>
                      @else
                        <div class="document-container">
                          <img src="{{ $pieceIdentitePath }}" 
                            class="img-thumbnail"
                            data-bs-toggle="modal" 
                            data-bs-target="#imageModal" 
                            onclick="showImage(this)" 
                            onerror="this.style.display='none'; document.getElementById('placeholder1-{{ $loop->index }}').style.display='block';">
                          <span id="placeholder1-{{ $loop->index }}" class="document-placeholder" style="display: none;">Aucun fichier</span>
                        </div>
                      @endif
                    @else
                      <span class="text-muted">N/A</span>
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
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" class="pdf-icon" alt="PDF">
                        </a>
                      @else
                        <div class="document-container">
                          <img src="{{ $extraitMariagePath }}" 
                            class="img-thumbnail"
                            data-bs-toggle="modal" 
                            data-bs-target="#imageModal" 
                            onclick="showImage(this)" 
                            onerror="this.style.display='none'; document.getElementById('placeholder2-{{ $loop->index }}').style.display='block';">
                          <span id="placeholder2-{{ $loop->index }}" class="document-placeholder" style="display: none;">Aucun fichier</span>
                        </div>
                      @endif
                    @else
                      <span class="text-muted">N/A</span>
                    @endif
                  </td>
                  <td>
                    <span class="status-badge status-{{ str_replace(' ', '-', strtolower($mariage->etat)) }}">
                      {{ $mariage->etat }}
                    </span>
                  </td>
                  <td>
                    @if($mariage->agent)
                      <span class="badge-agent">
                        {{ $mariage->agent->name.' '.$mariage->agent->prenom }}
                      </span>
                    @else
                      <span class="text-muted">Non attribué</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="9" class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <h5>Aucune demande de mariage trouvée</h5>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal pour l'aperçu des images -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Aperçu du document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body text-center">
        <img id="modalImage" src="{{ asset('assets/images/profiles/default.jpg') }}" alt="Document prévisualisé" class="img-fluid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Fonction pour la recherche
  document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#dataTable tbody tr');

    rows.forEach(row => {
      let match = false;
      const cells = row.querySelectorAll('td');

      const nomDemandeur = cells[0].textContent.toLowerCase();
      const nomEpoux = cells[1].textContent.toLowerCase();
      const prenomEpoux = cells[2].textContent.toLowerCase();
      const dateNaissance = cells[3].textContent.toLowerCase();
      const lieuNaissance = cells[4].textContent.toLowerCase();

      if (nomDemandeur.includes(filter) || nomEpoux.includes(filter) ||
          prenomEpoux.includes(filter) || dateNaissance.includes(filter) ||
          lieuNaissance.includes(filter)) {
           match = true;
      }
      row.style.display = match ? '' : 'none';
    });
  });

  // Fonction pour afficher l'image dans la modal
  function showImage(imageElement) {
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageElement.src;
  }

  // Adaptation pour les écrans mobiles
  function adaptForMobile() {
    if (window.innerWidth <= 768px) {
      const table = document.getElementById('dataTable');
      
      if (table) {
        const headers = [];
        const ths = table.querySelectorAll('thead th');
        
        ths.forEach(th => {
          headers.push(th.textContent.trim());
        });
        
        const rows = table.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
          const cells = row.querySelectorAll('td');
          
          cells.forEach((cell, index) => {
            if (headers[index]) {
              cell.setAttribute('data-label', headers[index]);
            }
          });
        });
      }
    }
  }

  // Exécuter au chargement et lors du redimensionnement
  window.addEventListener('load', adaptForMobile);
  window.addEventListener('resize', adaptForMobile);
</script>
@endsection