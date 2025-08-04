@extends('vendor.layouts.template')

@section('content')

<div class="container-fluid">
  <!-- En-tête -->
  <div class="dashboard-header">
    <div class="welcome-message">
      <h1>Tableau de Bord - Mairie de {{ Auth::guard('vendor')->user()->name }}</h1>
    </div>
  </div>

  <!-- Cartes de Résumé -->
  <div class="summary-cards">
    <div class="row">
      <!-- Demandes -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card summary-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title">Total Demandes</h6>
                <h2 class="card-value">{{ $totalData }}</h2>
              </div>
              <div class="icon-circle bg-primary">
                <i class="fas fa-file-alt text-white"></i>
              </div>
            </div>
            <div class="progress mt-3">
              <div class="progress-bar bg-primary" style="width: 100%"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Naissances -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card summary-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title">Extraits Naissance</h6>
                <h2 class="card-value">{{ $Naiss }}</h2>
              </div>
              <div class="icon-circle bg-success">
                <i class="fas fa-baby text-white"></i>
              </div>
            </div>
            <div class="progress mt-3">
              <div class="progress-bar bg-success" style="width: {{ $NaissP }}%"></div>
            </div>
            <small class="text-muted">{{ $NaissP }}% des demandes</small>
          </div>
        </div>
      </div>

      <!-- Décès -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card summary-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title">Extraits Décès</h6>
                <h2 class="card-value">{{ $decesdash + $decesdejadash }}</h2>
              </div>
              <div class="icon-circle bg-warning">
                <i class="fas fa-cross text-white"></i>
              </div>
            </div>
            <div class="progress mt-3">
              <div class="progress-bar bg-warning" style="width: {{ $DecesP }}%"></div>
            </div>
            <small class="text-muted">{{ $DecesP }}% des demandes</small>
          </div>
        </div>
      </div>

      <!-- Mariages -->
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="card summary-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title">Actes Mariage</h6>
                <h2 class="card-value">{{ $mariagedash }}</h2>
              </div>
              <div class="icon-circle bg-danger">
                <i class="fas fa-ring text-white"></i>
              </div>
            </div>
            <div class="progress mt-3">
              <div class="progress-bar bg-danger" style="width: {{ $mariagePercentage }}%"></div>
            </div>
            <small class="text-muted">{{ $mariagePercentage }}% des demandes</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Deuxième ligne de cartes -->
  <div class="summary-cards">
    <div class="row">
      <!-- Déclarations -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card summary-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title">Total Déclarations</h6>
                <h2 class="card-value">{{ $NaissHopTotal }}</h2>
              </div>
              <div class="icon-circle bg-info">
                <i class="fas fa-clipboard-list text-white"></i>
              </div>
            </div>
            <div class="progress mt-3">
              <div class="progress-bar bg-info" style="width: 100%"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Déclarations Naissance -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card summary-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title">Déclarations Naissance</h6>
                <h2 class="card-value">{{ $naisshopsdash }}</h2>
              </div>
              <div class="icon-circle bg-purple">
                <i class="fas fa-baby-carriage text-white"></i>
              </div>
            </div>
            <div class="progress mt-3">
              <div class="progress-bar bg-purple" style="width: {{ $naisshopPercentage }}%"></div>
            </div>
            <small class="text-muted">{{ $naisshopPercentage }}% des déclarations</small>
          </div>
        </div>
      </div>

      <!-- Déclarations Décès -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card summary-card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="card-title">Déclarations Décès</h6>
                <h2 class="card-value">{{ $deceshopsdash }}</h2>
              </div>
              <div class="icon-circle bg-orange">
                <i class="fas fa-book-dead text-white"></i>
              </div>
            </div>
            <div class="progress mt-3">
              <div class="progress-bar bg-orange" style="width: {{ $deceshopPercentage }}%"></div>
            </div>
            <small class="text-muted">{{ $deceshopPercentage }}% des déclarations</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Graphiques -->
  <div class="row">
    <!-- Taux des Demandes -->
    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Répartition des Demandes</h5>
          <div class="filter-section">
            <form method="GET" action="{{ route('vendor.dashboard') }}" class="form-inline">
              <select name="month" class="form-control form-control-sm mr-2">
                @for ($m = 1; $m <= 12; $m++)
                  <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                  </option>
                @endfor
              </select>
              <select name="year" class="form-control form-control-sm mr-2">
                @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                  <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>
                    {{ $y }}
                  </option>
                @endfor
              </select>
              <button type="submit" class="btn btn-sm btn-primary">Appliquer</button>
            </form>
          </div>
        </div>
        <div class="card-body">
          <canvas id="demandesChart" height="130"></canvas>
          <div class="chart-legend mt-3">
            <div class="legend-item">
              <span class="legend-color bg-success"></span>
              <span>Naissances ({{ $naissances->count() + $naissancesD->count() }})</span>
            </div>
            <div class="legend-item">
              <span class="legend-color bg-warning"></span>
              <span>Décès ({{ $deces->count() + $decesdeja->count() }})</span>
            </div>
            <div class="legend-item">
              <span class="legend-color bg-danger"></span>
              <span>Mariages ({{ $mariages->count() }})</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Taux des Déclarations -->
    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">Répartition des Déclarations</h5>
          <div class="filter-section">
            <form method="GET" action="{{ route('vendor.dashboard') }}" class="form-inline">
              <select name="month_hops" class="form-control form-control-sm mr-2">
                @for ($m = 1; $m <= 12; $m++)
                  <option value="{{ $m }}" {{ $m == $selectedMonthHops ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                  </option>
                @endfor
              </select>
              <select name="year_hops" class="form-control form-control-sm mr-2">
                @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                  <option value="{{ $y }}" {{ $y == $selectedYearHops ? 'selected' : '' }}>
                    {{ $y }}
                  </option>
                @endfor
              </select>
              <button type="submit" class="btn btn-sm btn-primary">Appliquer</button>
            </form>
          </div>
        </div>
        <div class="card-body">
          <canvas id="declarationsChart" height="130"></canvas>
          <div class="chart-legend mt-3">
            <div class="legend-item">
              <span class="legend-color bg-purple"></span>
              <span>Naissances ({{ $naisshopsdash }})</span>
            </div>
            <div class="legend-item">
              <span class="legend-color bg-orange"></span>
              <span>Décès ({{ $deceshopsdash }})</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- Styles personnalisés -->
<style>
  .dashboard-header {
    padding: 20px 0;
    margin-bottom: 30px;
    border-bottom: 1px solid #eee;
  }
  
  .welcome-message h1 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 5px;
  }
  
  .summary-card {
    border-radius: 10px;
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
  }
  
  .summary-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
  }
  
  .card-title {
    font-size: 14px;
    color: #6c757d;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  
  .card-value {
    font-size: 28px;
    font-weight: 700;
    margin: 5px 0;
  }
  
  .icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
  }
  
  .bg-purple {
    background-color: #6f42c1;
  }
  
  .bg-orange {
    background-color: #fd7e14;
  }
  
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    border-bottom: 1px solid #eee;
  }
  
  .filter-section {
    display: flex;
    align-items: center;
  }
  
  .chart-legend {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
  }
  
  .legend-item {
    display: flex;
    align-items: center;
    font-size: 13px;
  }
  
  .legend-color {
    width: 12px;
    height: 12px;
    border-radius: 3px;
    display: inline-block;
    margin-right: 5px;
  }
  
  .progress {
    height: 6px;
    border-radius: 3px;
  }
</style>

<!-- Scripts pour les graphiques -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Graphique des demandes
    const demandesCtx = document.getElementById('demandesChart').getContext('2d');
    const demandesChart = new Chart(demandesCtx, {
      type: 'doughnut',
      data: {
        labels: ['Naissances', 'Décès', 'Mariages'],
        datasets: [{
          data: [
            {{ $naissances->count() + $naissancesD->count() }},
            {{ $deces->count() + $decesdeja->count() }},
            {{ $mariages->count() }}
          ],
          backgroundColor: [
            '#28a745',
            '#ffc107',
            '#dc3545'
          ],
          borderWidth: 0
        }]
      },
      options: {
        cutout: '70%',
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });
    
    // Graphique des déclarations
    const declarationsCtx = document.getElementById('declarationsChart').getContext('2d');
    const declarationsChart = new Chart(declarationsCtx, {
      type: 'doughnut',
      data: {
        labels: ['Naissances', 'Décès'],
        datasets: [{
          data: [
            {{ $naisshopsdash }},
            {{ $deceshopsdash }}
          ],
          backgroundColor: [
            '#6f42c1',
            '#fd7e14'
          ],
          borderWidth: 0
        }]
      },
      options: {
        cutout: '70%',
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });
  });
</script>

@endsection