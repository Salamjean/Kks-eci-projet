@extends('sous_admin.layouts.template')

@section('content')
<div class="content-container">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <style>
    /* Global Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .content-container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    /* Form styles */
    #msform {
      width: 100%;
      max-width: 600px;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .div {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .input-group {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .input-group label {
      margin-bottom: 5px;
      font-weight: 600;
      font-size: 14px;
      color: #666;
    }

    .input-group input,
    .input-group textarea {
      width: 100%;
      padding: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      transition: border-color 0.3s ease;
      resize: none;
      outline: none;
    }

    .input-group input:focus,
    .input-group textarea:focus {
      border-color: #009efb;
    }

    .form-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-header h2 {
      font-size: 24px;
      font-weight: 600;
      color: #333;
    }

    .form-header p {
      font-size: 14px;
      color: #666;
    }

    .action-button {
      display: inline-block;
      padding: 12px 20px;
      background: #009efb;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      text-align: center;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease, box-shadow 0.3s ease;
    }

    .action-button:hover {
      background: #007bb5;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .div {
        flex-direction: column;
      }

      #msform {
        padding: 20px;
      }

      .form-header h2 {
        font-size: 20px;
      }

      .action-button {
        width: 100%;
        padding: 12px 0;
      }
    }
  </style>

<form id="msform" action="{{ route('decesHop.store') }}" method="POST">
    @csrf
    @method('POST')
    <!-- Form Header -->
    <div class="form-header">
      <h2>Déclaration de décès</h2>
      <p>Veuillez remplir les informations requises</p>
    </div>

    <!-- Input Fields -->
    <fieldset>
      <div class="div">
        <div class="input-group">
          <label for="nomM">Nom du défunt</label>
          <input type="text" id="nomM" name="NomM" placeholder="Entrez le nom du défunt" required />
        </div>

        <div class="input-group">
          <label for="prM">Prénom du défunt</label>
          <input type="text" id="prM" name="PrM" placeholder="Entrez le prénom du défunt" required />
        </div>
      </div>

      <div class="div">
        <div class="input-group">
          <label for="dateNaissance">Date de naissance du défunt</label>
          <input type="date" id="dateNaissance" name="DateNaissance" required />
        </div>

        <div class="input-group">
          <label for="dateDeces">Date du décès</label>
          <input type="date" id="dateDeces" name="DateDeces" id="dateDeces"  required />

        </div>
      </div>
      
        <div class="input-group">
          <label for="remarques">Décrivez les circonstances du décès</label>
          <textarea id="remarques" name="Remarques" required maxlength="200"></textarea>
        </div>
        <div class="div">
          <div class="input-group">
            <input type="text" class="text-center" style="background-color:#e8e8e8" name="nomHop" value="{{ Auth::guard('sous_admin')->user()->nomHop }}" readonly/>
          </div>
          <div class="input-group">
            <input type="text" class="text-center" style="background-color:#e8e8e8" name="commune" value="{{ Auth::guard('sous_admin')->user()->commune }}" readonly/>
          </div>
        </div>

      <button type="submit" class="action-button" style="margin-left:42%">Valider</button>
    </fieldset>
  </form>
</div>
@endsection
