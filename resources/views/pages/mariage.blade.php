@extends('pages.layouts.template')

@section('content')
<div class="main-wrapper" style="margin-top:70px">
  <section class="document-request-section" style="
    background-image: url('{{ asset('assets4/img/mmmaria.jpg') }}');
    background-size: cover;
    background-position: center;
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 60px 0;
    position: relative;">
    
    <!-- Overlay avec opacité -->
    <div class="overlay" style="
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(3px);">
    </div>
    
    <div class="container" style="position: relative; z-index: 1;">
      <div class="request-card bg-white rounded-lg shadow p-4 p-md-5" style="
        border-left: 5px solid #28a745;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        ">
        
        <!-- En-tête -->
        <div class="request-header text-center mb-5">
          <h1 class="request-title mb-3" style="font-size: 2.8rem; font-weight: 700; color: #333; line-height: 1.2;">
            Extrait de Mariage
          </h1>
          <p class="request-subtitle" style="font-size: 1.3rem; color: #555;">
            Documents officiels relatifs à l'union matrimoniale
          </p>
        </div>
        
        <!-- Description -->
        <div class="request-description mb-5">
          <p style="font-size: 1.15rem; line-height: 1.7; color: #333;">
            Un acte de mariage peut donner lieu à la délivrance de 2 documents différents : la copie intégrale ou l'extrait simple.
            La copie intégrale comporte des informations sur les époux (noms, prénoms, dates et lieu de naissance), 
            des informations sur leurs parents et les mentions marginales lorsqu'elles existent.
            Un extrait simple comporte uniquement les informations sur les époux.
          </p>
        </div>
        
        <div class="alert alert-info mb-5" style="
          background-color: #f8f9fa;
          border-left: 4px solid #17a2b8;
          padding: 15px;
          border-radius: 4px;
          font-size: 1.1rem;
          ">
          <i class="fas fa-info-circle mr-2"></i>
          <strong>Information :</strong> Vous pouvez demander soit la copie intégrale soit l'extrait simple selon vos besoins.
        </div>
        
        <!-- Procédure -->
        <div class="request-procedure mb-5">
          <h3 class="procedure-title mb-4" style="color: #28a745; font-weight: 600;">
            <i class="fas fa-list-check mr-2"></i>Documents et informations requis
          </h3>
          
          <p class="mb-4" style="font-size: 1.15rem; color: #333;">
            Pour une demande d'extrait de mariage, vous devez fournir :
          </p>
          
          <ul class="requirements-list pl-0" style="list-style: none;">
            <li class="mb-3 d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="
                min-width: 32px; 
                height: 32px; 
                border-radius: 50%; 
                display: flex; 
                align-items: center; 
                justify-content: center;
                background-color: #28a745;
                color: white;
                ">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1; font-weight: 500; font-size: 1.1rem;">Nom et prénoms du conjoint</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="
                min-width: 32px; 
                height: 32px; 
                border-radius: 50%; 
                display: flex; 
                align-items: center; 
                justify-content: center;
                background-color: #28a745;
                color: white;
                ">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1; font-weight: 500; font-size: 1.1rem;">Date de naissance du conjoint</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="
                min-width: 32px; 
                height: 32px; 
                border-radius: 50%; 
                display: flex; 
                align-items: center; 
                justify-content: center;
                background-color: #28a745;
                color: white;
                ">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1; font-weight: 500; font-size: 1.1rem;">Lieu de naissance du conjoint</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="
                min-width: 32px; 
                height: 32px; 
                border-radius: 50%; 
                display: flex; 
                align-items: center; 
                justify-content: center;
                background-color: #28a745;
                color: white;
                ">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1; font-weight: 500; font-size: 1.1rem;">Commune de mariage</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="
                min-width: 32px; 
                height: 32px; 
                border-radius: 50%; 
                display: flex; 
                align-items: center; 
                justify-content: center;
                background-color: #28a745;
                color: white;
                ">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1; font-weight: 500; font-size: 1.1rem;">Pièce d'identité</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="
                min-width: 32px; 
                height: 32px; 
                border-radius: 50%; 
                display: flex; 
                align-items: center; 
                justify-content: center;
                background-color: #28a745;
                color: white;
                ">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1; font-weight: 500; font-size: 1.1rem;">Extrait de mariage (si disponible)</span>
            </li>
            <li class="d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="
                min-width: 32px; 
                height: 32px; 
                border-radius: 50%; 
                display: flex; 
                align-items: center; 
                justify-content: center;
                background-color: #28a745;
                color: white;
                ">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1; font-weight: 500; font-size: 1.1rem;">Timbre fiscal (500 FCFA par copie)</span>
            </li>
          </ul>
        </div>
        
        <!-- CTA -->
        <div class="request-cta text-center mt-5">
          <a href="{{ route('dashboard') }}" class="btn btn-lg py-3 px-5 text-white" style="font-size: 1.1rem; font-weight: 600; background-color: #28a745;">
            <i class="fas fa-paper-plane mr-2"></i>Démarrer la demande
          </a>
        </div>
        
      </div>
    </div>
  </section>
</div>

<style>
  /* Styles de base */
  .request-card {
    transition: all 0.3s ease;
    background-color: white;
  }
  
  .request-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
  }
  
  .requirements-list li {
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
    transition: background-color 0.2s ease;
  }
  
  .requirements-list li:hover {
    background-color: #f9f9f9;
  }
  
  .requirements-list li:last-child {
    border-bottom: none;
  }
  
  /* Responsive Design */
  @media (max-width: 992px) {
    .request-title {
      font-size: 2.2rem !important;
    }
    
    .request-subtitle {
      font-size: 1.1rem !important;
    }
    
    .request-card {
      padding: 2.5rem !important;
    }
    
    p, li span {
      font-size: 1rem !important;
    }
  }
  
  @media (max-width: 768px) {
    .request-title {
      font-size: 1.8rem !important;
    }
    
    .request-card {
      padding: 2rem !important;
    }
    
    .btn-lg {
      width: 100% !important;
      padding: 15px !important;
    }
  }
  
  @media (max-width: 576px) {
    .request-title {
      font-size: 1.6rem !important;
    }
    
    .alert {
      font-size: 0.95rem !important;
    }
    
    .requirements-list li {
      padding: 10px 0;
    }
  }
</style>
@endsection