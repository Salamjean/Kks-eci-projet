@extends('utilisateur.layouts.template')

@section('title', 'Demande d\'Acte de Décès')

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
        max-width: 600px;
        margin: auto;
        animation: fadeIn 0.6s ease-in-out;
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
        display: block;
    }

    select,
    [type="text"],
    input[type="file"],
    input[type="date"] {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 10px;
        background: #f9f9f9;
        outline: none;
        margin-bottom: 1rem;
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
        justify-content: space-between;
    }

    .form-group {
        flex: 1;
        margin-right: 10px;
    }

    .form-group:last-child {
        margin-right: 0;
    }

    .radio-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1rem;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>

<div class="conteneurInfo">
    <h1>Demande d'acte de Décès</h1>
    <form id="declarationForm" method="POST" enctype="multipart/form-data" action="{{ route('deces.storedeja') }}">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label for="name">Nom et Prénoms du Défunt</label>
                <input type="text" id="name" name="name" placeholder="Exemple : Jean Dupont" required>
            </div>
            <div class="form-group">
                <label for="numberR">Numéro de Registre</label>
                <input type="text" id="numberR" name="numberR" placeholder="Exemple : 123456" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="dateR">Date de Registre</label>
                <input type="date" id="dateR" name="dateR" required>
            </div>
            <div class="form-group">
                <label for="commune">Commune sur l'extrait</label>
                <select id="commune" name="communeD" required>
                    <option value="">Selectionnez la commune</option>
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
                            <option value="abobo-baoule">Abobo-Baoule</option>
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
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="pActe">Certificat Médical de Décès</label>
                <input type="file" id="pActe" name="pActe" accept=".pdf,.jpg,.png" required>
            </div>
            <div class="form-group">
                <label for="CMU">Numéro CMU du demandeur</label>
                <input type="text" id="CMU" name="CMU" value="{{ Auth::user()->CMU }}" placeholder="Entrez votre numéro CMU" required>
            </div>
        </div>

        <label>Photocopie des documents :</label>
        <div class="form-row">
        <div class="form-group">
            <label for="CNIdfnt">CNI/extrait de naissance du défunt(e)</label>
            <input type="file" name="CNIdfnt" id="CNIdfnt" required>
        </div>
        <div class="form-group">
           <label for="CNIdcl">CNI du déclarant</label>
           <input type="file" name="CNIdcl" id="CNIdcl" required>
        </div>
        </div>

        <!-- Groupe de boutons radio : Mariage -->
        <div>
            <label>Le défunt était-il marié ?</label>
            <div style="display: flex; gap: 10px;">
                <label for="oui">Oui</label>
                <input type="radio" id="oui" name="married" value="oui">
                <label for="non">Non</label>
                <input type="radio" id="non" name="married" value="non">
            </div>
            <div id="married-file-inputs-container"></div>
        </div>

        <!-- Groupe de boutons radio : Décès hors centre de santé -->
        <div>
            <label>Le défunt est-il décédé hors d'un centre de santé ?</label>
            <div style="display: flex; gap: 10px;">
                <label for="ouiHorsS">Oui</label>
                <input type="radio" id="ouiHorsS" name="DecesHorsS" value="oui">
                <label for="nonHorsS">Non</label>
                <input type="radio" id="nonHorsS" name="DecesHorsS" value="non">
            </div>
            <div id="deces-file-inputs-container"></div>
        </div>

        <button type="submit">Soumettre</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Mariage radio buttons
        const marriedYes = document.getElementById('oui');
        const marriedNo = document.getElementById('non');
        const marriedFileInputsContainer = document.getElementById('married-file-inputs-container');

        // Décès hors centre de santé radio buttons
        const horsSYes = document.getElementById('ouiHorsS');
        const horsSNo = document.getElementById('nonHorsS');
        const decesFileInputsContainer = document.getElementById('deces-file-inputs-container');

        // Contenu des champs conditionnels
        const marriageFields =
         `
            <div class="form-group">
                <label for="documentMariage">Photocopie de document de mariage pour le défunt(e)</label>
                <input type="file" id="documentMariage" name="documentMariage" required>
            </div>
        `;

        const decesFields = `
            <div class="form-group">
                <label for="RequisPolice">Photocopie de la réquisition de la police</label>
                <input type="file" id="RequisPolice" name="RequisPolice" required>
            </div>
        `;

        // Gestion des champs conditionnels
        marriedYes.addEventListener('change', () => {
            marriedFileInputsContainer.innerHTML = marriageFields;
        });
        marriedNo.addEventListener('change', () => {
            marriedFileInputsContainer.innerHTML = '';
        });

        horsSYes.addEventListener('change', () => {
            decesFileInputsContainer.innerHTML = decesFields;
        });
        horsSNo.addEventListener('change', () => {
            decesFileInputsContainer.innerHTML = '';
        });
    });
</script>



@endsection