<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réinitialisation du mot de passe</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
      background: 
                linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.6)),
           url('{{ asset('assets/images/demandeR.jpg') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      padding: 20px;
    }

    .reset-container {
      width: 100%;
      max-width: 450px;
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      animation: fadeIn 0.5s ease-out;
      position: relative;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .home-btn {
      position: absolute;
      top: 15px;
      left: 15px;
      background: rgba(255, 255, 255, 0.2);
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      cursor: pointer;
      transition: all 0.3s;
      z-index: 10;
    }

    .home-btn:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: scale(1.1);
    }

    .reset-header {
      background-color: #ffa500;
      color: white;
      padding: 50px;
      text-align: center;
      position: relative;
    }

    .reset-header h1 {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .reset-header p {
      font-size: 14px;
      opacity: 0.9;
    }

    .reset-body {
      padding: 30px;
    }

    .input-group {
      margin-bottom: 20px;
      position: relative;
    }

    .input-group label {
      display: block;
      margin-bottom: 8px;
      font-size: 14px;
      color: #555;
      font-weight: 500;
    }

    .input-group input {
      width: 100%;
      padding: 14px 45px 14px 45px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 15px;
      transition: all 0.3s;
      background-color: #f9f9f9;
    }

    .input-group input:focus {
      border-color: #059652;
      box-shadow: 0 0 0 3px rgba(5, 150, 82, 0.1);
      outline: none;
      background-color: white;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 40px;
      color: #777;
      font-size: 18px;
    }

    .reset-btn {
      width: 100%;
      padding: 14px;
      background-color: #008000;
      border: none;
      border-radius: 8px;
      color: white;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      box-shadow: 0 4px 15px rgba(5, 150, 82, 0.3);
    }

    .reset-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(5, 150, 82, 0.4);
    }

    .reset-btn:active {
      transform: translateY(0);
    }

    .error-message {
      color: #e74c3c;
      font-size: 13px;
      margin-top: 5px;
      display: none;
    }

    .footer {
      text-align: center;
      margin-top: 25px;
      font-size: 14px;
      color: #777;
    }

    .footer a {
      color: #059652;
      text-decoration: none;
      font-weight: 500;
    }

    @media (max-width: 480px) {
      .reset-container {
        border-radius: 12px;
      }
      
      .reset-header {
        padding: 25px;
      }
      
      .reset-body {
        padding: 25px;
      }
      
      .input-group input {
        padding: 12px 40px 12px 40px;
      }
      
      .input-icon {
        font-size: 16px;
        top: 37px;
      }
    }
  </style>
</head>
<body>
  <div class="reset-container">
    <button class="home-btn" onclick="window.location.href='{{ route('general') }}'">
      <i class="fas fa-home"></i>
    </button>
    
    <div class="reset-header">
      <img src="{{asset('assets4/img/E-ci.jpg')}}" style="height: 50%; width:25%; border-radius:30%" alt="">
      <h1>Mot de passe oublié</h1>
      <p>Entrez votre email pour recevoir un lien de réinitialisation</p>
    </div>
    
    <div class="reset-body">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <div class="input-group">
          <label for="email">Adresse email</label>
          <i class="fas fa-envelope input-icon"></i>
          <input type="email" id="email" name="email" placeholder="votre@email.com" value="{{ old('email') }}" required>
          <div class="error-message" id="email-error">
            @error('email') {{ $message }} @enderror
          </div>
        </div>
        
        <button type="submit" class="reset-btn">Envoyer le lien de réinitialisation</button>
      </form>
      
      <div class="footer">
        <a href="{{ route('login') }}">Retour à la connexion</a>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const emailError = document.getElementById('email-error');
      
      if(emailError.textContent.trim() !== '') {
        emailError.style.display = 'block';
      }
      
      // Animation des champs avec erreur
      const emailInput = document.getElementById('email');
      emailInput.addEventListener('input', function() {
        if(emailError.style.display === 'block') {
          emailError.style.display = 'none';
        }
      });
});
      // SweetAlert notifications
      @if (Session::has('status'))
          Swal.fire({
              icon: 'success',
              title: 'Succès',
              text: '{{ Session::get('status') }}',
              confirmButtonText: 'OK',
          });
      @endif

      @if ($errors->any())
          Swal.fire({
              icon: 'error',
              title: 'Erreur',
              text: '{{ $errors->first() }}',
              confirmButtonText: 'OK',
          });
      @endif
    
  </script>
</body>
</html>