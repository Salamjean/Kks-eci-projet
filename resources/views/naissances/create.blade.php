@extends('utilisateur.layouts.template')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-image: url('{{ asset('assets/images/profiles/arriereP.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .conteneurInfo {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            margin: auto;
            animation: fadeIn 0.6s ease-in-out;
            box-sizing: border-box;
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
        }

        h4 {
            font-weight: bold;
        }

        label {
            font-weight: bold;
            color: #1a5c58;
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-control,
        select,
        input[type="text"],
        input[type="file"],
        input[type="date"] {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f9f9f9;
            outline: none;
            box-sizing: border-box;
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
            flex-wrap: wrap;
            margin: 0 -0.5rem;
        }

        .form-group {
            padding: 0.5rem;
            flex: 1;
            box-sizing: border-box;
        }

        .form-group.half-width {
            flex: 0 0 50%;
            max-width: 50%;
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

        /* Media queries for responsive design */
        @media (max-width: 768px) {
            .conteneurInfo {
                padding: 15px;
            }

            h1 {
                font-size: 24px;
                margin-top: 30px;
            }

            .titre{
                margin-top: 70px;
            }

            .form-group.half-width {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .form-row {
                flex-direction: column;
            }

            .form-group {
                width: 100%;
                margin-right: 0;
                min-width: auto;
            }
        }

        @media (max-width: 480px) {
            .conteneurInfo {
                padding: 10px;
            }

            h1 {
                font-size: 20px;
                margin-top: 30px;
            }
            .titre{
                margin-top: 100px;
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
        <h1 class="titre">Demande d'acte de Naissance</h1>
        <form id="naissanceForm" method="POST" action="{{ route('naissance.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="form-group text-center">
                <label for="dossierNum">Numéro de Dossier Médical</label>
                <input class="text-center" type="text" id="dossierNum" name="dossierNum"
                       value="{{ old('dossierNum') }}" placeholder="Ex: CMN1411782251" required>
                @error('dossierNum')
                <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            <div id="infoDefunt" class="hidden">
                <div class="form-group text-center">
                    <label for="nomHopital">Nom de l'Hôpital</label>
                    <input class="text-center" type="text" id="nomHopital" name="nomHopital" readonly>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nomDefunt">Nom et Prénom de la Mère</label>
                        <input type="text" id="nomDefunt" name="nomDefunt" readonly>
                    </div>
                    <div class="form-group">
                        <label for="dateNaiss">Nom et Prénom de l'accompagnateur</label>
                        <input type="text" id="dateNaiss" name="dateNaiss" readonly>
                    </div>
                </div>

                <h4 class="text-center">Les informations concernant l'enfant</h4>
                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="lieuNaiss">Date de Naissance de l'Enfant</label>
                        <input type="text" id="lieuNaiss" name="lieuNaiss" readonly>
                    </div>
                    <div class="form-group half-width">
                        <label for="nom">Nom du nouveau né</label>
                        <input type="text" id="nom" name="nom" placeholder="Entrez le nom du nouveau né">
                        @error('nom')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénoms du nouveau né</label>
                        <input type="text" id="prenom" name="prenom" placeholder="Entrez les prénoms du nouveau né">
                        @error('prenom')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <h4 class="text-center">Les informations concernant le père</h4>
                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="nompere">Nom du père</label>
                        <input type="text" id="nompere" name="nompere" placeholder="Entrez le nom du père">
                        @error('nompere')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group half-width">
                        <label for="prenompere">Prénoms du père</label>
                        <input type="text" id="prenompere" name="prenompere"
                               placeholder="Entrez les prénoms du père">
                        @error('identiteDeclarant')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group half-width">
                        <label for="datepere">Date de naissance du père</label>
                        <input type="date" id="datepere" name="datepere">
                        @error('identiteDeclarant')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group half-width">
                        <label for="identiteDeclarant">Pièce d'Identité du Père</label>
                        <input type="file" id="identiteDeclarant" name="identiteDeclarant"
                               accept=".pdf, .jpg, .jpeg, .png, .gif">
                        @error('identiteDeclarant')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group text-center">
                    <label for="cdnaiss">Certificat de Déclaration de Naissance</label>
                    <input type="file" id="cdnaiss" name="cdnaiss" accept=".pdf, .jpg, .jpeg, .png, .gif">
                    @error('cdnaiss')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
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

            <!-- Boutons -->
            <button type="button" id="btnSuivant" onclick="validerFormulaire()">Suivant</button>
            <button type="submit" id="btnValider" class="hidden">Valider</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Cacher la section des options par défaut
            $("#optionsSection").hide();

            // Fonction pour vérifier si tous les champs obligatoires sont remplis
            function checkFields() {
                const isFilled = $("#naissanceForm input[required]").toArray().every(input => input.value.trim() !== "");
                if (isFilled) {
                    $("#optionsSection").fadeIn();  // Afficher avec effet
                } else {
                    $("#optionsSection").hide();   // Cacher si des champs sont vides
                }
            }

            // Écoutez les changements dans les champs du formulaire
            $("#naissanceForm input").on("input change", checkFields);

            // Appel de la fonction initiale pour vérifier l'état des champs
            checkFields();

            // Gestion de la soumission du formulaire
            $("#naissanceForm").submit(function (event) {
                event.preventDefault();  // Empêcher la soumission standard du formulaire

                if ($('input[name="choix_option"]:checked').val() === 'livraison') {
                    showLivraisonPopup();
                } else {
                    this.submit();
                }
            });
        });

        function validerFormulaire() {
            const dossierNum = $("#dossierNum").val();
            if (!dossierNum.trim()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Veuillez entrer un numéro de certificat médical de naissance.',
                });
                return;
            }

            $.ajax({
                url: "{{ route('verifierCodeDM') }}",
                method: "POST",
                data: {
                    codeCMN: dossierNum,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.existe) {
                        $("#nomHopital").val(response.nomHopital);
                        $("#nomDefunt").val(response.nomMere);
                        $("#dateNaiss").val(response.nomPere);
                        $("#lieuNaiss").val(response.dateNaiss);

                        $("#infoDefunt").removeClass("hidden");
                        $("#btnSuivant").addClass("hidden");
                        $("#btnValider").removeClass("hidden");
                        checkFields(); // Vérifiez les champs après la réponse
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: 'Ce numéro <' + dossierNum + '> n\'existe pas.',
                        });
                    }
                },
                error: function () {
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
                    // Ajout des données de livraison au formulaire
                    const formData = result.value;
                    const form = document.getElementById('naissanceForm');
                    for (const key in formData) {
                        if (formData.hasOwnProperty(key)) {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = key;
                            hiddenInput.value = formData[key];
                            form.appendChild(hiddenInput)
                        }
                    }
                    // Soumission du formulaire
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // Si l'utilisateur clique sur annuler, selectionner l'option 1
                    document.getElementById('option1').checked = true;
                }
            });
        }
    </script>
<style>
/* Styles par défaut (écrans larges) */
.swal-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Deux colonnes sur les écrans larges */
    gap: 10px;
}

/* Media query pour les écrans de taille moyenne et petits (tablettes et mobiles) */
@media (max-width: 767px) {
    .swal-grid {
        grid-template-columns: 1fr; /* Une seule colonne sur les petits écrans */
    }
}
</style>
@endsection