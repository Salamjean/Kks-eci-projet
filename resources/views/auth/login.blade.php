<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion / Inscription</title>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

    * { box-sizing: border-box; }
    body { background: #f6f5f7; display: flex; justify-content: center; align-items: center; flex-direction: column; font-family: 'Montserrat', sans-serif; height: 100vh; margin: -20px 0 50px; }
    h1 { font-weight: bold; margin: 0; }
    h2 { text-align: center; }
    p { font-size: 14px; font-weight: 100; line-height: 20px; letter-spacing: 0.5px; margin: 20px 0 30px; }
    span { font-size: 12px; }
    a { color: #333; font-size: 14px; text-decoration: none; margin: 15px 0; }
    button { border-radius: 20px; border: 1px solid #FF4B2B; background-color: #FF4B2B; color: #FFFFFF; font-size: 12px; font-weight: bold; padding: 12px 45px; letter-spacing: 1px; text-transform: uppercase; transition: transform 80ms ease-in; }
    button:active { transform: scale(0.95); }
    button:focus { outline: none; }
    button.ghost { background-color: transparent; border-color: #FFFFFF; }
    form { background-color: #FFFFFF; display: flex; align-items: center; justify-content: center; flex-direction: column; padding: 0 50px; height: 100%; text-align: center; }
    input, select { background-color: #eee; border: none; padding: 12px 15px; margin: 8px 0; width: 100%; }
    .container { background-color: #fff; border-radius: 10px; box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22); position: relative; overflow: hidden; width: 768px; max-width: 100%; min-height: 480px; }
    .form-container { position: absolute; top: 0; height: 100%; transition: all 0.6s ease-in-out; }
    .sign-in-container { left: 0; width: 50%; z-index: 2; }
    .container.right-panel-active .sign-in-container { transform: translateX(100%); }
    .sign-up-container { left: 0; width: 50%; opacity: 0; z-index: 1; }
    .container.right-panel-active .sign-up-container { transform: translateX(100%); opacity: 1; z-index: 5; animation: show 0.6s; }
    @keyframes show { 0%, 49.99% { opacity: 0; z-index: 1; } 50%, 100% { opacity: 1; z-index: 5; } }
    .overlay-container { position: absolute; top: 0; left: 50%; width: 50%; height: 100%; overflow: hidden; transition: transform 0.6s ease-in-out; z-index: 100; }
    .container.right-panel-active .overlay-container { transform: translateX(-100%); }
    .overlay { background: linear-gradient(to right, #059652, #52f3a8); color: #FFFFFF; position: relative; left: -100%; height: 100%; width: 200%; transform: translateX(0); transition: transform 0.6s ease-in-out; }
    .container.right-panel-active .overlay { transform: translateX(50%); }
    .overlay-panel { position: absolute; display: flex; align-items: center; justify-content: center; flex-direction: column; padding: 0 40px; text-align: center; top: 0; height: 100%; width: 50%; transform: translateX(0); transition: transform 0.6s ease-in-out; }
    .overlay-left { transform: translateX(-20%); }
    .container.right-panel-active .overlay-left { transform: translateX(0); }
    .overlay-right { right: 0; transform: translateX(0); }
    .container.right-panel-active .overlay-right { transform: translateX(20%); }
    footer { background-color: #222; color: #fff; font-size: 14px; bottom: 0; position: fixed; left: 0; right: 0; text-align: center; z-index: 999; }
    footer p { margin: 10px 0; }
    footer a { color: #3c97bf; text-decoration: none; }
  </style>
</head>
<body>
  <div class="container" id="container">
    <!-- Formulaire d'inscription -->
    <div class="form-container sign-up-container">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <h1>Créez votre compte</h1>
        <input type="text" name="name" placeholder="Nom" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Mot de passe" required />
        <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required />
        <select id="commune" name="commune" class="block mt-1 w-full" required>
            <option value="">Sélectionnez une commune</option>
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
            <option value="ferkessedougou">Ferkessédougou</option>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
        <!-- Script d'initialisation de Select2 -->
        <script>
            $(document).ready(function() {
                $('#commune').select2({
                    placeholder: "Sélectionnez une commune",
                    allowClear: true,
                    width: '100%'
                });
            });
        </script><br>
        <button type="submit">S'inscrire</button>
      </form>
    </div>
    <!-- Formulaire de connexion -->
    <div class="form-container sign-in-container">
      <form method="POST" action="{{ route('login') }}">
        @csrf

        @if (Session::get('success'))
        <div style="text-align:center; color:green ">
            {{ Session::get('success') }}
        </div>
        @endif
        
        @error('email')
        <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
        @enderror
        @error('password')
        <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
        @enderror
        <h1>Se connecter</h1>
        <input type="email" name="email" placeholder="Email" required />
       
        <input type="password" name="password" placeholder="Mot de passe" required />
       
        <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
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
  <script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');
    signUpButton.addEventListener('click', () => container.classList.add("right-panel-active"));
    signInButton.addEventListener('click', () => container.classList.remove("right-panel-active"));
  </script>
</body>
</html>
