<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - 404</title>
    <link rel="icon" href="{{ asset('assets/images/profiles/E-ci-logo.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: white;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        h1 {
            font-size: 6rem;
            color: #ff6b6b;
        }
        p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #007bfc;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #005bb5;
        }
        img{
            width: 200px;
        }
    </style>
</head>
<body>
    <div>
        <img src="{{ asset('assets4/img/E-ci.jpg') }}" alt="">
        <h1><span>Erreur</span> 404</h1>
        <p>Oups ! La page que vous cherchez n'existe pas.</p>
        <a href="{{ url('/') }}">Retour à l'accueil</a>
    </div>
</body>
</html>
