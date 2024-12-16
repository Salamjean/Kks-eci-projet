
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Demande d'extrait de Naissance</title>
    <style>
        
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color:#f4f7f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        /*Reduction du formulaire*/
        .reduit {
            width: 60%;
            max-width: 400px;
            transition: all 0.5s ease;
            height: 50px;
        }
        .conteneurInfo {
           
                    background: #ffffff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 60%;
            animation: fadeIn 0.6s ease-in-out;
                    
            
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        h1 {
            font-size: 2rem;
            color: #1a5c58;
            text-align: center;
            margin-bottom: 1rem;
        }

        h3 {
            font-size: 1rem;
            text-align: center;
            color: #666;
            margin-bottom: 2rem;
        }

        label {
            display: block;
            font-weight: bold;
            color: #1a5c58;
            margin-top: 1rem;
        }

        input[type="text"]  {
            width: 170px;
            padding: 0.8rem;
            margin-top: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f9f9f9;
            outline: none;
            transition: all 0.3s ease;
        }
        input[type="file"]{
            width: 300px;
            padding: 0.8rem;
            margin-top: 0.5rem;
            border: 1px solid #b2d8d8;
            border-radius: 8px;
            font-size: 1rem;
            color: #333;
            transition: border-color 0.3s ease;
            
        }
        input[type="file"]::file-selector-button{
            background-color: #4CAF50;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="text"]:focus, input[type="file"]:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 8px rgba(108, 99, 255, 0.4);
        }

        .readonly-input {
            background-color: #f0f0f0;
            
        }

        .radio-group {
            display: flex;
            gap: 1rem;
            align-items: center;
            margin-top: 0.5rem;
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
            transition: background-color 0.3s ease;
            margin-top: 2rem;
        }
        button:hover {
            background-color: #144d4b;
        }

        .hidden {
            display: none;
            position: relative;
            width: 25em;
            visibility: hidden; /* Reste invisible */
            height: 0; /* Hauteur initiale nulle */
            overflow: hidden; /* Empêche les débordements */
            transition: height 0.5s ease, visibility 0.5s ease; /* Transition fluide */
        }
        .hidden.active {
            visibility: visible; /* Devient visible */
            height: auto; /* Ajuste automatiquement la hauteur */
        }
        /*Acte de mariage*/
        .sectionActeMariage{
            position: relative;
            width: 20em;
        }
        .modal {
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 1.5rem;
            text-align: center;
            display: none;
            z-index: 1000;
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }
        .modal p {
            font-size: 1rem;
            color: #333;
        }
        /*Icon d'erreur modal*/
        .erreurModal{
            position: relative;
            top: 5px;
            width: 45px;
            height: auto;
        }
        
        .modal-close {
            margin-top: 1rem;
            position: relative;
            
            width: 20px;
            height: auto;
            background-color: #e82724;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
        /*Les input de saisir*/
       
        #dossierNum{
            width: 100%;
        }
        .erreur-texte {
        font-weight: bold;
}
        /*Nom hopitale*/
        
        .NomDfnt{
            position: relative;
            bottom: 5.41em;
            left: 420px;
        }
        .dateNais{
            position: relative;
            bottom: 5.80em;
           
            
        }
        .lieuNais {
            position: relative;
            bottom: 16.09em;
            left: 210px;
        }
        /*Conteneur de l'input*/
        .conteneurInput {
            position: relative;
            bottom: 10.8em;
        }
        #boutonImprimer{
            position: relative;
            bottom: 15em;
        }
       /*reduit la taille*/
       .reduit {
            width: 90%;
            max-width: 650px;
            height: 50em; /* Ajuste cette valeur si nécessaire */
            transition: all 0.5s ease; /* Ajoute un effet fluide */
        }
        

.btn-imprimer:hover {
    display: none;
    background-color: #0056b3; /* Couleur au survol */
            width: 300px;
            height:70px;
            border-radius: 0px 30px 30px 0px;
            transition: all 0.5s ease;
            position: relative;
            right: 32px;
            padding: 05px;
            
}
.btn-imprimer:focus {
    display: none;
    background-color: #0056b3; /* Couleur au survol */
            width: 300px;
            height:70px;
            border-radius: 0px 30px 30px 0px;
            transition: all 0.5s ease;
            position: relative;
            right: 32px;
            padding: 05px;
}
.btn-imprimer {
    display: none;
    background-color: #0056b3; 
    width: 70px;
    height: 70px;
    border-radius: 30px 0px 20px;
    transition: all 0.5s ease;
    color: white;
}

.icone-imprimer {
    display: none;
    width: 50px; /* Largeur de l'image */
    height: auto; /* Hauteur de l'image */
    transition: opacity 0.3s ease; /* Transition fluide pour le changement */
    border-radius: 10px;
    position: relative;
    bottom:02px ;
    right: 05px;
}
.icone-imprimer :focus {
    display: none;
    width: 50px; /* Largeur de l'image */
    height: auto; /* Hauteur de l'image */
    transition: opacity 0.3s ease; /* Transition fluide pour le changement */
    border-radius: 10px;
    position: relative;
    bottom:02px ;
    right: 05px;
}

.btn-imprimer:hover .icone-imprimer {
    display: none;
    content: url("imprimante.gif"); 
    width: 45px; 
    height: auto;
    transition: opacity 0.3s ease; 
    border-radius: 10px;
    position: relative;
    bottom:02px ;
    right: 05px;
}

.btn-imprimer:focus .icone-imprimer {
    display: none;
    content: url("imprimante.gif"); 
    width: 50px; 
    height: auto;
    transition: opacity 0.3s ease; 
    border-radius: 10px;
    position: relative;
    bottom:02px ;
    right: 05px;
}

.texte-bouton {
    display: none;
    opacity: 0; /* Rendre le texte invisible */
    visibility: hidden; /* Empêcher l'interaction avec le texte masqué */
}

.btn-imprimer:hover .texte-bouton {
    display: none;
    opacity: 100%;
    transition: opacity 0.3s ease; /* Transition douce pour le texte */
}
.btn-imprimer:focus .texte-bouton {
    opacity: 0; /* Rendre le texte invisible */
    visibility: hidden; /* Empêcher l'interaction avec le texte masqué */
}
#OK{
    position: relative;
    bottom: 190px;
}

    

    </style>
</head>
<body>
    @if (Session::get('success1')) <!-- Pour la suppression -->
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Suppression réussie',
            text: '{{ Session::get('success1') }}',
            timer: 3000,
            showConfirmButton: false,
            background: '#ffcccc', // Couleur de fond personnalisée
            color: '#b30000' // Texte rouge foncé
        });
    </script>
    @endif

    @if (Session::get('success')) <!-- Pour la modification -->
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Action réussie',
                text: '{{ Session::get('success') }}',
                timer: 3000,
                showConfirmButton: true,
                background: '#ccffcc', // Couleur de fond personnalisée
                color: '#006600' // Texte vert foncé
            });
        </script>
    @endif

    @if (Session::get('error')) <!-- Pour une erreur générale -->
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: '{{ Session::get('error') }}',
                timer: 3000,
                showConfirmButton: false,
                background: '#f86750', // Couleur de fond rouge vif
                color: '#ffffff' // Texte blanc
            });
        </script>
    @endif
    <form class="conteneurInfo" enctype="multipart/form-data" id="declarationForm" method="post" action="{{ route('naissance.store') }}">
        @csrf
        @method('POST')
        <p style="text-align: center">@error('acteMariage')
            <span style="color: #e82724">{{ $message }}</span>
        @enderror</p>
        <p  style="text-align: center">
            @error('cdnaiss')
            <span style="color: #e82724">{{ $message }}</span>
             @enderror
        </p>
        <p  style="text-align: center">
            @error('identiteDeclarant')
            <span style="color: #e82724">{{ $message }}</span>
             @enderror
        </p>
    </div>
        <h1>Demande d'Acte de naissance</h1>
        <h3>Remplissez le formulaire suivant pour la demande d'Acte de naissance</h3>

        <label for="dossierNum">Numéro de dossier médical</label>
        <input type="text" id="dossierNum" placeholder="Ex : DM1411782251" required >

        <div class="hidden" id="infoDefunt">
            <div class="hop"><label for="nomHopital">Hôpital</label>
                <input type="text" id="nomHopital" class="readonly-input"  name="nomHopital" readonly>
            </div>
            
            <div class="NomDfnt">
                <label for="nomDefunt">Nom de la mère</label>
                <input type="text" id="nomDefunt" class="readonly-input"  name="nomDefunt" readonly>

            </div>

            
            <div class="dateNais">
                <label for="dateNaiss">Nom de l'accompagnateur</label>
                <input type="text" id="dateNaiss" class="readonly-input"  name="dateNaiss" readonly>
            </div>
            <div class="lieuNais">
                <label for="lieuNaiss">Date de Naissance du Né</label>
                <input type="text" id="lieuNaiss" class="readonly-input"  name="lieuNaiss" readonly>

            </div>
            
            <div class="conteneurInput">
                <label for="identiteDeclarant">Pièce d'identité des parent</label>
                <input type="file" id="identiteDeclarant" value="{{ old('identiteDeclarant') }}" name="identiteDeclarant">
                @error('identiteDeclarant')
                    <span style="color: #e82724">{{ $message }}</span>
                @enderror
                <label for="cdnaiss">Certificat de declaration de naissance</label>
                <input type="file" id="cdnaiss" value="{{ old('cdnaiss') }}" name="cdnaiss">
                @error('cdnaiss')
                    <span style="color: #e82724">{{ $message }}</span>
                @enderror


                <label>Les parents de l'enfant sont-il mariés ?</label>
                <div class="radio-group">
                    <input type="radio" id="marieOui" name="etatMatrimonial" value="oui" >
                    <label for="marieOui">Oui</label>
                    <input type="radio" id="marieNon" name="etatMatrimonial" value="non" >
                    <label for="marieNon">Non</label>
                </div>

                 <div class="hidden" id="sectionActeMariage">
                        <label for="acteMariage">Copie de l'acte de mariage</label>
                        <input type="file" id="acteMariage" value="{{ old('acteMariage') }}" name="acteMariage">
                        @error('acteMariage')
                            <span style="color: #e82724">{{ $message }}</span>
                        @enderror
                </div>

                
            </div>

        </div>
            </div>
            

        <button type="button" onclick="validerFormulaire()" id="Valid">Suivant</button>
        <button type="submit" onclick="validerFormulaire()" id="OK" class="hidden">Valider la demande </button>
        <button type="button" id="boutonImprimer" class="btn-imprimer" onclick="imprimer()">
            <img src="imprimente.PNG" alt="Imprimer" class="icone-imprimer" />
            <span class="texte-bouton">Imprimer la Déclaration</span>
        </button>
        
        
    </form>

    <div class="modal" id="modalErreur">
        <p id="messageErreur"></p>
        <img src="retirer.png" alt="" class="erreurModal">
    </div>

    <script>
        const NomHop = "HOSPITAL GEMMA";  // Nom de l'hôpital statique si besoin
    
        function validerFormulaire() {
            const dossierNum = document.getElementById("dossierNum").value;
            const infoDefunt = document.getElementById("infoDefunt");
            const boutonValider = document.getElementById("Valid");
            const boutonImprimer = document.getElementById("boutonImprimer");
            const formulaire = document.querySelector(".conteneurInfo");
            const valid2 = document.getElementById("OK");
    
            // Faire une requête AJAX pour vérifier si le code existe dans la base de données
            fetch("{{ route('verifierCodeDM') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token
                },
                body: JSON.stringify({ codeCMN: dossierNum })
            })
            .then(response => response.json())
            .then(data => {
                if (data.existe) {
                    // Si le code existe, remplir les champs du formulaire avec les données de la base
                    document.getElementById("nomHopital").value = data.nomHopital;
                    document.getElementById("nomDefunt").value = data.nomMere;  // Nom de la mère
                    document.getElementById("dateNaiss").value = data.nomPere; // Date de naissance
                    document.getElementById("lieuNaiss").value = data.dateNaiss; // Lieu de naissance
    
                    // Afficher les informations
                    infoDefunt.classList.remove("hidden");
                    boutonValider.classList.add("hidden"); // Masque le bouton de validation
                    boutonImprimer.classList.remove("hidden"); // Affiche le bouton d'impression
                    valid2.classList.remove("hidden"); // Affiche le bouton d'impression
                    formulaire.classList.add("reduit");
                } else {
                    // Si le code n'existe pas, afficher un message d'erreur
                    const messageErreur = document.getElementById("messageErreur");
                    messageErreur.textContent = "Le numéro d'acte de naissance N° " + dossierNum + " n'est pas reconnu.";
                    
                    // Appliquer la classe CSS pour le texte rouge
                    messageErreur.classList.add('erreur-texte');
                    
                    ouvrirModal();
                    setTimeout(() => {
                        document.getElementById("modalErreur").style.opacity = "0";
                        setTimeout(fermerModal, 500);
                    }, 2000);
                }
            })
            .catch(error => {
                console.error("Erreur lors de la vérification du code DM:", error);
            });
        }
    
        // Fonction pour ouvrir le modal
        function ouvrirModal() {
            const modal = document.getElementById("modalErreur");
            modal.style.display = "block";
            modal.style.opacity = "1";
        }
    
        // Fonction pour fermer le modal
        function fermerModal() {
            const modal = document.getElementById("modalErreur");
            modal.style.display = "none";
            modal.style.opacity = "1";
        }
        document.addEventListener('DOMContentLoaded', () => {
        const idParDefaut = 'conteneur-txt'; // ID du conteneur par défaut
        const boutons = [
            { boutonId: 'demamde0', contenuId: 'DnewNais' },
            { boutonId: 'demamde1', contenuId: 'Dnaissance' },
            { boutonId: 'demamde2', contenuId: 'Ddeces' },
            { boutonId: 'demamde3', contenuId: 'Dmariage' },
        ];
    
        // Fonction pour masquer tout le contenu
        function masquerToutContenu() {
            boutons.forEach(({ contenuId }) => {
                const contenu = document.getElementById(contenuId);
                if (contenu) contenu.style.display = 'none';  // Masque le contenu
            });
            const conteneurParDefaut = document.getElementById(idParDefaut);
            if (conteneurParDefaut) conteneurParDefaut.style.display = 'none'; // Masque le conteneur par défaut
        }
    
        // Fonction pour afficher un contenu spécifique
        function afficherContenu(contenuId) {
            masquerToutContenu();
            const contenu = document.getElementById(contenuId);
            if (contenu) contenu.style.display = 'block';  // Affiche le contenu sélectionné
        }
    
        // Ajouter l'événement de clic à chaque bouton pour afficher le contenu
        boutons.forEach(({ boutonId, contenuId }) => {
            const bouton = document.getElementById(boutonId);
            if (bouton) {
                bouton.addEventListener('click', (event) => {
                    event.preventDefault();  // Empêche le comportement par défaut du lien
                    afficherContenu(contenuId); // Affiche le contenu associé
                });
            }
        });
    
        // Affiche le conteneur par défaut au chargement de la page
        afficherContenu(idParDefaut);
    });

            document.addEventListener("DOMContentLoaded", function() {
        @if (Session::get('success'))
            showMessage('{{ Session::get('success') }}', 'lightgreen');
        @endif
        @if (Session::get('success1'))
            showMessage('{{ Session::get('success1') }}', 'lightred');
        @endif

        @if (Session::get('error'))
            showMessage('{{ Session::get('error') }}', '#f86750');
        @endif
    });

    function showMessage(message, backgroundColor) {
        const popup = document.getElementById('popup-message');
        popup.textContent = message;
        popup.style.backgroundColor = backgroundColor;
        popup.style.display = 'block';

        setTimeout(() => {
            popup.style.display = 'none';
        }, 3000); // Masquer après 3 secondes
    }
    </script>
    
</body>
</html>
