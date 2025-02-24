<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion / Inscription</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="icon" href="{{ asset('assets/images/profiles/E-ci-logo.png') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

    * { box-sizing: border-box; }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      font-family: 'Montserrat', sans-serif;
      height: 100vh;
      margin: -20px 0 50px;
      background-image: url({{ asset('assets/images/profiles/userbg.jpg') }});
      background-size: cover;
    }
    h1 { font-weight: bold; margin: 0; }
    h2 { text-align: center; }
    p { font-size: 14px; font-weight: 100; line-height: 20px; letter-spacing: 0.5px; margin: 20px 0 30px; }
    span { font-size: 12px; }
    a { color: #333; font-size: 14px; text-decoration: none; margin: 15px 0; }
    button {
      border-radius: 20px;
      border: 1px solid #FF4B2B;
      background-color: #FF4B2B;
      color: #FFFFFF;
      font-size: 12px;
      font-weight: bold;
      padding: 12px 45px;
      letter-spacing: 1px;
      text-transform: uppercase;
      transition: transform 80ms ease-in;
    }
    button:active { transform: scale(0.95); }
    button:focus { outline: none; }
    button.ghost { background-color: transparent; border-color: #FFFFFF; }
    form {
      background-color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 0 50px;
      height: 100%;
      text-align: center;
    }
    input, select { background-color: #eee; border: none; padding: 12px 15px; margin: 8px 0; width: 100%; }

    .container {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
      position: relative;
      overflow: hidden;
      width: 768px;
      max-width: 100%;
      min-height: 600px;
    }

    @media (max-width: 768px) {
      .container {
        transform: scale(0.8);
        min-height: 500px;
        width: 90%;
        margin: 0 auto;
        box-shadow: none;
      }
      input, select {
        padding: 8px 12px;
        font-size: 0.9em;
        width: 200px;
      }
      h1, p { font-size: 15px; }
      .creer { font-size: 15px; }
      button { padding: 10px 30px; }
      .accueil {
        margin-bottom: 0 !important;
        margin-top: 10px;
      }
      a {
        font-size: 8px;
        padding: 2px 10px;
      }
    }

    @media (max-width: 480px) {
      .container {
        transform: scale(1.0);
        min-height: 400px;
        width: 90%;
        margin: 0 auto;
        box-shadow: none;
      }
      input, select {
        padding: 4px 10px;
        font-size: 10px;
        width: 160px;
      }
      h1, p { font-size: 15px; }
      .creer { font-size: 12px; }
      button { padding: 6px 30px; }
      .accueil {
        margin-bottom: 10px !important;
        margin-top: 10px;
      }
      a {
        font-size: 8px;
        padding: 6px 10px;
      }
    }

    .form-container {
      position: absolute;
      top: 0;
      height: 100%;
      transition: all 0.6s ease-in-out;
    }
    .sign-in-container { left: 0; width: 50%; z-index: 2; }
    .container.right-panel-active .sign-in-container { transform: translateX(100%); }
    .sign-up-container { left: 0; width: 50%; opacity: 0; z-index: 1; }
    .container.right-panel-active .sign-up-container {
      transform: translateX(100%);
      opacity: 1;
      z-index: 5;
      animation: show 0.6s;
    }
    @keyframes show {
      0%, 49.99% { opacity: 0; z-index: 1; }
      50%, 100% { opacity: 1; z-index: 5; }
    }
    .overlay-container {
      position: absolute;
      top: 0;
      left: 50%;
      width: 50%;
      height: 100%;
      overflow: hidden;
      transition: transform 0.6s ease-in-out;
      z-index: 100;
    }
    .container.right-panel-active .overlay-container { transform: translateX(-100%); }
    .overlay {
      background: linear-gradient(to right, #059652, #52f3a8);
      color: #FFFFFF;
      position: relative;
      left: -100%;
      height: 100%;
      width: 200%;
      transform: translateX(0);
      transition: transform 0.6s ease-in-out;
    }
    .container.right-panel-active .overlay { transform: translateX(50%); }
    .overlay-panel {
      position: absolute;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 0 40px;
      text-align: center;
      top: 0;
      height: 100%;
      width: 50%;
      transform: translateX(0);
      transition: transform 0.6s ease-in-out;
    }
    .overlay-left { transform: translateX(-20%); }
    .container.right-panel-active .overlay-left { transform: translateX(0); }
    .overlay-right { right: 0; transform: translateX(0); }
    .container.right-panel-active .overlay-right { transform: translateX(20%); }
  </style>
</head>
<body>
  <button class="accueil" style="margin-bottom:20px">
    <a href="{{ route('general') }}" class="text-accuei" style="color: white;">Accueil</a>
  </button>
  <div class="container" id="container">
    <!-- Formulaire d'inscription -->
    <div class="form-container sign-up-container">
      <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <h1 class="creer">Créez votre compte</h1>
        <input type="text" name="name" placeholder="Votre nom" required />
        <input type="text" name="prenom" placeholder="Votre prénom" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Mot de passe" required />
        <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required />
        <select id="commune" name="commune" class="block mt-1 w-full" required>
            <option value="">Sélectionnez votre commune de naisance</option>
            <option value="abobo">Abobo</option>
            <option value="adjame">Adjamé</option>
            <option value="attiecoube">Attécoubé</option>
            <option value="cocody">Cocody</option>
            <option value="koumassi">Koumassi</option>
            <option value="marcory">Marcory</option>
            <option value="plateau">Plateau</option>
            <option value="port-bouet">Port-Bouët</option>
            <option value="treichville">Treichville</option>
            <option value="yopougon">Yopougon</option>
            <option value="aboisso">Aboisso</option>
            <option value="abengourou">Abengourou</option>
            <option value="abobo-baoule">Abobo-Baoulé</option>
            <option value="agboville">Agboville</option>
            <option value="agni-bouake">Agni-Bouaké</option>
            <option value="allankoua">Allankoua</option>
            <option value="anono">Anono</option>
            <option value="ankoum">Ankoum</option>
            <option value="anyama">Anyama</option>
            <option value="alepe">Alépé</option>
            <option value="ayama">Ayama</option>
            <option value="bagohouo">Bagohouo</option>
            <option value="banga">Banga</option>
            <option value="bamboue">Bamboué</option>
            <option value="bocanda">Bocanda</option>
            <option value="borotou">Borotou</option>
            <option value="bouna">Bouna</option>
            <option value="bounkani">Bounkani</option>
            <option value="bouafle">Bouaflé</option>
            <option value="bouake">Bouaké</option>
            <option value="bounoua">Bounoua</option>
            <option value="dabakala">Dabakala</option>
            <option value="dabou">Dabou</option>
            <option value="daloa">Daloa</option>
            <option value="dimbokro">Dimbokro</option>
            <option value="debine">Débine</option>
            <option value="djangokro">Djangokro</option>
            <option value="dini">Dini</option>
            <option value="ferkessedougou">Ferkessedougou</option>
            <option value="gagnoa">Gagnoa</option>
            <option value="genegbe">Génégbé</option>
            <option value="grand-bassam">Grand-Bassam</option>
            <option value="grand-lahou">Grand-Lahou</option>
            <option value="guiberoua">Guiberoua</option>
            <option value="ikessou">Ikessou</option>
            <option value="jacqueville">Jacqueville</option>
            <option value="kong">Kong</option>
            <option value="korhogo">Korhogo</option>
            <option value="marako">Marako</option>
            <option value="man">Man</option>
            <option value="mondougou">Mondougou</option>
            <option value="nzi">Nzi</option>
            <option value="odienne">Odienné</option>
            <option value="san-pedro">San-Pédro</option>
            <option value="sassandra">Sassandra</option>
            <option value="segueila">Séguéla</option>
            <option value="sénoufo">Sénoufo</option>
            <option value="sikensi">Sikensi</option>
            <option value="songon">Songon</option>
            <option value="solia">Solia</option>
            <option value="soubre">Soubré</option>
            <option value="tabou">Tabou</option>
            <option value="tiago">Tiago</option>
            <option value="tiassale">Tiassalé</option>
            <option value="toumodi">Toumodi</option>
            <option value="zuénoula">Zuénoula</option>
            <option value="chire">Chiré</option>
            <option value="deboudougou">Déboudougou</option>
            <option value="diboke">Diboké</option>
            <option value="doungou">Doungou</option>
            <option value="boura">Boura</option>
            <option value="bofora">Bofora</option>
            <option value="zagoua">Zagoua</option>
        </select>
        <input type="text" name="CMU" placeholder="Entrez votre numéro CMU" required />
        <div class="flex-column">
          <label>Photo de Profil</label>
          <div class="inputForm mb-3">
            <input type="file" name="profile_picture" class="input" />
            @error('profile_picture')
              <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <button style="margin-top: 1px" type="submit" id="registerButton">S'inscrire</button>
      </form>
    </div>

    <!-- Formulaire de connexion -->
    <div class="form-container sign-in-container">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1>Se connecter</h1>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" />
        @error('email')
        <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
        @enderror
        <input type="password" name="password" placeholder="Mot de passe" />
        @error('password')
        <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
      @enderror
        <a href="{{ route('password.request') }}" style="text-align: flex">Mot de passe oublié?</a>
        <button type="submit">Connexion</button>
      </form>
    </div>

    <!-- Overlay -->
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Content de vous revoir !</h1>
          <p>Entrez vos informations pour vous connecter</p>
          <button class="ghost" id="signIn">Se connecter</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Bienvenue !</h1>
          <p>Créez un compte et rejoignez-nous !</p>
          <button class="ghost" id="signUp">S'inscrire</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
 const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const registerButton = document.getElementById('registerButton');
const signUpForm = document.querySelector('.sign-up-container form');
const signUpInputs = signUpForm.querySelectorAll('input:not([type="file"]), select');
const passwordInput = signUpForm.querySelector('input[name="password"]');
const passwordConfirmationInput = signUpForm.querySelector('input[name="password_confirmation"]');
const emailInput = signUpForm.querySelector('input[name="email"]');

// Gestion des événements pour les boutons
signUpButton.addEventListener('click', () => container.classList.add("right-panel-active"));
signInButton.addEventListener('click', () => container.classList.remove("right-panel-active"));

// Initialisation de Select2
$(document).ready(function() {
    $('#commune').select2({
        placeholder: "Entrez votre commune de naissance",
        allowClear: true,
        width: '100%'
    });
});

// Fonction pour vérifier les erreurs de formulaire
function getFormErrors() {
    let errorMessages = [];
    
    // Vérification des champs vides
    signUpInputs.forEach(input => {
        if (input.required && !input.value.trim()) {
            let fieldName = input.placeholder || input.name;
            errorMessages.push(`Le champ "${fieldName}" est requis`);
        }
    });

    // Validation de l'email si rempli
    if (emailInput.value.trim()) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value)) {
            errorMessages.push("Le format de l'email est invalide");
        }
    }

    // Validation du mot de passe si rempli
    if (passwordInput.value.trim()) {
        if (passwordInput.value.length < 8) {
            errorMessages.push("Le mot de passe doit avoir au moins 8 caractères");
        }
        if (!/[a-z]/.test(passwordInput.value)) {
            errorMessages.push("Le mot de passe doit contenir au moins une minuscule");
        }
        if (!/[A-Z]/.test(passwordInput.value)) {
            errorMessages.push("Le mot de passe doit contenir au moins : Une majuscule");
        }
        if (!/[0-9]/.test(passwordInput.value)) {
            errorMessages.push("Un chiffre");
        }
        if (!/[@$!%*#?&.]/.test(passwordInput.value)) {
            errorMessages.push("Un caractère spécial (@$!%*#?&.)");
        }
    }

    // Validation de la confirmation du mot de passe
    if (passwordInput.value !== passwordConfirmationInput.value) {
        errorMessages.push("Les mots de passe ne correspondent pas");
    }

    return errorMessages;
}

// Gestion du clic sur le bouton d'inscription
registerButton.addEventListener('click', function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire par défaut
    
    const errors = getFormErrors();
    
    if (errors.length > 0) {
        // Afficher le popup avec les erreurs
        Swal.fire({
            icon: 'error',
            title: 'Erreurs dans le formulaire',
            html: errors.join('<br>'),
            confirmButtonColor: '#FF4B2B'
        });
    } else {
        // Si pas d'erreurs, soumettre le formulaire
        signUpForm.submit();
    }
});

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Inscription réussie',
            text: '{{ session('success') }}',
            confirmButtonColor: '#FF4B2B'
        });
    @endif
});
  </script>
</body>
</html>