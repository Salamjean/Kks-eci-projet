<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item nav-category">Naissance</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-floor-plan"></i>
        <span class="menu-title">Type de demande</span>
        <i class="menu-arrow"></i> 
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('naissance.create') }}">Naissance avec certificat</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('naissanced.create') }}">Acte de Naissance</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('utilisateur.index') }}">Liste de vos demandes</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item nav-category">Décès</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="menu-icon mdi mdi-card-text-outline"></i>
        <span class="menu-title">Type de demande</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{ route('deces.create') }}">Décès avec certificat</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('deces.createdeja') }}">Extrait de décès</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('decesutilisateur.index') }}">Listes Extrait de décès</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item nav-category">Mariage</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
        <i class="menu-icon mdi mdi-chart-line"></i>
        <span class="menu-title">Type de demande</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="charts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('mariage.create') }}">Acte de mariage</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('mariage.userindex') }}">Listes des actes de mariage</a></li>
        </ul>
      </div>
    </li>
      
  </ul>
</nav>