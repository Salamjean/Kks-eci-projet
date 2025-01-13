@extends('superadmin.layouts.template')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 <!-- Calcules de soldes de toutes les caisses des mairies enregistrées -->
<div class="container-fluid" id="container-wrapper">
    <div class="text-center mb-4">
        <h2 class="font-semibold text-xl text-gray-800">
            Total des caisses <br>
            <small>Nombres de mairies enrégistrées ({{ $mairie }})</small>
        </h2>
    </div>
  
    <div class="row mb-4">
      <!-- Total Demande Extrait Naissance -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Nombre de demande</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $total }}</div>
            <i class="fas fa-list fa-2x text-primary"></i>
          </div>
        </div>
      </div>

      <!-- Total Demande Extrait Décès -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Solde Fourni selon les mairies enrégistrées</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $soldeActuel }} FCFA</div>
            <i class="fas fa-money-bill fa-2x text-success"></i>
          </div>
        </div>
      </div>

      <!-- Total Demande Acte Mariage -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Solde débité</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $soldeDebite }} FCFA</div>
            <i class="fas fa-money-bill fa-2x text-danger"></i>
          </div>
        </div>
      </div>

      <!-- Total Demandes -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Solde restant</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $soldeRestant }} FCFA</div>
            <i class="fas fa-money-bill-wave fa-2x text-warning"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Le nombre totals des demandes  -->
<div class="container-fluid" id="container-wrapper">
    <div class="text-center mb-4">
        <h2 class="font-semibold text-xl text-gray-800">
        Total de demande d'extrait effectuée
        </h2>
    </div>
  
    <div class="row mb-4">
      <!-- Total Demande Extrait Naissance -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Naissance</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $naissance + $naissanceD }}</div>
            <i class="fas fa-user fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    
      <!-- Total Demande Extrait Décès -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Décès</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $deces + $decesdeja }}</div>
            <i class="fas fa-church fa-2x text-success"></i>
          </div>
        </div>
      </div>
    
      <!-- Total Demande Acte Mariage -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Mariage</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $mariage }}</div>
            <i class="fas fa-ring fa-2x text-danger"></i>
          </div>
        </div>
      </div>
    
      <!-- Total Demandes -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Total des demandes</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{$naissance + $naissanceD + $deces + $decesdeja + $mariage}}</div>
            <i class="fas fa-list fa-2x text-warning"></i>
          </div>
        </div>
      </div>
    </div>

        <!-- Le nombre totals des demandes  -->
<div class="container-fluid" id="container-wrapper">
    <div class="text-center mb-4">
        <h2 class="font-semibold text-xl text-gray-800">
        Total de docteur et de déclaration effectuée <br>
        <small>Nombre d'hôpital enrégistré ({{ $doctors }})</small>
        </h2>
    </div>
  
    <div class="row mb-4">
      <!-- Total Demande Extrait Naissance -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Docteur</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $sousadmin }}</div>
            <i class="fas fa-school fa-2x text-primary"></i>
          </div>
        </div>
      </div>
    
      <!-- Total Demande Extrait Décès -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Naissance</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $naisshop }}</div>
            <i class="fas fa-baby fa-2x text-success"></i>
          </div>
        </div>
      </div>
    
      <!-- Total Demande Acte Mariage -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Décès</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $deceshop }}</div>
            <i class="fas fa-church fa-2x text-danger"></i>
          </div>
        </div>
      </div>
    
      <!-- Total Demandes -->
      <div class="col-xl-3 col-md-6 mb-3">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <h5 class="text-xl font-weight-bold text-uppercase mb-4">Total des déclarations</h5>
            <div class="h2 mb-0 font-weight-bold text-gray-800">{{$naisshop + $deceshop}}</div>
            <i class="fas fa-list fa-2x text-warning"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Les nombres totals de personnels inscrire dans toute les mairies -->

    <div class="container-fluid" id="container-wrapper">
        <div class="text-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800">
               Totals des personnels inscrits dans toutes les mairies
            </h2>
        </div>
      
        <div class="row mb-4">
          <!-- Total Demande Extrait Naissance -->
          <div class="col-xl-4 col-md-6 mb-3">
            <div class="card h-100 shadow-sm">
              <div class="card-body text-center">
                <h5 class="text-xl font-weight-bold text-uppercase mb-4">Agents</h5>
                <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $agents }}</div>
                <i class="fas fa-user fa-2x text-primary"></i>
              </div>
            </div>
          </div>
    
          <!-- Total Demande Extrait Décès -->
          <div class="col-xl-4 col-md-6 mb-3">
            <div class="card h-100 shadow-sm">
              <div class="card-body text-center">
                <h5 class="text-xl font-weight-bold text-uppercase mb-4">Caissiés</h5>
                <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $caisses }} </div>
                <i class="fas fa-money-bill fa-2x text-success"></i>
              </div>
            </div>
          </div>
    
          <!-- Total Demande Acte Mariage -->
          <div class="col-xl-4 col-md-6 mb-3">
            <div class="card h-100 shadow-sm">
              <div class="card-body text-center">
                <h5 class="text-xl font-weight-bold text-uppercase mb-4">Ajoint au maire</h5>
                <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $ajoints }}</div>
                <i class="fas fa-money-bill fa-2x text-danger"></i>
              </div>
            </div>
          </div>
    
          <!-- Total Demandes -->
        </div>
@endsection