@extends('vendor.agent.layouts.template')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>
  :root {
    --primary-color: #6777ef;
    --secondary-color: #2c3e50;
    --success-color: #2ecc71;
    --warning-color: #f39c12;
    --danger-color: #e74c3c;
    --light-color: #f8f9fa;
    --dark-color: #34495e;
    --border-radius: 10px;
    --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
  }

  body {
    background-color: #f5f7fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .page-container {
    padding: 30px;
    max-width: 100%;
    margin: 0 auto;
  }

  .page-title {
    color: var(--secondary-color);
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
    padding-bottom: 15px;
  }

  .page-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: var(--primary-color);
  }

  .card {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    transition: var(--transition);
    margin-bottom: 30px;
    overflow: hidden;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
  }

  .card-header {
    background-color: var(--primary-color);
    color: white;
    padding: 15px 20px;
    font-weight: 600;
    border-bottom: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .card-header h6 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
  }

  .card-header i {
    font-size: 1.3rem;
    margin-right: 10px;
  }

  .table-responsive {
    border-radius: var(--border-radius);
    overflow: hidden;
  }

  .table {
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0;
  }

  .table thead th {
    background-color: #f8f9fa;
    color: var(--secondary-color);
    font-weight: 600;
    border: none;
    padding: 15px;
    vertical-align: middle;
    border-bottom: 2px solid #e9ecef;
  }

  .table tbody tr {
    transition: var(--transition);
  }

  .table tbody tr:hover {
    background-color: rgba(52, 152, 219, 0.05);
  }

  .table tbody td {
    padding: 15px;
    vertical-align: middle;
    border-top: 1px solid #e9ecef;
  }

  .badge-type {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
  }

  .badge-naiss {
    background-color: #9b59b6;
    color: white;
  }

  .badge-deces {
    background-color: #e74c3c;
    color: white;
  }

  .badge-mariage {
    background-color: #2ecc71;
    color: white;
  }

  .btn-action {
    background-color: var(--primary-color);
    border: none;
    border-radius: 20px;
    padding: 8px 15px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: var(--transition);
    color: white;
  }

  .btn-action:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .btn-action:active {
    transform: translateY(0);
  }

  .search-box {
    position: relative;
    margin-bottom: 20px;
  }

  .search-box input {
    padding-left: 40px;
    border-radius: 20px;
    border: 1px solid #ddd;
    box-shadow: none;
    height: 40px;
  }

  .search-box i {
    position: absolute;
    left: 15px;
    top: 10px;
    color: #aaa;
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

  .empty-state h5 {
    font-weight: 500;
  }

  .pagination {
    display: flex;
    justify-content: center;
    padding: 20px 0;
  }

  .pagination .page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
  }

  .pagination .page-link {
    color: var(--secondary-color);
    border-radius: 20px;
    margin: 0 5px;
    border: none;
    padding: 8px 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
  }

  .pagination .page-link:hover {
    background-color: #f8f9fa;
  }

  @media (max-width: 768px) {
    .page-container {
      padding: 15px;
    }
    
    .card-header {
      flex-direction: column;
      align-items: flex-start;
    }
    
    .card-header h6 {
      margin-bottom: 10px;
    }
    
    .table thead {
      display: none;
    }
    
    .table tbody tr {
      display: block;
      margin-bottom: 15px;
      border: 1px solid #e9ecef;
      border-radius: var(--border-radius);
      padding: 10px;
    }
    
    .table tbody td {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 15px;
      border: none;
      border-bottom: 1px solid #f1f1f1;
    }
    
    .table tbody td::before {
      content: attr(data-label);
      font-weight: 600;
      color: var(--secondary-color);
      margin-right: 15px;
    }
    
    .table tbody td:last-child {
      border-bottom: none;
    }
  }
</style>

<div class="page-container">
  <!-- Notifications -->
  <div class="row">
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

  <h1 class="page-title">
    <i class="fas fa-history me-2"></i>Les demandes effectuées récemment
  </h1>

  <!-- Tableau des naissances -->
  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <h6><i class="fas fa-baby me-2"></i>Demandes d'extrait de naissance récentes</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="searchHistoryTable2">
              <thead>
                <tr class="text-center">
                  <th>Type de copie</th>
                  <th>Hôpital</th>
                  <th>Date</th>
                  <th>Heure</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ([$recentNaissances, $recentNaissancesd] as $naissancesGroup)
                  @forelse ($naissancesGroup as $naissance)
                    <tr class="text-center">
                      <td>
                        <span class="badge-type badge-naiss">
                          {{ $loop->parent->index === 0 ? 'Nouveau né' : $naissance->type }}
                        </span>
                      </td>
                      <td>{{ $loop->parent->index === 0 ? ($naissance->nomHopital ?: 'Extrait Simple/Integral') : 'N/A' }}</td>
                      <td>{{ $naissance->created_at->format('d/m/Y') }}</td>
                      <td>{{ $naissance->created_at->format('H:i') }}</td>
                      <td>
                        <form action="{{ route('naissance.traiter', $naissance->id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('POST')
                          <button type="submit" class="btn-action">
                            <i class="fas fa-download me-1"></i>Récupérer
                          </button>
                        </form>
                      </td>
                    </tr>
                  @empty
                    @if ($loop->first)
                      <tr>
                        <td colspan="5" class="empty-state">
                          <i class="fas fa-baby-carriage"></i>
                          <h5>Aucune naissance récente</h5>
                        </td>
                      </tr>
                    @endif
                    @if ($loop->last)
                      <tr>
                        <td colspan="5" class="empty-state">
                          <i class="fas fa-baby-carriage"></i>
                          <h5>Aucune naissance existante</h5>
                        </td>
                      </tr>
                    @endif
                  @endforelse
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <h6><i class="fas fa-church me-2"></i>Demandes d'extrait de décès récentes</h6>
        </div>
        <div class="card-body">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="search2" class="form-control" placeholder="Rechercher dans ce tableau...">
          </div>
          <div class="table-responsive">
            <table class="table" id="searchHistoryTable2">
              <thead>
                <tr class="text-center">
                  <th>Type</th>
                  <th>Hôpital</th>
                  <th>Date</th>
                  <th>Heure</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tableBody2">
                @forelse ($recentDeces as $deces)
                  <tr class="text-center">
                    <td><span class="badge-type badge-deces">Décès</span></td>
                    <td>{{ $deces->nomHopital }}</td>
                    <td>{{ $deces->created_at->format('d/m/Y') }}</td>
                    <td>{{ $deces->created_at->format('H:i') }}</td>
                    <td>
                      <form action="{{ route('deces.traiter', $deces->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn-action">
                          <i class="fas fa-download me-1"></i>Récupérer
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="empty-state">
                      <i class="fas fa-church"></i>
                      <h5>Aucun décès récent</h5>
                    </td>
                  </tr>
                @endforelse

                @forelse ($recentDecesdeja as $decesdeja)
                  <tr class="text-center">
                    <td><span class="badge-type badge-deces">Décès</span></td>
                    <td>{{ $decesdeja->nomHopital }}</td>
                    <td>{{ $decesdeja->created_at->format('d/m/Y') }}</td>
                    <td>{{ $decesdeja->created_at->format('H:i') }}</td>
                    <td>
                      <form action="{{ route('deces.traiter', $decesdeja->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn-action">
                          <i class="fas fa-download me-1"></i>Récupérer
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="empty-state">
                      <i class="fas fa-church"></i>
                      <h5>Aucun décès existant</h5>
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

  <!-- Tableau des mariages -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h6><i class="fas fa-ring me-2"></i>Demandes d'extrait de mariage récentes</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="searchHistoryTable1">
              <thead>
                <tr class="text-center">
                  <th>Type</th>
                  <th>Demandeur</th>
                  <th>Date</th>
                  <th>Heure</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tableBody1">
                @forelse ($recentMariages as $mariage)
                  <tr class="text-center">
                    <td><span class="badge-type badge-mariage">Mariage</span></td>
                    <td>{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
                    <td>{{ $mariage->created_at->format('d/m/Y') }}</td>
                    <td>{{ $mariage->created_at->format('H:i') }}</td>
                    <td>
                      <form action="{{ route('mariage.traiter', $mariage->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn-action">
                          <i class="fas fa-download me-1"></i>Récupérer
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="empty-state">
                      <i class="fas fa-ring"></i>
                      <h5>Aucun mariage récent</h5>
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
</div>

<script>
  $(document).ready(function() {
    // Fonction de recherche générique
    function setupSearch(inputId, tableBodyId) {
      $('#' + inputId).on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#' + tableBodyId + ' tr').filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    }

    // Initialisation des recherches
    setupSearch('search2', 'tableBody2');
    
    // Adaptation pour mobile
    function adaptForMobile() {
      if (window.innerWidth <= 768px) {
        // Ajout des data-labels pour l'affichage mobile
        $('table thead th').each(function() {
          const headerText = $(this).text();
          const columnIndex = $(this).index();
          $('table tbody tr td:nth-child(' + (columnIndex + 1) + ')').attr('data-label', headerText);
        });
      }
    }

    // Exécuter au chargement et lors du redimensionnement
    adaptForMobile();
    $(window).resize(adaptForMobile);
  });
</script>
@endsection