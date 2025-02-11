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
              <h1 style="font-size: 80px; color:black;">Extrait de Décès <br> Simple ou <br>Intégral</h1>
              <p style="color: black">Acte de décès peut donner lieu à la délivrance de 2 documents différents : la copie intégrale, l'extrait simple.
                La copie intégrale comporte des informations sur la personne concernée par l'acte (nom, prénoms, date et lieu de naissance), 
                des informations sur ses parents et les mentions marginales lorsqu'elles existent.
                Un extrait simple comporte uniquement les informations sur la personne concernée par l'acte de décès.
            </p>
            <p style="color: black">Pour une demande d'extrait de décès, <br>
                il faut :
                <li>Le nom et prénoms du défunt</li>
                <li>Numéro de registre</li>
                <li>Date de registre</li>
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
