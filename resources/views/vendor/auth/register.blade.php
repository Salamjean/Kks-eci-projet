<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Document</title>
</head>
<style>
    body{
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: url(meilleurs-plugin-formulaires.png);
}

.form {
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    top: 100px;
    gap: 10px;
    background: linear-gradient(45deg, rgb(85, 114, 199), rgb(55, 175, 175));
    padding: 30px;
    width: 450px;
    border-radius: 20px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
      Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
    transition: background 0.3s ease;
  }
  
  .form:hover {
    background: linear-gradient(45deg, #f86750, #f58e7e);
    color: black;
  }
  
  ::placeholder {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
      Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  }
  
  .form button {
    align-self: flex-end;
  }
  
  .flex-column > label {
    color: #151717;
    font-weight: 600;
  }
  
  .inputForm {
    border: 1.5px solid #ecedec;
    border-radius: 10em;
    height: 50px;
    display: flex;
    align-items: center;
    padding-left: 10px;
    transition: 0.2s ease-in-out;
    background-color: white;
  }
  
  .input {
    margin-left: 10px;
    border-radius: 10rem;
    border: none;
    width: 100%;
    height: 100%;
  }
  
  .input:focus {
    outline: none;
  }
  
  .inputForm:focus-within {
    border: 1.5px solid #2d79f3;
  }
  
  .flex-row {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 10px;
    justify-content: space-between;
  }
  
  .flex-row > div > label {
    font-size: 14px;
    color: black;
    font-weight: 400;
  }
  
  .span {
    font-size: 14px;
    margin-left: 5px;
    color: white;
    font-weight: 500;
    cursor: pointer;
  }
  
  .button-submit {
    position: relative;
    display: inline-block;
    padding: 15px 30px;
    text-align: center;
    letter-spacing: 1px;
    text-decoration: none;
    background: transparent;
    transition: ease-out 0.5s;
    border: 2px solid;
    border-radius: 10em;
    box-shadow: inset 0 0 0 0 red;
    margin: 20px 0 10px 0;
    color: white;
    font-size: 15px;
    font-weight: 500;
    height: 50px;
    width: 100%;
    cursor: pointer;
  }
  
  .button-submit:hover {
    color: white;
    box-shadow: inset 0 -100px 0 0 darkorange;
  }
  
  .button-submit:active {
    transform: scale(0.9);
  }
  
  .p {
    text-align: center;
    color: black;
    font-size: 14px;
    margin: 5px 0;
  }
  
  .btn {
    margin-top: 10px;
    width: 100%;
    height: 50px;
    border-radius: 10em;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 500;
    gap: 10px;
    border: 1px solid #ededef;
    background-color: white;
    cursor: pointer;
    transition: 0.2s ease-in-out;
  }
  
  .btn:hover {
    border: 1px solid #2d79f3;
  }
  
</style>
<body>
    
    
    <form class="form" method="POST" action="{{ route('vendor.handleRegister') }}">
        <h2 style="text-align: center">Inscription d'un Admin</h2>
        @if (Session::get('success'))
        <div style="background-color:lightgreen; text-align:center ">
            {{ Session::get('success') }}
        </div>
    @endif
    
        @method('post')
        @csrf

        <div class="mt-4">
          <x-input-label for="commune" :value="__('Commune')" />
      
          <select id="name" name="name" class="block mt-1 w-full" required>
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
                  $('#name').select2({
                      placeholder: "Sélectionnez une commune",
                      allowClear: true,
                      width: '100%'
                  });
              });
          </script>       
        @error('name')
            <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
        @enderror
      </div>

      <div class="flex-column">
        <label>Email </label>
      </div>
      <div class="inputForm">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="20"
          viewBox="0 0 32 32"
          height="20"
        >
          <g data-name="Layer 3" id="Layer_3">
            <path
              d="m30.853 13.87a15 15 0 0 0 -29.729 4.082 15.1 15.1 0 0 0 12.876 12.918 15.6 15.6 0 0 0 2.016.13 14.85 14.85 0 0 0 7.715-2.145 1 1 0 1 0 -1.031-1.711 13.007 13.007 0 1 1 5.458-6.529 2.149 2.149 0 0 1 -4.158-.759v-10.856a1 1 0 0 0 -2 0v1.726a8 8 0 1 0 .2 10.325 4.135 4.135 0 0 0 7.83.274 15.2 15.2 0 0 0 .823-7.455zm-14.853 8.13a6 6 0 1 1 6-6 6.006 6.006 0 0 1 -6 6z"
            ></path>
          </g> 
        </svg>
        <input placeholder="Email@exemple.com" class="input" type="email" value="{{ old('email') }}" name="email"/>
        @error('email')
            <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
        @enderror
    </div>
    
      <div class="flex-column">
        <label>Mot de passe </label>
      </div>
      <div class="inputForm">
       
          <path
            d="m336 512h-288c-26.453125 0-48-21.523438-48-48v-224c0-26.476562 21.546875-48 48-48h288c26.453125 0 48 21.523438 48 48v224c0 26.476562-21.546875 48-48 48zm-288-288c-8.8125 0-16 7.167969-16 16v224c0 8.832031 7.1875 16 16 16h288c8.8125 0 16-7.167969 16-16v-224c0-8.832031-7.1875-16-16-16zm0 0"
          ></path>
          <path
            d="m304 224c-8.832031 0-16-7.167969-16-16v-80c0-52.929688-43.070312-96-96-96s-96 43.070312-96 96v80c0 8.832031-7.167969 16-16 16s-16-7.167969-16-16v-80c0-70.59375 57.40625-128 128-128s128 57.40625 128 128v80c0 8.832031-7.167969 16-16 16zm0 0"
          ></path>
        </svg>
        <input placeholder="Entrez votre mot de passe" class="input" type="password" id="password" name="password" />
        @error('password')
            <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
        @enderror
    </div>
      <button class="button-submit">S'Incrire</button>
      <p class="p">Déjà inscrit?<span class="span"><a href="{{ route('doctor.login') }}">Connectez-vous</a></span></p>
      <p class="p line">Ou avec</p>
    
      <div class="flex-row">
        <button class="btn google">
          <svg
            xml:space="preserve"
            style="enable-background:new 0 0 512 512;"
            viewBox="0 0 512 512"
            y="0px"
            x="0px"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            xmlns="http://www.w3.org/2000/svg"
            id="Layer_1"
            width="20"
            version="1.1"
          >
            <path
              d="M113.47,309.408L95.648,375.94l-65.139,1.378C11.042,341.211,0,299.9,0,256
        c0-42.451,10.324-82.483,28.624-117.732h0.014l57.992,10.632l25.404,57.644c-5.317,15.501-8.215,32.141-8.215,49.456
        C103.821,274.792,107.225,292.797,113.47,309.408z"
              style="fill:#FBBB00;"
            ></path>
            <path
              d="M507.527,208.176C510.467,223.662,512,239.655,512,256c0,18.328-1.927,36.206-5.598,53.451
        c-12.462,58.683-45.025,109.925-90.134,146.187l-0.014-0.014l-73.044-3.727l-10.338-64.535
        c29.932-17.554,53.324-45.025,65.646-77.911h-136.89V208.176h138.887L507.527,208.176L507.527,208.176z"
              style="fill:#518EF8;"
            ></path>
            <path
              d="M416.253,455.624l0.014,0.014C372.396,490.901,316.666,512,256,512
        c-97.491,0-182.252-54.491-225.491-134.681l82.961-67.91c21.619,57.698,77.278,98.771,142.53,98.771
        c28.047,0,54.323-7.582,76.87-20.818L416.253,455.624z"
              style="fill:#28B446;"
            ></path>
            <path
              d="M419.404,58.936l-82.933,67.896c-23.335-14.586-50.919-23.012-80.471-23.012
        c-66.729,0-123.429,42.957-143.965,102.724l-83.397-68.276h-0.014C71.23,56.123,157.06,0,256,0
        C318.115,0,375.068,22.126,419.404,58.936z"
              style="fill:#F14336;"
            ></path>
          </svg>
    
          Google</button
        >
      </div>
    </form>
    
    

</body>
</html>