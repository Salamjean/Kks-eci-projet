<!-- dashboard.blade.php -->
@if($user->has_actions)

<!-- Afficher les actions ou les informations spécifiques -->
@else
<x-app-layout>
  <x-slot name="header">
      <div class="font-semibold text-xl text-gray-800 text-center leading-tight" style="display: flex; justify-content:center; ">
         Bienvenue sur la page de la mairie de {{ Auth::user()->commune }}
      </div>
  </x-slot>
  <!DOCTYPE html>
  <html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="{{ asset('assets1/css/style.css') }}">
    <title>Service Details - EstateAgency Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
      <!-- Favicons -->
  
  
  <!-- Fonts -->
   <link rel="icon" href="haut.png">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  
  
    <!-- =======================================================
    * Template Name: EstateAgency
    * Template URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
    * Updated: Aug 09 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
  </head>
  
  <body class="service-details-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
      <div class="row" style="width:100%; justify-content:center">
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
    </div>
    </header>
    
    <main class="main">
  
      <!-- Page Title -->
      <div class="page-title" data-aos="fade">
        <div class="heading">
          <div class="container">
            <div class="row d-flex justify-content-center text-center">
              
            </div>
          </div>
        </div>
   
        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://unpkg.com/tailwindcss@1.3.4/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body class="h-screen flex items-center justify-center bg-gray-100">
            <div class="container">
                <nav class="breadcrumbs rounded-lg ml-16 shadow-md w-full">
                    <ol class="flex items-center justify-center space-x-4">
                        <!-- Select -->
                        <li class="flex items-center">
                            <label for="demandes" class="text-sm mr-2">Sélectionnez une demande ({{ $nombreDemandes }}) :</label>
                            <select id="demandes" class="block p-2 border border-gray-300 rounded-md h-12" onchange="updateStatus()">
                              @forelse ($demandes as $demande)
                                  <option value="{{ $demande->etat }}" {{ $loop->first ? 'selected' : '' }}>
                                      {{ isset($demande->type) && $demande->type === 'naissance' 
                                          ? 'Demande n° ' . $demande->id . ' d\'extrait de naissance' 
                                          : 'Demande n° ' . $demande->id . ' d\'extrait de naissance' }}
                                  </option>
                              @empty
                                  <option>Aucune demande effectuée</option>
                              @endforelse
                          </select>
                        </li>
        
                        <!-- Steps -->
                        <li class="flex items-center">
                            <div id="step1" class="step bg-gray-300 rounded-lg flex items-center justify-center border border-gray-200 h-12 w-32">
                                <h2 class="font-bold text-sm">en attente</h2>
                            </div>
                        </li>
        
                        <li class="flex items-center">
                            <div id="step2" class="step bg-gray-300 rounded-lg flex items-center justify-center border border-gray-200 h-12 w-32">
                                <h2 class="font-bold text-sm">réçu</h2>
                            </div>
                        </li>
        
                        <li class="flex items-center">
                            <div id="step3" class="step bg-gray-300 rounded-lg flex items-center justify-center border border-gray-200 h-12 w-32">
                                <h2 class="font-bold text-sm">terminé</h2>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        
            <script>
                function updateStatus() {
                    const select = document.getElementById('demandes');
                    const status = select.value;
        
                    const steps = ["en attente", "réçu", "terminé"];
        
                    // Réinitialiser tous les divs
                    document.querySelectorAll('.step').forEach((step, index) => {
                        step.classList.remove('bg-orange-500', 'bg-green-500', 'bg-red-500', 'text-white');
                        step.classList.add('bg-gray-300', 'text-black');
                        step.querySelector('h2').textContent = steps[index];
                    });
        
                    // Mettre à jour le texte et le style de l'étape correspondant à l'état sélectionné
                    if (status === "en attente") {
                        document.getElementById('step1').classList.add('bg-orange-500', 'text-white');
                    } else if (status === "réçu") {
                        document.getElementById('step2').classList.add('bg-green-500', 'text-white');
                    } else if (status === "terminé") {
                        document.getElementById('step3').classList.add('bg-red-500', 'text-white');
                    }
                }
        
                // Mettre à jour l'état de la première demande au chargement de la page
                window.onload = () => {
                    updateStatus();
                };
            </script>
        </body>
        </html>
        

        



      </div><!-- End Page Title -->
  
      <!-- Service Details Section -->
      <section id="service-details" class="service-details section">
  
        <div class="container">
  
          <div class="row gy-5">
  
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            
              <div class="service-box">
               
                <h4>Service Administratif</h4>
                <div class="services-list">
                  <a href="#1" id="demamde0"><i class="bi bi-arrow-right-circle"></i><span>Demande d'extrait de naissance (Nouveau né)</span></a>
                  <a href="#2" id="demamde1"><i class="bi bi-arrow-right-circle"></i><span>Demande d'extrait de naissance </span></a>
                  <a href="#3" id="demamde2"><i class="bi bi-arrow-right-circle"></i><span>Demande d'acte de décès</span></a>
                  <a href="#4" id="demamde3"><i class="bi bi-arrow-right-circle"></i><span>Demande d'acte de Mariage</span></a>
                  
                </div>
              </div><!-- End Services List -->
              <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
              <div class="conteneur-txt" data-aos="fade-up" data-aos-delay="200" id="conteneur-txt">
                <div class="container">
                  <span class="title"></span>
                </div>
                      <img src="{{ asset('assets/images/profiles/services.png') }}" alt="" class="img-fluid services-img">
                      <div class="text">
                        <strong><h3>Informations à lire avant d'effectuer votre demande </h3></strong>
                        <h1>Où obtenir des documents d'état civil ?</h1>
                        <li>
                            Le service de l'état civil détient les actes concernant des événements survenus sur le territoire de la Ville (sauf les transcriptions de décès).
                        </li>
                        <p>
                            <li>
                                Le service de l'état civil détient les actes concernant des événements survenus sur le territoire de la Ville (sauf les transcriptions de décès).
                            </li>
                        </p>
                            
                        <p>
                        <h3>Qui peut obtenir des documents d'état civil ?</h3>
                        </p>
                        <p>
                            <li><i class="bi bi-check-circle"></i> <span>Des copies intégrales ou extraits d’actes de naissance ou mariage avec filiation :</span></li>
                        </p>
                        <p><ol><ul>Toute personne majeure ou émancipée, ascendants, descendants, conjoint, partenaire, représentant légal (sont donc exclus les demandes émanant des frère, soeur, oncle, tante, neveu, nièce, concubin, concubine)</ul></ol></p>
                        <p><li><i class="bi bi-check-circle"></i> <span>Sur indication des noms et prénoms des parents de la personne concernée (préciser le nom de jeune fille)</span></li></p>
                        <p><li><i class="bi bi-check-circle"></i> <span>En précisant de la date de l’événement.</span></li></p>
                        
                        <p>
                        <li>Des extraits d’acte de naissance ou de mariage sans filiation et copies d’actes de décès</li>
                        </p>
                        <p>
                        <li>A tout requérant</li>
                        </p>
                        <p><h3>Quelles sont les modalités de délivrance ?</h3></p>
                        <p>La demande peut être effectuée au guichet, par correspondance, par fax ou par l'intermédiaire des formulaires en ligne.</p>
                        <p>Pour toutes demandes, vous devez préciser votre qualité (personne concernée par l'acte, ascendant, descendant, ...) et indiquez la filiation de la personne concernée (les noms et prénoms de ses parents, nom de jeune fille pour les femmes mariées).</p>
                        <p>En l'absence de vérification possible par le service de l'état civil de votre lien de parenté avec la personne concernée par l'acte, votre demande ne pourra pas être traitée.</p>
                        <p>Aussi, nous vous invitons à effectuer celle-ci par courrier en fournissant la preuve de votre lien de parenté par tout document en votre possession (photocopie de livret de famille, actes d'état civil,...) à la
                            Mairie de votre commume
                            Service de l'Etat Civil </p>
                      </div>
                      
                </div> 
                 
                </div>
                <div class="conteneur-txt-1" id="DnewNais" style="display: none;" >
                  <img src="{{ asset('assets/images/profiles/bb.png') }}" alt="">
                  <div class="text">
                    <h3 class="project_title">Déclaration de Naissance</h3>
                                                      
                      <h3 style="color: #000000;">Comment faire la déclaration de naissance </h3>
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
  
                            
                            <!-- HTML !-->
                  <!-- HTML !-->
                  <button class="button-77" role="button" onclick="openPopup()">
                    Faite Votre demande
                  </button>
                  
                  <script>
                    function openPopup() {
                      // Définir la taille du pop-up
                      var width = 800;
                      var height = 600;
                  
                      // Calculer la position pour centrer le pop-up
                      var left = Math.max((window.innerWidth / 2) - (width / 2), 0);
                      var top = Math.max((window.innerHeight / 2) - (height / 2), 0);
                  
                      // Ouvrir la fenêtre pop-up au centre de l'écran
                      var popupWindow = window.open(
                        "{{ route('naissance.create') }}",
                        "Extrait Demande",
                        "width=" + width + ",height=" + height + ",left=" + left + ",top=" + top + ",resizable=yes,scrollbars=yes"
                      );
                  
                      // Attendre la soumission du formulaire dans la fenêtre pop-up
                      popupWindow.addEventListener('load', function() {
                        // Ajouter un gestionnaire pour la soumission du formulaire dans la pop-up
                        popupWindow.document.querySelector('form').addEventListener('submit', function(event) {
                          event.preventDefault();  // Empêche la soumission classique du formulaire
                  
                          // Utiliser AJAX (par exemple, fetch ou axios) pour soumettre le formulaire sans recharger la page
                          var form = new FormData(popupWindow.document.querySelector('form'));
                  
                          fetch("{{ route('naissance.store') }}", {
                            method: "POST",
                            body: form,
                            headers: {
                              'X-CSRF-TOKEN': popupWindow.document.querySelector('input[name="_token"]').value
                            }
                          })
                          .then(response => {
                            if (response.ok) {
                              // Attendre 3 secondes avant de fermer la fenêtre pop-up
                              setTimeout(function() {
                                popupWindow.close();
                                // Afficher un message de succès sur la page principale
                                displaySuccessMessage();
                              }, 100);  // 2000 millisecondes = 2 secondes
                            } else {
                              alert('Erreur lors de la soumission');
                            }
                          })
                          .catch(error => {
                            console.error('Erreur:', error);
                          });
                        });
                      });
                    }
                  
                    // Fonction pour afficher le message de succès sur la page principale
                    function displaySuccessMessage() {
                      var successMessage = document.createElement('div');
                      successMessage.className = 'success-message';
                      successMessage.innerHTML = '<p>Votre demande a été envoyée avec succès !</p>';
                      document.body.appendChild(successMessage);
                  
                      // Vous pouvez aussi styliser le message via CSS, par exemple :
                      successMessage.style.position = 'fixed';
                      successMessage.style.top = '20px';
                      successMessage.style.left = '50%';
                      successMessage.style.transform = 'translateX(-50%)';
                      successMessage.style.padding = '10px 20px';
                      successMessage.style.backgroundColor = '#4CAF50';
                      successMessage.style.color = 'white';
                      successMessage.style.fontSize = '16px';
                      successMessage.style.borderRadius = '5px';
                      successMessage.style.zIndex = '9999';
                  
                      // Masquer le message après quelques secondes
                      setTimeout(function() {
                        successMessage.style.display = 'none';
                      }, 5000);  // 5000 millisecondes = 5 secondes
                    }
                  </script>
                
                  </div>

                </div>	
  
                <div class="conteneur-txt-2" id="Dnaissance" style="display: none;" >
                  <img src="{{ asset('assets/images/profiles/bébé.png') }}" alt="">
                  <div class="text">
                    <h3 class="project_title">Demande d'extrait de Naissance</h3>
                                                      
                        <p>
                          <h3 style="color: #000000;">Comment obtenir un extrait de naissance</h3>	
                        </p>
                        <p><h4>Vous souhaitez obtenir un extrait de naissance pour une personne (adulte ou enfant) ? Voici les étapes simples à suivre pour faire votre demande :</h4></p>
  
                        <p>Avant de commencer la procédure, assurez-vous d'avoir les informations suivantes :</p>
                        <p>
                          <li><strong>Numéro de l'acte de naissance </strong>de la personne concernée.</li>
                          <li><strong>Nom et prénoms</strong></li>
                          
                        </p>
                          
                        <button class="button-77" role="button" onclick="openPopup1()">
                          Faite Votre demande
                        </button>
                        
                        <script>
                          function openPopup1() {
                            // Définir la taille du pop-up
                            var width = 800;
                            var height = 600;
                        
                            // Calculer la position pour centrer le pop-up
                            var left = Math.max((window.innerWidth / 2) - (width / 2), 0);
                            var top = Math.max((window.innerHeight / 2) - (height / 2), 0);
                        
                            // Ouvrir la fenêtre pop-up au centre de l'écran
                            var popupWindow = window.open(
                              "{{ route('naissanced.create') }}",
                              "Extrait Demande",
                              "width=" + width + ",height=" + height + ",left=" + left + ",top=" + top + ",resizable=yes,scrollbars=yes"
                            );
                        
                            // Attendre la soumission du formulaire dans la fenêtre pop-up
                            popupWindow.addEventListener('load', function() {
                              // Ajouter un gestionnaire pour la soumission du formulaire dans la pop-up
                              popupWindow.document.querySelector('form').addEventListener('submit', function(event) {
                                event.preventDefault();  // Empêche la soumission classique du formulaire
                        
                                // Utiliser AJAX (par exemple, fetch ou axios) pour soumettre le formulaire sans recharger la page
                                var form = new FormData(popupWindow.document.querySelector('form'));
                        
                                fetch("{{ route('naissanced.store') }}", {
                                  method: "POST",
                                  body: form,
                                  headers: {
                                    'X-CSRF-TOKEN': popupWindow.document.querySelector('input[name="_token"]').value
                                  }
                                })
                                .then(response => {
                                  if (response.ok) {
                                    // Attendre 3 secondes avant de fermer la fenêtre pop-up
                                    setTimeout(function() {
                                      popupWindow.close();
                                      // Afficher un message de succès sur la page principale
                                      displaySuccessMessage();
                                    }, 100);  // 2000 millisecondes = 2 secondes
                                  } else {
                                    alert('Erreur lors de la soumission');
                                  }
                                })
                                .catch(error => {
                                  console.error('Erreur:', error);
                                });
                              });
                            });
                          }
                        
                          // Fonction pour afficher le message de succès sur la page principale
                          function displaySuccessMessage() {
                            var successMessage = document.createElement('div');
                            successMessage.className = 'success-message';
                            successMessage.innerHTML = '<p>Votre demande a été envoyée avec succès !</p>';
                            document.body.appendChild(successMessage);
                        
                            // Vous pouvez aussi styliser le message via CSS, par exemple :
                            successMessage.style.position = 'fixed';
                            successMessage.style.top = '20px';
                            successMessage.style.left = '50%';
                            successMessage.style.transform = 'translateX(-50%)';
                            successMessage.style.padding = '10px 20px';
                            successMessage.style.backgroundColor = '#4CAF50';
                            successMessage.style.color = 'white';
                            successMessage.style.fontSize = '16px';
                            successMessage.style.borderRadius = '5px';
                            successMessage.style.zIndex = '9999';
                        
                            // Masquer le message après quelques secondes
                            setTimeout(function() {
                              successMessage.style.display = 'none';
                            }, 5000);  // 5000 millisecondes = 5 secondes
                          }
                        </script>
                        
                        
                      
                      
                        
                  </div>
                      
              </div>	
              
              <div class="conteneur-txt-3" id="Ddeces" style="display: none;">
                <img src="{{ asset('assets/images/profiles/deces.png') }}" alt="">
                <div class="text">
                  <h3 class="project_title">Déclaration de Décès</h3>
                  <h5>Comment faire la déclaration de naissance</h5>
                      <p> il faut :
                      <ul class="">
                          <li>- Procès-verbal de constations de décès ; </li></br>
                          <li>- Une pièce d'identité du defunt(Carte nationale d’identité,extrait de naissance , passeport ou certificat de nationalité )  </li>
                          <li>- Une pièce d'identité du déclarant(Carte nationale d’identité,extrait de naissance , passeport ou certificat de nationalité )  </li></br>
                          <li>- Copie de l'acte de mariage si le defunt etait marié</li>		
                          <li>- Copie du de-par-la loi s’il y a lieu</li>		
                          
                      </ul>
                      Délai : Quinze (15) jours à compter du jour du décès.
                      </p>																						
                  
                  <h3 class="project_title">Acte de décès</h3>
                  <p>
                      Acte de décès peut donner lieu à la délivrance de 2 documents différents : la copie intégrale, l'extrait simple .</br>
                      La copie intégrale comporte des informations sur la personne concernée par l'acte (nom, prénoms, date et lieu de naissance), des informations sur ses parents et les mentions marginales lorsqu'elles existent.	</br>												
                      Un extrait simple  comporte uniquement les informations sur la personne concernée par l'acte de décès.
                  </p>
                  <h5 >Comment faire la demande</h5>
                  <p>Pour une demande de copie intégrale ou un extrait simple, il faut présenter sa pièce d'identité et une copie de l'extrait de décès des frais de timbre (500 F CFA /Copie) sont applicables </p>
                  <button class="button-77" role="button" onclick="openPopup2()">
                    Faite Votre demande
                  </button>
                  
                  <script>
                    function openPopup2() {
                      // Définir la taille du pop-up
                      var width = 800;
                      var height = 600;
                  
                      // Calculer la position pour centrer le pop-up
                      var left = Math.max((window.innerWidth / 2) - (width / 2), 0);
                      var top = Math.max((window.innerHeight / 2) - (height / 2), 0);
                  
                      // Ouvrir la fenêtre pop-up au centre de l'écran
                      var popupWindow = window.open(
                        "{{ route('deces.create') }}",
                        "Extrait Demande",
                        "width=" + width + ",height=" + height + ",left=" + left + ",top=" + top + ",resizable=yes,scrollbars=yes"
                      );
                  
                      // Attendre la soumission du formulaire dans la fenêtre pop-up
                      popupWindow.addEventListener('load', function() {
                        // Ajouter un gestionnaire pour la soumission du formulaire dans la pop-up
                        popupWindow.document.querySelector('form').addEventListener('submit', function(event) {
                          event.preventDefault();  // Empêche la soumission classique du formulaire
                  
                          // Utiliser AJAX (par exemple, fetch ou axios) pour soumettre le formulaire sans recharger la page
                          var form = new FormData(popupWindow.document.querySelector('form'));
                  
                          fetch("{{ route('deces.store') }}", {
                            method: "POST",
                            body: form,
                            headers: {
                              'X-CSRF-TOKEN': popupWindow.document.querySelector('input[name="_token"]').value
                            }
                          })
                          .then(response => {
                            if (response.ok) {
                              // Attendre 3 secondes avant de fermer la fenêtre pop-up
                              setTimeout(function() {
                                popupWindow.close();
                                // Afficher un message de succès sur la page principale
                                displaySuccessMessage();
                              }, 100);  
                            } else {
                              alert('Erreur lors de la soumission');
                            }
                          })
                          .catch(error => {
                            console.error('Erreur:', error);
                          });
                        });
                      });
                    }
                  
                    // Fonction pour afficher le message de succès sur la page principale
                    function displaySuccessMessage() {
                      var successMessage = document.createElement('div');
                      successMessage.className = 'success-message';
                      successMessage.innerHTML = '<p>Votre demande a été envoyée avec succès !</p>';
                      document.body.appendChild(successMessage);
                  
                      // Vous pouvez aussi styliser le message via CSS, par exemple :
                      successMessage.style.position = 'fixed';
                      successMessage.style.top = '20px';
                      successMessage.style.left = '50%';
                      successMessage.style.transform = 'translateX(-50%)';
                      successMessage.style.padding = '10px 20px';
                      successMessage.style.backgroundColor = '#4CAF50';
                      successMessage.style.color = 'white';
                      successMessage.style.fontSize = '16px';
                      successMessage.style.borderRadius = '5px';
                      successMessage.style.zIndex = '9999';
                  
                      // Masquer le message après quelques secondes
                      setTimeout(function() {
                        successMessage.style.display = 'none';
                      }, 5000);  // 5000 millisecondes = 5 secondes
                    }
                  </script>
                </div>
                  
                </div> 
              
               <div class="conteneur-txt-4" id="Dmariage" style="display: none;">
                <div class="text">
                  
                </div>
    
                <img src="{{ asset('assets/images/profiles/mariage.png') }}" alt="">
                <div class="text">
                
                  <h3 class="project_title">Acte de Mariage</h3>
                  
                          <p>
                            Un acte de mariage peut donner lieu à la délivrance de 2 documents différents : la copie intégrale, l'extrait simple .</br>
                            La copie intégrale comporte des informations sur les époux (noms, prénoms, dates et lieu de naissance), des informations sur leurs parents et les mentions marginales lorsqu'elles existent. 	</br>												
                            Un extrait simple  comporte uniquement les informations  sur les époux. 
                          </p>
                          <h5>Comment faire la demande</h5>
                          <p>Pour une demande de copie intégrale ou un extrait simple, il faut présenter sa pièce d'identité et une copie de l'extrait de mariage.des frais de timbre (500 F CFA /Copie) sont applicables </p>
                          
                          <h3 class="project_title">Mariage Civil</h3>
                          <h5>Les formalités de mariage</h5>
                          <p>Le mariage doit être célébré à la mairie. Toutefois, des exceptions sont prévues. En effet, en cas d'empêchement grave, le procureur de la République pourra demander à l'officier d'état civil de se déplacer au domicile ou à la résidence de l'une des parties pour célébrer le mariage. 
                          </p>
                          <h5>Le nombre de témoins pour la célébration du mariage</h5>
                          <p>
                          La célébration du mariage doit être faite par un officier de l'état civil, à la mairie, en présence de deux témoins.
                          </p>
                          <h5>Constituer son dossier de mariage</h5>
                          <p>Il faut vous rendre au Service Mariage de la Mairie de Cocody pour obtenir les documents à fournir 
                           et faire la réservation de la date du mariage 
                          </p>
                          <button class="button-77" role="button" onclick="openPopup3()">
                            Faite Votre demande
                          </button>
                          
                          <script>
                            function openPopup3() {
                              // Définir la taille du pop-up
                              var width = 800;
                              var height = 600;
                          
                              // Calculer la position pour centrer le pop-up
                              var left = Math.max((window.innerWidth / 2) - (width / 2), 0);
                              var top = Math.max((window.innerHeight / 2) - (height / 2), 0);
                          
                              // Ouvrir la fenêtre pop-up au centre de l'écran
                              var popupWindow = window.open(
                                "{{ route('mariage.create') }}",
                                "Extrait Demande",
                                "width=" + width + ",height=" + height + ",left=" + left + ",top=" + top + ",resizable=yes,scrollbars=yes"
                              );
                          
                              // Attendre la soumission du formulaire dans la fenêtre pop-up
                              popupWindow.addEventListener('load', function() {
                                // Ajouter un gestionnaire pour la soumission du formulaire dans la pop-up
                                popupWindow.document.querySelector('form').addEventListener('submit', function(event) {
                                  event.preventDefault();  // Empêche la soumission classique du formulaire
                          
                                  // Utiliser AJAX (par exemple, fetch ou axios) pour soumettre le formulaire sans recharger la page
                                  var form = new FormData(popupWindow.document.querySelector('form'));
                          
                                  fetch("{{ route('mariage.store') }}", {
                                    method: "POST",
                                    body: form,
                                    headers: {
                                      'X-CSRF-TOKEN': popupWindow.document.querySelector('input[name="_token"]').value
                                    }
                                  })
                                  .then(response => {
                                    if (response.ok) {
                                      // Attendre 3 secondes avant de fermer la fenêtre pop-up
                                      setTimeout(function() {
                                        popupWindow.close();
                                        // Afficher un message de succès sur la page principale
                                        displaySuccessMessage();
                                      }, 100);  
                                    } else {
                                      alert('Erreur lors de la soumission');
                                    }
                                  })
                                  .catch(error => {
                                    console.error('Erreur:', error);
                                  });
                                });
                              });
                            }
                          
                            // Fonction pour afficher le message de succès sur la page principale
                            function displaySuccessMessage() {
                              var successMessage = document.createElement('div');
                              successMessage.className = 'success-message';
                              successMessage.innerHTML = '<p>Votre demande a été envoyée avec succès !</p>';
                              document.body.appendChild(successMessage);
                          
                              // Vous pouvez aussi styliser le message via CSS, par exemple :
                              successMessage.style.position = 'fixed';
                              successMessage.style.top = '20px';
                              successMessage.style.left = '50%';
                              successMessage.style.transform = 'translateX(-50%)';
                              successMessage.style.padding = '10px 20px';
                              successMessage.style.backgroundColor = '#4CAF50';
                              successMessage.style.color = 'white';
                              successMessage.style.fontSize = '16px';
                              successMessage.style.borderRadius = '5px';
                              successMessage.style.zIndex = '9999';
                          
                              // Masquer le message après quelques secondes
                              setTimeout(function() {
                                successMessage.style.display = 'none';
                              }, 5000);  // 5000 millisecondes = 5 secondes
                            }
                          </script>
                </div>
                  
               </div>
          </div>
          <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center active"><img src="{{ asset('assets/images/profiles/haut.png') }}" alt="" class="haut"></a>
          
          <script>
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
</x-app-layout>
@endif



