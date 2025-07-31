@extends('utilisateur.layouts.template')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.cinetpay.com/seamless/main.js"></script>
    <script src="{{ asset('js/cinetpay_deces.js') }}"></script> {{-- Include cinetpay_deces.js --}}
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
            padding: 1rem;
            font-size: 1rem;
            font-weight: bold;
            background-color: #3e8e41;
            border: none;
            border-radius: 8px;
            color: #ffffff;
            cursor: pointer;
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
        <h1 class="titre">Demande d'extrait de décès</h1>
        <form method="POST" action="{{ route('deces.store') }}" enctype="multipart/form-data"
              id="declarationForm">
            @csrf

            <div class="form-group text-center">
                <label for="dossierNum" class="text-center">N° Certificat médical de décès</label>
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

            <button type="button" id="btnSuivant" onclick="validerFormulaire()" style="width: 100%">Suivant</button>
            <button type="submit" id="btnValider" class="hidden" style="width: 100%">Valider</button>
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

            if (dossierNum.trim() === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez entrer un numéro de certificat médical de décès.',
                });
                return;
            }

            Swal.fire({
                title: 'Vérification en cours...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: "{{ route('deces.verifierCodeCMD') }}",
                method: "POST",
                data: {
                    codeCMN: dossierNum,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    Swal.close();
                    if (response.existe) {
                        $("#nomHopital").val(response.nomHopital);
                        $("#nomDefunt").val(response.nomDefunt);
                        $("#dateNaiss").val(response.dateNaiss);
                        $("#dateDces").val(response.dateDeces);
                        $("#lieuNaiss").val(response.lieuNaiss);

                        infoDefunt.classList.remove("hidden");
                        btnSuivant.classList.add("hidden");
                        btnValider.classList.remove("hidden");
                        const isFilled = $("#declarationForm input[required]").toArray().every(input => input.value.trim() !== "");
                        if (isFilled) {
                            $("#optionsSection").fadeIn();
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: 'Ce numéro <' + dossierNum + '> n\'existe pas.',
                        });
                    }
                },
                error: function (xhr) {
                    Swal.close();
                    console.error(xhr.responseText);
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
                width: '700px',
                html: `
                    <div class="swal-grid">
                        <div>
                            <label for="swal-montant_timbre" style="font-weight: bold">Timbre</label>
                            <input id="swal-montant_timbre" class="swal2-input text-center" value="50" readonly>
                            <label for="swal-montant_timbre" style="font-size:13px; color:red">Pour la phase pilote les frais de timbre sont fournis par Kks-technologies</label>
                        </div>
                        <div>
                            <label for="swal-montant_livraison" style="font-weight: bold">Frais Livraison</label>
                            <input id="swal-montant_livraison" class="swal2-input text-center" value="50" readonly>
                            <label for="swal-montant_livraison" style="font-size:13px; color:red">Pour la phase pilote les frais de livraison sont fixés à 1500 Fcfa</label>
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
                    icon: 'warning',
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
                    initiateCinetPayPaymentDeces(formData, form); // Call the function from cinetpay_deces.js
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    document.getElementById('option1').checked = true;
                    submitAfterPopup = false;
                }
            });
        }

        document.getElementById('declarationForm').addEventListener('submit', function(event) {
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
            function checkFields() {
                const isFilled = $("#declarationForm input[required]").toArray().every(input => input.value.trim() !== "");
                if (isFilled) {
                    $("#optionsSection").fadeIn();
                } else {
                    $("#optionsSection").hide();
                }
            }
            $("#declarationForm input").on("input change", checkFields);
            checkFields();
        });
    </script>

    <style>
        .swal-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        @media (max-width: 767px) {
            .swal-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection