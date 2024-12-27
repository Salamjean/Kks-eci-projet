
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-CI</title>
    <style>
       body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        header {
            background-color: #F58A33;
            padding: 10px 0;
        }

        header .container {
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin: 0 auto;
        }

        header .logo img {
            height: 60px;
            margin-right: 10px;
        }

        header .logo span {
            font-size: 24px;
            font-weight: bold;
            font-family: 'Playfair Display', serif;
        }

        header nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

         header nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
           cursor: pointer;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }
        .inscription-button:hover{
            background-color: white;
            color: #000000;
            width: 50%;
            height: 30px;
        }
        .inscription-button {
            
            color: #000000;
           
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            color: #fff;
        }

        .background-slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .background-slider .slider {
            display: flex;
            height: 100%;
            transition: transform 0.5s ease-in-out;
        }

        .background-slider .slide {
            min-width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .main-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .main-content h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif;
           text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-weight: 500;
        }

        .main-content p {
           font-size: 1.4rem;
            line-height: 1.8;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
             font-weight: 400;
        }

        .cta-button {
            background-color: #F58A33;
            color: white;
             padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            transition: background-color 0.3s;
        }
        header nav ul li a:focus,
        header nav ul li a:active, header nav ul li a:hover {
        text-decoration: none;
        }
        .cta-button:hover {
            background-color: #e47a22;
        }

         /* Style du menu déroulant */
       .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
           position: absolute;
          background-color: #f9f9f9;
          min-width: 250px;
           box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
           z-index: 1;
         border-radius: 5px;
          transform: translateY(10px);
         padding: 10px 0;
        }
        .dropdown.active .dropdown-content{
          display: block;
        }

       .dropdown-content a {
           color: black;
            padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

         .dropdown-content a:hover {
            background-color: #f1f1f1;
           }

           /* Style de la modale */
        .modal {
           display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
             opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .modal.active{
          display: block;
           opacity: 1;
        }

        .modal-content {
             background-color: #fefefe;
           margin: 15% auto;
            padding: 20px;
             border: 1px solid #888;
             width: 80%;
            max-width: 600px;
             position: relative;
            border-radius: 10px;
            color: black;
             transform: translateY(-50px);
            transition: transform 0.3s ease-in-out;
             text-align: left;
        }

        .modal.active .modal-content {
           transform: translateY(0);
        }

         .modal-content h2 {
          margin-bottom: 15px;
            font-family: 'Playfair Display', serif;
        }

         .modal-content p {
         font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 10px;
          }

         .close {
              color: #aaa;
               float: right;
               font-size: 28px;
               font-weight: bold;
             cursor: pointer;
        }

        .close:hover,
        .close:focus {
             color: black;
            text-decoration: none;
             cursor: pointer;
       }

       .modal-content button {
         background-color: #F58A33;
         color: white;
         padding: 10px 20px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
          font-weight: bold;
       display: block;
          margin: 20px auto 0;
    }

    .modal-content button:hover {
        background-color: #e47a22;
    }

    .btn{
        border: none;
        background-color: white;
    }
    .btn:hover{
        border: none;
        background-color: white;
    }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;700&family=Playfair+Display:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                 <img src="{{ asset('assets/images/profiles/E-ci-logo.png') }}" alt="ECI Logo">
                <span>E-CI</span>
            </div>
            <nav>
                <ul>
                    <li><a href="{{ route('general') }}">Accueil</a></li>
                    <li class="dropdown" style="z-index: 20;">
                        <a href="#" id="naissanceLink">Extrait de naissance</a>
                        <div class="dropdown-content">
                             <a href="#" data-modal="modalGrandePersonne">Extrait de naissance pour grande personne</a>
                             <a href="#" data-modal="modalBebe">Extrait de naissance pour bébé</a>
                        </div>
                    </li>
                    <li><a href="#">Acte de mariage</a></li>
                    <li><a href="#">Acte de decèss</a></li>
                     <li><a href="#"></a></li>
                </ul>
            </nav>
            <div style="width: 180px; background-color: #f58a33; height: 30px; display: flex; padding: 5px; ;  border-radius: 5px;
            text-decoration: none;
            font-weight: bold; gap: 8px;" >
                <button class="btn"><a href="{{ route('login') }}"class="inscription-button" > Connexion</a></button>
                <button class="btn"><a href="{{ route('register') }}"class="inscription-button" >Inscription </a></button> 
            </div>
           
        </div>
    </header>

    <main>
        <div class="background-slider">
            <div class="slider" id="slider">
                <div class="slide" style="background-image: url({{ asset('assets/images/profiles/slide1.jpg') }});"></div>
                <div class="slide" style="background-image: url({{ asset('assets/images/profiles/slide2.jpg') }});"></div>
                <div class="slide" style="background-image: url({{ asset('assets/images/profiles/slide3.jpg') }});"></div>
            </div>
        </div>

        <div class="main-content">
            <h1>Bienvenue sur ECI</h1>
            <p>La plateforme de dématérialisation des procédures administratives en Côte d'Ivoire conçue pour vous informer et vous permettre d'effectuer des demandes de documents administratifs à distance et en toute simplicité.</p>
            <a href="#" class="cta-button">En savoir plus</a>
        </div>
    </main>

       <div id="modalGrandePersonne" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h3 style="color: #000000;">Comment obtenir un extrait de naissance pour adulte</h3>	
                      </p>
                      <p><h4>Vous souhaitez obtenir un extrait de naissance pour une personne (adulte ou enfant) ? Voici les étapes simples à suivre pour faire votre demande :</h4></p>

                      <p>Avant de commencer la procédure, assurez-vous d'avoir les informations suivantes :</p>
                      <p>
                        <li><strong>Numéro de l'acte de naissance </strong>de la personne concernée.</li>
                        <li><strong>Nom et prénoms</strong></li>
                        
                      </p>
             <button><a href="{{ route('utilisateur.dashboard') }}">Faire une demande</a></button>
           </div>
        </div>

       <div id="modalBebe" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2>Demande d'Extrait de Naissance pour bébé</h2>
            <h3 class="project_title">Déclaration de Naissance</h3>
                                                    
                    <p> il faut :
                    <ul class="">
                      <li>- Un Certificat de naissance comportant le numéro d’enregistrement, la signature du médecin ou de la sage-femme et le cachet du Centre médical </li></br>
                      <li>- Une pièce d'identité de la mère(Carte nationale d’identité,extrait de naissance , passeport ou certificat de nationalité )  </li></br>
                      <li>- Une pièce d'identité du père(Carte nationale d’identité,extrait de naissance , passeport ou certificat de nationalité )  </li></br>
                      <li>- Une Copie de l'acte de mariage si vous êtes mariéS</li>		
                      
                    </ul>
                    Délai : trois (03) mois à compter du jour de la naissance.
                    </p>													
                  <h3 class="project_title">Acte de Naissance</h3>
                  <p>
                    Un acte de naissance peut donner lieu à la délivrance de 2 documents différents : la copie intégrale, l'extrait simple .</br>
                    La copie intégrale comporte des informations sur la personne concernée par l'acte (nom, prénoms, date et lieu de naissance), des informations sur ses parents et les mentions marginales lorsqu'elles existent.	</br>												
                    Un extrait simple  comporte uniquement les informations sur la personne concernée par l'acte de naissance.
                  </p>
                  <h5 >Comment faire la demande</h5>
                  <p>Pour une demande de copie intégrale ou un extrait simple, il faut présenter sa pièce d'identité et une copie de l'extrait de naissance des frais de timbre (500 F CFA /Copie) sont applicables </p>
            <button><a href="{{ route('utilisateur.dashboard') }}">Faire une demande</a></button>
           </div>
        </div>
    <script>
        const slider = document.getElementById('slider');
        const slides = document.querySelectorAll('.slide');
        let currentIndex = 0;
        const dropdown = document.querySelector('.dropdown');
        const dropdownLinks = document.querySelectorAll('.dropdown-content a');
        const modals = document.querySelectorAll('.modal');
        const closeBtns = document.querySelectorAll(".close");
        const naissanceLink = document.getElementById('naissanceLink');

        function updateSlider() {
            slider.style.transform = `translateX(${-currentIndex * 100}%)`;
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            updateSlider();
        }

        setInterval(nextSlide, 3000);

        naissanceLink.addEventListener('click', function(event){
             event.preventDefault();
             dropdown.classList.toggle('active');
        });

       dropdownLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const modalId = this.getAttribute('data-modal');
                modals.forEach(modal => modal.classList.remove('active')); // Fermer toute modales
                const modal = document.getElementById(modalId);
                modal.classList.add('active'); //Ouvrir la bonne modale
               dropdown.classList.remove('active');
              });
        });

     closeBtns.forEach(btn => {
         btn.onclick = () => {
           modals.forEach(modal => modal.classList.remove('active'));
          }
     });

        window.onclick = (event) => {
           if(!dropdown.contains(event.target) ){
           dropdown.classList.remove('active');
          }
           modals.forEach(modal => {
             if(event.target === modal) {
              modal.classList.remove('active')
           }
         });
        }
    </script>
</body>
</html>