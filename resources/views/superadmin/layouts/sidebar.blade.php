<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('super_admin.dashboard') }}">
    <div>
      <img src="{{ asset('assets/images/profiles/E-ci-logo.png') }}" style="height:70px" class="mr-7">
      <div class="sidebar-brand-text mx-3" style="font-size: 30px">E-CI</div>
    </div>
  </a>
  <hr class="sidebar-divider my-0">

  <li class="nav-item active">
    <a class="nav-link" href="{{ route('super_admin.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading" style="font-size: 15px; text-align:center">
   Toutes les Demandes
  </div>

  <li class="nav-item" style="font-size: 15px; text-align:center">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
      aria-expanded="true" aria-controls="collapseBootstrap">
      <i class="far fa-fw fa-window-maximize"></i>
      <span>Naissances</span>
    </a>
    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Naissance</h6>
        <a class="collapse-item" href="{{ route('supernaisshop.index') }}">Déclaration-Naissance</a>
        <a class="collapse-item" href="{{ route("supernaissance.index") }}">Extrait-Naissance</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
      aria-controls="collapseForm">
      <i class="fa fa-church"></i>
      <span>Décès</span>
    </a>
    <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Décès</h6>
        <a class="collapse-item" href="{{ route('superdeceshop.index') }}">Déclaration-Décès</a>
        <a class="collapse-item" href="{{ route('superdeces.index') }}">Extrait-Décès</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('supermariage.index') }}">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Acte de mariage</span>
    </a>
  </li>

  <hr class="sidebar-divider">
<hr class="sidebar-divider">
<div class="sidebar-heading" style="font-size: 15px; text-align:center">
  Institution
</div>

   <!-- Section Mairie -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMairie"
      aria-expanded="true" aria-controls="collapseMairie">
      <i class="fa fa-school"></i>
      <span>Mairie</span>
    </a>
    <div id="collapseMairie" class="collapse" aria-labelledby="headingMairie" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Gestion des Mairies</h6>
        <a class="collapse-item" href="{{ route('super_admin.create') }}">Ajout d'une mairie</a>
        <a class="collapse-item" href="{{ route('super_admin.index') }}">Toutes les mairies</a>
        <a class="collapse-item" href="{{ route('super_admin.archive') }}">Archives</a>
      </div>
    </div>
  </li>

   <!-- Section CAGRAE -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCnps"
    aria-expanded="true" aria-controls="collapseCnps">
    <i class="fa fa-school"></i>
    <span>CNPS</span>
  </a>
  <div id="collapseCnps" class="collapse" aria-labelledby="headingCnps" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Gestion de la cnps</h6>
      <a class="collapse-item" href="{{ route('cnps.create') }}">Ajout CNPS</a>
      <a class="collapse-item" href="{{ route('cnps.index') }}">CNPS enregistrée</a>
      <a class="collapse-item" href="{{ route('cnps.indexarchive') }}">CNPS archivés</a>
    </div>
  </div>
</li>

   <!-- Section CAGRAE -->
   <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCAGRAE"
      aria-expanded="true" aria-controls="collapseCAGRAE">
      <i class="fa fa-school"></i>
      <span>CAGRAE</span>
    </a>
    <div id="collapseCAGRAE" class="collapse" aria-labelledby="headingCAGRAE" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Gestion de la CAGRAE</h6>
        <a class="collapse-item" href="{{ route('cgrae.create') }}">Ajout CAGRAE</a>
        <a class="collapse-item" href="{{ route('cgrae.index') }}">CAGRAE enregistrée</a>
        <a class="collapse-item" href="{{ route('cgrae.indexarchive') }}">CAGRAE archivés</a>
      </div>
    </div>
  </li>


     <!-- Section Ministere -->
     <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMinistere"
        aria-expanded="true" aria-controls="collapseMinistere">
        <i class="fa fa-school"></i>
        <span>Ministère de la santé</span>
      </a>
      <div id="collapseMinistere" class="collapse" aria-labelledby="headingMinistere" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Gestion de la ministère</h6>
          <a class="collapse-item" href="{{ route('ministere.create') }}">Ajout du ministère</a>
          <a class="collapse-item" href="{{ route('ministere.index') }}">Ministère enregistré</a>
          <a class="collapse-item" href="{{ route('ministere.indexarchive') }}">Ministère archivés</a>
        </div>
      </div>
    </li>
  

  <hr class="sidebar-divider">
  <hr class="sidebar-divider">

  <div class="sidebar-heading" style="font-size: 15px; text-align:center">
    Le Personnel
  </div>


     <!-- Section Agent -->
 <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAgent"
    aria-expanded="true" aria-controls="collapseAgent">
    <i class="fa fa-user"></i>
    <span>Agents</span>
  </a>
  <div id="collapseAgent" class="collapse" aria-labelledby="headingAgent" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Gestion des Agents</h6>
      <a class="collapse-item" href="{{ route('superagent.index') }}">Tous les agents</a>
    </div>
  </div>
</li>

  <!-- Section Maire -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaire"
      aria-expanded="true" aria-controls="collapseMaire">
      <i class="fa fa-user"></i>
      <span>Huissier d'état civil</span>
    </a>
    <div id="collapseMaire" class="collapse" aria-labelledby="headingMaire" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Gestion-Huissier</h6>
        <a class="collapse-item" href="{{ route('superajoint.index') }}">Tous les huissiers</a>
      </div>
    </div>
  </li>

  <!-- Section Hôpital -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHopital"
      aria-expanded="true" aria-controls="collapseHopital">
      <i class="fa fa-hospital"></i>
      <span>Hôpital</span>
    </a>
    <div id="collapseHopital" class="collapse" aria-labelledby="headingHopital" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Gestion des Hôpitaux</h6>
        <a class="collapse-item" href="{{ route('superhopital.index') }}">Tous les hôputaux</a>
      </div>
    </div>
  </li>

   <!-- Section Caisse -->
 <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCaisse"
    aria-expanded="true" aria-controls="collapseCaisse">
    <i class="fa fa-hospital"></i>
    <span>Caisse</span>
  </a>
  <div id="collapseCaisse" class="collapse" aria-labelledby="headingCaisse" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Gestion des caisses</h6>
      <a class="collapse-item" href="{{ route('supercaisse.index') }}">Tous les caissiés</a>
    </div>
  </div>
</li>


<!-- Section Docteur -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDocteur"
    aria-expanded="true" aria-controls="collapseDocteur">
    <i class="fa fa-hospital"></i>
    <span>Docteur</span>
  </a>
  <div id="collapseDocteur" class="collapse" aria-labelledby="headingDocteur" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Gestion des docteurs</h6>
      <a class="collapse-item" href="{{ route('superdocteur.index') }}">Tous les docteurs</a>
    </div>
  </div>
</li>

<li class="nav-item">
  <a class="nav-link" href="{{ route('supermariage.index') }}">
    <i class="fab fa-fw fa-money"></i>
    <span>Paiements</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link" href="{{ route('paiement-configuration') }}">
    <i class="fab fa-fw fa-money"></i>
    <span>Configurations</span>
  </a>
</li>
</ul>
