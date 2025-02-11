@extends('pages.layouts.template')

@section('content')
  <div class="main-wrapper">
    <section class="error-page section content" style="background-image: url('{{ asset('assets4/img/avechh.jpg') }}');
                                                         background-size: cover;
                                                         background-position: center;
                                                         background-repeat: no-repeat;
                                                         position: relative; /* Important pour positionner l'overlay */
                                                         color: black;">  <!-- Rendre le texte noir -->
      <div style="position: absolute; /* Positionnement absolu par rapport à la section */
                  top: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;
                  background-color: rgba(255, 255, 255, 0.7); /* Blanc semi-transparent (RGBA) */
                  "></div>
      <div class="container" style="position: relative; z-index: 1;"> <!-- Pour que le contenu soit au-dessus de l'overlay -->
        <div class="row">
          <div class="col-lg-10 offset-lg-1 col-12">
            <div class="error-inner">
              <br><br><br>
              <h1 style="font-size: 80px; color:black;">Extrait avec certificat<span>Vous devez disposer
                  d'un certificat médical de naissance</span></h1>
              <p style="color:black">Pour faire une demande d'extrait de naissance pour votre enfant, un certificat médical
                de naissance est nécessaire. Un certificat qui est délivré par l'hôpital, merci de
                vous assurer que vous
                disposez de ce document avant de décider de faire votre demande.</p>
              <h4><strong>Comment faire la demande</strong></h4>
              <p style="color:black">Pour une demande d'extrait de naissance avec le certificat médical de naissance,
                <br><br>
                il faut :
              <li>Choisir le nom et prénoms du nouveau né</li>
              <li>Le nom et prénom du père</li>
              <li>La date de naissance du père</li>
              <li>Joindre la pièce d'identité du père</li>
              <li>Joindre le certificat médical de décès</li>
              <li>Timbre (500 F CFA /Copie)</li>
              </p>
              <div class="get-quote">
                <a href="{{ route('dashboard') }}" class="btn"
                  style="background-color: green; padding:25px; width:300px">Faites votre
                  demande</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection