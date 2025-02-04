<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    <form id="popupForm">
        @csrf
        <div>
            <input type="text" name="montant_timbre" value="500" class="text-center w-75 mb-2" readonly>
            <input type="text" name="montant_livraison" class="text-center mb-2" placeholder="Entrer le montant de la livraison" required>
            @error('montant_livraison')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <input type="text" name="adresse_livraison" placeholder="Adresse" class="text-center mb-2" required>
            @error('adresse_livraison')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <input type="text" name="name" placeholder="Nom du destinataire " class="text-center mb-2" required>
            @error('name')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <input type="text" name="prenom" placeholder="Prénom du destinataire" class="text-center mb-2" >
            @error('prenom')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <input type="text" name="contact" placeholder="Contact" class="text-center mb-2" >
            @error('contact')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <input type="email" name="email" placeholder="Email" class="text-center mb-2" >
            @error('email')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <input type="text" name="ville" placeholder="Ville" class="text-center mb-2" >
            @error('ville')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <input type="text" name="commune" placeholder="Commune" class="text-center mb-2" >
            @error('commune')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <input type="text" name="code_postal" placeholder="Code Postal" class="text-center mb-2" >
        </div>
    </form>
</body>
</html>