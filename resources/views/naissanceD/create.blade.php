@extends('utilisateur.layouts.template')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>

body {
        background-image: url('{{ asset('assets/images/profiles/arriereP.jpg') }}'); /* Remplacez par le chemin de votre image */
        background-size: cover; /* Pour couvrir l'ensemble de la zone */
        background-position: center; /* Centre l'image */
        min-height: 100vh; /* Hauteur minimale pour remplir la page */
    }
    /* Style pour le formulaire */
    .conteneurInfo {
        background: #ffffff;
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        max-width: 600px;
        margin: auto;
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    h1 {
        text-align: center;
        color: #1a5c58;
        margin-bottom: 1rem;
        font-size: 40px;
    }

    label {
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
    }

    button {
        width: 100%;
        padding: 1rem;
        font-size: 1rem;
        font-weight: bold;
        background-color: #3e8e41;
        border: none;
        border-radius: 8px;
        color: #ffffff;
        cursor: pointer;
        margin-top: 2rem;
    }

    button:hover {
        background-color: #144d4b;
    }

    .hidden {
        display: none;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .form-group {
        flex: 1; /* Prend tout l'espace disponible */
        margin-right: 1rem; /* Espacement entre les champs */
    }

    .form-group:last-child {
        margin-right: 0; /* Élimine l'espacement du dernier champ */
    }
</style>

@if (Session::get('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Succès',
        text: '{{ Session::get('success') }}',
        timer: 3000,
        showConfirmButton: false,
    });
</script>
@endif

@if (Session::get('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: '{{ Session::get('error') }}',
        timer: 3000,
        showConfirmButton: false,
    });
</script>
@endif

<div class="conteneurInfo">
    <h1>Demande d'Extrait de Naissance</h1>
    <form method="POST" action="{{ route('naissanced.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="type">Type de demande</label>
                <select id="type" name="type" class="form-control">
                    <option value="extrait_integral" {{ old('type') == 'extrait_integral' ? 'selected' : '' }}>Extrait intégral</option>
                    <option value="simple" {{ old('type') == 'simple' ? 'selected' : '' }}>Simple</option>
                </select>
                @error('type')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        
            <div class="form-group col-md-6">
                <label for="pour">Pour ?</label>
                <select id="pour" name="pour" class="form-control" onchange="updateFields()">
                    <option value="Moi" {{ old('pour') == 'Moi' ? 'selected' : '' }}>Moi</option>
                    <option value="une_autre_personne" {{ old('pour') == 'une_autre_personne' ? 'selected' : '' }}>Une autre personne</option>
                </select>
                @error('pour')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $userName) }}">
                    @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="prenom">Prénoms</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom', $userPrenom) }}">
                    @error('prenom')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <script>
                function updateFields() {
                    const pourSelect = document.getElementById('pour');
                    const nameInput = document.getElementById('name');
                    const prenomInput = document.getElementById('prenom');
                    
                    // Vérifie si "Moi" est sélectionné
                    if (pourSelect.value === 'Moi') {
                        nameInput.value = '{{ $userName }}'; // Remplit le champ avec le nom de l'utilisateur
                        prenomInput.value = '{{ $userPrenom }}'; // Remplit le champ avec le prénom de l'utilisateur
                    } else {
                        nameInput.value = ''; // Vide le champ si une autre option est sélectionnée
                        prenomInput.value = ''; // Vide le champ si une autre option est sélectionnée
                    }
                }
            
                // Appel initial pour mettre à jour les champs si "Moi" est déjà sélectionné
                document.addEventListener('DOMContentLoaded', updateFields);
            </script>

    <div class="form-row">
            <div class="form-group text-center">
                <label for="number">Numéro de registre</label>
                <input type="text" id="number" name="number" value="{{ old('number') }}">
                @error('number')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group text-center">
                <label for="DateR">Date de registre</label>
                <input type="date" id="DateR" name="DateR" value="{{ old('DateR') }}">
                @error('DateR')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
    </div>
    <div class="form-group text-center">
        <label for="CNI">Joindre Votre pièce d'identité</label>
        <input type="file" id="CNI" name="CNI">
        @error('CNI')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

        <button type="submit">Soumettre</button>
    </form>
</div>

@endsection