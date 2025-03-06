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
        margin: 0;
        padding: 0;
    }

    .conteneurInfo {
        background: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        max-width: 800px;
        margin: 20px auto;
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    h2 {
        text-align: center;
        color: #1a5c58;
        margin-bottom: 1rem;
        font-size: 30px;
    }

    label {
        font-weight: bold;
        color: #1a5c58;
        display: block;
        margin-bottom: 0.3rem;
    }

    select, input[type="text"], input[type="file"], input[type="date"] {
        width: 100%;
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 10px;
        background: #f9f9f9;
        outline: none;
    }

    button {
        width: 100%;
        padding: 0.8rem;
        font-size: 0.9rem;
        font-weight: bold;
        background-color: #3e8e41;
        border: none;
        border-radius: 8px;
        color: #ffffff;
        cursor: pointer;
        margin-top: 1.5rem;
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
        margin-bottom: 1rem;
    }

    .form-group {
        padding: 0.5rem;
        flex: 1 1 100%;
    }

    @media (min-width: 768px) {
        .form-group {
            flex: 0 0 50%; /* Deux colonnes */
        }
        .titre{
            margin-top: 45px;
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
    <h2 class="titre text-center">Demande d'Extrait de Naissance</h2>
    <form id="naissanceForm" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <div class="form-group half-width">
                <label for="pour">Pour ?</label>
                <select id="pour" name="pour" class="form-control" onchange="updateFields()">
                    <option value="Moi" {{ old('pour') == 'Moi' ? 'selected' : '' }}>Moi</option>
                    <option value="une_autre_personne" {{ old('pour') == 'une_autre_personne' ? 'selected' : '' }}>Une autre personne</option>
                </select>
                @error('pour')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group half-width">
                <label for="type">Type de demande</label>
                <select id="type" name="type" class="form-control">
                    <option value="simple" {{ old('type') == 'simple' ? 'selected' : '' }}>Simple</option>
                    <option value="extrait_integral" {{ old('type') == 'extrait_integral' ? 'selected' : '' }}>Extrait intégral</option>
                </select>
                @error('type')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group half-width">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $userName) }}" >
                @error('name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group half-width">
                <label for="prenom">Prénoms</label>
                <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom', $userPrenom) }}" >
                @error('prenom')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group half-width">
                <label for="number">Numéro de registre</label>
                <input type="text" id="number" name="number" class="form-control" value="{{ old('number') }}" >
                @error('number')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group half-width">
                <label for="DateR">Date de registre</label>
                <input type="date" id="DateR" name="DateR" class="form-control" value="{{ old('DateR') }}" >
                @error('DateR')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group half-width">
                <label for="commune">Commune</label>
                <input type="text" id="commune" name="commune" class="form-control" value="{{ old('commune', $userCommune) }}" >
                @error('commune')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group half-width">
                <label for="CNI">Pièce d'identité (demandeur)</label>
                <input type="file" id="CNI" name="CNI" class="form-control" >
                @error('CNI')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="CMU">Numéro CMU</label>
            <input type="text" id="CMU" name="CMU" class="form-control" value="{{ old('CMU', $userCMU) }}" >
            @error('CMU')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Options Radio -->
        <div class="form-group text-center" id="optionsSection">
            <p style="font-weight: bold; color: #1a5c58;">Choisissez le mode de retrait :</p>
            <div class="form-row d-flex justify-content-center align-items-center gap-4 justify-content-md-around">
                <div class="radio-group">
                    <input type="radio" id="option1" name="choix_option" value="retrait_sur_place" checked >
                    <label for="option1" class="">Retrait sur place</label>
                </div>
                <div class="radio-group">
                    <input type="radio" id="option2" name="choix_option" value="livraison" >
                    <label for="option2" class="">Livraison</label>
                </div>
            </div>
        </div>

        <!-- Boutons -->
        <button type="submit" id="btnValider">Valider</button>
    </form>
</div>

<script>
    let formSubmitted = false;

    function updateFields() {
        const pourSelect = document.getElementById('pour');
        const nameInput = document.getElementById('name');
        const prenomInput = document.getElementById('prenom');
        const communeInput = document.getElementById('commune');
        const CMUInput = document.getElementById('CMU');

        if (pourSelect.value === 'Moi') {
            nameInput.value = '{{ $userName }}';
            prenomInput.value = '{{ $userPrenom }}';
            communeInput.value = '{{ $userCommune }}';
            CMUInput.value = '{{ $userCMU }}';
        } else {
            nameInput.value = '';
            prenomInput.value = '';
            communeInput.value = '';
            CMUInput.value = '';
        }
    }
    document.addEventListener('DOMContentLoaded', updateFields);

    document.getElementById('naissanceForm').addEventListener('submit', function(event) {
        if (formSubmitted) {
            event.preventDefault();
            return;
        }

        const livraisonCheckbox = document.getElementById('option2');
        if (livraisonCheckbox.checked) {
            event.preventDefault();
            showPaymentPopup();
        } else {
            formSubmitted = true;
            this.submit();
        }
    });

    function showPaymentPopup() {
        Swal.fire({
            title: 'Confirmer le paiement',
            width: '700px',
            html:
                    `<div class="swal-grid">
                        <div>
                            <label for="swal-montant_timbre" style="font-weight: bold">Timbre</label>
                            <input id="swal-montant_timbre" class="swal2-input text-center" value="150" readonly>
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
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, payer!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                const montantTimbre = parseFloat(document.getElementById('swal-montant_timbre').value);
                const montantLivraison = parseFloat(document.getElementById('swal-montant_livraison').value);
                const nomDestinataire = document.getElementById('swal-nom_destinataire').value;
                const prenomDestinataire = document.getElementById('swal-prenom_destinataire').value;
                const emailDestinataire = document.getElementById('swal-email_destinataire').value;
                const contactDestinataire = document.getElementById('swal-contact_destinataire').value;
                const adresseLivraison = document.getElementById('swal-adresse_livraison').value;
                const codePostal = document.getElementById('swal-code_postal').value;
                const ville = document.getElementById('swal-ville').value;
                const communeLivraison = document.getElementById('swal-commune_livraison').value;
                const quartier = document.getElementById('swal-quartier').value;

                const formData = new FormData(document.getElementById('naissanceForm'));
                const transactionId = Math.floor(Math.random() * 100000000).toString(); // ID de transaction

                // Ajoutez les informations de livraison dans formData
                formData.append('montant_timbre', montantTimbre);
                formData.append('montant_livraison', montantLivraison);
                formData.append('nom_destinataire', nomDestinataire);
                formData.append('prenom_destinataire', prenomDestinataire);
                formData.append('email_destinataire', emailDestinataire);
                formData.append('contact_destinataire', contactDestinataire);
                formData.append('adresse_livraison', adresseLivraison);
                formData.append('code_postal', codePostal);
                formData.append('ville', ville);
                formData.append('commune_livraison', communeLivraison);
                formData.append('quartier', quartier);

                const totalAmount = montantTimbre + montantLivraison; // Montant total

                // Configuration CinetPay et soumission
                CinetPay.setConfig({
                    apikey: '521006956621e4e7a6a3d16.70681548', // Remplacez par votre APIKEY
                    site_id: '935132', // Remplacez par votre SITE ID
                    notify_url: 'http://mondomaine.com/notify/',
                    mode: 'PRODUCTION'
                });

                CinetPay.getCheckout({
                    transaction_id: transactionId,
                    amount: totalAmount,
                    currency: 'XOF',
                    channels: 'ALL',
                    description: 'Demande d\'extrait de naissance',
                    customer_name: formData.get('name'),
                    customer_surname: formData.get('prenom'),
                    customer_email: '{{ auth()->user()->email }}',
                    customer_phone_number: '{{ auth()->user()->phone }}',
                    customer_address: formData.get('commune'),
                    customer_city: formData.get('commune'),
                    customer_country: 'CI',
                    customer_state: 'CI',
                    customer_zip_code: '225',
                });

                CinetPay.waitResponse(function(data) {
                    if (data.status === "ACCEPTED") {
                        formSubmitted = true; // Soumettre le formulaire après le paiement réussi
                        // Soumettez le formulaire avec les nouvelles données
                        document.getElementById('naissanceForm').submit();
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