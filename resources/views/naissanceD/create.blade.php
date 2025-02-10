@extends('utilisateur.layouts.template')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        padding: 0.6rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f9f9f9;
        outline: none;
        margin-bottom: 0.5rem;
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

    /* Style for larger screens */
    @media (min-width: 768px) {
        .form-group {
            flex: 0 0 50%; /* Two columns */
        }
        .titre{
            margin-top: 45px;
        }
    }
    /* Responsive radio buttons */
    .form-group.text-center .form-row.d-flex.justify-content-center.align-items-center.gap-4 {
        flex-direction: row !important; /* Make the layout horizontal on larger screens */
    }
.form-row .form-group .radio-group input[type="radio"] {
    display: inline-block !important;
    width: auto !important; /* Set width to auto */
    margin-right: 0.5em; /* Add some spacing */
}

.form-row .form-group .radio-group label {
    display: inline-block;
    margin-left: 0; /* Reset margin for proper alignment */
    color: #1a5c58;
    font-weight: bold; /* Maintain font weight */
}
   /* Responsive radio buttons */
   @media(max-width: 576px) {
        .form-row.d-flex.justify-content-center.align-items-center.gap-4 {
        flex-direction: column !important; 
        }
        .titre{
            margin-top: 45 px;
        }
    }
    /* SweetAlert width adjustments */
    .swal2-popup {
        width: auto !important; /* Let SweetAlert determine its width */
        max-width: 90% !important;  /* Ensure it fits on smaller screens */
    }

    @media (min-width: 768px) {
        .swal2-popup {
            width: 800px !important; /* Set it back to the original width on larger screens */
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
    <form id="naissanceForm" method="POST" action="{{ route('naissanced.store') }}" enctype="multipart/form-data">
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
                <label for="CNI">Pièce d'identité(demandeur)</label>
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
                        
        <script>
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
        </script>
          <!-- Options Radio -->
       <div class="form-group text-center" id="optionsSection">
        <p style="font-weight: bold; color: #1a5c58;">Choisissez le mode de rétrait :</p>
        <div class="form-row d-flex justify-content-center align-items-center gap-4 justify-content-md-around" >
            <div class="radio-group">
                <input type="radio" id="option1" name="choix_option" value="retrait_sur_place" checked required>
                <label for="option1" class="">Retrait sur place</label>
            </div>
            <div class="radio-group">
                <input type="radio" id="option2" name="choix_option" value="livraison" required>
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
    let livraisonSelected = false;
    let submitAfterPopup = false; // Nouveau drapeau

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
                if (!nom_destinataire || !prenom_destinataire || !email_destinataire || !contact_destinataire || !adresse_livraison || !code_postal || !ville || !commune_livraison || !quartier|| !montant_timbre || !montant_livraison) {
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
                     montant_timbre:montant_timbre,
                    montant_livraison:montant_livraison,
                };
            }
        }).then((result) => {
           if (result.isConfirmed) {
                const formData = result.value;
                const form = document.getElementById('naissanceForm');
                for (const key in formData) {
                    if (formData.hasOwnProperty(key)) {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = key;
                        hiddenInput.value = formData[key];
                        form.appendChild(hiddenInput);
                    }
                }
                submitAfterPopup = true; // Définir le drapeau
                form.submit(); // Soumettre explicitement le formulaire
           }
             else if(result.dismiss === Swal.DismissReason.cancel){
                 // Si l'utilisateur clique sur annuler, selectionner l'option 1
                  document.getElementById('option1').checked = true;
                  submitAfterPopup = false;
        }
    });
}


document.getElementById('naissanceForm').addEventListener('submit', function(event) {
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
</script>
@endsection