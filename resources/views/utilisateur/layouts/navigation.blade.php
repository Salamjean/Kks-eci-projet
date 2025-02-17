<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row navbar-orange">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
      <!-- Logo principal agrandi -->
      <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
        @if (Auth::user()->commune === 'yopougon')
        <img src="{{ asset('assets/images/profiles/yopougon.png') }}" alt="Logo Yopougon" style="height: 100px; width: auto;" />
        @elseif (Auth::user()->commune === 'marcory')
        <img src="{{ asset('assets/images/profiles/marcory.png') }}" alt="Logo Marcory" style="height: 100px; width: auto;" />
        @elseif (Auth::user()->commune === 'cocody')
        <img src="{{ asset('assets/images/profiles/cocody.png') }}" alt="Logo Cocody" style="height: 100px; width: auto;" />
        @elseif (Auth::user()->commune === 'abobo')
        <img src="{{ asset('assets/images/profiles/abobo.png') }}" alt="Logo Abobo" style="height: 100px; width: auto;" />
        @elseif (Auth::user()->commune === 'koumassi')
        <img src="{{ asset('assets/images/profiles/koumassi.png') }}" alt="Logo Koumassi" style="height: 100px; width: auto;" />
        @elseif (Auth::user()->commune === 'port-bouet')
        <img src="{{ asset('assets/images/profiles/portbouet.png') }}" alt="Logo Port-Bouët" style="height: 100px; width: auto;" />
        @elseif (Auth::user()->commune === 'treichville')
        <img src="{{ asset('assets/images/profiles/treichville.png') }}" alt="Logo Treichville" style="height: 100px; width: auto;" />
        @elseif (Auth::user()->commune === 'attecoube')
        <img src="{{ asset('assets/images/profiles/attecoube.png') }}" alt="Logo Attécoubé" style="height: 100px; width: auto;" />
        @elseif (Auth::user()->commune === 'adjame')
        <img src="{{ asset('assets/images/profiles/adjame.jpg') }}" alt="Logo Adjamé" style="height: 100px; width: auto;" />
        @elseif (Auth::user()->commune === 'songon')
        <img src="{{ asset('assets/images/profiles/songon.png') }}" alt="Logo Songon" style="height: 100px; width: auto;" />
        @elseif (Auth::user()->commune === 'plateau')
        <img src="{{ asset('assets/images/profiles/plateau.jpeg') }}" alt="Logo Songon" style="height: 100px; width: auto;" />
        @else
        <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo par défaut" style="height: 100px; width: auto;" />
        @endif
      </a>

      <!-- Logo miniature agrandi -->
      <a class="navbar-brand brand-logo-mini" href="index.html">
        @if (Auth::user()->commune)
        <img src="{{ asset('assets/images/profiles/' . strtolower(Auth::user()->commune) . '.png') }}" alt="Logo {{ Auth::user()->commune }}" style="height: 100px; width: auto;" />
        @else
        <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="Logo miniature par défaut" style="height: 100px; width: auto;" />
        @endif
      </a>
    </div>
  </div>
  <div class="navbar-menu-wrapper" style="display: flex; justify-content:space-between">
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
        <h1 class="welcome-text">Bienvenue, Mlle/Mme/M. <span class="text-black fw-bold">{{ Auth::user()->name }} {{ Auth::user()->prenom }}</span></h1>
      </li>
    </ul>

    <ul>
      <h3 style="color: black; text-align:center"><strong>Mairie de {{ strtoupper(Auth::user()->commune) }}</strong></h3>
      <h6 class="welcome-sub-text">Vous pouvez maintenant effectuer votre demande</h6>
    </ul>
   
    <ul class="navbar-nav">
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">
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
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
