<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information sur le profil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #4a5568;
        }
        .mt-1 {
            margin-top: 8px;
        }
        .mt-6 {
            margin-top: 24px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        label {
            display: block;
            margin-bottom: 4px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn-primary {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
        }
        .btn-secondary {
            background-color: orange;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
        .text-sm {
            font-size: 14px;
        }
        .text-gray-600 {
            color: #718096;
        }
        .text-green-600 {
            color: #38a169;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Information sur le profil</h2>
    <p class="mt-1 text-sm text-gray-600">
        Mettez à jour les informations de profil et l'adresse électronique de votre compte.
    </p>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name">Nom</label>
            <input id="name" name="name" value="{{ old('name', $user->name) }}" type="text" required autofocus />
        </div>
        <div class="form-group">
            <label for="prenom">Prénoms</label>
            <input id="prenom" name="prenom"  value="{{ old('prenom', $user->prenom) }}" type="text" required autofocus />
        </div>
        <div class="form-group">
            <label for="commune">Commune</label>
            <select id="commune" name="commune" required>
                <option value="{{ old('commune', $user->commune) }}">{{ Auth::user()->commune }}</option>
                    <option value="abobo">Abobo</option>
                    <option value="adjame">Adjamé</option>
                    <option value="attecoube">Attécoubé</option>
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
                <!-- Ajoutez d'autres options si nécessaire -->
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" value="{{ old('email', $user->email) }}" type="email" required />
        </div>

        <div>
            <button type="submit" class="btn-primary">Enregistrer</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#commune').select2({
            placeholder: "Sélectionnez une commune",
            allowClear: true,
            width: '100%'
        });
    });
</script>

</body>
</html>