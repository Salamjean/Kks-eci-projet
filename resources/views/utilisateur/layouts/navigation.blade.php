
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" >
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start" >
        <a class="navbar-brand brand-logo me-5" href="{{ route('dashboard') }}"> 
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
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
          @if (Auth::user()->commune === 'yopougon')
          <img src="{{ asset('assets/images/profiles/yopougon.png') }}" alt="Logo Yopougon" style="height: 60px; width: auto;" />
          @elseif (Auth::user()->commune === 'marcory')
          <img src="{{ asset('assets/images/profiles/marcory.png') }}" alt="Logo Marcory" style="height: 60px; width: auto;" />
          @elseif (Auth::user()->commune === 'cocody')
          <img src="{{ asset('assets/images/profiles/cocody.png') }}" alt="Logo Cocody" style="height: 60px; width: auto;" />
          @elseif (Auth::user()->commune === 'abobo')
          <img src="{{ asset('assets/images/profiles/abobo.png') }}" alt="Logo Abobo" style="height: 60px; width: auto;" />
          @elseif (Auth::user()->commune === 'koumassi')
          <img src="{{ asset('assets/images/profiles/koumassi.png') }}" alt="Logo Koumassi" style="height: 60px; width: auto;" />
          @elseif (Auth::user()->commune === 'port-bouet')
          <img src="{{ asset('assets/images/profiles/portbouet.png') }}" alt="Logo Port-Bouët" style="height: 60px; width: auto;" />
          @elseif (Auth::user()->commune === 'treichville')
          <img src="{{ asset('assets/images/profiles/treichville.png') }}" alt="Logo Treichville" style="height: 60px; width: auto;" />
          @elseif (Auth::user()->commune === 'attecoube')
          <img src="{{ asset('assets/images/profiles/attecoube.png') }}" alt="Logo Attécoubé" style="height: 60px; width: auto;" />
          @elseif (Auth::user()->commune === 'adjame')
          <img src="{{ asset('assets/images/profiles/adjame.jpg') }}" alt="Logo Adjamé" style="height: 60px; width: auto;" />
          @elseif (Auth::user()->commune === 'songon')
          <img src="{{ asset('assets/images/profiles/songon.png') }}" alt="Logo Songon" style="height: 60px; width: auto;" />
          @elseif (Auth::user()->commune === 'plateau')
          <img src="{{ asset('assets/images/profiles/plateau.jpeg') }}" alt="Logo Songon" style="height: 60px; width: auto;" />
          @else
          <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo par défaut" style="height: 60px; width: auto;" />
          @endif
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="background-color: #ffa500">
        <button class="navbar-toggler navbar-toggler align-self-center text-white" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="{{ optional(Auth::user())->profile_picture 
                       ? asset('storage/' . Auth::user()->profile_picture) 
                       : asset('assets/images/profiles/useriii.jpeg') }}" 
               alt="Profile Picture">
               <strong class="text-white"> {{ Auth::user()->name }} {{ Auth::user()->prenom }}</strong>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="{{ route('profile.edit') }}" class="dropdown-item">
                <i class="ti-user text-primary"></i> Profil </a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
                <button  class="dropdown-item">
                  <i class="ti-power-off text-primary"></i> Déconnexion 
                </button>
            </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>