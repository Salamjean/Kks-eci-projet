@extends('vendor.ajoint.layouts.template')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

  .welcome-banner {
    background: linear-gradient(135deg, #6777ef 0%, #6777ef 100%);
    color: white;
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: var(--box-shadow);
  }

  .stat-card {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    transition: var(--transition);
    height: 100%;
  }

  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  }

  .stat-card .card-body {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .stat-card .icon-container {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    font-size: 1.5rem;
  }

  .stat-card .icon-baby {
    background-color: rgba(67, 97, 238, 0.1);
    color: var(--primary-color);
  }

  .stat-card .icon-death {
    background-color: rgba(247, 37, 133, 0.1);
    color: var(--danger-color);
  }

  .stat-card .icon-marriage {
    background-color: rgba(248, 150, 30, 0.1);
    color: var(--warning-color);
  }

  .stat-card .icon-total {
    background-color: rgba(76, 201, 240, 0.1);
    color: var(--success-color);
  }

  .stat-card .stat-value {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
  }

  .stat-card .stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .section-card {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-bottom: 2rem;
  }

  .section-card .card-header {
    background-color: var(--primary-color);
    color: white;
    border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
    padding: 1rem 1.5rem;
    font-weight: 600;
  }

  .table-responsive {
    border-radius: 0 0 var(--border-radius) var(--border-radius);
  }

  .table {
    margin-bottom: 0;
  }

  .table thead th {
    background-color: #f8f9fa;
    color: var(--dark-color);
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
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

  .badge-primary {
    background-color: var(--primary-color);
    color: white;
  }

  .badge-success {
    background-color: var(--success-color);
    color: white;
  }

  .badge-warning {
    background-color: var(--warning-color);
    color: white;
  }

  .badge-danger {
    background-color: var(--danger-color);
    color: white;
  }

  .chart-container {
    position: relative;
    height: 300px;
    margin-bottom: 2rem;
  }
</style>

<div class="container-fluid py-4">
  <!-- Welcome Banner -->
  <div class="welcome-banner">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h2 class="mb-3">Bienvenue, Huissier d'état civil M. {{ Auth::guard('ajoint')->user()->name }}</h2>
        <p class="mb-0">Vous êtes actuellement à la mairie de {{ Auth::guard('ajoint')->user()->communeM }}</p>
      </div>
      <div class="col-md-4 text-md-end">
        <i class="bi bi-person fa-4x opacity-75"></i>
      </div>
    </div>
  </div>

  <!-- Statistics Cards -->
  <div class="row mb-4">
    <!-- Birth Certificates -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card">
        <div class="card-body">
          <div class="icon-container icon-baby">
            <i class="bi bi-person-vcard"></i>
          </div>
          <div class="stat-value text-primary">{{ $Naiss }}</div>
          <div class="stat-label">Demandes d'extrait de naissance</div>
        </div>
      </div>
    </div>
    
    <!-- Death Certificates -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card">
        <div class="card-body">
          <div class="icon-container icon-death">
            <i class="bi bi-file-earmark-medical"></i>
          </div>
          <div class="stat-value text-danger">{{ $decesdash + $decesdejadash }}</div>
          <div class="stat-label">Demandes d'extrait de décès</div>
        </div>
      </div>
    </div>
    
    <!-- Marriage Certificates -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card">
        <div class="card-body">
          <div class="icon-container icon-marriage">
            <i class="bi bi-heart-fill"></i>
          </div>
          <div class="stat-value text-warning">{{ $mariagedash }}</div>
          <div class="stat-label">Demandes d'acte de mariage</div>
        </div>
      </div>
    </div>
    
    <!-- Total Requests -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="stat-card">
        <div class="card-body">
          <div class="icon-container icon-total">
            <i class="bi bi-list-check"></i>
          </div>
          <div class="stat-value text-success">{{ $totalData }}</div>
          <div class="stat-label">Total des demandes</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Requests Section -->
  <div class="row">
    <!-- Recent Births -->
    <div class="col-lg-4 mb-4">
      <div class="section-card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span><i class="bi bi-person-vcard me-2"></i>Naissances récentes</span>
          <span class="badge bg-white text-primary">{{ $recentNaissances->count() + $recentNaissancesd->count() }}</span>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Type</th>
                  <th>Source</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach ([$recentNaissances, $recentNaissancesd] as $naissancesGroup)
                  @forelse ($naissancesGroup as $naissance)
                    <tr>
                      <td>{{ $loop->parent->index === 0 ? 'Nouveau né' : $naissance->type }}</td>
                      <td>{{ $loop->parent->index === 0 ? ($naissance->nomHopital ?: 'Extrait') : 'N/A' }}</td>
                      <td>{{ $naissance->created_at->format('d/m H:i') }}</td>
                    </tr>
                  @empty
                    @if ($loop->first)
                      <tr><td colspan="3" class="text-center py-3">Aucune naissance récente</td></tr>
                    @endif
                  @endforelse
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Deaths -->
    <div class="col-lg-4 mb-4">
      <div class="section-card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span><i class="bi bi-file-earmark-medical me-2"></i>Décès récents</span>
          <span class="badge bg-white text-danger">{{ $recentDeces->count() + $recentDecesdeja->count() }}</span>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Type</th>
                  <th>Source</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($recentDeces as $deces)
                  <tr>
                    <td>Décès</td>
                    <td>{{ $deces->nomHopital }}</td>
                    <td>{{ $deces->created_at->format('d/m H:i') }}</td>
                  </tr>
                @empty
                  <tr><td colspan="3" class="text-center py-3">Aucun décès récent</td></tr>
                @endforelse
                @forelse ($recentDecesdeja as $decesdeja)
                  <tr>
                    <td>Décès</td>
                    <td>{{ $decesdeja->nomHopital }}</td>
                    <td>{{ $decesdeja->created_at->format('d/m H:i') }}</td>
                  </tr>
                @empty
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Marriages -->
    <div class="col-lg-4 mb-4">
      <div class="section-card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span><i class="bi bi-heart-fill me-2"></i>Mariages récents</span>
          <span class="badge bg-white text-warning">{{ $recentMariages->count() }}</span>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Type</th>
                  <th>Demandeur</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($recentMariages as $mariage)
                  <tr>
                    <td>Mariage</td>
                    <td>{{ $mariage->user ? $mariage->user->name : 'Inconnu' }}</td>
                    <td>{{ $mariage->created_at->format('d/m H:i') }}</td>
                  </tr>
                @empty
                  <tr><td colspan="3" class="text-center py-3">Aucun mariage récent</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection