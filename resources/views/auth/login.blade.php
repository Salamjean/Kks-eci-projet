<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" href="{{ asset('assets/images/profiles/E-ci-logo.png') }}">
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

    .login-container {
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

    .login-header {
      background-color: #ffa500;
      color: white;
      padding: 50px;
      text-align: center;
      position: relative;
    }

    .login-header h1 {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .login-header p {
      font-size: 14px;
      opacity: 0.9;
    }

    .login-body {
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

    .password-toggle {
      position: absolute;
      right: 15px;
      top: 40px;
      color: #777;
      font-size: 18px;
      cursor: pointer;
      transition: color 0.3s;
    }

    .password-toggle:hover {
      color: #059652;
    }

    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      font-size: 14px;
    }

    .remember-me {
      display: flex;
      align-items: center;
    }

    .remember-me input {
      margin-right: 8px;
    }

    .forgot-password a {
      color: #059652;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
    }

    .forgot-password a:hover {
      color: #037a3f;
      text-decoration: underline;
    }

    .login-btn {
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

    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(5, 150, 82, 0.4);
    }

    .login-btn:active {
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
      .login-container {
        border-radius: 12px;
      }
      
      .login-header {
        padding: 25px;
      }
      
      .login-body {
        padding: 25px;
      }
      
      .input-group input {
        padding: 12px 40px 12px 40px;
      }
      
      .input-icon, .password-toggle {
        font-size: 16px;
        top: 37px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <!-- Bouton de retour à l'accueil -->
    <button class="home-btn" onclick="window.location.href='{{ route('general') }}'">
      <i class="fas fa-home"></i>
    </button>
    
    <div class="login-header">
      <img src="{{asset('assets4/img/E-ci.jpg')}}" style="height: 50%; width:25%; border-radius:30%" alt="">
      <p>Connectez-vous pour accéder à votre compte</p>
    </div>
    
    <div class="login-body">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="input-group">
          <label for="email">Adresse email</label>
          <i class="fas fa-envelope input-icon"></i>
          <input type="email" id="email" name="email" placeholder="votre@email.com" value="{{ old('email') }}" required>
          <div class="error-message" id="email-error">
            @error('email') {{ $message }} @enderror
          </div>
        </div>
        
        <div class="input-group">
          <label for="password">Mot de passe</label>
          <i class="fas fa-lock input-icon"></i>
          <input type="password" id="password" name="password" placeholder="••••••••" required>
          <i class="fas fa-eye password-toggle" id="togglePassword"></i>
          <div class="error-message" id="password-error">
            @error('password') {{ $message }} @enderror
          </div>
        </div>
        
        <div class="options">
          <div class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Se souvenir de moi</label>
          </div>
          {{-- <div class="forgot-password">
            <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
          </div> --}}
        </div>
        
        <button type="submit" class="login-btn">Se connecter</button>
      </form>
      
      <div class="footer">
        Vous n'avez pas de compte ? <a href="{{ route('register') }}">S'inscrire</a>
      </div>
    </div>
  </div>

  <script>
    // Afficher les messages d'erreur s'ils existent
    document.addEventListener('DOMContentLoaded', function() {
      const emailError = document.getElementById('email-error');
      const passwordError = document.getElementById('password-error');
      
      if(emailError.textContent.trim() !== '') {
        emailError.style.display = 'block';
      }
      
      if(passwordError.textContent.trim() !== '') {
        passwordError.style.display = 'block';
      }
      
      // Animation des champs avec erreur
      const inputs = document.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('input', function() {
          if(this.id === 'email' && emailError.style.display === 'block') {
            emailError.style.display = 'none';
          }
          if(this.id === 'password' && passwordError.style.display === 'block') {
            passwordError.style.display = 'none';
          }
        });
      });

      // Fonctionnalité d'affichage/masquage du mot de passe
      const togglePassword = document.getElementById('togglePassword');
      const password = document.getElementById('password');
      
      togglePassword.addEventListener('click', function() {
        // Change le type d'input
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Change l'icône
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    });


    // SweetAlert notifications
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: '{{ Session::get('success') }}',
                    confirmButtonText: 'OK',
                });
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: '{{ Session::get('error') }}',
                    confirmButtonText: 'OK',
                    
                });
            @endif
  </script>
</body>
</html>