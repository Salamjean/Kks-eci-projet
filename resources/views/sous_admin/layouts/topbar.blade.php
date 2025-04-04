<nav class="navbar ms-navbar">
  <div class="ms-aside-toggler ms-toggler pl-0" data-target="#ms-side-nav" data-toggle="slideLeft">
    <span class="ms-toggler-bar bg-white"></span>
    <span class="ms-toggler-bar bg-white"></span>
    <span class="ms-toggler-bar bg-white"></span>
  </div>
  <div class="logo-sn logo-sm ms-d-block-sm">
    <a class="pl-0 ml-0 text-center navbar-brand mr-0" href="index.html"><img src="https://via.placeholder.com/84x41" alt="logo"> </a>
  </div>
  {{-- Ajoute un logo ici centré --}}
  <div class="text-center my-2">
    <img src="{{ asset('assets4/img/logoo.png') }}" alt="Logo" style="width: 100px; height: auto;">
  </div>
  {{-- Fin de l'ajout du logo --}}
  <li class="ms-nav-item ms-nav-user dropdown" style="list-style: none;">
    <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <div class="profile-container" style="display: flex; align-items: center;">
        <img class="ms-user-img ms-img-round" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;"  src="
        @if(Auth::guard('sous_admin')->user()->profile_picture)
            {{ asset('storage/' . Auth::guard('sous_admin')->user()->profile_picture) }}
        @else
            @if(Auth::guard('sous_admin')->user()->sexe == 'Homme') 
                {{ asset('assets/images/profiles/user_homme.png') }}
            @elseif(Auth::guard('sous_admin')->user()->sexe == 'Femme')
                {{ asset('assets/images/profiles/user_femme.jpeg') }}
            @else
                {{ asset('assets/images/profiles/neutre.png') }} 
            @endif
        @endif
    ">
        <span style="color: white; font-weight: bold;">
          {{ Auth::guard('sous_admin')->user()->fonction }} : {{ Auth::guard('sous_admin')->user()->name }} 
        </span>
      </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown" style="list-style: none;">
      <li class="dropdown-menu-header" style="list-style: none;">
        <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Bienvenue, {{ Auth::guard('sous_admin')->user()->name }} {{ Auth::guard('sous_admin')->user()->prenom }}</span></h6>
      </li>
      <li class="dropdown-divider"></li>
      <li class="ms-dropdown-list" style="list-style: none;">
        <a class="media fs-14 p-2" href="{{ route('sous_admin.profil') }}"> <span><i class="flaticon-user mr-2"></i> Profile</span> </a>
      </li>
      <li class="dropdown-divider"></li>
      <li class="dropdown-menu-footer" style="list-style: none;">
        <a class="media fs-14 p-2" href="{{ route('sous_admin.logout') }}"> <span><i class="flaticon-shut-down mr-2"></i> Déconnexion</span> </a>
      </li>
    </ul>
  </li>
  <div class="ms-toggler ms-d-block-sm pr-0 ms-nav-toggler" data-toggle="slideDown" data-target="#ms-nav-options">
    <span class="ms-toggler-bar bg-white"></span>
    <span class="ms-toggler-bar bg-white"></span>
    <span class="ms-toggler-bar bg-white"></span>
  </div>
</nav>