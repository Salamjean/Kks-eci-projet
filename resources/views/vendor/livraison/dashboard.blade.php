@extends('vendor.livraison.layouts.template')

@section('content')
<div class="container-fluid py-4 ">
    <div class="row">
      <div class="col-lg-12 col-12 mb-4">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-12">
            <div class="card">
              <span class="mask bg-primary opacity-10 border-radius-lg"></span>
              <div class="card-body p-3 position-relative">
                <div class="row justify-content-center"> <!-- Centrer horizontalement -->
                  <div class="col-8 text-center"> <!-- Centrer le texte -->
                    <div class="icon icon-shape bg-white shadow  border-radius-2xl d-flex justify-content-center mx-auto" >
                      <i class="ni ni-cart text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                    <h5 class="text-white text-center font-weight-bolder mb-0 mt-3">
                     {{ $totalLivraisons }}
                    </h5>
                    <span class="text-white text-sm">Total de livraison</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-12">
            <div class="card">
              <span class="mask bg-dark opacity-10 border-radius-lg"></span>
              <div class="card-body p-3 position-relative">
                <div class="row justify-content-center"> <!-- Centrer horizontalement -->
                  <div class="col-8 text-center"> <!-- Centrer le texte -->
                    <div class="icon icon-shape bg-white shadow  border-radius-2xl d-flex justify-content-center mx-auto" >
                      <i class="ni ni-cart text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                      {{ $countNaissanceD + $countNaissances }}
                    </h5>
                    <span class="text-white text-sm">Total de livraison d'acte de naissance</span>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-6 col-md-6 col-12">
            <div class="card">
              <span class="mask bg-dark opacity-10 border-radius-lg"></span>
              <div class="card-body p-3 position-relative">
                <div class="row justify-content-center"> <!-- Centrer horizontalement -->
                  <div class="col-8 text-center"> <!-- Centrer le texte -->
                    <div class="icon icon-shape bg-white shadow  border-radius-2xl d-flex justify-content-center mx-auto" >
                      <i class="ni ni-cart text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                      {{ $countDeces + $countDecesDejas }}
                    </h5>
                    <span class="text-white text-sm">Total de livraison d'acte de décès</span>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-12">
            <div class="card">
              <span class="mask bg-dark opacity-10 border-radius-lg"></span>
              <div class="card-body p-3 position-relative">
                <div class="row justify-content-center"> <!-- Centrer horizontalement -->
                  <div class="col-8 text-center"> <!-- Centrer le texte -->
                    <div class="icon icon-shape bg-white shadow  border-radius-2xl d-flex justify-content-center mx-auto" >
                      <i class="ni ni-cart text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                    <h5 class="text-white font-weight-bolder mb-0 mt-3">
                      {{ $countMariages }}
                    </h5>
                    <span class="text-white text-sm">Total de livraison d'acte de mariage</span>
                  </div>
            
              </div>
            </div>
          </div>
        </div>
      </div>
<br>
      <div class="col-lg-12 col-12 mt-10 mt-lg-0">
        <div class="card shadow h-100">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-0">Statistiques</h6>
          </div>
          <div class="card-body pb-0 p-3">
            <ul class="list-group">
              <!-- Naissances (NaissanceD + Naissance) -->
              <li class="list-group-item border-0 d-flex align-items-center px-0 mb-0">
                <div class="w-100">
                  <div class="d-flex mb-2">
                    <span class="me-2 text-sm font-weight-bold text-dark">Naissances</span>
                    <span class="ms-auto text-sm font-weight-bold">{{ round($pourcentageNaissances, 2) }}%</span>
                  </div>
                  <div>
                    <div class="progress progress-md">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $pourcentageNaissances }}%;" aria-valuenow="{{ $pourcentageNaissances }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </li>
      
              <!-- Décès (Deces + Decesdeja) -->
              <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                <div class="w-100">
                  <div class="d-flex mb-2">
                    <span class="me-2 text-sm font-weight-bold text-dark">Décès</span>
                    <span class="ms-auto text-sm font-weight-bold">{{ round($pourcentageDeces, 2) }}%</span>
                  </div>
                  <div>
                    <div class="progress progress-md">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $pourcentageDeces }}%;" aria-valuenow="{{ $pourcentageDeces }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </li>
      
              <!-- Mariages -->
              <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                <div class="w-100">
                  <div class="d-flex mb-2">
                    <span class="me-2 text-sm font-weight-bold text-dark">Mariages</span>
                    <span class="ms-auto text-sm font-weight-bold">{{ round($pourcentageMariages, 2) }}%</span>
                  </div>
                  <div>
                    <div class="progress progress-md">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $pourcentageMariages }}%;" aria-valuenow="{{ $pourcentageMariages }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
         
   
  
@endsection