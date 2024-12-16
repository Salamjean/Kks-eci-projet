<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Déclaration d'Acte de Décès</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
        }
        .conteneurInfo {
            width: 100%;
            max-width: 650px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            animation: fadeIn 1s ease;
        }
        h1 {
            font-size: 2rem;
            color: #1a5c58;
            text-align: center;
            margin-bottom: 1rem;
        }
        label {
            display: block;
            font-weight: bold;
            color: #1a5c58;
            margin-top: 1rem;
        }
        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 0.8rem;
            margin-top: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f9f9f9;
            outline: none;
            transition: all 0.3s ease;
        }
        select {
            padding: 0.8rem;
        }
        .radio-group {
            display: flex;
            gap: 1rem;
        }
        .radio-group input[type="radio"] {
            margin-top: 0;
        }
        button {
            background-color: #3e8e41;
            color: #ffffff;
            cursor: pointer;
            margin-top: 1rem;
            width: 100%;
            padding: 1rem;
            border: none;
            border-radius: 10px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #144d4b;
        }
        .hidden {
            display: none;
        }
        .modal {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

    <form class="conteneurInfo" id="declarationForm" method="POST" enctype="multipart/form-data" action="{{ route('deces.store') }}">
        @csrf
        <h1>Demande d'Acte de Décès</h1>

        <!-- Champ pour le numéro de dossier -->
        <label for="dossierNum">Numéro de dossier médical</label>
        <input type="text" id="dossierNum" name="dossierNum" placeholder="Ex : DM1411782251" required>

        <!-- Information sur le défunt (masqué initialement) -->
        <div class="hidden" id="infoDefunt">
            <label for="nomHopital">Nom de l'Hôpital</label>
            <input type="text" id="nomHopital" name="nomHopital" class="readonly-input" readonly>

            <label for="dateDces">Date du Décès</label>
            <input type="text" id="dateDces" name="dateDces" class="readonly-input" readonly>

            <label for="nomDefunt">Nom du Défunt</label>
            <input type="text" id="nomDefunt" name="nomDefunt" class="readonly-input" readonly>

            <label for="dateNaiss">Date de Naissance</label>
            <input type="text" id="dateNaiss" name="dateNaiss" class="readonly-input" readonly>

            <label for="lieuNaiss">Lieu de Naissance</label>
            <input type="text" id="lieuNaiss" name="lieuNaiss" class="readonly-input" readonly>
        </div>

        <!-- Pièce d'identité du déclarant (masqué initialement) -->
        <div class="hidden" id="identiteDeclarantSection">
            <label for="identiteDeclarant">Pièce d'identité du Déclarant</label>
            <input type="file" name="identiteDeclarant" id="identiteDeclarant" required>
        </div>

        <!-- Mariage (masqué initialement) -->
        <div class="hidden" id="mariageSection">
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
        </div>

        <!-- De-par-la loi (masqué initialement) -->
        <div class="hidden" id="deParLaLoiSection">
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
        </div>

        <!-- Boutons -->
        <button type="button" onclick="validerFormulaire()" id="Valid">Valider la Déclaration</button>
        <button type="submit" id="boutonImprimer" class="hidden">Soumettre</button>
    </form>

    <!-- Modal d'erreur -->
    <div class="modal" id="modalErreur">
        <p id="messageErreur"></p>
        <button onclick="fermerModal()">Fermer</button>
    </div>

    <script>
        function validerFormulaire() {
            const dossierNum = document.getElementById("dossierNum").value;

            fetch("{{ route('deces.verifierCodeCMD') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ codeCMD: dossierNum })
            })
            .then(response => response.json())
            .then(data => {
                if (data.existe) {
                    // Afficher tous les champs après la vérification réussie
                    document.getElementById("nomHopital").value = data.nomHopital;
                    document.getElementById("dateDces").value = data.dateDeces;
                    document.getElementById("nomDefunt").value = data.nomDefunt;
                    document.getElementById("dateNaiss").value = data.dateNaiss;
                    document.getElementById("lieuNaiss").value = data.lieuNaiss;

                    // Afficher les sections masquées
                    document.getElementById("infoDefunt").classList.remove("hidden");
                    document.getElementById("identiteDeclarantSection").classList.remove("hidden");
                    document.getElementById("mariageSection").classList.remove("hidden");
                    document.getElementById("deParLaLoiSection").classList.remove("hidden");
                    document.getElementById("boutonImprimer").classList.remove("hidden");

                    // Masquer le bouton Valider après la vérification
                    document.getElementById("Valid").classList.add("hidden");
                } else {
                    document.getElementById("messageErreur").textContent = "Le numéro de code CMD " + dossierNum + " est incorrect.";
                    ouvrirModal();
                }
            })
            .catch(error => {
                console.error("Error:", error);
                document.getElementById("messageErreur").textContent = "Une erreur est survenue. Veuillez réessayer.";
                ouvrirModal();
            });
        }

        function ouvrirModal() {
            const modal = document.getElementById("modalErreur");
            modal.style.display = "block";
        }

        function fermerModal() {
            const modal = document.getElementById("modalErreur");
            modal.style.display = "none";
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
    </script>
</body>
</html>
