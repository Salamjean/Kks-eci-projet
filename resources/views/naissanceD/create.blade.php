@extends('utilisateur.layouts.template')

@section('content')

<!-- Inclure SweetAlert2 et CinetPay -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.cinetpay.com/seamless/main.js"></script>

<!-- Inclure le fichier JavaScript externe pour CinetPay -->
<script src="{{ asset('js/cinetpay.js') }}"></script>

<style>
    :root {
        --primary: #008000; /* Vert */
        --secondary: #ffa500; /* Orange */
        --light: #ffffff; /* Blanc */
        --dark: #2c3e50; /* Texte foncé */
        --light-gray: #f8f9fa;
        --border-radius: 12px;
        --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    body {
        background-image: url('{{ asset('assets/images/profiles/arriereP.jpg') }}');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .conteneurInfo {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        margin: 40px auto;
        animation: fadeIn 0.6s ease-in-out;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        width: 60%;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    h2 {
        text-align: center;
        color: var(--primary);
        margin-bottom: 1.5rem;
        font-size: 32px;
        font-weight: 700;
        position: relative;
        padding-bottom: 15px;
    }

    h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: var(--secondary);
        border-radius: 2px;
    }

    label {
        font-weight: 600;
        color: var(--dark);
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    select, input[type="text"], input[type="file"], input[type="date"] {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        background: var(--light);
        outline: none;
        font-size: 1rem;
        transition: var(--transition);
        box-sizing: border-box;
    }

    select:focus, input[type="text"]:focus, input[type="date"]:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 128, 0, 0.1);
    }

    #btnValider {
        padding: 14px 20px;
        font-size: 1rem;
        font-weight: 600;
        background: linear-gradient(135deg, var(--primary) 0%, #006400 100%);
        border: none;
        border-radius: 10px;
        color: var(--light);
        cursor: pointer;
        transition: var(--transition);
        display: block;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 6px rgba(0, 128, 0, 0.2);
    }

    #btnValider:hover {
        background: linear-gradient(135deg, #006400 0%, #004d00 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 128, 0, 0.3);
    }

    .hidden {
        display: none;
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
        margin-bottom: 1.5rem;
    }

    .form-group {
        padding: 0 10px;
        flex: 1 1 100%;
        margin-bottom: 1rem;
    }

    @media (min-width: 768px) {
        .form-group {
            flex: 0 0 50%;
        }
    }

    .radio-group {
        display: flex;
        align-items: center;
        background: var(--light-gray);
        padding: 12px 20px;
        border-radius: 10px;
        margin: 8px 0;
        transition: var(--transition);
        border: 2px solid transparent;
    }

    .radio-group:hover {
        border-color: var(--primary);
        background: rgba(0, 128, 0, 0.05);
    }

    .radio-group input[type="radio"] {
        margin-right: 10px;
        accent-color: var(--primary);
        transform: scale(1.2);
    }

    .radio-group label {
        margin: 0;
        font-weight: 500;
        color: var(--dark);
    }

    /* Styles pour la popup de livraison */
    .swal-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    @media (max-width: 767px) {
        .swal-grid {
            grid-template-columns: 1fr;
        }
    }

    .swal2-input {
        margin: 8px 0;
        padding: 12px 15px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        transition: var(--transition);
    }

    .swal2-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 128, 0, 0.1);
    }

    .error-message {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 5px;
        display: block;
    }

    .options-container {
        background: var(--light-gray);
        padding: 20px;
        border-radius: var(--border-radius);
        margin: 20px 0;
        border-left: 4px solid var(--secondary);
        
    }

    .chois{
        display: flex;
        justify-content: space-around;
    }

    .options-title {
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 15px;
        text-align: center;
        font-size: 1.1rem;
    }

    /* Animation pour les éléments du formulaire */
    .form-group {
        animation: slideIn 0.5s ease forwards;
        opacity: 0;
        transform: translateY(10px);
    }

    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Délais d'animation pour chaque champ */
    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }
    .form-group:nth-child(5) { animation-delay: 0.5s; }
    .form-group:nth-child(6) { animation-delay: 0.6s; }
    .form-group:nth-child(7) { animation-delay: 0.7s; }
    .form-group:nth-child(8) { animation-delay: 0.8s; }

    /* Style personnalisé pour les fichiers */
    input[type="file"]::file-selector-button {
        background: var(--secondary);
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        margin-right: 10px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
    }

    input[type="file"]::file-selector-button:hover {
        background: #e59400;
    }

    /* Style pour les sélecteurs */
    select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23008000' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px;
        appearance: none;
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
            background: 'var(--light)',
            color: 'var(--dark)'
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
            background: 'var(--light)',
            color: 'var(--dark)'
        });
    </script>
@endif

<div class="conteneurInfo">
    <h2>Demande d'extrait de naissance</h2>
    <form id="naissanceForm" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="pour">Pour ?</label>
                <select id="pour" name="pour" class="form-control" onchange="updateFields()">
                    <option value="Moi" {{ old('pour') == 'Moi' ? 'selected' : '' }}>Moi</option>
                    <option value="une_autre_personne" {{ old('pour') == 'une_autre_personne' ? 'selected' : '' }}>Une autre personne</option>
                </select>
                @error('pour')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Type de demande</label>
                <select id="type" name="type" class="form-control">
                    <option value="simple" {{ old('type') == 'simple' ? 'selected' : '' }}>Simple</option>
                    <option value="extrait_integral" {{ old('type') == 'extrait_integral' ? 'selected' : '' }}>Extrait intégral</option>
                </select>
                @error('type')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $userName) }}" >
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="prenom">Prénoms</label>
                <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom', $userPrenom) }}" >
                @error('prenom')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="number">Numéro de registre</label>
                <input type="text" id="number" name="number" class="form-control" value="{{ old('number') }}" >
                @error('number')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="DateR">Date de registre</label>
                <input type="date" id="DateR" name="DateR" class="form-control" value="{{ old('DateR') }}" >
                @error('DateR')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="commune">Commune</label>
                <select id="commune" name="commune" class="form-control">
                    <option value="">Sélectionnez une commune</option>
                    <option value="abobo" {{ old('commune', $userCommune) == 'Abobo' ? 'selected' : '' }}>Abobo</option>
                    <option value="adjamé" {{ old('commune', $userCommune) == 'Adjamé' ? 'selected' : '' }}>Adjamé</option>
                    <!-- Autres options de communes -->
                </select>
                @error('commune')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="CNI">Pièce d'identité (demandeur)</label>
                <input type="file" id="CNI" name="CNI" class="form-control" >
                @error('CNI')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="CMU">Numéro CMU</label>
            <input type="text" id="CMU" name="CMU" class="form-control" value="{{ old('CMU', $userCMU) }}" >
            @error('CMU')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Options Radio -->
        <div class="options-container">
            <div class="options-title">Choisissez le mode de retrait :</div>
            <div class="form-row chois">
                <div class="radio-group">
                    <input type="radio" id="option1" name="choix_option" value="retrait_sur_place" checked >
                    <label for="option1">Retrait sur place</label>
                </div>
                <div class="radio-group">
                    <input type="radio" id="option2" name="choix_option" value="livraison" >
                    <label for="option2">Livraison</label>
                </div>
            </div>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" id="btnValider">Valider la demande</button>
    </form>
</div>

<script>
    let formSubmitted = false;

    function updateFields() {
        const pourSelect = document.getElementById('pour');
        const nameInput = document.getElementById('name');
        const prenomInput = document.getElementById('prenom');
        const communeSelect = document.getElementById('commune');
        const CMUInput = document.getElementById('CMU');

        if (pourSelect.value === 'Moi') {
            nameInput.value = '{{ $userName }}';
            prenomInput.value = '{{ $userPrenom }}';
            // Sélectionner l'option correspondant à la commune de l'utilisateur
            const userCommune = '{{ $userCommune }}';
            if (userCommune) {
                for (let i = 0; i < communeSelect.options.length; i++) {
                    if (communeSelect.options[i].value === userCommune) {
                        communeSelect.selectedIndex = i;
                        break;
                    }
                }
            }
            CMUInput.value = '{{ $userCMU }}';
        } else {
            nameInput.value = '';
            prenomInput.value = '';
            communeSelect.selectedIndex = 0; // Réinitialiser à "Sélectionnez une commune"
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
            title: 'Informations de Livraison',
            width: '700px',
            html: `
                <div class="swal-grid">
                    <div>
                        <label for="swal-montant_timbre" style="font-weight: bold">Timbre</label>
                        <input id="swal-montant_timbre" class="swal2-input text-center" value="50" readonly>
                        <label for="swal-montant_timbre" style="font-size:13px; color:var(--secondary)">Pour la phase pilote les frais de timbre sont fournis par Kks-technologies</label>
                    </div>
                    <div>
                        <label for="swal-montant_livraison" style="font-weight: bold">Frais Livraison</label>
                        <input id="swal-montant_livraison" class="swal2-input text-center" value="50" readonly>
                        <label for="swal-montant_livraison" style="font-size:13px; color:var(--secondary)">Pour la phase pilote les frais des livraisons sont fixés à 1500 Fcfa</label>
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
            confirmButtonColor: 'var(--primary)',
            cancelButtonColor: '#6c757d',
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
                    montant_timbre: parseFloat(montant_timbre),
                    montant_livraison: parseFloat(montant_livraison),
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = result.value;
                initializeCinetPay(formData); // Appel de la fonction CinetPay
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Si l'utilisateur clique sur annuler, sélectionner l'option 1
                document.getElementById('option1').checked = true;
            }
        });
    }
</script>
@endsection