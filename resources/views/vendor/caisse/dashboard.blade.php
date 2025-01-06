@extends('vendor.caisse.layouts.template')
@section('content')

<div class="container-fluid" id="container-wrapper">
    <div >
      <div class="font-semibold text-xl text-gray-800 text-center" style="display: flex;justify-content:center; text-align:center; font-weight:bold; font-size:20px;">
        Caisse N° {{ Auth::guard('caisse')->user()->id }}, Visualisé par : {{ Auth::guard('caisse')->user()->name }} {{ Auth::guard('caisse')->user()->prenom }}
      </div>
      <br><br>
    </div>
  
    <div class="row mb-0">
      <!-- Total Demande Extrait Naissance -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demande Extrait Naissance</div>
            <div class="h2 mb-0 font-weight-bold text-gray-800">22222</div>
            <i class="fas fa-user fa-2x text-primary"></i>
          </div>
        </div>
      </div>
      
      <!-- Total Demande Extrait Décès -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demande Extrait Décès</div>
            <div class="h2 mb-0 font-weight-bold text-gray-800">222</div>
            <i class="fas fa-school fa-2x text-success"></i>
          </div>
        </div>
      </div>
  
      <!-- Total Demande Acte Mariage -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demande Acte Mariage</div>
            <div class="h2 mb-0 font-weight-bold text-gray-800">222222</div>
            <i class="fas fa-ring fa-2x text-warning"></i>
          </div>
        </div>
      </div>
  
      <!-- Total Demandes -->
      <div class="col-xl-3 col-md-6 mb-2">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="text-xs font-weight-bold text-uppercase mb-4">Total Demandes</div>
            <div class="h2 mb-0 font-weight-bold text-gray-800">22222</div>
            <i class="fas fa-list fa-2x text-danger"></i>
          </div>
        </div>
      </div>
    </div>

@endsection