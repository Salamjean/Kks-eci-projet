@extends('utilisateur.layouts.template')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.cinetpay.com/seamless/main.js"></script>
    
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
            font-size: 40px; /* Taille par défaut pour les grands écrans */
        }

        label {
            font-weight: bold;
            color: #1a5c58;
            margin-top: 1rem;
        }

        input[type="text"], input[type="file"], select , input[type="date"] {
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
         .radio-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }
    .radio-group label {
        margin-left: 5px;
    }
     .radio-group input[type="radio"] {
        margin-right: 5px;
        transform: scale(1.2);
    }

        /* Styles pour les écrans de tablettes (768px à 1024px) */
        @media (max-width: 1024px) {
            h2 {
                margin: 50px 0 0 0;
                font-size: 32px; /* Taille réduite pour les tablettes */
            }
        }

        /* Styles pour les écrans de mobiles (moins de 768px) */
        @media (max-width: 767.98px) {
            h2 {
                margin: 70px 0 0 0;
                font-size: 24px; /* Taille réduite pour les mobiles */
            }
        }

        /* Styles pour les écrans d'ordinateurs plus petits (1024px à 1280px) */
        @media (min-width: 1024px) and (max-width: 1280px) {
            h2 {
                margin: 50px 0 0 0;
                font-size: 36px; /* Taille légèrement réduite pour les petits écrans d'ordinateurs */
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
                    <select id="commune" name="commune" class="form-control" >
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
                    <input type="file" id="pieceIdentite" name="pieceIdentite" class="form-control"  >
                    @error('pieceIdentite')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="extraitMariage">Extrait de mariage</label>
                    <input type="file" id="extraitMariage" name="extraitMariage" class="form-control" >
                    @error('extraitMariage')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group">
                    <label for="CMU">Numéro CMU</label>
                    <input type="text" id="CMU" value="{{ Auth::user()->CMU }}" name="CMU" placeholder="Entrez votre numéro CMU" class="form-control" >
                </div>
            </div>
            <!-- Options Radio -->
           <div class="form-group text-center" id="optionsSection">
                <p style="font-weight: bold; color: #1a5c58;">Choisissez le mode de rétrait :</p>
                <div class="form-row d-flex justify-content-center align-items-center gap-4">
                <div class="radio-group">
                    <input type="radio" id="option1" name="choix_option" value="retrait_sur_place" checked >
                    <label for="option1" class="mt-2">Retrait sur place</label>
                </div>
                <div class="radio-group">
                    <input type="radio" id="option2" name="choix_option" value="livraison" >
                    <label for="option2" class="mt-2">Livraison</label>
                </div>
                </div>
            </div>

            <button type="submit">Soumettre</button>
        </form>
    </div>

    <script>
        let formSubmitted = false;
        let submitAfterPopup = false;
       const optionsSection = document.getElementById('optionsSection');
        document.getElementById('typeDemande').addEventListener('change', function() {
            const infoEpoux = document.getElementById('infoEpoux');
            infoEpoux.classList.toggle('hidden', this.value !== 'copieIntegrale');
           
        });
        function showLivraisonPopup() {
    Swal.fire({
        title: 'Informations de Livraison',
        width: '700px',
        html: `
            <div style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 10px;">
                <div>
                    <label for="swal-montant_timbre" style="font-weight: bold">Timbre</label>
                    <input id="swal-montant_timbre" class="swal2-input text-center" value="50" readonly>
                    <label for="swal-montant_timbre" style="font-size:13px; color:red">Pour la phase pilote les frais de timbre sont fournir par Kks-technologies</label>
                </div>
                <div>
                    <label for="swal-montant_livraison" style="font-weight: bold">Frais Livraison</label>
                    <input id="swal-montant_livraison" class="swal2-input text-center" value="50" readonly>
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
            const totalAmount = parseFloat(formData.montant_timbre) + parseFloat(formData.montant_livraison); // Montant total

            // Configuration CinetPay
            CinetPay.setConfig({
                apikey: '521006956621e4e7a6a3d16.70681548', // Remplacez par votre APIKEY
                site_id: '935132', // Remplacez par votre SITE ID
                notify_url: 'http://mondomaine.com/notify/', // URL de notification
                mode: 'PRODUCTION' // ou 'TEST' pour le mode test
            });

            // Générer un ID de transaction unique
            const transactionId = Math.floor(Math.random() * 100000000).toString();

            // Lancer le paiement
            CinetPay.getCheckout({
                transaction_id: transactionId,
                amount: totalAmount,
                currency: 'XOF',
                channels: 'ALL',
                description: 'Paiement pour la livraison de l\'acte de mariage',
                customer_name: formData.nom_destinataire,
                customer_surname: formData.prenom_destinataire,
                customer_email: formData.email_destinataire,
                customer_phone_number: formData.contact_destinataire,
                customer_address: formData.adresse_livraison,
                customer_city: formData.ville,
                customer_country: 'CI',
                customer_state: 'CI',
                customer_zip_code: formData.code_postal,
            });

            // Gérer la réponse de CinetPay
            CinetPay.waitResponse(function(data) {
                if (data.status === "ACCEPTED") {
                    // Ajouter les données de livraison au formulaire
                    const form = document.getElementById('demandeForm');
                    for (const key in formData) {
                        if (formData.hasOwnProperty(key)) {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = key;
                            hiddenInput.value = formData[key];
                            form.appendChild(hiddenInput);
                        }
                    }
                    // Soumettre le formulaire
                    form.submit();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Le paiement a échoué. Veuillez réessayer.',
                    });
                }
            });

            CinetPay.onError(function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Une erreur s\'est produite lors du traitement du paiement.',
                });
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Si l'utilisateur clique sur annuler, sélectionner l'option 1
            document.getElementById('option1').checked = true;
        }
    });
}
document.getElementById('demandeForm').addEventListener('submit', function(event) {
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
      const isFilled = $("#demandeForm input[required], #demandeForm select").toArray().every(input => input.value.trim() !== "");
              if (isFilled) {
                  optionsSection.style.display = 'block';
              }
        });
    </script>
@endsection