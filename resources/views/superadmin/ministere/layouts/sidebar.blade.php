<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" >
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('ministere.dashboard') }}"  style="background-color:#0b70aa">
    <div>
      <img src="{{ asset('assets/images/profiles/E-ci-logo.png') }}" style="height:70px" class="mr-7">
    </div>
    <div class="sidebar-brand-text mx-3" style="font-size: 30px; color:white">E-CI</div>
  </a>
  <hr class="sidebar-divider my-0">

  <li class="nav-item active">
    <a class="nav-link" href="{{ route('ministere.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Tableau de bord</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading" style="font-size: 15px; text-align:center">
   Personnel-Ministère
  </div>

  <li class="nav-item" style="font-size: 15px; text-align:center">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
      aria-expanded="true" aria-controls="collapseBootstrap">
      <i class="far fa-fw fa-user"></i>
      <span>Agent</span>
    </a>
    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Agent-Ministère</h6>
        <a class="collapse-item" href="{{ route('ministereagent.create') }}">Ajout d'un agent</a>
        <a class="collapse-item" href="{{ route('ministereagent.index') }}">Listes des agents</a>
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
        <a class="collapse-item" href="{{ route('ministere.decesdashboard') }}">Déclaration-Décès</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAgent" aria-expanded="true"
      aria-controls="collapseAgent">
      <i class="fa fa-baby"></i>
      <span>Naissance</span>
    </a>
    <div id="collapseAgent" class="collapse" aria-labelledby="headingAgent" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Décès</h6>
        <a class="collapse-item" href="{{ route('ministere.naissancedashboard') }}">Déclaration-Naissance</a>
      </div>
    </div>
  </li>
</ul>
