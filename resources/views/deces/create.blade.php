@extends('utilisateur.layouts.template')
@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.cinetpay.com/seamless/main.js"></script>
    <script src="{{ asset('js/cinetpay_deces.js') }}"></script>

    <style>
        :root {
            --primary: #1a5c58;
            --secondary: #3e8e41;
            --light: #f8f9fa;
            --dark: #343a40;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --transition: all 0.3s ease;
        }

        body {
            background-image: url('{{ asset('assets/images/profiles/arriereP.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .conteneurInfo {
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            margin: 40px auto;
            animation: fadeIn 0.6s ease-in-out;
            box-sizing: border-box;
            width: 80%;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            text-align: center;
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-size: 32px;
            font-weight: 700;
        }

        h4 {
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        label {
            font-weight: 600;
            color: var(--primary);
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-control, select, input[type="text"], input[type="file"], input[type="date"] {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f9f9f9;
            outline: none;
            box-sizing: border-box;
            transition: var(--transition);
            font-size: 1rem;
        }

        .form-control:focus, select:focus, input[type="text"]:focus, input[type="date"]:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 92, 88, 0.2);
        }

        button {
            padding: 1rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            background-color: var(--primary);
            border: none;
            border-radius: 10px;
            color: white;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        button:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .hidden {
            display: none !important;
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
            font-weight: normal;
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;
            transform: scale(1.2);
        }

        /* Styles pour les étapes */
        .steps-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .steps-container::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #e0e0e0;
            transform: translateY(-50%);
            z-index: 1;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            position: relative;
            z-index: 2;
            transition: var(--transition);
        }

        .step.active {
            background: var(--primary);
            transform: scale(1.1);
        }

        .step.completed {
            background: var(--success);
        }

        .step-label {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            margin-top: 8px;
            font-size: 0.8rem;
            white-space: nowrap;
            color: var(--dark);
            font-weight: 500;
        }

        .step-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .step-content.active {
            display: block;
        }

        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        /* Media queries for responsive design */
        @media (max-width: 768px) {
            .conteneurInfo {
                padding: 20px;
                margin: 20px;
            }

            h1 {
                font-size: 26px;
            }

            .form-group.half-width {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .form-row {
                flex-direction: column;
            }

            .step-label {
                font-size: 0.7rem;
            }
        }

        @media (max-width: 480px) {
            .conteneurInfo {
                padding: 15px;
                margin: 15px;
            }

            h1 {
                font-size: 22px;
            }
            
            .steps-container {
                margin-bottom: 1.5rem;
            }
            
            .step {
                width: 32px;
                height: 32px;
                font-size: 0.9rem;
            }
            
            .navigation-buttons {
                flex-direction: column;
                gap: 10px;
            }
            
            .navigation-buttons button {
                width: 100%;
            }
        }

        /* Styles pour le popup de livraison */
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

        .swal2-input {
            margin: 5px 0;
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
        
        <!-- Indicateur d'étapes -->
        <div class="steps-container">
            <div class="step active" id="step1-indicator">
                1
                <span class="step-label">Certificat</span>
            </div>
            <div class="step" id="step2-indicator">
                2
                <span class="step-label">Défunt</span>
            </div>
            <div class="step" id="step3-indicator">
                3
                <span class="step-label">Documents</span>
            </div>
            <div class="step" id="step4-indicator">
                4
                <span class="step-label">Livraison</span>
            </div>
        </div>

        <form id="declarationForm" method="POST" action="{{ route('deces.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Étape 1: Certificat médical -->
            <div class="step-content active" id="step1">
                <div class="form-group text-center">
                    <label for="dossierNum">N° Certificat médical de décès</label>
                    <input class="text-center" type="text" id="dossierNum" name="dossierNum"
                           value="{{ old('dossierNum') }}" placeholder="Ex: CMD1411782251" required>
                    @error('dossierNum')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="navigation-buttons">
                    <div></div> <!-- Empty div for spacing -->
                    <button type="button" onclick="validerCertificat()">Suivant</button>
                </div>
            </div>

            <!-- Étape 2: Informations sur le défunt -->
            <div class="step-content" id="step2">
                <div class="form-row">
                    <div class="form-group text-center">
                        <label for="nomHopital">Nom de l'Hôpital</label>
                        <input type="text" id="nomHopital" name="nomHopital" readonly>
                    </div>

                    <div class="form-group text-center">
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
                    <div class="form-group text-center">
                        <label for="lieuNaiss">Lieu de Naissance</label>
                        <input type="text" id="lieuNaiss" name="lieuNaiss" readonly>
                    </div>
                </div>

                <div class="navigation-buttons">
                    <button type="button" onclick="changeStep(1)">Précédent</button>
                    <button type="button" onclick="changeStep(3)">Suivant</button>
                </div>
            </div>

            <!-- Étape 3: Documents -->
            <div class="step-content" id="step3">
                <div class="form-group">
                    <label for="identiteDeclarant">Pièce d'Identité du défunt</label>
                    <input type="file" id="identiteDeclarant" name="identiteDeclarant" 
                           accept=".pdf,.jpg,.jpeg,.png" required>
                    <small class="text-muted">Formats acceptés: PNG, JPG, JPEG, PDF (max 1Mo)</small>
                    @error('identiteDeclarant')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="acteMariage">Certificat Médical de décès</label>
                        <input type="file" id="acteMariage" name="acteMariage" 
                               accept=".pdf,.jpg,.jpeg,.png" required>
                        <small class="text-muted">Formats acceptés: PNG, JPG, JPEG, PDF (max 1Mo)</small>
                        @error('acteMariage')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="deParLaLoi">De par la loi</label>
                        <input type="file" id="deParLaLoi" name="deParLaLoi" 
                               accept=".pdf,.jpg,.jpeg,.png">
                        <small class="text-muted">Formats acceptés: PNG, JPG, JPEG, PDF (max 1Mo)</small>
                        @error('deParLaLoi')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="navigation-buttons">
                    <button type="button" onclick="changeStep(2)">Précédent</button>
                    <button type="button" onclick="changeStep(4)">Suivant</button>
                </div>
            </div>

            <!-- Étape 4: Options de livraison -->
            <div class="step-content" id="step4">
                <div class="form-group text-center" id="optionsSection">
                    <p style="font-weight: bold; color: #1a5c58;">Choisissez le mode de retrait :</p>
                    <div class="form-row d-flex justify-content-center align-items-center gap-4">
                        <div class="radio-group">
                            <input type="radio" id="option1" name="choix_option" value="retrait_sur_place" checked required>
                            <label for="option1" class="mt-2">Retrait sur place</label>
                        </div>
                        <div class="radio-group">
                            <input type="radio" id="option2" name="choix_option" value="livraison" required>
                            <label for="option2" class="mt-2">Livraison</label>
                        </div>
                    </div>
                </div>

                <div class="navigation-buttons">
                    <button type="button" onclick="changeStep(3)">Précédent</button>
                    <button type="button" id="btnValider" onclick="validateAndSubmit()">Valider la demande</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let currentStep = 1;
        let isCertificatValid = false;

        $(document).ready(function () {
            // Validation en temps réel pour les fichiers
            $('#identiteDeclarant, #acteMariage, #deParLaLoi').on('change', function() {
                validateFile(this);
            });
        });

        function validateFile(input) {
            const file = input.files[0];
            const errorElement = $(input).nextAll('.error-message').first();
            
            if (!file) return;
            
            // Vérification de la taille (1Mo max)
            if (file.size > 1000000) {
                errorElement.text('Le fichier ne doit pas dépasser 1 Mo.');
                $(input).val('');
            } else {
                errorElement.text('');
            }
            
            // Vérification du type de fichier
            const validExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
            if (!validExtensions.includes(file.type)) {
                errorElement.text('Le format de fichier n\'est pas valide. Formats acceptés: JPG, JPEG, PNG, PDF.');
                $(input).val('');
            }
        }

        function changeStep(step) {
            // Valider l'étape actuelle avant de passer à la suivante
            if (step > currentStep && !validateStep(currentStep)) {
                return;
            }

            // Masquer l'étape actuelle
            $(`#step${currentStep}`).removeClass('active');
            $(`#step${currentStep}-indicator`).removeClass('active');

            // Afficher la nouvelle étape
            $(`#step${step}`).addClass('active');
            $(`#step${step}-indicator`).addClass('active');

            // Marquer les étapes précédentes comme complétées
            for (let i = 1; i < step; i++) {
                $(`#step${i}-indicator`).addClass('completed');
            }

            currentStep = step;
        }

        function validateStep(step) {
            let isValid = true;
            let errorMessage = '';
            
            switch(step) {
                case 1:
                    if (!$("#dossierNum").val().trim()) {
                        errorMessage = 'Veuillez entrer un numéro de certificat médical de décès.';
                        isValid = false;
                    }
                    break;
                    
                case 3:
                    if (!$("#identiteDeclarant").val()) {
                        errorMessage = 'Veuillez sélectionner la pièce d\'identité du défunt.';
                        isValid = false;
                    } else if (!$("#acteMariage").val()) {
                        errorMessage = 'Veuillez sélectionner le certificat médical de décès.';
                        isValid = false;
                    }
                    break;
            }
            
            if (!isValid && errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Champ(s) manquant(s)',
                    text: errorMessage,
                });
            }
            
            return isValid;
        }

        function validateAndSubmit() {
            // Valider toutes les étapes avant soumission
            for (let i = 1; i <= 4; i++) {
                if (!validateStep(i)) {
                    changeStep(i); // Revenir à l'étape avec erreur
                    return;
                }
            }

            // Vérifier le mode de retrait choisi
            if ($('input[name="choix_option"]:checked').val() === 'livraison') {
                showLivraisonPopup();
            } else {
                // Soumettre le formulaire directement pour retrait sur place
                document.getElementById('declarationForm').submit();
            }
        }

        function validerCertificat() {
            const dossierNum = $("#dossierNum").val();
            if (!dossierNum.trim()) {
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

                        isCertificatValid = true;
                        changeStep(2);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur',
                            text: 'Ce numéro <' + dossierNum + '> n\'existe pas.',
                        });
                    }
                },
                error: function () {
                    Swal.close();
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
                        <div><input id="swal-nom_destinataire" class="swal2-input text-center" placeholder="Nom du destinataire" required></div>
                        <div><input id="swal-prenom_destinataire" class="swal2-input text-center" placeholder="Prénom du destinataire" required></div>
                        <div><input id="swal-email_destinataire" class="swal2-input text-center" placeholder="Email du destinataire" type="email" required></div>
                        <div><input id="swal-contact_destinataire" class="swal2-input text-center" placeholder="Contact du destinataire" required></div>
                        <div><input id="swal-adresse_livraison" class="swal2-input text-center" placeholder="Adresse de livraison" required></div>
                        <div><input id="swal-code_postal" class="swal2-input text-center" placeholder="Code postal"></div>
                        <div><input id="swal-ville" class="swal2-input text-center" placeholder="Ville" required></div>
                        <div><input id="swal-commune_livraison" class="swal2-input text-center" placeholder="Commune" required></div>
                        <div><input id="swal-quartier" class="swal2-input text-center" placeholder="Quartier" required></div>
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

                    if (!nom_destinataire || !prenom_destinataire || !email_destinataire || !contact_destinataire || !adresse_livraison || !ville || !commune_livraison || !quartier || !montant_timbre || !montant_livraison) {
                        Swal.showValidationMessage("Veuillez remplir tous les champs obligatoires pour la livraison.");
                        return false;
                    }
                    
                    // Validation de l'email
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(email_destinataire)) {
                        Swal.showValidationMessage("Veuillez entrer une adresse email valide.");
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
                    initiateCinetPayPaymentDeces(formData, document.getElementById('declarationForm'));
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // Si l'utilisateur clique sur annuler, sélectionner l'option 1
                    document.getElementById('option1').checked = true;
                }
            });
        }
    </script>
@endsection