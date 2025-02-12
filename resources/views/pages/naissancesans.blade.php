@extends('pages.layouts.template')

@section('content')
  <div class="main-wrapper">
    <section class="error-page section content" style="
      background-image: url('{{ asset('assets4/img/docu.jpg') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
      color: black;
      min-height: 100vh; /* Occupe toute la hauteur de la fenêtre */
      display: flex; /* Active le mode flexbox */
      flex-direction: column; /* Organise les éléments en colonne */
      justify-content: center; /* Centre le contenu verticalement */
      ">
      <div style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);">
      </div>
      <div class="container" style="position: relative; z-index: 1;">
        <div class="row">
          <div class="col-lg-10 offset-lg-1 col-12">
            <div class="error-inner">
              <br><br><br>
              <h1 class="responsive-title">Extrait simple ou <br>intégrale</h1>
              <p style="color:black; font-size:22px">Un acte de naissance peut donner lieu à la délivrance de 2 documents différents : la copie
                intégrale, l'extrait simple. La copie intégrale comporte des informations sur
                la personne concernée par l'acte (nom, prénoms, date et lieu de naissance), des informations sur ses
                parents et les mentions marginales lorsqu'elles existent. Un extrait simple comporte uniquement les
                informations sur la personne concernée par l'acte de naissance.</p>
              <p style="color:black; font-size:22px">Pour une demande d'extrait de naissance simple/integrale, <br><br>
                il faut :
              <li style="font-size:22px">Nom et prénoms sur l'extrait</li>
              <li style="font-size:22px">Le numéro de registre</li>
              <li style="font-size:22px">La date de registre</li>
              <li style="font-size:22px">La commune de naissance</li>
              <li style="font-size:22px">Joindre la pièce de d'identité</li>
              <li style="font-size:22px">Timbre (500 F CFA /Copie)</li>
              </p>
              <div class="get-quote">
                <a href="{{ route('dashboard') }}" class="btn"
                  style="background-color: green; padding:25px; width:300px">Faites votre demande</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <style>
    /* Styles par défaut (grand écran) */
    .responsive-title {
      font-size: 100px !important;
      color: black;
      text-align: center;
    }
    /* Media query pour les écrans de taille tablette (ex: 768px et moins) */
    @media (max-width: 998px) {
      .responsive-title {
        font-size: 50px !important;
        margin-top: 50px !important;
      }
      .responsive-title span{
        margin-top: 10px !important;
      }
      p, li{
        font-size: 16px!important;
      }
    }
    /* Media query pour les écrans de taille mobile (ex: 480px et moins) */
    @media (max-width: 480px) {
      .responsive-title {
        font-size: 40px !important;
        margin-top: 50px !important;
      }
      .responsive-title span{
        margin-top: 10px !important;
      }
      p, li{
        font-size: 16px!important;
      }
    }
  </style>
@endsection