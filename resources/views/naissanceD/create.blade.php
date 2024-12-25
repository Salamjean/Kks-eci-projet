@extends('utilisateur.layouts.template')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
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
        }

        label {
            font-weight: bold;
            color: #1a5c58;
            margin-top: 1rem;
        }

        input[type="text"], input[type="file"], select {
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

            <div class="form-group">
                <label for="type">Type de Déclaration</label>
                <select id="type" name="type" class="form-control">
                    <option value="extrait_integral" {{ old('type') == 'extrait_integral' ? 'selected' : '' }}>Extrait intégral</option>
                    <option value="simple" {{ old('type') == 'simple' ? 'selected' : '' }}>Simple</option>
                </select>
                @error('type')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Nom et Prénoms</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="number">Numéro d'Extrait de Naissance</label>
                <input type="text" id="number" name="number" value="{{ old('number') }}">
                @error('number')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Soumettre</button>
        </form>
    </div>

@endsection
