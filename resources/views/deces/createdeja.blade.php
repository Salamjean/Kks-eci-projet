@extends('utilisateur.layouts.template')

@section('title', 'Demande d\'Acte de Décès')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    /* Styles spécifiques au formulaire */
    .conteneurInfo {
        background: #ffffff;
        padding: 30px 40px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        max-width: 600px;
        margin: auto;
        animation: fadeIn 0.6s ease-in-out;
    }

    h1 {
        text-align: center;
        color: #1a5c58;
        margin-bottom: 1rem;
    }

    label {
        font-weight: bold;
        color: #1a5c58;
        margin-top: 1rem;
    }

    input[type="text"], input[type="file"], input[type="date"] {
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

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
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
    <h1>Formulaire de Demande d'Acte de Décès</h1>
    <form id="declarationForm" method="POST" enctype="multipart/form-data" action="{{ route('deces.storedeja') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nom et Prénoms du Défunt</label>
            <input type="text" id="name" name="name" placeholder="Exemple : Jean Dupont" required>
        </div>

        <div class="form-group">
            <label for="numberR">Numéro de Registre</label>
            <input type="text" id="numberR" name="numberR" placeholder="Exemple : 123456" required>
        </div>

        <div class="form-group">
            <label for="dateR">Date de Registre</label>
            <input type="date" id="dateR" name="dateR" required>
        </div>

        <div class="form-group">
            <label for="CMD">Numéro du Certificat Médical de Décès</label>
            <input type="text" id="CMD" name="CMD" placeholder="Exemple : CMD-2023-001" required>
        </div>

        <div class="form-group">
            <label for="pActe">Joindre le Premier Acte de Décès (Scan ou PDF)</label>
            <input type="file" id="pActe" name="pActe" accept=".pdf,.jpg,.png" required>
        </div>

        <button type="submit">Soumettre la Demande</button>
    </form>
</div>

@endsection