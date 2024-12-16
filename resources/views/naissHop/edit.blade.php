@extends('sous_admin.layouts.template')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Multi-step Form</title>
  
  <style>
    /* Custom font */
    @import url(https://fonts.googleapis.com/css?family=Montserrat);

    /* Basic reset */
    * { margin: 0; padding: 0; }

    html {
      height: 100vh;
      background-image:url({{ asset('assets/images/profiles/arriereP.jpg') }});
    }

    body {
      font-family: montserrat, arial, verdana;
    }

    /* Form styles */
    #msform {
      width: 50%;
      margin-top: 60px;
      margin-left:170px;
      text-align: center;
      position: relative;
    }

    #msform fieldset {
      background: white;
      border: none;
      border-radius: 20px;
      box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.1);
      padding: 20px 30px;
      box-sizing: border-box;
      width: 120%;
      margin: 0 10%;
      position: relative;
      opacity: 0; /* Start with hidden fieldset */
      animation: slideIn 0.5s forwards; /* Slide in animation */
    }

    /* Slide in animation */
      @keyframes slideIn {
        from {
          transform: translateX(-100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }

    #msform fieldset:not(:first-of-type) {
      display: none;
    }

    #msform input, #msform textarea {
      padding: 15px;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-bottom: 10px;
      width: 100%;
      box-sizing: border-box;
      font-family: montserrat;
      color: #2C3E50;
      font-size: 13px;
      border-radius: 8px;
    }

    input[type="file"]::file-selector-button {
        background-color: #f3d023de;
        border: none;
        height: 30px;
        border-radius: 5px;
        color: white;
    }

    input[type="file"] {
        border: 1px dashed black;
    }

    #msform .action-button {
      width: 100px;
      background: #009efb;
      font-weight: bold;
      color: white;
      border: none;
      border-radius: 1px;
      cursor: pointer;
      padding: 10px;
      margin: 10px 5px;
      text-decoration: none;
      font-size: 14px;
    }

    #msform .action-button:hover, #msform .action-button:focus {
      box-shadow: 0 0 0 2px white, 0 0 0 3px #009efb;
      border-radius: 10px;
      transition: all 0.30s;
    }

    .fs-title {
      font-size: 15px;
      text-transform: uppercase;
      color: #2C3E50;
      margin-bottom: 10px;
    }

    .fs-subtitle {
      font-weight: normal;
      font-size: 13px;
      color: #666;
      margin-bottom: 20px;
    }

    /* Progress bar */
    #progressbar {
      margin-bottom: 30px;
      overflow: hidden;
      counter-reset: step;
      width: 142%;
      position: relative;
      right: 02px;
    }

    #progressbar li {
      list-style-type: none;
      color: black;
      left: 10%;
      text-transform: uppercase;
      font-size: 9px;
      width: 25%;
      float: left;
      position: relative;
    }

    #progressbar li:before {
      content: counter(step);
      counter-increment: step;
      width: 20px;
      line-height: 20px;
      display: block;
      font-size: 10px;
      color: #333;
      background: white;
      border-radius: 3px;
      margin: 0 auto 5px auto;
    }

    #progressbar li:after {
      content: '';
      width: 100%;
      height: 2px;
      background: white;
      position: absolute;
      left: -50%;
      top: 9px;
      z-index: -1;
    }

    #progressbar li:first-child:after {
      content: none;
    }

    #progressbar li.active:before, #progressbar li.active:after {
      background: #009efb;
      color: white;
    }
    select.text-center {
    text-align: center;
    text-align-last: center; /* Centrer aussi l'élément sélectionné */
    width: 100%; /* Ajuste la largeur si nécessaire */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    } 
  </style>
</head>
<body>
  <form id="msform" action="{{ route('naissHop.update', $naisshop->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <ul id="progressbar">
      <li class="active">Informations 
        <br>sur la mère</li>
      <li>Informations 
        <br>sur le père</li>
      <li>Informations du nouveau-né</li>
    </ul>

    <fieldset>
      <h2 class="fs-title">Déclaration de naissance</h2>
      <h3 class="fs-subtitle">Informations sur la mère</h3>
      <input type="text" name="NomM" placeholder="Entrez le nom de la mère" value="{{ $naisshop->NomM }}" />
      @error('NomM')
      <div class="text-danger text-center">{{ $message }}</div>
  @enderror
      <input type="text" name="PrM" placeholder="Entrez le prénom de la mère" value="{{ $naisshop->PrM }}" />
      @error('PrM')
      <div class= "text-danger text-center">{{ $message }}</div>
  @enderror
      <input type="text" name="contM" placeholder="Entrez le numéro de la mère" value="{{ $naisshop->contM }}"><br>
      @error('contM')
      <div class="text-danger text-center">{{ $message }}</div>
  @enderror
      <label style="position: relative; right: 22px;">Joindre copie CNI/passeport/extrait de la mère</label><br>
      <input type="file" name="CNI_mere" value="{{ $naisshop->CNI_mere }}" />
      @error('CNI_mere')
      <div class="text-danger text-center">{{ $message }}</div>
  @enderror
      <input type="button" class="next action-button" value="Suivant" />
    </fieldset>

    <fieldset>
      <h2 class="fs-title">Déclaration de naissance</h2>
      <h3 class="fs-subtitle">Informations sur la compagnateur</h3>
      <input type="text" name="NomP" placeholder="Entrez le nom de la compagnateur" value="{{ $naisshop->NomP }}" />
      @error('NomP')
      <div class="text-danger text-center">{{ $message }}</div>
  @enderror
      <input type="text" name="PrP" placeholder="Entrez le prénom de la compagnateur" value="{{ $naisshop->PrP }}"/>
      @error('PrP')
      <div class="text-danger text-center">{{ $message }}</div>
  @enderror
      <input type="text" name="contP" placeholder="Entrez le numéro de la compagnateur" value="{{ $naisshop->contP }}"><br>
      @error('contP')
      <div class="text-danger text-center">{{ $message }}</div>
  @enderror
      <label style="position: relative; right: 27px;">Joindre copie CNI/passeport/extrait de la compagnateur</label><br>
      <input type="file" name="CNI_Pere" value="{{ $naisshop->CNI_Pere }}"/>
      @error('CNI_Pere')
      <div class="text-danger text-center">{{ $message }}</div>
  @enderror
      <input type="button" class="previous action-button" value="Retour" />
      <input type="button" class="next action-button" value="Suivant" />
    </fieldset>

    <fieldset >
      <h2 class="fs-title">Informations du nouveau-né</h2>
      <h3 class="fs-subtitle">Complétez les informations du bébé</h3>
      <input type="date" class="text-center" name="DateNaissance" placeholder="Entrez la date de naissance" value="{{ $naisshop->DateNaissance }}"  />
      <select class="text-center" name="sexe" >
        <option value="masculin" {{ $naisshop->sexe == 'masculin' ? 'selected' : '' }}>Masculin</option>
        <option value="feminin" {{ $naisshop->sexe == 'feminin' ? 'selected' : '' }}>Féminin</option>
      </select>
      <input type="button"  class="previous action-button" value="Retour" />
      <input type="submit" class="next action-button" style="width:130px" value="Mettre à jour" />
    </fieldset>
  </form>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      // Navigation entre les étapes
      $(".next").click(function () {
        var current = $(this).parent();
        var next = $(this).parent().next();
        if (next.length) {
          current.fadeOut(500, function () {
            next.fadeIn(500);
          });
          $("#progressbar li").eq($("fieldset").index(next)).addClass("active");
        }
      });

      $(".previous").click(function () {
        var current = $(this).parent();
        var previous = $(this).parent().prev();
        if (previous.length) {
          current.fadeOut(500, function () {
            previous.fadeIn(500);
          });
          $("#progressbar li").eq($("fieldset").index(current)).removeClass("active");
        }
      });

      // Soumission du formulair
    });
  </script>
</body>
</html>
@endsection
