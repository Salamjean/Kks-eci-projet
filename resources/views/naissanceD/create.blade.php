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
        width: 60%;
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
        width: 93%;
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
        <h2 style="font-size: 30px;">Demande d'extait de naissance</h2>
        <p>Veuillez remplir les informations requises ci-dessous</p>
      </div>
      <form id="demandeForm" method="POST" action="{{ route('naissanced.store') }}">
        @csrf
        @method('POST')
  
        <div class="form-group">
          <label for="pieceIdentite">Type de déclaration</label>
          <select id="pieceIdentite" name="type" class="form-control">
              <option value="extrait_integral">Extrait intégral</option>
              <option value="simple">Simple</option>
          </select>
      </div>
      
        <div class="form-group">
          <label for="pieceIdentite">Entrez votre nom et Prenoms</label>
          <input type="text" id="pieceIdentite" name="name" >
        </div>

        <div class="form-group">
          <label for="extraitMariage">Entrez le numéro de votre extrait de naissance</label>
          <input type="text" id="extraitMariage" name="number" >
        </div>

        <form method="POST" action="{{ route('naissanced.store') }}">
          @csrf
          <!-- Vos champs de formulaire ici -->
          <button type="submit">Soumettre</button>
      </form>
      
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