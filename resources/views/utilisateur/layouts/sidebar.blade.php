<style>
  /* Styles de base (déjà présents) */
  .profile-sidebar {
      text-align: center; /* Centre le contenu horizontalement */
      padding: 20px 0; /* Ajoute un peu d'espace */
      border-bottom: 1px solid #47474742;
      position: relative; /* Important pour le positionnement absolu du menu */
  }
  
  .profile-sidebar img {
      width: 80px; /* Taille de l'image (ajustez selon vos besoins) - Sera écrasé par la media query sur mobile */
      height: 80px;
      border-radius: 50%; /* Image ronde */
      object-fit: cover; /* Conserve les proportions et remplit le cercle */
      margin-bottom: 10px; /* Espace sous l'image */
      border: 3px solid #fff;
      cursor: pointer; /* Change le curseur en main pour indiquer que c'est cliquable */
  }
  
  .profile-sidebar .user-name {
      color: black;
  }
  
  .profile-sidebar .user-designation {
      color: #ffffff;
      display:none
  }
  
  /* Styles spécifiques pour les petits écrans (mobile) */
  @media (max-width: 991.98px) { /* Utilisez 991.98px (lg breakpoint) */
      .profile-sidebar img {
          width: 60px;  /* Réduire un peu la taille */
          height: 60px;
          margin-bottom: 0; /* Plus besoin d'espace en dessous sur mobile, car pas de texte */
      }
       .profile-sidebar{
          padding: 10px 0;
      }
  }
  
  
  /* Styles pour le menu déroulant */
  .profile-sidebar .dropdown-menu {
      position: absolute; /* Positionnement absolu par rapport à .profile-sidebar */
      left: 0;       /* Aligné à gauche de la sidebar */
      top: 100%;   /* En dessous de l'image */
      width: 100%;   /* Occupe toute la largeur de la sidebar */
      z-index: 1000;  /* Assure qu'il s'affiche au-dessus des autres éléments */
      padding: 0;     /* Supprime le padding par défaut */
      border: none;   /* Supprime la bordure par défaut */
      border-radius: 0; /* Supprime les coins arrondis */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Ombre légère */
      background-color: #343a40;
  
  }
  
  .profile-sidebar .dropdown-menu a{
      color:#ffffff;
  }
  
  /* Ajustements pour les éléments du menu */
  .profile-sidebar .dropdown-item {
      padding: 0.5rem 1rem; /* Espacement interne */
     /* border-bottom: 1px solid #ddd;  Ligne de séparation */
      text-align: center; /* Centrer le texte des éléments du menu */
  }
  
  .profile-sidebar .dropdown-item:last-child {
      border-bottom: none; /* Pas de ligne pour le dernier élément */
  }
  .profile-sidebar .dropdown-menu .dropdown-header{
      color:#ffffff
  }
  </style>
  
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <!-- Section Photo de Profil (uniquement sur mobile) -->
      <div class="d-lg-none d-block">
          <li class="nav-item profile-sidebar">
              <a href="#" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                  <img src="{{ optional(Auth::user())->profile_picture
                          ? asset('storage/' . Auth::user()->profile_picture)
                          : asset('assets/images/profiles/useriii.jpeg') }}"
                      alt="Profile Picture">
                <p class="user-name">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</p>
                <p class="user-designation">{{ Auth::user()->commune ?? "Commune non définie"}}</p>
              </a>
  
              <div class="dropdown-menu">
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
      </div>
      <!-- Fin Section Photo de Profil -->
  
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
          <span class="menu-title">Faire une demade</span>
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
          <span class="menu-title">Faire une demade</span>
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
          <span class="menu-title">Faire une demade</span>
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
  
  <script>
      // JavaScript pour gérer l'ouverture/fermeture du menu déroulant (pas toujours nécessaire avec Bootstrap 5)
      document.addEventListener('DOMContentLoaded', function() {
          var dropdownElementList = [].slice.call(document.querySelectorAll('.profile-sidebar [data-bs-toggle="dropdown"]'))
          var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
              return new bootstrap.Dropdown(dropdownToggleEl)
          });
  
           // Fermer le menu si on clique en dehors (amélioration)
          document.addEventListener('click', function(event) {
              var isClickInside = document.querySelector('.profile-sidebar').contains(event.target);
              if (!isClickInside) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                  var openDropdown = dropdowns[i];
                  if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                  }
                }
              }
            });
      });
  </script>