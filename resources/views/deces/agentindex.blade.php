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

  .breadcrumb {
    background-color: transparent;
    padding: 0;
  }

  .breadcrumb-item.active {
    color: var(--primary-color);
    font-weight: 500;
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
      <h1 class="h3 mb-0 text-gray-800">Gestion des demandes d'extrait de décès</h1>
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
      <button class="nav-link" id="tierce-tab" data-bs-toggle="tab" data-bs-target="#tierce" type="button" role="tab" aria-controls="tierce" aria-selected="false">
        <i class="bi bi-people me-2"></i>Pour moi/tiers
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
                <th>Date Décès</th>
                <th>Défunt</th>
                <th>Documents</th>
                <th>État</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($deces as $decesItem)
              <tr class="text-center">
                <td>
                  @if($decesItem->user)
                    <a href="#" class="user-link" data-bs-toggle="modal" data-bs-target="#userModal" onclick="showUserModal({{ json_encode($decesItem->user) }})">
                      {{ $decesItem->user->name.' '.$decesItem->user->prenom }}
                    </a>
                  @else
                    <span class="text-muted">Inconnu</span>
                  @endif
                </td>
                <td>{{ $decesItem->nomHopital }}</td>
                <td>{{ $decesItem->dateDces }}</td>
                <td>
                  <strong>{{ $decesItem->nomDefunt }}</strong><br>
                  <small>Né le: {{ $decesItem->dateNaiss }}</small><br>
                  <small>À: {{ $decesItem->lieuNaiss }}</small>
                </td>
                <td>
                  <div class="d-flex justify-content-center gap-2 flex-wrap">
                    <!-- Identité Déclarant -->
                    @if($decesItem->identiteDeclarant)
                      @php
                        $identiteDeclarantPath = asset('storage/' . $decesItem->identiteDeclarant);
                        $isIdentiteDeclarantPdf = strtolower(pathinfo($identiteDeclarantPath, PATHINFO_EXTENSION)) === 'pdf';
                      @endphp
                      @if ($isIdentiteDeclarantPdf)
                        <a href="{{ $identiteDeclarantPath }}" target="_blank" class="document-preview">
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" class="document-preview">
                        </a>
                      @else
                        <img src="{{ $identiteDeclarantPath }}" 
                          alt="Pièce déclarant" 
                          class="document-preview"
                          data-bs-toggle="modal" 
                          data-bs-target="#imageModal" 
                          onclick="showImage(this)" 
                          onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                      @endif
                    @else
                      <span class="badge bg-secondary">N/A</span>
                    @endif

                    <!-- Acte Mariage -->
                    @if($decesItem->acteMariage)
                      @php
                        $acteMariagePath = asset('storage/' . $decesItem->acteMariage);
                        $isActeMariagePdf = strtolower(pathinfo($acteMariagePath, PATHINFO_EXTENSION)) === 'pdf';
                      @endphp
                      @if ($isActeMariagePdf)
                        <a href="{{ $acteMariagePath }}" target="_blank" class="document-preview">
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" class="document-preview">
                        </a>
                      @else
                        <img src="{{ $acteMariagePath }}" 
                          alt="Acte mariage" 
                          class="document-preview"
                          data-bs-toggle="modal" 
                          data-bs-target="#imageModal" 
                          onclick="showImage(this)" 
                          onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                      @endif
                    @else
                      <span class="badge bg-secondary">N/A</span>
                    @endif

                    <!-- Déclaration Loi -->
                    @if($decesItem->deParLaLoi)
                      @php
                        $deParLaLoiPath = asset('storage/' . $decesItem->deParLaLoi);
                        $isDeParLaLoiPdf = strtolower(pathinfo($deParLaLoiPath, PATHINFO_EXTENSION)) === 'pdf';
                      @endphp
                      @if ($isDeParLaLoiPdf)
                        <a href="{{ $deParLaLoiPath }}" target="_blank" class="document-preview">
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" class="document-preview">
                        </a>
                      @else
                        <img src="{{ $deParLaLoiPath }}" 
                          alt="Déclaration loi" 
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
                    @if($decesItem->etat == 'en attente') badge-warning
                    @elseif($decesItem->etat == 'réçu') badge-success
                    @else badge-danger @endif">
                    {{ $decesItem->etat }}
                  </span>
                </td>
                <td>
                  <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('deces.edit', $decesItem->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    
                    @if($decesItem->choix_option == 'livraison')
                      <a href="#" class="delivery-badge btn-sm" data-bs-toggle="modal" data-bs-target="#livraisonModal" onclick="showLivraison1Modal({{ json_encode($decesItem) }})" title="Livraison">
                        <i class="bi bi-truck"></i>
                      </a>
                    @else
                      <span class="badge bg-secondary">Retrait</span>
                    @endif
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center py-4">Aucune demande trouvée</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Third Party Tab -->
    <div class="tab-pane fade" id="tierce" role="tabpanel" aria-labelledby="tierce-tab">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold">Demandes pour moi/personne tierce</h6>
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
                <th>Défunt</th>
                <th>Registre</th>
                <th>Documents</th>
                <th>État</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($decesdeja as $dece)
              <tr class="text-center">
                <td>
                  @if($dece->user)
                    <a href="#" class="user-link" data-bs-toggle="modal" data-bs-target="#userModal" onclick="showUserModal({{ json_encode($dece->user) }})">
                      {{ $dece->user->name.' '.$dece->user->prenom }}
                    </a>
                  @else
                    <span class="text-muted">Inconnu</span>
                  @endif
                </td>
                <td>
                  <strong>{{ $dece->name }}</strong><br>
                  <small>CMU: {{ $dece->CMU }}</small>
                </td>
                <td>
                  <small>N°: {{ $dece->numberR }}</small><br>
                  <small>Date: {{ \Carbon\Carbon::parse($dece->dateR)->format('d/m/Y') }}</small>
                </td>
                <td>
                  <div class="d-flex justify-content-center gap-2 flex-wrap">
                    <!-- Certificat Médical -->
                    @if($dece->pActe)
                      @php
                        $pActePath = asset('storage/' . $dece->pActe);
                        $isPActePdf = strtolower(pathinfo($pActePath, PATHINFO_EXTENSION)) === 'pdf';
                      @endphp
                      @if ($isPActePdf)
                        <a href="{{ $pActePath }}" target="_blank" class="document-preview">
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" class="document-preview">
                        </a>
                      @else
                        <img src="{{ $pActePath }}" 
                          alt="Certificat médical" 
                          class="document-preview"
                          data-bs-toggle="modal" 
                          data-bs-target="#imageModal" 
                          onclick="showImage(this)" 
                          onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                      @endif
                    @else
                      <span class="badge bg-secondary">N/A</span>
                    @endif

                    <!-- CNI Défunt -->
                    @if($dece->CNIdfnt)
                      @php
                        $CNIdfntPath = asset('storage/' . $dece->CNIdfnt);
                        $isCNIdfntPdf = strtolower(pathinfo($CNIdfntPath, PATHINFO_EXTENSION)) === 'pdf';
                      @endphp
                      @if ($isCNIdfntPdf)
                        <a href="{{ $CNIdfntPath }}" target="_blank" class="document-preview">
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" class="document-preview">
                        </a>
                      @else
                        <img src="{{ $CNIdfntPath }}" 
                          alt="CNI défunt" 
                          class="document-preview"
                          data-bs-toggle="modal" 
                          data-bs-target="#imageModal" 
                          onclick="showImage(this)" 
                          onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                      @endif
                    @else
                      <span class="badge bg-secondary">N/A</span>
                    @endif

                    <!-- CNI Déclarant -->
                    @if($dece->CNIdcl)
                      @php
                        $CNIdclPath = asset('storage/' . $dece->CNIdcl);
                        $isCNIdclPdf = strtolower(pathinfo($CNIdclPath, PATHINFO_EXTENSION)) === 'pdf';
                      @endphp
                      @if ($isCNIdclPdf)
                        <a href="{{ $CNIdclPath }}" target="_blank" class="document-preview">
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" class="document-preview">
                        </a>
                      @else
                        <img src="{{ $CNIdclPath }}" 
                          alt="CNI déclarant" 
                          class="document-preview"
                          data-bs-toggle="modal" 
                          data-bs-target="#imageModal" 
                          onclick="showImage(this)" 
                          onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                      @endif
                    @else
                      <span class="badge bg-secondary">N/A</span>
                    @endif

                    <!-- Document Mariage -->
                    @if($dece->documentMariage)
                      @php
                        $documentMariagePath = asset('storage/' . $dece->documentMariage);
                        $isDocumentMariagePdf = strtolower(pathinfo($documentMariagePath, PATHINFO_EXTENSION)) === 'pdf';
                      @endphp
                      @if ($isDocumentMariagePdf)
                        <a href="{{ $documentMariagePath }}" target="_blank" class="document-preview">
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" class="document-preview">
                        </a>
                      @else
                        <img src="{{ $documentMariagePath }}" 
                          alt="Document mariage" 
                          class="document-preview"
                          data-bs-toggle="modal" 
                          data-bs-target="#imageModal" 
                          onclick="showImage(this)" 
                          onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                      @endif
                    @else
                      <span class="badge bg-secondary">Non marié(e)</span>
                    @endif

                    <!-- Requisition Police -->
                    @if($dece->RequisPolice)
                      @php
                        $RequisPolicePath = asset('storage/' . $dece->RequisPolice);
                        $isRequisPolicePdf = strtolower(pathinfo($RequisPolicePath, PATHINFO_EXTENSION)) === 'pdf';
                      @endphp
                      @if ($isRequisPolicePdf)
                        <a href="{{ $RequisPolicePath }}" target="_blank" class="document-preview">
                          <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" class="document-preview">
                        </a>
                      @else
                        <img src="{{ $RequisPolicePath }}" 
                          alt="Réquisition police" 
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
                    @if($dece->etat == 'en attente') badge-warning
                    @elseif($dece->etat == 'réçu') badge-success
                    @else badge-danger @endif">
                    {{ $dece->etat }}
                  </span>
                </td>
                <td>
                  <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('decesdeja.edit', $dece->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    
                    @if($dece->choix_option == 'livraison')
                      <a href="#" class="delivery-badge btn-sm" data-bs-toggle="modal" data-bs-target="#livraisonModal" onclick="showLivraisonModal({{ json_encode($dece) }})" title="Livraison">
                        <i class="bi bi-truck"></i>
                      </a>
                    @else
                      <span class="badge bg-secondary">Retrait</span>
                    @endif
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center py-4">Aucune demande trouvée</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
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
  });
  
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
  
  function showLivraisonModal(dece) {
    const livraisonDetailsDiv = document.getElementById('livraisonDetails');
    livraisonDetailsDiv.innerHTML = `
      <div class="mb-4">
        <h6 class="text-primary mb-3">Destinataire</h6>
        <p><strong>Nom complet:</strong> ${dece.nom_destinataire} ${dece.prenom_destinataire}</p>
        <p><strong>Contact:</strong> ${dece.contact_destinataire}</p>
        <p><strong>Email:</strong> ${dece.email_destinataire}</p>
      </div>
      <div class="mb-4">
        <h6 class="text-primary mb-3">Adresse de livraison</h6>
        <p><strong>Adresse:</strong> ${dece.adresse_livraison}</p>
        <p><strong>Ville/Commune:</strong> ${dece.ville}, ${dece.commune}</p>
        <p><strong>Quartier:</strong> ${dece.quartier}</p>
        <p><strong>Code postal:</strong> ${dece.code_postal}</p>
      </div>
    `;
  }
  
  function showLivraison1Modal(decesItem) {
    const livraisonDetailsDiv = document.getElementById('livraisonDetails');
    livraisonDetailsDiv.innerHTML = `
      <div class="mb-4">
        <h6 class="text-primary mb-3">Destinataire</h6>
        <p><strong>Nom complet:</strong> ${decesItem.nom_destinataire} ${decesItem.prenom_destinataire}</p>
        <p><strong>Contact:</strong> ${decesItem.contact_destinataire}</p>
        <p><strong>Email:</strong> ${decesItem.email_destinataire}</p>
      </div>
      <div class="mb-4">
        <h6 class="text-primary mb-3">Adresse de livraison</h6>
        <p><strong>Adresse:</strong> ${decesItem.adresse_livraison}</p>
        <p><strong>Ville/Commune:</strong> ${decesItem.ville}, ${decesItem.commune}</p>
        <p><strong>Quartier:</strong> ${decesItem.quartier}</p>
        <p><strong>Code postal:</strong> ${decesItem.code_postal}</p>
      </div>
    `;
  }
</script>
@endsection