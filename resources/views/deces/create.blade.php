
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déclaration d'Acte de Décès</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
            position: relative;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100vw;
            box-sizing: border-box;
        }
        /*Reduction du formulaire*/
        .reduit {
            width: 60%;
            max-width: 400px;
            transition: all 0.5s ease;
            height: 50px;
        }
        .conteneurInfo {
            position: relative;
            left: 400px;
            top: 05em;
            width: 100%;
            max-width: 650px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            animation: fadeIn 1s ease;
            
            
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
            pointer-events: none;
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
            width: 600px;
        }
        .dateDcs{
            position: relative;
            bottom: 05.5em;
            left: 210px;
        }
        .Nomdft{
            position: relative;
            bottom: 11em;
            left: 420px;
        }
        .dateNais{
            position: relative;
            bottom: 11em;
            
        }
        .lieuNais{
            position: relative;
            bottom: 16.5em;
            left: 210px;
        }
        /*Conteneur de l'input*/
        .conteneurInput{
            position: relative;
           bottom: 15em;
        }
        #boutonImprimer{
            position: relative;
            bottom: 15em;
        }
       /*reduit la taille*/
       .reduit {
            width: 90%;
            max-width: 650px;
            height: 60em; /* Ajuste cette valeur si nécessaire */
            transition: all 0.5s ease; /* Ajoute un effet fluide */
        }
        input[type="submit"]{
            width: 180px;
            height: 40px;
            color: white;
            background-color: #6c63ff;
            border: none;
            border-radius: 5px;
            position: relative;
            bottom: 220px;
            cursor: pointer;
            font-size: 17px;


        }
        input[type="submit"] :hover{
            background-color: #271cf8;
        }

    </style>
</head>
<body>

    <form class="conteneurInfo" id="declarationForm" method="POST" enctype="multipart/form-data" action="{{ route('deces.store') }}">
        @csrf
        @method('POST')

        <h1>Demande d'Acte de Décès</h1>
        <h3>Remplissez le formulaire suivant pour la demande d'Acte de Décès</h3>

        <label for="dossierNum">Numéro de dossier médical</label>
        <input type="text" id="dossierNum" placeholder="Ex : DM1411782251" >

        <div class="hidden" id="infoDefunt">
            <div class="hop"><label for="nomHopital">Nom de l'Hôpital</label>
                <input type="text" id="nomHopital" name="nomHopital" class="readonly-input" readonly>
            </div>
            <div class="dateDcs"><label for="dateDces">Date du Décès</label>
                <input type="text" id="dateDces" name="dateDces" class="readonly-input" readonly>
            </div>
            <div class="Nomdft">
                <label for="nomDefunt">Nom du Défunt</label>
                <input type="text" id="nomDefunt" name="nomDefunt" class="readonly-input" readonly>

            </div>
            
            <div class="dateNais">
                <label for="dateNaiss">Date de Naissance</label>
                <input type="text" id="dateNaiss" name="dateNaiss" class="readonly-input" readonly>
            </div>
            <div class="lieuNais">
                <label for="lieuNaiss">Lieu de Naissance</label>
                <input type="text" id="lieuNaiss" name="lieuNaiss" class="readonly-input" readonly>

            </div>
            
            <div class="conteneurInput">
                <label for="identiteDeclarant">Pièce d'identité du Déclarant</label>
                <input type="file" name="identiteDeclarant" id="identiteDeclarant" >
                @error('identiteDeclarant')
            <span style="color: #e82724">{{ $message }}</span>
             @enderror
                <label>Le défunt était-il marié ?</label>
                <div class="radio-group">
                    <input type="radio" id="marieOui" name="etatMatrimonial" value="oui" required>
                    <label for="marieOui">Oui</label>
                    <input type="radio" id="marieNon" name="etatMatrimonial" value="non" required>
                    <label for="marieNon">Non</label>
                </div>

                 <div class="hidden" id="sectionActeMariage">
                        <label for="acteMariage">Copie de l'acte de mariage</label>
                        <input type="file" name="acteMariage" id="acteMariage">
                </div>
                @error('acteMariage')
            <span style="color: #e82724">{{ $message }}</span>
             @enderror

                <label>Y a-t-il un de-par-la loi applicable ?</label>
                <div class="radio-group">
                <input type="radio" id="deParLaLoiOui" name="deParLaLoiApplicable" value="oui" required>
                <label for="deParLaLoiOui">Oui</label>
                <input type="radio" id="deParLaLoiNon" name="deParLaLoiApplicable" value="non" required>
                <label for="deParLaLoiNon">Non</label>
            </div>

            <div class="hidden" id="sectionDeParLaLoi">
                <label for="deParLaLoi">Référence du de-par-la loi</label>
                <input type="file" name="deParLaLoi" id="deParLaLoi">
            </div>
            @error('deParLaLoi')
            <span style="color: #e82724">{{ $message }}</span>
             @enderror
        </div>
            </div>
            

        <button type="button" onclick="validerFormulaire()" id="Valid">Valider la Déclaration</button>
        <form method="POST" action="{{ route('naissance.store') }}">
            @csrf
            <!-- Vos champs de formulaire ici -->
            <button type="submit" id="boutonImprimer" class="hidden">Soumettre</button>
        </form>
        
    </form>

    <div class="modal" id="modalErreur">
        <p id="messageErreur"></p>
        <img src="retirer.png" alt="" class="erreurModal">
    </div>

    <script>
        const NomHop = "HOSPITAL GEMMA";
        const DateDces = "01/01/2023";
        const NomHopnuméroMedi = "2001";
        const NomDfnt = "Dion Olive";
        const DateNaiss = "12/07/1989";
        const LieuNaiss = "Abobo";

        function validerFormulaire() {
    const dossierNum = document.getElementById("dossierNum").value;
    const infoDefunt = document.getElementById("infoDefunt");
    const boutonValider = document.getElementById("Valid");
    const boutonImprimer = document.getElementById("boutonImprimer");
    const formulaire = document.querySelector(".conteneurInfo");
    const Valid = document.getElementById("valider");




    if (dossierNum === NomHopnuméroMedi) {
        document.getElementById("nomHopital").value = NomHop;
        document.getElementById("dateDces").value = DateDces;
        document.getElementById("nomDefunt").value = NomDfnt;
        document.getElementById("dateNaiss").value = DateNaiss;
        document.getElementById("lieuNaiss").value = LieuNaiss;

        infoDefunt.classList.remove("hidden");
        boutonValider.classList.add("hidden"); // Masque le bouton de validation
        boutonImprimer.classList.remove("hidden"); // Affiche le bouton d'impression
        Valid.classList.remove("hidden") //Affiche le input Submit
        formulaire.classList.add("reduit");

        
    } else {
        document.getElementById("messageErreur").textContent = "Le numéro médical " + dossierNum + " est incorrect.";
        ouvrirModal();
        setTimeout(() => {
            document.getElementById("modalErreur").style.opacity = "0";
            setTimeout(fermerModal, 100);
        }, 1000);
        
    }
}


        document.getElementById("marieOui").addEventListener("change", () => {
            document.getElementById("sectionActeMariage").classList.remove("hidden");
        });
        document.getElementById("marieNon").addEventListener("change", () => {
            document.getElementById("sectionActeMariage").classList.add("hidden");
        });

        document.getElementById("deParLaLoiOui").addEventListener("change", () => {
            document.getElementById("sectionDeParLaLoi").classList.remove("hidden");
        });
        document.getElementById("deParLaLoiNon").addEventListener("change", () => {
            document.getElementById("sectionDeParLaLoi").classList.add("hidden");
        });

        function ouvrirModal() {
            const modal = document.getElementById("modalErreur");
            modal.style.display = "block";
            modal.style.opacity = "1";
        }

        function fermerModal() {
            const modal = document.getElementById("modalErreur");
            modal.style.display = "none";
            modal.style.opacity = "1";
        }

        function imprimer() {
    const contenuImprimable = `
        <h2>CERTIFICAT MEDICAL DE DECES</h2>
        <p><strong>Formation Sanitaire :</strong> ${NomHop}</p>
        <p><strong>Ville / Commune de Décès :</strong> ${LieuNaiss}</p>
        <p><strong>Numéro de Déclaration :</strong> ${NomHopnuméroMedi}</p>
        <p><strong>Date :</strong> ${DateDces}</p>
        <p><strong>Nom du Défunt :</strong> ${NomDfnt}</p>
        <p><strong>Date de Naissance :</strong> ${DateNaiss}</p>
    `;

    const nouvelleFenetre = window.open("", "", "width=600,height=800");
    nouvelleFenetre.document.write(`
        <html>
            <head><title>Impression Déclaration</title></head>
            <body>${contenuImprimable}</body>
        </html>
    `);
    nouvelleFenetre.document.close();
    nouvelleFenetre.print();
}

    </script>
</body>
</html>

