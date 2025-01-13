<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer le Compte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            color: #4a5568;
        }
        .mt-1 {
            margin-top: 8px;
        }
        .mt-6 {
            margin-top: 24px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        label {
            display: block;
            margin-bottom: 4px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn-danger {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-secondary {
            background-color: orange;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
        .text-sm {
            font-size: 14px;
        }
        .text-gray-600 {
            color: #718096;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .modal.show {
            display: flex;
        }
    </style>
</head>
<body>

<div class="container space-y-6">
    <header>
        <h2>Supprimer le Compte</h2>
        <p class="mt-1 text-sm text-gray-600">
            Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.
        </p>
    </header>

    <button class="btn-danger" onclick="openModal()">Supprimer le Compte</button>

    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <h2>Es-tu sûr de supprimer cet utilisateur?</h2>
            <p class="mt-1 text-sm text-gray-600">
                Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.
            </p>

            <div class="form-group mt-6">
                <label for="password" class="sr-only">Mot de passe</label>
                <input id="password" name="password" type="password" placeholder="Mot de passe" required />
                <span class="text-red-600" id="error-message"></span>
            </div>

            <div class="mt-6 flex justify-end">
                <button class="btn-secondary" onclick="closeModal()">Annuler</button>
                <button class="btn-danger" onclick="confirmDeletion()">Supprimer le Compte</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('confirmModal').classList.add('show');
    }

    function closeModal() {
        document.getElementById('confirmModal').classList.remove('show');
    }

    function confirmDeletion() {
        const password = document.getElementById('password').value;
        // Exemple de vérification de mot de passe (à remplacer par une vérification réelle)
        if (password === 'votre_mot_de_passe') {
            alert('Compte supprimé avec succès.');
            // Ici, vous pouvez ajouter la logique pour supprimer le compte
        } else {
            document.getElementById('error-message').textContent = 'Mot de passe incorrect.';
        }
    }
</script>

</body>
</html>