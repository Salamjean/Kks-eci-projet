<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Inscription d'un Docteur</title>
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

    <form class="form" method="POST" action="{{ route('handleRegister') }}" enctype="multipart/form-data">
        <h2 style="text-align: center">Inscription d'un Docteur</h2>
        
        @if (Session::get('success'))
        <div style="background-color:lightgreen; text-align:center ">
            {{ Session::get('success') }}
        </div>
        @endif
        
        @method('post')
        @csrf

        <!-- Nom -->
        <div class="flex-column">
            <label>Nom </label>
        </div>
        <div class="inputForm">
            <input placeholder="Entrez votre nom & prenoms" value="{{ old('name') }}" class="input" type="text" id="name" name="name"/>
            @error('name')
            <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="flex-column">
            <label>Email </label>
        </div>
        <div class="inputForm">
            <input placeholder="Email@exemple.com" class="input" type="email" value="{{ old('email') }}" name="email"/>
            @error('email')
            <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div class="flex-column">
            <label>Mot de passe </label>
        </div>
        <div class="inputForm">
            <input placeholder="Entrez votre mot de passe" class="input" type="password" id="password" name="password" />
            @error('password')
            <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
            @enderror
        </div>
         <!-- Selcetion des communes d'abidjan -->
         <div class="flex-column">
            <x-input-label for="commune" :value="__('Commune')" />
        
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
            </script>          
        
            <x-input-error :messages="$errors->get('commune')" class="mt-2" />
        </div>

        <div class="flex-column">
            <label>Hôpital</label>
        </div>
        <div class="inputForm">
            <input placeholder="Entrezle nom de l'hôpital" class="input" type="text" id="password" name="nomHop" />
            @error('nomHop')
            <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
            @enderror
        </div>

        <!-- Photo de Profil -->
        <div class="flex-column">
            <label>Photo de Profil</label>
        </div>
        <div class="inputForm">
            <input type="file" name="profile_picture" accept="image/*" class="input" />
            @error('profile_picture')
            <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bouton d'inscription -->
        <button class="button-submit">S'Inscrire</button>
        
        <p class="p">Déjà inscrit?<span class="span"><a href="{{ route('doctor.login') }}">Connectez-vous</a></span></p>
        <p class="p line">Ou avec</p>
    
        <!-- Autres options d'inscription -->
        <div class="flex-row">
            <button class="btn google">
                Google
            </button>
        </div>
    </form>

</body>
</html>
