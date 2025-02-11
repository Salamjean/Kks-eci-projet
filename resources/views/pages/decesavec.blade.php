@extends('pages.layouts.template')

@section('content')
  <div class="main-wrapper">
    <section class="error-page section content" style="background-image: url('{{ asset('assets4/img/decessur.jpg') }}');
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
              <h1 style="font-size: 80px; color:black;">Extrait avec certificat<span>Vous devez disposer d'un certificat médical de décès</span></h1>
                  <p style="color: black">Pour faire une demande d'extrait de décès, un certificat médical de décès est nécessaire. 
                    Un certificat qui est délivré par l'hôpital, Merci de vous assurer que vous disposez de ce 
                    document avant de décider de faire votre demande.</p>
                <p style="color: black">Pour une demande d'extrait de décès avec le certificat médical de décès, <br><br>
                    il faut :
                    <li>Joindre la pièce d'identité du défunt</li>
                    <li>Joindre le certificat médical de décès</li>
                    <li>Joindre le de par la loi (facultatif)</li>
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



