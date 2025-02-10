@extends('utilisateur.layouts.template')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-image: url('{{ asset('assets/images/profiles/arriereP.jpg') }}');
            /* Remplacez par le chemin de votre image */
            background-size: cover;
            /* Pour couvrir l'ensemble de la zone */
            background-position: center;
            /* Centre l'image */
            min-height: 100vh;
            /* Hauteur minimale pour remplir la page */
        }

        /* Style pour le formulaire */
        .conteneurInfo {
            background: #ffffff;
            padding: 20px;
            /* Reduced padding for smaller screens */
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            margin: auto;
            animation: fadeIn 0.6s ease-in-out;
            box-sizing: border-box;
            /* Ensure padding is included in width */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        h1 {
            text-align: center;
            color: #1a5c58;
            margin-bottom: 1rem;
            font-size: 30px;
            /* Reduced font size for smaller screens */
        }

        label {
            font-weight: bold;
            color: #1a5c58;
            margin-top: 1rem;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f9f9f9;
            outline: none;
            box-sizing: border-box;
            /* Ensure padding is included in width */
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
            flex-wrap: wrap;
            /* Allow items to wrap */
        }

        .half-width {
            flex: 1;
            margin-right: 10px;
        }

        .half-width:last-child {
            margin-right: 0;
        }

        .radio-group {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .radio-group label {
            margin-left: 5px;
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;
            transform: scale(1.2);
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            /* Tablets and smaller */
            .conteneurInfo {
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            .titre{
                margin-top: 70px;
            }

            .form-row {
                flex-direction: column;
            }

            .half-width {
                margin-right: 0;
            }
        }

        @media (max-width: 480px) {
            /* Phones */
            .conteneurInfo {
                padding: 10px;
            }

            h1 {
                font-size: 20px;
            }
            .titre{
                margin-top: 80px;
            }
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
        <h1 class="titre">Demande d'acte de Décès</h1>
        <form method="POST" action="{{ route('deces.store') }}" enctype="multipart/form-data"
              id="declarationForm">
            @csrf

            <div class="form-group text-center">
                <label for="dossierNum" class="text-center">Numéro de Dossier Médical</label>
                <input type="text" class="text-center" id="dossierNum" name="dossierNum"
                       value="{{ old('dossierNum') }}" placeholder="Ex: CMD1411782251">
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
                    <div class="form-group half-width text-center">
                        <label for="dateNaiss">Date de Naissance</label>
                        <input type="text" id="dateNaiss" name="dateNaiss" readonly>
                    </div>

                    <div class="form-group half-width text-center">
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
                        <label for="acteMariage">Certificat Médical de décès</label>
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
                <!-- Options Radio -->
                <div class="form-group text-center" id="optionsSection">
                    <p style="font-weight: bold; color: #1a5c58;">Choisissez le mode de rétrait :</p>
                    <div class="form-row d-flex justify-content-center align-items-center gap-4">
                        <div class="radio-group">
                            <input type="radio" id="option1" name="choix_option" value="retrait_sur_place" checked
                                   required>
                            <label for="option1" class="mt-2">Retrait sur place</label>
                        </div>
                        <div class="radio-group">
                            <input type="radio" id="option2" name="choix_option" value="livraison" required>
                            <label for="option2" class="mt-2">Livraison</label>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="btnSuivant" onclick="validerFormulaire()">Suivant</button>
            <button type="submit" id="btnValider" class="hidden">Valider</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let formSubmitted = false;
        let submitAfterPopup = false;

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
                    text: 'Veuillez entrer un numéro de certificat médical de décès.',
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
                url: "{{ route('deces.verifierCodeCMD') }}",
                method: "POST",
                data: {
                    codeCMN: dossierNum,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    Swal.close();
                    // Ferme l'indicateur de chargement

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
                        const isFilled = $("#declarationForm input[required]").toArray().every(input => input.value.trim() !== "");
                        if (isFilled) {
                            $("#optionsSection").fadeIn();
                            // Afficher avec effet
                        }
                    } else {
                        // Si le code n'existe pas, afficher une alerte d'erreur
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: 'Ce numéro <' + dossierNum + '> n\'existe pas.',
                        });
                    }
                },
                error: function (xhr) {
                    Swal.close();
                    // Ferme l'indicateur de chargement
                    console.error(xhr.responseText);
                    // Affiche les erreurs dans la console
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Problème de connexion au serveur.',
                    });
                }
            });
        }

        function showLivraisonPopup() {
            Swal.fire({
                title: 'Informations de Livraison',
                width: '800px',
                html:
                    `<div style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 10px;">
                        <div>
                            <label for="swal-montant_timbre" style="font-weight: bold">Timbre</label>
                            <input id="swal-montant_timbre" class="swal2-input text-center" value="500" readonly>
                            <label for="swal-montant_timbre" style="font-size:13px; color:red">Pour la phase pilote les frais de timbre sont fournir par Kks-technologies</label>
                        </div>
                        <div>
                            <label for="swal-montant_livraison" style="font-weight: bold">Frais Livraison</label>
                            <input id="swal-montant_livraison" class="swal2-input text-center" value="1500" readonly>
                            <label for="swal-montant_livraison" style="font-size:13px; color:red">Pour la phase pilote les frais des livraisons sont fixés à 1500 Fcfa</label>
                        </div>
                        <div><input id="swal-nom_destinataire" class="swal2-input text-center" placeholder="Nom du destinataire"></div>
                        <div><input id="swal-prenom_destinataire" class="swal2-input text-center" placeholder="Prénom du destinataire"></div>
                        <div><input id="swal-email_destinataire" class="swal2-input text-center" placeholder="Email du destinataire"></div>
                        <div><input id="swal-contact_destinataire" class="swal2-input text-center" placeholder="Contact du destinataire"></div>
                        <div><input id="swal-adresse_livraison" class="swal2-input text-center" placeholder="Adresse de livraison"></div>
                        <div><input id="swal-code_postal" class="swal2-input text-center" placeholder="Code postal"></div>
                        <div><input id="swal-ville" class="swal2-input text-center" placeholder="Ville"></div>
                        <div><input id="swal-commune_livraison" class="swal2-input text-center" placeholder="Commune"></div>
                        <div><input id="swal-quartier" class="swal2-input text-center" placeholder="Quartier"></div>
                    </div>`,
                showCancelButton: true,
                confirmButtonText: 'Payer',
                cancelButtonText: 'Annuler',
                focusConfirm: false,
                preConfirm: () => {
                    const nom_destinataire = document.getElementById('swal-nom_destinataire').value;
                    const prenom_destinataire = document.getElementById('swal-prenom_destinataire').value;
                    const email_destinataire = document.getElementById('swal-email_destinataire').value;
                    const contact_destinataire = document.getElementById('swal-contact_destinataire').value;
                    const adresse_livraison = document.getElementById('swal-adresse_livraison').value;
                    const code_postal = document.getElementById('swal-code_postal').value;
                    const ville = document.getElementById('swal-ville').value;
                    const commune_livraison = document.getElementById('swal-commune_livraison').value;
                    const quartier = document.getElementById('swal-quartier').value;
                    const montant_timbre = document.getElementById('swal-montant_timbre').value;
                    const montant_livraison = document.getElementById('swal-montant_livraison').value;
                    if (!nom_destinataire || !prenom_destinataire || !email_destinataire || !contact_destinataire || !adresse_livraison || !code_postal || !ville || !commune_livraison || !quartier || !montant_timbre || !montant_livraison) {
                        Swal.showValidationMessage("Veuillez remplir tous les champs pour la livraison.");
                        return false;
                    }
                    return {
                        nom_destinataire: nom_destinataire,
                        prenom_destinataire: prenom_destinataire,
                        email_destinataire: email_destinataire,
                        contact_destinataire: contact_destinataire,
                        adresse_livraison: adresse_livraison,
                        code_postal: code_postal,
                        ville: ville,
                        commune_livraison: commune_livraison,
                        quartier: quartier,
                        montant_timbre: montant_timbre,
                        montant_livraison: montant_livraison,
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = result.value;
                    const form = document.getElementById('declarationForm');
                    for (const key in formData) {
                        if (formData.hasOwnProperty(key)) {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = key;
                            hiddenInput.value = formData[key];
                            form.appendChild(hiddenInput);
                        }
                    }
                    submitAfterPopup = true;
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    document.getElementById('option1').checked = true;
                    submitAfterPopup = false;
                }
            });
        }

        document.getElementById('declarationForm').addEventListener('submit', function (event) {
            if (formSubmitted) {
                event.preventDefault();
                return;
            }

            const livraisonCheckbox = document.getElementById('option2');
            if (livraisonCheckbox.checked && !submitAfterPopup) {
                event.preventDefault();
                showLivraisonPopup();
            } else {
                formSubmitted = true;
            }
        });
        $(document).ready(function() {
          $("#optionsSection").hide();
            // Fonction pour vérifier si tous les champs obligatoires sont remplis
            function checkFields() {
                const isFilled = $("#declarationForm input[required]").toArray().every(input => input.value.trim() !== "");
                if (isFilled) {
                     $("#optionsSection").fadeIn(); // Afficher avec effet
                } else {
                  $("#optionsSection").hide(); // Cacher si des champs sont vides
               }
        }
            // Écoutez les changements dans les champs du formulaire
            $("#declarationForm input").on("input change", checkFields);

            // Appel de la fonction initiale pour vérifier l'état des champs
            checkFields();
       });
    </script>

@endsection