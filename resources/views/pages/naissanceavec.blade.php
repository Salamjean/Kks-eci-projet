@extends('pages.layouts.template')

@section('content')
<div class="main-wrapper1" style="margin-top:60px">
  <section class="document-request-section" style="
    background-image: url('{{ asset('assets4/img/avechh.jpg') }}');
    background-size: cover;
    background-position: center;
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 60px 0;
    position: relative;">
    
    <div class="overlay" style="
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.4);">
    </div>
    
    <div class="container" style="position: relative; z-index: 1;">
      <div class="request-card bg-white rounded-lg shadow p-4 p-md-5" style="border-left: 5px solid #28a745;">
        
        <!-- En-tête -->
        <div class="request-header text-center mb-5">
          <h1 class="request-title mb-3" style="font-size: 2.5rem; font-weight: 700; color: #333;">
            Extrait avec certificat
          </h1>
          <p class="request-subtitle" style="font-size: 1.25rem; color: #6c757d;">
            Vous devez disposer d'un certificat médical de naissance
          </p>
        </div>
        
        <!-- Description -->
        <div class="request-description mb-5">
          <p style="font-size: 1.1rem; line-height: 1.6; color: #333;">
            Pour faire une demande d'extrait de naissance pour votre enfant, un certificat
            médical de naissance est nécessaire. Ce document officiel est délivré par l'hôpital
            ou la maternité où a eu lieu l'accouchement.
          </p>
        </div>
        
        <div class="alert alert-info mb-5" style="background-color: #f8f9fa; border-left: 4px solid #17a2b8;">
          <i class="fas fa-info-circle mr-2"></i>
          <strong>Important :</strong> Vérifiez que vous disposez bien de ce document avant de compléter votre demande.
        </div>
        
        <!-- Procédure -->
        <div class="request-procedure mb-5">
          <h3 class="procedure-title mb-4" style="color: #28a745; font-weight: 600;">
            <i class="fas fa-file-alt mr-2"></i>Procédure de demande
          </h3>
          
          <p class="mb-4" style="font-size: 1.1rem; color: #333;">
            Pour obtenir un extrait de naissance avec certificat médical, vous devez fournir :
          </p>
          
          <ul class="requirements-list pl-0" style="list-style: none;">
            <li class="mb-3 d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="min-width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1;">Nom et prénoms complets du nouveau-né</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="min-width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1;">Nom et prénom du père</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="min-width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1;">Date de naissance du père</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="min-width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1;">Copie de la pièce d'identité du père</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="min-width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1;">Certificat médical de naissance original</span>
            </li>
            <li class="d-flex align-items-start">
              <span class="badge badge-success mr-3 p-2" style="min-width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-check"></i>
              </span>
              <span style="flex: 1;">Timbre fiscal (500 FCFA par copie)</span>
            </li>
          </ul>
        </div>
        
        <!-- CTA -->
        <div class="request-cta text-center mt-5">
          <a href="{{ route('dashboard') }}" class="btn btn-lg py-3 px-5 text-white" style="font-size: 1.1rem; font-weight: 600; ">
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
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .request-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }
  
  .requirements-list li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
  }
  
  .requirements-list li:last-child {
    border-bottom: none;
  }
  
  /* Responsive Design */
  @media (max-width: 992px) {
    .request-title {
      font-size: 2rem !important;
    }
    
    .request-subtitle {
      font-size: 1.1rem !important;
    }
    
    .request-card {
      padding: 2rem !important;
    }
  }
  
  @media (max-width: 768px) {
    .request-title {
      font-size: 1.8rem !important;
    }
    
    .request-card {
      padding: 1.5rem !important;
    }
    
    .btn-lg {
      width: 100% !important;
      padding: 12px !important;
    }
  }
  
  @media (max-width: 576px) {
    .request-title {
      font-size: 1.5rem !important;
    }
    
    .request-subtitle {
      font-size: 1rem !important;
    }
    
    .requirements-list li {
      font-size: 0.95rem !important;
    }
  }
</style>
@endsection