<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('vendor.dashboard') }}">
    <div>
      <img src="{{ asset('assets/images/profiles/E-ci-logo.png') }}" style="height:70px" class="mr-7">
      <div class="sidebar-brand-text mx-3" style="font-size: 30px">E-CI</div>
    </div>
  </a>
  <hr class="sidebar-divider my-0">

  <li class="nav-item active">
    <a class="nav-link" href="{{ route('vendor.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading" style="font-size: 15px; text-align:center">
    Les Demandes
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
        <a class="collapse-item" href="{{ route('naissHop.mairieindex') }}">Déclaration-Naissance</a>
        <a class="collapse-item" href="{{ route('naissance.index') }}">Extrait-Naissance</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
      aria-controls="collapseForm">
      <i class="fa fa-school"></i>
      <span>Décès</span>
    </a>
    <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Décès</h6>
        <a class="collapse-item" href="{{ route('deces.mairieDecesindex') }}">Déclaration-Décès</a>
        <a class="collapse-item" href="{{ route('deces.index') }}">Extrait-Décès</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('mariage.index') }}">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Acte de mariage</span>
    </a>
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
      <span>Agent</span>
    </a>
    <div id="collapseAgent" class="collapse" aria-labelledby="headingAgent" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Gestion des Agents</h6>
        <a class="collapse-item" href="{{ route('agent.index') }}">Liste des Agents</a>
        <a class="collapse-item" href="{{ route('agent.create') }}">Ajouter un Agent</a>
      </div>
    </div>
  </li>

  <!-- Section Maire -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaire"
      aria-expanded="true" aria-controls="collapseMaire">
      <i class="fa fa-user"></i>
      <span>Ajoint-Maire</span>
    </a>
    <div id="collapseMaire" class="collapse" aria-labelledby="headingMaire" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Gestion Ajoint-Maire</h6>
        <a class="collapse-item" href="#">Liste des Ajoint-Maire</a>
        <a class="collapse-item" href="#">Ajouter un Ajoint-Maire</a>
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
        <a class="collapse-item" href="{{ route('doctor.hoptitalcreate') }}">Ajouter un Hôpital</a>
      </div>
    </div>
  </li>
</ul>
