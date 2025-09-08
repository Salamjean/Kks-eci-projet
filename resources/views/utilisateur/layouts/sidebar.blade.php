<style>
  /* Styles de base (déjà présents) */
  .profile-sidebar {
      text-align: center;
      padding: 20px 0;
      border-bottom: 1px solid #47474742;
      position: relative;
  }
  
  .profile-sidebar img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
      border: 3px solid #fff;
      cursor: pointer;
  }
  
  .profile-sidebar .user-name {
      color: black;
  }
  
  .profile-sidebar .user-designation {
      color: #ffffff;
      display:none
  }
  
  /* Styles spécifiques pour les petits écrans (mobile) */
  @media (max-width: 991.98px) {
      .profile-sidebar img {
          width: 60px;
          height: 60px;
          margin-bottom: 0;
      }
       .profile-sidebar{
          padding: 10px 0;
      }
  }
  
  /* Styles pour le menu déroulant (MODIFIÉ) */
  .profile-sidebar .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      z-index: 999;
      padding: 0;
      border: none;
      border-radius: 0;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      background-color: #343a40;
      transform: translateY(10px);
  }
  
  .profile-sidebar .dropdown-menu a{
      color:#ffffff;
  }
  
  /* Ajustements pour les éléments du menu */
  .profile-sidebar .dropdown-item {
      padding: 0.5rem 1rem;
      text-align: center;
  }
  
  .profile-sidebar .dropdown-item:last-child {
      border-bottom: none;
  }
  .profile-sidebar .dropdown-menu .dropdown-header{
      color:#ffffff
  }
</style>
  
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav" style="margin-top: 65px">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Tableau de bord</span>
            </a>
        </li>
        <li class="nav-item nav-category">Naissance</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">Faites une demade</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('naissance.create') }}">Naissance avec certificat</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('naissanced.create') }}">Extrait de Naissance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('utilisateur.index') }}">Listes Extraits de naissances</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Décès</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Faites une demade</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('deces.create') }}">Décès avec certificat</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('deces.createdeja') }}">Extrait de décès</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('decesutilisateur.index') }}">Listes Extraits de décès</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Mariage</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">Faites une demade</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('mariage.create') }}">Extrait de mariage</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('mariage.userindex') }}">Listes des Extraits de mariage</a></li>
                </ul>
            </div>
        </li>
    </ul>
  
   <!-- Section de Déconnexion (visible sur mobile/tablette uniquement) -->
   <ul class="navbar-nav d-lg-none">
      <li class="nav-item dropdown">
        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="ms-user-img ms-img-round float-right" 
               style="width: 50px; height: 40px; border-radius: 50%; object-fit: cover;" 
               src="{{ optional(Auth::user())->profile_picture 
                       ? asset('storage/' . Auth::user()->profile_picture) 
                       : asset('assets/images/profiles/useriii.jpeg') }}" 
               alt="Profile Picture">
                  <strong> {{ Auth::user()->name }} {{ Auth::user()->prenom }}</strong>
      </a>
     
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            @if(Auth::check())
              <p class="mb-1 mt-3 font-weight-semibold">
                  {{ Auth::user()->name ?? 'Nom non défini' }} {{ Auth::user()->prenom ?? 'Prénom non défini' }}
              </p>
            @endif
            <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
          </div>
          <a class="dropdown-item" href="{{ route('profile.edit') }}">
            <i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Profil
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="dropdown-item">
              <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i> Déconnexion
            </button>
          </form>
        </div>
      </li>
    </ul>
</nav>