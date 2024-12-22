<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Déclaration d'Acte de Décès</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
        }
        .conteneurInfo {
            width: 100%;
            max-width: 650px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            animation: fadeIn 1s ease;
        }
        h1 {
            font-size: 2rem;
            color: #1a5c58;
            text-align: center;
            margin-bottom: 1rem;
        }
        label {
            display: block;
            font-weight: bold;
            color: #1a5c58;
            margin-top: 1rem;
        }
        input[type="text"], input[type="file"],input[type="date"], select {
            width: 100%;
            padding: 0.8rem;
            margin-top: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f9f9f9;
            outline: none;
            transition: all 0.3s ease;
        }
        select {
            padding: 0.8rem;
        }
        .radio-group {
            display: flex;
            gap: 1rem;
        }
        .radio-group input[type="radio"] {
            margin-top: 0;
        }
        button {
            background-color: #3e8e41;
            color: #ffffff;
            cursor: pointer;
            margin-top: 1rem;
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 10px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #144d4b;
        }
        .hidden {
            display: none;
        }
        .modal {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

    <form class="conteneurInfo" id="declarationForm" method="POST" enctype="multipart/form-data" action="{{ route('deces.storedeja') }}">
        @csrf
        <h1>Demande d'Acte de Décès deja existant</h1>

        
        
          <div class="form-group">
            <label for="pieceIdentite">Entrez votre nom et Prenoms du défunt</label>
            <input type="text" id="pieceIdentite" name="name" >
          </div>
  
          <div class="form-group">
            <label for="extraitMariage">Entrez le numéro de registre</label>
            <input type="text" id="extraitMariage" name="numberR" >
          </div>
          <div class="form-group">
            <label for="extraitMariage">Entrez la date de registre</label>
            <input type="date" id="extraitMariage" name="dateR" >
          </div>
          <div class="form-group">
            <label for="extraitMariage">N° du Certificat Médical de décès</label>
            <input type="text" id="extraitMariage" name="CMD" >
          </div>
          <div class="form-group">
            <label for="extraitMariage">Joindre le premier acte de décès</label>
            <input type="file" id="extraitMariage" name="pActe" >
          </div>
          
  
          <form method="POST" action="{{ route('deces.storedeja') }}">
            @csrf
            <!-- Vos champs de formulaire ici -->
            <button type="submit">Soumettre</button>
        </form>
</body>
</html>
