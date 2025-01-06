@extends('utilisateur.layouts.template')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body {
            background-image: url('{{ asset('assets/images/profiles/arriereP.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .conteneurInfo {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 900px;
            margin: auto;
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        h2 {
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

        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 0.8rem;
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

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-group {
            flex: 1;
            min-width: 48%; /* Pour que deux champs tiennent sur une ligne */
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
        <h2>Demande d'acte de Mariage</h2>
        <form id="demandeForm" method="POST" enctype="multipart/form-data" action="{{ route('mariage.store') }}">
            @csrf

            <div class="form-group">
                <label for="typeDemande">Type de demande</label>
                <select id="typeDemande" name="typeDemande" class="form-control">
                    <option value="extraitSimple">Extrait simple</option>
                    <option value="copieIntegrale">Copie intégrale</option>
                </select>
            </div>

            <div id="infoEpoux" class="hidden">
                <h3>Informations sur le conjoint(e)</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="nomEpoux">Nom du conjoint(e)</label>
                        <input type="text" id="nomEpoux" name="nomEpoux" class="form-control" placeholder="Entrez le nom de l'époux" >
                    </div>
                    <div class="form-group">
                        <label for="prenomEpoux">Prénom du conjoint(e)</label>
                        <input type="text" id="prenomEpoux" name="prenomEpoux" class="form-control" placeholder="Entrez le prénom de l'époux" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="dateNaissanceEpoux">Date de naissance du conjoint(e)</label>
                        <input type="date" id="dateNaissanceEpoux" name="dateNaissanceEpoux" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="lieuNaissanceEpoux">Lieu de naissance du conjoint(e)</label>
                        <input type="text" id="lieuNaissanceEpoux" name="lieuNaissanceEpoux" class="form-control" placeholder="Entrez le lieu de naissance" >
                    </div>
                </div>
            </div>

            <!-- Champ de commune de mariage -->
            <div class="form-row">
                <div class="form-group">
                    <label for="commune">Commune de mariage</label>
                    <select id="commune" name="commune" class="form-control">
                        <option value="{{ Auth::user()->commune }}">{{ Auth::user()->commune }}</option>
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
                    </select>
                </div>
                <div class="form-group">
                    <label for="pieceIdentite">Pièce d'identité</label>
                    <input type="file" id="pieceIdentite" name="pieceIdentite" class="form-control" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="extraitMariage">Extrait de mariage</label>
                    <input type="file" id="extraitMariage" name="extraitMariage" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="CMU">Numéro CMU</label>
                    <input type="text" id="CMU" value="{{ Auth::user()->CMU }}" name="CMU" placeholder="Entrez votre numéro CMU" class="form-control" required>
                </div>
           
        </div>
            <button type="submit">Soumettre</button>
        </form>
    </div>

    <script>
        document.getElementById('typeDemande').addEventListener('change', function() {
            const infoEpoux = document.getElementById('infoEpoux');
            infoEpoux.classList.toggle('hidden', this.value !== 'copieIntegrale');
        });
    </script>
@endsection
