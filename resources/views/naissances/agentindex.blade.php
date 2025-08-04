@extends('vendor.agent.layouts.template')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  :root {
    --primary-color: #6777ef;
    --secondary-color: #6777ef;
    --success-color: #4cc9f0;
    --danger-color: #f72585;
    --warning-color: #f8961e;
    --light-color: #f8f9fa;
    --dark-color: #212529;
    --border-radius: 8px;
    --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fb;
  }

  .card {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    transition: var(--transition);
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  }

  .card-header {
    background-color: var(--primary-color);
    color: white;
    border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
    padding: 1.25rem;
  }

  .table-responsive {
    border-radius: var(--border-radius);
    overflow: hidden;
  }

  .table {
    margin-bottom: 0;
  }

  .table thead th {
    background-color: var(--primary-color);
    color: white;
    border: none;
    font-weight: 500;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
  }

  .table tbody tr {
    transition: var(--transition);
  }

  .table tbody tr:hover {
    background-color: rgba(67, 97, 238, 0.05);
  }

  .badge {
    font-weight: 500;
    padding: 0.5em 0.75em;
    border-radius: 20px;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .badge-warning {
    background-color: var(--warning-color);
    color: white;
  }

  .badge-success {
    background-color: var(--success-color);
    color: white;
  }

  .badge-danger {
    background-color: var(--danger-color);
    color: white;
  }

  .btn {
    border-radius: var(--border-radius);
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: var(--transition);
  }

  .btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
  }

  .btn-primary:hover {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
  }

  .btn-danger {
    background-color: var(--danger-color);
    border-color: var(--danger-color);
  }

  .btn-sm {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
  }

  .search-box {
    position: relative;
    margin-bottom: 1.5rem;
  }

  .search-box input {
    padding-left: 2.5rem;
    border-radius: var(--border-radius);
    border: 1px solid #dee2e6;
  }

  .search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
  }

  .status-chip {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
  }

  .modal-content {
    border-radius: var(--border-radius);
    border: none;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  }

  .modal-header {
    background-color: var(--primary-color);
    color: white;
    border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
  }

  .modal-body p {
    margin-bottom: 0.75rem;
  }

  .modal-body strong {
    color: var(--primary-color);
  }

  .document-preview {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 4px;
    cursor: pointer;
    transition: var(--transition);
  }

  .document-preview:hover {
    transform: scale(1.05);
    box-shadow: var(--box-shadow);
  }

  .section-title {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
  }

  .section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background-color: var(--primary-color);
  }

  .nav-tabs .nav-link {
    color: var(--dark-color);
    border: none;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
  }

  .nav-tabs .nav-link.active {
    color: var(--primary-color);
    background-color: transparent;
    border-bottom: 3px solid var(--primary-color);
  }

  .tab-content {
    padding: 1.5rem 0;
  }

  .delivery-badge {
    background-color: var(--danger-color);
    color: white;
    padding: 0.5rem;
    border-radius: var(--border-radius);
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
  }

  .delivery-badge:hover {
    background-color: #e5177b;
  }

  .user-link {
    color: var(--primary-color);
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    transition: var(--transition);
  }

  .user-link:hover {
    color: var(--secondary-color);
    text-decoration: underline;
  }
</style>

<div class="container-fluid py-4">
  <!-- SweetAlert Notifications -->
  <div class="row">
    @if (Session::get('success1'))
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Suppression réussie',
          text: '{{ Session::get('success1') }}',
          confirmButtonText: 'OK',
          customClass: {
            popup: 'animated bounceIn'
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
          confirmButtonText: 'OK',
          customClass: {
            popup: 'animated bounceIn'
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
          confirmButtonText: 'OK',
          customClass: {
            popup: 'animated shake'
          }
        });
      </script>
    @endif
  </div>

  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3 mb-0 text-gray-800">Gestion des demandes d'extrait de naissance</h1>
    </div>
  </div>

  <!-- Tabs Navigation -->
  <ul class="nav nav-tabs mb-4" id="demandesTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="avec-certificat-tab" data-bs-toggle="tab" data-bs-target="#avec-certificat" type="button" role="tab" aria-controls="avec-certificat" aria-selected="true">
        <i class="bi bi-file-earmark-medical me-2"></i>Avec certificat
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="sans-certificat-tab" data-bs-toggle="tab" data-bs-target="#sans-certificat" type="button" role="tab" aria-controls="sans-certificat" aria-selected="false">
        <i class="bi bi-file-text me-2"></i>Sans certificat
      </button>
    </li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content" id="demandesTabContent">
    <!-- With Certificate Tab -->
    <div class="tab-pane fade show active" id="avec-certificat" role="tabpanel" aria-labelledby="avec-certificat-tab">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold">Demandes avec certificat médical</h6>
          <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput1" class="form-control" placeholder="Rechercher...">
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush" id="dataTable1">
            <thead class="thead-light">
              <tr class="text-center">
                <th>Demandeur</th>
                <th>Hôpital</th>
                <th>Nouveau Né</th>
                <th>Date Naiss.</th>
                <th>Mère</th>
                <th>Père</th>
                <th>Pièces</th>
                <th>État</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($naissances as $naissance)
              <tr class="text-center">
                <td>
                  @if($naissance->user)
                    <a href="#" class="user-link" data-bs-toggle="modal" data-bs-target="#userModal" onclick="showUserModal({{ json_encode($naissance->user) }})">
                      {{ $naissance->user->name.' '.$naissance->user->prenom }}
                    </a>
                  @else
                    <span class="text-muted">Inconnu</span>
                  @endif
                </td>
                <td>{{ $naissance->nomHopital }}</td>
                <td>{{ $naissance->nom .' '.$naissance->prenom }}</td>
                <td>{{ $naissance->lieuNaiss }}</td>
                <td>{{ $naissance->nomDefunt }}</td>
                <td>{{ $naissance->nompere.' '.$naissance->prenompere }}</td>
                <td>
                  <div class="d-flex justify-content-center gap-2">
                    @if($naissance->identiteDeclarant)
                      @php
                        $identiteDeclarantPath = asset('storage/' . $naissance->identiteDeclarant);
                        $isIdentiteDeclarantPdf = strtolower(pathinfo($identiteDeclarantPath, PATHINFO_EXTENSION)) === 'pdf';
                      @endphp
                      @if ($isIdentiteDeclarantPdf)
                        <a href="{{ $identiteDeclarantPath }}" target="_blank" class="document-preview">
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" class="document-preview">
                        </a>
                      @else
                        <img src="{{ $identiteDeclarantPath }}" 
                          alt="Pièce parent" 
                          class="document-preview"
                          data-bs-toggle="modal" 
                          data-bs-target="#imageModal" 
                          onclick="showImage(this)" 
                          onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                      @endif
                    @else
                      <span class="badge bg-secondary">N/A</span>
                    @endif

                    @if($naissance->cdnaiss)
                      @php
                        $cdnaissPath = asset('storage/' . $naissance->cdnaiss);
                        $isCdnaissPdf = strtolower(pathinfo($cdnaissPath, PATHINFO_EXTENSION)) === 'pdf';
                      @endphp
                      @if ($isCdnaissPdf)
                        <a href="{{ $cdnaissPath }}" target="_blank" class="document-preview">
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" class="document-preview">
                        </a>
                      @else
                        <img src="{{ $cdnaissPath }}" 
                          alt="Certificat" 
                          class="document-preview"
                          data-bs-toggle="modal" 
                          data-bs-target="#imageModal" 
                          onclick="showImage(this)" 
                          onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                      @endif
                    @else
                      <span class="badge bg-secondary">N/A</span>
                    @endif
                  </div>
                </td>
                <td>
                  <span class="badge 
                    @if($naissance->etat == 'en attente') badge-warning
                    @elseif($naissance->etat == 'réçu') badge-success
                    @else badge-danger @endif">
                    {{ $naissance->etat }}
                  </span>
                </td>
                <td>
                  <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('naissances.edit', $naissance->id) }}" class="btn btn-sm btn-primary">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    
                    @if($naissance->choix_option == 'livraison')
                      <a href="#" class="delivery-badge btn-sm" data-bs-toggle="modal" data-bs-target="#livraisonModal" onclick="showLivraison1Modal({{ json_encode($naissance) }})">
                        <i class="bi bi-truck"></i> Livraison
                      </a>
                    @else
                      <span class="badge bg-secondary">Retrait</span>
                    @endif
                    
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#annulationModal" data-demande-id="{{ $naissance->id }}">
                      <i class="bi bi-x-circle"></i>
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="9" class="text-center py-4">Aucune demande trouvée</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Without Certificate Tab -->
    <div class="tab-pane fade" id="sans-certificat" role="tabpanel" aria-labelledby="sans-certificat-tab">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold">Demandes sans certificat médical</h6>
          <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput2" class="form-control" placeholder="Rechercher...">
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush" id="dataTable2">
            <thead class="thead-light">
              <tr class="text-center">
                <th>Demandeur</th>
                <th>Type</th>
                <th>Nom Extrait</th>
                <th>N° Registre</th>
                <th>Date Registre</th>
                <th>CNI</th>
                <th>État</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($naissancesD as $naissanceD)
              <tr class="text-center">
                <td>
                  @if($naissanceD->user)
                    <a href="#" class="user-link" data-bs-toggle="modal" data-bs-target="#userModal" onclick="showUserModal({{ json_encode($naissanceD->user) }})">
                      {{ $naissanceD->user->name .' '.$naissanceD->user->prenom }}
                    </a>
                  @else
                    <span class="text-muted">Inconnu</span>
                  @endif
                </td>
                <td>{{ $naissanceD->type }}</td>
                <td>{{ $naissanceD->name.' '.$naissanceD->prenom .' ('.$naissanceD->pour.')'}}</td>
                <td>{{ $naissanceD->number }}</td>
                <td>{{ $naissanceD->DateR }}</td>
                <td>
                  @if($naissanceD->CNI)
                    @php
                      $CNIPath = asset('storage/' . $naissanceD->CNI);
                      $isCNIPdf = strtolower(pathinfo($CNIPath, PATHINFO_EXTENSION)) === 'pdf';
                    @endphp
                    @if ($isCNIPdf)
                      <a href="{{ $CNIPath }}" target="_blank" class="document-preview">
                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" class="document-preview">
                      </a>
                    @else
                      <img src="{{ $CNIPath }}"
                        alt="CNI" 
                        class="document-preview"
                        data-bs-toggle="modal" 
                        data-bs-target="#imageModal" 
                        onclick="showImage(this)" 
                        onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                    @endif
                  @else
                    <span class="badge bg-secondary">N/A</span>
                  @endif
                </td>
                <td>
                  <span class="badge 
                    @if($naissanceD->etat == 'en attente') badge-warning
                    @elseif($naissanceD->etat == 'réçu') badge-success
                    @else badge-danger @endif">
                    {{ $naissanceD->etat }}
                  </span>
                </td>
                <td>
                  <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('naissanced.edit', $naissanceD->id) }}" class="btn btn-sm btn-primary">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    
                    @if($naissanceD->choix_option == 'livraison')
                      <a href="#" class="delivery-badge btn-sm" data-bs-toggle="modal" data-bs-target="#livraisonModal" onclick="showLivraisonModal({{ json_encode($naissanceD) }})">
                        <i class="bi bi-truck"></i> Livraison
                      </a>
                    @else
                      <span class="badge bg-secondary">Retrait</span>
                    @endif
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center py-4">Aucune demande trouvée</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Annulation Modal -->
  <div class="modal fade" id="annulationModal" tabindex="-1" aria-labelledby="annulationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="annulationModalLabel">Motif d'annulation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <form id="annulationForm" method="POST" action="{{ route('annuler.demande', 'demandeId') }}">
            @csrf
            @method('post')
            <input type="hidden" name="demande_id" id="demande_id_input" value="">
    
            <div class="mb-3">
              <label for="motif_annulation" class="form-label">Motif d'annulation:</label>
              <select class="form-select" id="motif_annulation" name="motif_annulation" required>
                <option value="Une erreur du demandeur">Erreur du demandeur</option>
                <option value="Document Incomplet ou Incorret">Document incomplet/incorrect</option>
                <option value="Demande dupliquée">Demande dupliquée</option>
                <option value="autre">Autre motif</option>
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
          <button type="button" class="btn btn-danger" onclick="submitAnnulationForm()">
            <i class="bi bi-x-circle me-1"></i> Annuler
          </button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Image Preview Modal -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel">Aperçu du document</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body text-center">
          <img id="modalImage" src="{{ asset('assets/images/profiles/bébé.jpg') }}" alt="Document" class="img-fluid rounded">
        </div>
      </div>
    </div>
  </div>
  
  <!-- User Info Modal -->
  <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">Informations du demandeur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <div id="userDetails" class="row">
            <!-- Content will be loaded here -->
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Livraison Info Modal -->
  <div class="modal fade" id="livraisonModal" tabindex="-1" aria-labelledby="livraisonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="livraisonModalLabel">Détails de livraison</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          <div id="livraisonDetails">
            <!-- Content will be loaded here -->
          </div>
        </div>
        <div class="modal-footer">
          <a href="{{ route('agent.livraison') }}" class="btn btn-primary">
            <i class="bi bi-truck me-1"></i> Gérer la livraison
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Initialize modals and search functionality
  document.addEventListener('DOMContentLoaded', function() {
    // Search functionality for first table
    document.getElementById('searchInput1').addEventListener('keyup', function() {
      const filter = this.value.toLowerCase();
      const rows = document.querySelectorAll('#dataTable1 tbody tr');
  
      rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const match = Array.from(cells).some(cell => 
          cell.textContent.toLowerCase().includes(filter)
        );
        row.style.display = match ? '' : 'none';
      });
    });
    
    // Search functionality for second table
    document.getElementById('searchInput2').addEventListener('keyup', function() {
      const filter = this.value.toLowerCase();
      const rows = document.querySelectorAll('#dataTable2 tbody tr');
  
      rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const match = Array.from(cells).some(cell => 
          cell.textContent.toLowerCase().includes(filter)
        );
        row.style.display = match ? '' : 'none';
      });
    });
    
    // Annulation modal setup
    const annulationModal = document.getElementById('annulationModal');
    if (annulationModal) {
      annulationModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const demandeId = button.getAttribute('data-demande-id');
        document.getElementById('demande_id_input').value = demandeId;
        
        let formAction = "{{ route('annuler.demande', 'demandeId') }}";
        formAction = formAction.replace('demandeId', demandeId);
        document.getElementById('annulationForm').action = formAction;
      });
    }
    
    // Motif selection logic
    const motifSelect = document.getElementById('motif_annulation');
    const autreMotifDiv = document.getElementById('autreMotifDiv');
    
    if (motifSelect && autreMotifDiv) {
      motifSelect.addEventListener('change', function() {
        if (this.value === 'autre') {
          autreMotifDiv.style.display = 'block';
          document.getElementById('autre_motif_text').setAttribute('required', 'required');
        } else {
          autreMotifDiv.style.display = 'none';
          document.getElementById('autre_motif_text').removeAttribute('required');
        }
      });
    }
  });
  
  function submitAnnulationForm() {
    document.getElementById('annulationForm').submit();
  }
  
  function showImage(imageElement) {
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageElement.src.includes('assets/images/profiles/bébé.jpg') ? 
      imageElement.src : 
      imageElement.src;
  }
  
  function showUserModal(user) {
    const userDetailsDiv = document.getElementById('userDetails');
    userDetailsDiv.innerHTML = `
      <div class="col-md-6 mb-3">
        <div class="card border-0 bg-light p-3 h-100">
          <h6 class="text-primary mb-3">Identité</h6>
          <p><strong>Nom:</strong> ${user.name}</p>
          <p><strong>Prénom(s):</strong> ${user.prenom}</p>
          <p><strong>Email:</strong> ${user.email}</p>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="card border-0 bg-light p-3 h-100">
          <h6 class="text-primary mb-3">Contact</h6>
          <p><strong>Téléphone:</strong> ${user.contact}</p>
          <p><strong>Commune:</strong> ${user.commune}</p>
          <p><strong>N°CMU:</strong> ${user.CMU || 'N/A'}</p>
        </div>
      </div>
    `;
  }
  
  function showLivraisonModal(naissanceD) {
    const livraisonDetailsDiv = document.getElementById('livraisonDetails');
    livraisonDetailsDiv.innerHTML = `
      <div class="mb-4">
        <h6 class="text-primary mb-3">Destinataire</h6>
        <p><strong>Nom complet:</strong> ${naissanceD.nom_destinataire} ${naissanceD.prenom_destinataire}</p>
        <p><strong>Contact:</strong> ${naissanceD.contact_destinataire}</p>
        <p><strong>Email:</strong> ${naissanceD.email_destinataire}</p>
      </div>
      <div class="mb-4">
        <h6 class="text-primary mb-3">Adresse de livraison</h6>
        <p><strong>Adresse:</strong> ${naissanceD.adresse_livraison}</p>
        <p><strong>Ville/Commune:</strong> ${naissanceD.ville}, ${naissanceD.commune}</p>
        <p><strong>Quartier:</strong> ${naissanceD.quartier}</p>
        <p><strong>Code postal:</strong> ${naissanceD.code_postal}</p>
      </div>
    `;
  }
  
  function showLivraison1Modal(naissance) {
    const livraisonDetailsDiv = document.getElementById('livraisonDetails');
    livraisonDetailsDiv.innerHTML = `
      <div class="mb-4">
        <h6 class="text-primary mb-3">Destinataire</h6>
        <p><strong>Nom complet:</strong> ${naissance.nom_destinataire} ${naissance.prenom_destinataire}</p>
        <p><strong>Contact:</strong> ${naissance.contact_destinataire}</p>
        <p><strong>Email:</strong> ${naissance.email_destinataire}</p>
      </div>
      <div class="mb-4">
        <h6 class="text-primary mb-3">Adresse de livraison</h6>
        <p><strong>Adresse:</strong> ${naissance.adresse_livraison}</p>
        <p><strong>Ville/Commune:</strong> ${naissance.ville}, ${naissance.commune}</p>
        <p><strong>Quartier:</strong> ${naissance.quartier}</p>
        <p><strong>Code postal:</strong> ${naissance.code_postal}</p>
      </div>
    `;
  }
</script>
@endsection