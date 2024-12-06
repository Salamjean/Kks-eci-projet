<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire de Demande d'acte de Mariage</title>
  <style>
    /* Styles de base */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .form-container {
      background: #ffffff;
      padding: 30px 40px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      max-width: 600px;
      width: 100%;
      animation: fadeIn 0.6s ease-in-out;
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
      margin-bottom: 20px;
      color: #2575fc;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #666;
    }
    .form-group select{
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      transition: all 0.3s ease;

    }
    .form-group input, 
    
    .form-group textarea {
      width: 95%;
      padding: 12px 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      transition: all 0.3s ease;
    }

    .form-group input:focus, 
    .form-group select:focus, 
    .form-group textarea:focus {
      border-color: #2575fc;
      outline: none;
      box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
    }

    .hidden {
      display: none;
    }

    button {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
      width: 100%;
      transition: all 0.3s ease;
    }

    button:hover {
      background: linear-gradient(135deg, #2575fc, #6a11cb);
      box-shadow: 0 5px 15px rgba(37, 117, 252, 0.3);
    }

    .form-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-header p {
      color: #888;
      font-size: 14px;
    }

    @media (max-width: 768px) {
      .form-container {
        padding: 20px;
      }

      button {
        font-size: 16px;
      }
    }
    input[type="file"]::file-selector-button{
      background-color:#4CAF50;
      height: 35px;
      border-radius: 5px;
      border: none;
      color: white;
      cursor: pointer;
    }
    input[type="file"]{
      width: 300px;
      border: 1px dashed;
    }
    select{
      width: 100px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <div class="form-header">
      <h2 style="font-size: 30px;">Demande d' acte de Mariage</h2>
      <p>Veuillez remplir les informations requises ci-dessous</p>
    </div>
    <form id="demandeForm" method="POST" enctype="multipart/form-data" action="{{ route('mariage.store') }}">
            @csrf
            @method('POST')

      <div class="form-group">
        <label for="typeDemande">Type de demande</label>
        <select id="typeDemande" name="typeDemande">
            <option value="extraitSimple">Extrait simple</option>
          <option value="copieIntegrale">Copie intégrale</option>
          
        </select>
      </div>

      <div id="infoEpoux" class="hidden">
        <h3 style="font-size: 20px;" >Informations sur le conjoint(e)</h3><br>
        <div class="form-group">
          <label for="nomEpoux">Nom du conjoint(e)</label>
          <input type="text" id="nomEpoux" name="nomEpoux" placeholder="Entrez le nom de l'époux">
        </div>
        <div class="form-group">
          <label for="prenomEpoux">Prénom du conjoint(e)</label>
          <input type="text" id="prenomEpoux" name="prenomEpoux" placeholder="Entrez le prénom de l'époux">
        </div>
        <div class="form-group">
          <label for="dateNaissanceEpoux">Date de naissance du conjoint(e)</label>
          <input type="date" id="dateNaissanceEpoux" name="dateNaissanceEpoux">
        </div>
        <div class="form-group">
          <label for="lieuNaissanceEpoux">Lieu de naissance du conjoint(e)</label>
          <input type="text" id="lieuNaissanceEpoux" name="lieuNaissanceEpoux" placeholder="Entrez le lieu de naissance">
        </div>
      </div>

      <div class="form-group">
        <label for="pieceIdentite">Pièce d'identité (format PDF)</label>
        <input type="file" id="pieceIdentite" name="pieceIdentite" >
      </div>

      <div class="form-group">
        <label for="extraitMariage">Extrait de mariage (format PDF)</label>
        <input type="file" id="extraitMariage" name="extraitMariage" >
      </div>

      <button type="submit">Soumettre la demande</button>
    </form>
  </div>

  <script>
    // Gestion des champs conditionnels
    document.getElementById('typeDemande').addEventListener('change', function() {
      const typeDemande = this.value;
      const infoEpoux = document.getElementById('infoEpoux');

      if (typeDemande === 'copieIntegrale') {
        infoEpoux.classList.remove('hidden');
      } else {
        infoEpoux.classList.add('hidden');
      }
    });
  </script>
</body>
</html>
