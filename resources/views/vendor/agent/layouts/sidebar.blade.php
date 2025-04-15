<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('agent.vue') }}">
    <div>
      <img src="{{ asset('assets/images/profiles/E-ci-logo.png') }}" style="height:70px" class="mr-7">
    </div>
    <div class="sidebar-brand-text mx-3" style="font-size: 30px">E-CI</div>
  </a>
  <hr class="sidebar-divider my-0">

  <li class="nav-item active">
    <a class="nav-link" href="{{ route('agent.vue') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Les demandes venues</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading" style="font-size: 15px; text-align:center">
    Les Demandes
  </div>

  <li class="nav-item" style="font-size: 15px; text-align:center">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
      aria-expanded="true" aria-controls="collapseBootstrap">
      <i class="fas fa-baby" style="color: #4dabf7;"></i>
      <span>Naissances</span>
    </a>
    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Naissance</h6>
        <a class="collapse-item" href="{{ route('naissHop.agentmairieindex') }}">Déclaration-Naissance</a>
        <a class="collapse-item" href="{{ route('naissance.agentindex') }}">Extrait-Naissance</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
      aria-controls="collapseForm">
      <i class="fa fa-church" style="color: red;"></i>
      <span>Décès</span>
    </a>
    <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Décès</h6>
        <a class="collapse-item" href="{{ route('deces.agentmairieDecesindex') }}">Déclaration-Décès</a>
        <a class="collapse-item" href="{{ route('deces.agentindex') }}">Extrait-Décès</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('mariage.agentindex') }}">
      <i class="fab fa-fw fa-wpforms " style="color: blue;"></i>
      <span>Acte de mariage</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('agent.livraison') }}">
      <i class="fas fa-user" style="color: orange;"></i>
      <span>Livreur</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHistory" aria-expanded="true"
      aria-controls="collapseHistory">
      <i class="fas fa-check-circle" style="color: limegreen;"></i>
      <span>Historiques</span>
    </a>
    <div id="collapseHistory" class="collapse" aria-labelledby="headingHistory" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Historique</h6>
        <a class="collapse-item" href="{{ route('agent.taskend') }}">Naissance</a>
        <a class="collapse-item" href="{{ route('agent.taskenddeces') }}">Décès</a>
        <a class="collapse-item" href="{{ route('agent.taskendmariages') }}">Mariage</a>
      </div>
    </div>
  </li>
</ul>
