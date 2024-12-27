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

    input[type="text"], input[type="file"] {
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
        gap: 10px;
    }

    .half-width {
        flex: 1; 
        margin-right: 10px;
    }

    .half-width:last-child {
        margin-right: 0; 
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
    <h1>Demande d'acte de Décès</h1>
    <form method="POST" action="{{ route('deces.store') }}" enctype="multipart/form-data" id="declarationForm">
        @csrf

        <div class="form-group text-center">
            <label for="dossierNum">Numéro de Dossier Médical</label>
            <input type="text" id="dossierNum" name="dossierNum" value="{{ old('dossierNum') }}" placeholder="Ex: CMD1411782251">
            @error('dossierNum')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div id="infoDefunt" class="hidden">
            <div class="form-row">    
                <div class="form-group half-width text-center">
                    <label for="nomHopital">Nom de l'Hôpital</label>
                    <input type="text" id="nomHopital" name="nomHopital" readonly>
                </div>

                <div class="form-group half-width text-center">
                    <label for="nomDefunt">Nom du Défunt</label>
                    <input type="text" id="nomDefunt" name="nomDefunt" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group text-center">
                    <label for="dateNaiss">Date de Naissance</label>
                    <input type="text" id="dateNaiss" name="dateNaiss" readonly>
                </div>

                <div class="form-group text-center">
                    <label for="dateDeces">Date de Décès</label>
                    <input type="text" id="dateDces" name="dateDces" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group text-center half-width">
                    <label for="lieuNaiss">Lieu de Naissance</label>
                    <input type="text" id="lieuNaiss" name="lieuNaiss" readonly>
                </div>
                <div class="form-group half-width">
                    <label for="identiteDeclarant">Pièce d'Identité du défunt</label>
                    <input type="file" id="identiteDeclarant" name="identiteDeclarant">
                    @error('identiteDeclarant')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group text-center half-width">
                    <label for="identiteDeclarant">Certificat Médical de décès</label>
                    <input type="file" id="acteMariage" name="acteMariage">
                    @error('acteMariage')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group text-center half-width">
                    <label for="deParLaLoi">De par la loi</label>
                    <input type="file" id="deParLaLoi" name="deParLaLoi">
                    @error('deParLaLoi')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <button type="button" id="btnSuivant" onclick="validerFormulaire()">Suivant</button>
        <button type="submit" id="btnValider" class="hidden">Valider</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function validerFormulaire() {
        const dossierNum = document.getElementById("dossierNum").value;
        const infoDefunt = document.getElementById("infoDefunt");
        const btnSuivant = document.getElementById("btnSuivant");
        const btnValider = document.getElementById("btnValider");

        // Vérification si le numéro de dossier est vide
        if (dossierNum.trim() === "") {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Veuillez entrer un numéro de dossier médical.',
            });
            return;
        }

        // Affichage de la préloader pendant la vérification
        Swal.fire({
            title: 'Vérification en cours...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        // Envoi de la requête AJAX pour vérifier le code CMD
        $.ajax({
            url: "{{ route('deces.verifierCodeCMD') }}", // La route à utiliser
            method: "POST",
            data: {
                codeCMN: dossierNum,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                Swal.close(); // Ferme l'indicateur de chargement

                // Si le code est trouvé, afficher les informations du défunt
                if (response.existe) {
                    $("#nomHopital").val(response.nomHopital);
                    $("#nomDefunt").val(response.nomDefunt);
                    $("#dateNaiss").val(response.dateNaiss);
                    $("#dateDces").val(response.dateDeces);
                    $("#lieuNaiss").val(response.lieuNaiss);

                    // Afficher les informations et masquer les boutons
                    infoDefunt.classList.remove("hidden");
                    btnSuivant.classList.add("hidden");
                    btnValider.classList.remove("hidden");
                } else {
                    // Si le code n'existe pas, afficher une alerte d'erreur
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Numéro de dossier incorrect.',
                    });
                }
            },
            error: function(xhr) {
                Swal.close(); // Ferme l'indicateur de chargement
                console.error(xhr.responseText); // Affiche les erreurs dans la console
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Problème de connexion au serveur.',
                });
            }
        });
    }
</script>

@endsection
