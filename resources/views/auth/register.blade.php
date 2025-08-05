<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    .register-container {
      width: 100%;
      max-width: 800px;
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

    .register-header {
      background-color: #ffa500;
      color: white;
      padding: 30px;
      text-align: center;
      position: relative;
    }

    .register-header h1 {
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .register-header p {
      font-size: 14px;
      opacity: 0.9;
    }

    .register-body {
      padding: 30px;
    }

    .form-columns {
      display: flex;
      gap: 20px;
    }

    .form-column {
      flex: 1;
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

    .input-group input, 
    .input-group select {
      width: 100%;
      padding: 14px 15px 14px 45px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 15px;
      transition: all 0.3s;
      background-color: #f9f9f9;
      appearance: none;
    }

    .input-group input:focus,
    .input-group select:focus {
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

    .phone-group {
      display: flex;
      gap: 10px;
    }

    .phone-group select {
      flex: 1;
      padding: 14px 15px;
    }

    .phone-group input {
      flex: 2;
    }

    .file-input {
      width: 100%;
      padding: 14px 15px;
      border: 1px dashed #ddd;
      border-radius: 8px;
      background-color: #f9f9f9;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s;
    }

    .file-input:hover {
      border-color: #059652;
      background-color: #f0f0f0;
    }

    .register-btn {
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
      margin-top: 10px;
    }

    .register-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(5, 150, 82, 0.4);
    }

    .register-btn:active {
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

    @media (max-width: 768px) {
      .form-columns {
        flex-direction: column;
        gap: 0;
      }
      
      .register-container {
        max-width: 500px;
      }
    }

    @media (max-width: 480px) {
      .register-container {
        border-radius: 12px;
      }
      
      .register-header {
        padding: 25px;
      }
      
      .register-body {
        padding: 25px;
      }
      
      .input-group input,
      .input-group select {
        padding: 12px 15px 12px 40px;
      }
      
      .input-icon, .password-toggle {
        font-size: 16px;
        top: 37px;
      }

      .phone-group {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="register-container">
    <!-- Bouton de retour à l'accueil -->
    <button class="home-btn" onclick="window.location.href='{{ route('general') }}'">
      <i class="fas fa-home"></i>
    </button>
    
    <div class="register-header">
      <img src="{{asset('assets4/img/E-ci.jpg')}}" style="height: 50%; width:25%; border-radius:30%" alt="">
      <h1>Créez votre compte</h1>
      <p>Rejoignez notre communauté dès maintenant</p>
    </div>
    
    <div class="register-body">
      <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="form-columns">
          <!-- Première colonne -->
          <div class="form-column">
            <div class="input-group">
              <label for="name">Nom</label>
              <i class="fas fa-user input-icon"></i>
              <input type="text" id="name" name="name" placeholder="Votre nom" required>
              <div class="error-message" id="name-error">
                @error('name') {{ $message }} @enderror
              </div>
            </div>
            
            <div class="input-group">
              <label for="prenom">Prénom</label>
              <i class="fas fa-user input-icon"></i>
              <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required>
              <div class="error-message" id="prenom-error">
                @error('prenom') {{ $message }} @enderror
              </div>
            </div>
            
            <div class="input-group">
              <label for="email">Adresse email</label>
              <i class="fas fa-envelope input-icon"></i>
              <input type="email" id="email" name="email" placeholder="votre@email.com" required>
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
            
            
          </div>
          
          <!-- Deuxième colonne -->
          <div class="form-column">
            <div class="input-group">
              <label>Numéro de téléphone</label>
              <div class="phone-group">
                <select name="indicatif" required>
                  <option value="+225">Côte d'Ivoire (+225)</option>
                  <option value="+93">Afghanistan (+93)</option>
                  <option value="+355">Albanie (+355)</option>
                  <option value="+213">Algérie (+213)</option>
                  <option value="+1684">Samoa américaines (+1684)</option>
                  <option value="+376">Andorre (+376)</option>
                  <option value="+244">Angola (+244)</option>
                  <option value="+1264">Anguilla (+1264)</option>
                  <option value="+1268">Antigua-et-Barbuda (+1268)</option>
                  <option value="+54">Argentine (+54)</option>
                  <option value="+374">Arménie (+374)</option>
                  <option value="+297">Aruba (+297)</option>
                  <option value="+61">Australie (+61)</option>
                  <option value="+43">Autriche (+43)</option>
                  <option value="+994">Azerbaïdjan (+994)</option>
                  <option value="+1242">Bahamas (+1242)</option>
                  <option value="+973">Bahreïn (+973)</option>
                  <option value="+880">Bangladesh (+880)</option>
                  <option value="+1246">Barbade (+1246)</option>
                  <option value="+375">Biélorussie (+375)</option>
                  <option value="+32">Belgique (+32)</option>
                  <option value="+501">Belize (+501)</option>
                  <option value="+229">Bénin (+229)</option>
                  <option value="+1441">Bermudes (+1441)</option>
                  <option value="+975">Bhoutan (+975)</option>
                  <option value="+591">Bolivie (+591)</option>
                  <option value="+387">Bosnie-Herzégovine (+387)</option>
                  <option value="+267">Botswana (+267)</option>
                  <option value="+55">Brésil (+55)</option>
                  <option value="+246">British Indian Ocean Territory (+246)</option>
                  <option value="+673">Brunei (+673)</option>
                  <option value="+359">Bulgarie (+359)</option>
                  <option value="+226">Burkina Faso (+226)</option>
                  <option value="+257">Burundi (+257)</option>
                  <option value="+855">Cambodge (+855)</option>
                  <option value="+237">Cameroun (+237)</option>
                  <option value="+1">Canada (+1)</option>
                  <option value="+238">Cap-Vert (+238)</option>
                  <option value="+1345">Îles Caïmans (+1345)</option>
                  <option value="+236">République centrafricaine (+236)</option>
                  <option value="+235">Tchad (+235)</option>
                  <option value="+56">Chili (+56)</option>
                  <option value="+86">Chine (+86)</option>
                  <option value="+61">Île Christmas (+61)</option>
                  <option value="+57">Colombie (+57)</option>
                  <option value="+269">Comores (+269)</option>
                  <option value="+242">Congo (+242)</option>
                  <option value="+243">République démocratique du Congo (+243)</option>
                  <option value="+682">Îles Cook (+682)</option>
                  <option value="+506">Costa Rica (+506)</option>
                  <option value="+225">Côte d'Ivoire (+225)</option>
                  <option value="+385">Croatie (+385)</option>
                  <option value="+53">Cuba (+53)</option>
                  <option value="+357">Chypre (+357)</option>
                  <option value="+420">République tchèque (+420)</option>
                  <option value="+45">Danemark (+45)</option>
                  <option value="+253">Djibouti (+253)</option>
                  <option value="+1767">Dominique (+1767)</option>
                  <option value="+1809">République dominicaine (+1809)</option>
                  <option value="+593">Équateur (+593)</option>
                  <option value="+20">Égypte (+20)</option>
                  <option value="+503">El Salvador (+503)</option>
                  <option value="+240">Guinée équatoriale (+240)</option>
                  <option value="+291">Érythrée (+291)</option>
                  <option value="+372">Estonie (+372)</option>
                  <option value="+251">Éthiopie (+251)</option>
                  <option value="+500">Îles Falkland (Malouines) (+500)</option>
                  <option value="+298">Îles Féroé (+298)</option>
                  <option value="+679">Fidji (+679)</option>
                  <option value="+358">Finlande (+358)</option>
                  <option value="+33">France (+33)</option>
                  <option value="+594">Guyane française (+594)</option>
                  <option value="+689">Polynésie française (+689)</option>
                  <option value="+241">Gabon (+241)</option>
                  <option value="+220">Gambie (+220)</option>
                  <option value="+995">Géorgie (+995)</option>
                  <option value="+49">Allemagne (+49)</option>
                  <option value="+233">Ghana (+233)</option>
                  <option value="+350">Gibraltar (+350)</option>
                  <option value="+30">Grèce (+30)</option>
                  <option value="+299">Groenland (+299)</option>
                  <option value="+1473">Grenade (+1473)</option>
                  <option value="+590">Guadeloupe (+590)</option>
                  <option value="+1671">Guam (+1671)</option>
                  <option value="+502">Guatemala (+502)</option>
                  <option value="+224">Guinée (+224)</option>
                  <option value="+245">Guinée-Bissau (+245)</option>
                  <option value="+592">Guyana (+592)</option>
                  <option value="+509">Haïti (+509)</option>
                  <option value="+379">Vatican (+379)</option>
                  <option value="+504">Honduras (+504)</option>
                  <option value="+852">Hong Kong (+852)</option>
                  <option value="+36">Hongrie (+36)</option>
                  <option value="+354">Islande (+354)</option>
                  <option value="+91">Inde (+91)</option>
                  <option value="+62">Indonésie (+62)</option>
                  <option value="+98">Iran (+98)</option>
                  <option value="+964">Irak (+964)</option>
                  <option value="+353">Irlande (+353)</option>
                  <option value="+972">Israël (+972)</option>
                  <option value="+39">Italie (+39)</option>
                  <option value="+1876">Jamaïque (+1876)</option>
                  <option value="+81">Japon (+81)</option>
                  <option value="+962">Jordanie (+962)</option>
                  <option value="+7">Kazakhstan (+7)</option>
                  <option value="+254">Kenya (+254)</option>
                  <option value="+686">Kiribati (+686)</option>
                  <option value="+850">Corée du Nord (+850)</option>
                  <option value="+82">Corée du Sud (+82)</option>
                  <option value="+965">Koweït (+965)</option>
                  <option value="+996">Kirghizistan (+996)</option>
                  <option value="+856">Laos (+856)</option>
                  <option value="+371">Lettonie (+371)</option>
                  <option value="+961">Liban (+961)</option>
                  <option value="+266">Lesotho (+266)</option>
                  <option value="+231">Libéria (+231)</option>
                  <option value="+218">Libye (+218)</option>
                  <option value="+423">Liechtenstein (+423)</option>
                  <option value="+370">Lituanie (+370)</option>
                  <option value="+352">Luxembourg (+352)</option>
                  <option value="+853">Macao (+853)</option>
                  <option value="+389">Macédoine (+389)</option>
                  <option value="+261">Madagascar (+261)</option>
                  <option value="+265">Malawi (+265)</option>
                  <option value="+60">Malaisie (+60)</option>
                  <option value="+960">Maldives (+960)</option>
                  <option value="+223">Mali (+223)</option>
                  <option value="+356">Malte (+356)</option>
                  <option value="+692">Îles Marshall (+692)</option>
                  <option value="+596">Martinique (+596)</option>
                  <option value="+222">Mauritanie (+222)</option>
                  <option value="+230">Maurice (+230)</option>
                  <option value="+262">Mayotte (+262)</option>
                  <option value="+52">Mexique (+52)</option>
                  <option value="+691">Micronésie (+691)</option>
                  <option value="+373">Moldavie (+373)</option>
                  <option value="+377">Monaco (+377)</option>
                  <option value="+976">Mongolie (+976)</option>
                  <option value="+382">Monténégro (+382)</option>
                  <option value="+1664">Montserrat (+1664)</option>
                  <option value="+212">Maroc (+212)</option>
                  <option value="+258">Mozambique (+258)</option>
                  <option value="+95">Myanmar (Birmanie) (+95)</option>
                  <option value="+264">Namibie (+264)</option>
                  <option value="+674">Nauru (+674)</option>
                  <option value="+977">Népal (+977)</option>
                  <option value="+31">Pays-Bas (+31)</option>
                  <option value="+687">Nouvelle-Calédonie (+687)</option>
                  <option value="+64">Nouvelle-Zélande (+64)</option>
                  <option value="+505">Nicaragua (+505)</option>
                  <option value="+227">Niger (+227)</option>
                  <option value="+234">Nigeria (+234)</option>
                  <option value="+683">Niue (+683)</option>
                  <option value="+672">Île Norfolk (+672)</option>
                  <option value="+1670">Îles Mariannes du Nord (+1670)</option>
                  <option value="+47">Norvège (+47)</option>
                  <option value="+968">Oman (+968)</option>
                  <option value="+92">Pakistan (+92)</option>
                  <option value="+680">Palaos (+680)</option>
                  <option value="+970">Palestine (+970)</option>
                  <option value="+507">Panama (+507)</option>
                  <option value="+675">Papouasie-Nouvelle-Guinée (+675)</option>
                  <option value="+595">Paraguay (+595)</option>
                  <option value="+51">Pérou (+51)</option>
                  <option value="+63">Philippines (+63)</option>
                  <option value="+48">Pologne (+48)</option>
                  <option value="+351">Portugal (+351)</option>
                  <option value="+1787">Porto Rico (+1787)</option>
                  <option value="+974">Qatar (+974)</option>
                  <option value="+40">Roumanie (+40)</option>
                  <option value="+7">Russie (+7)</option>
                  <option value="+250">Rwanda (+250)</option>
                  <option value="+262">Réunion (+262)</option>
                  <option value="+590">Saint-Barthélemy (+590)</option>
                  <option value="+290">Sainte-Hélène (+290)</option>
                  <option value="+1869">Saint-Christophe-et-Niévès (+1869)</option>
                  <option value="+1758">Sainte-Lucie (+1758)</option>
                  <option value="+590">Saint-Martin (+590)</option>
                  <option value="+508">Saint-Pierre-et-Miquelon (+508)</option>
                  <option value="+1784">Saint-Vincent-et-les-Grenadines (+1784)</option>
                  <option value="+685">Samoa (+685)</option>
                  <option value="+378">Saint-Marin (+378)</option>
                  <option value="+239">Sao Tomé-et-Principe (+239)</option>
                  <option value="+966">Arabie saoudite (+966)</option>
                  <option value="+221">Sénégal (+221)</option>
                  <option value="+381">Serbie (+381)</option>
                  <option value="+248">Seychelles (+248)</option>
                  <option value="+232">Sierra Leone (+232)</option>
                  <option value="+65">Singapour (+65)</option>
                  <option value="+1721">Saint-Martin (partie néerlandaise) (+1721)</option>
                  <option value="+421">Slovaquie (+421)</option>
                  <option value="+386">Slovénie (+386)</option>
                  <option value="+677">Îles Salomon (+677)</option>
                  <option value="+252">Somalie (+252)</option>
                  <option value="+27">Afrique du Sud (+27)</option>
                  <option value="+211">Soudan du Sud (+211)</option>
                  <option value="+34">Espagne (+34)</option>
                  <option value="+94">Sri Lanka (+94)</option>
                  <option value="+249">Soudan (+249)</option>
                  <option value="+597">Suriname (+597)</option>
                  <option value="+47">Svalbard et Jan Mayen (+47)</option>
                  <option value="+268">Swaziland (+268)</option>
                  <option value="+46">Suède (+46)</option>
                  <option value="+41">Suisse (+41)</option>
                  <option value="+963">Syrie (+963)</option>
                  <option value="+886">Taïwan (+886)</option>
                  <option value="+992">Tadjikistan (+992)</option>
                  <option value="+255">Tanzanie (+255)</option>
                  <option value="+66">Thaïlande (+66)</option>
                  <option value="+670">Timor oriental (+670)</option>
                  <option value="+228">Togo (+228)</option>
                  <option value="+690">Tokelau (+690)</option>
                  <option value="+676">Tonga (+676)</option>
                  <option value="+1868">Trinité-et-Tobago (+1868)</option>
                  <option value="+216">Tunisie (+216)</option>
                  <option value="+90">Turquie (+90)</option>
                  <option value="+993">Turkménistan (+993)</option>
                  <option value="+1649">Îles Turques et Caïques (+1649)</option>
                  <option value="+688">Tuvalu (+688)</option>
                  <option value="+256">Ouganda (+256)</option>
                  <option value="+380">Ukraine (+380)</option>
                  <option value="+971">Émirats arabes unis (+971)</option>
                  <option value="+44">Royaume-Uni (+44)</option>
                  <option value="+1">États-Unis (+1)</option>
                  <option value="+598">Uruguay (+598)</option>
                  <option value="+998">Ouzbékistan (+998)</option>
                  <option value="+678">Vanuatu (+678)</option>
                  <option value="+58">Venezuela (+58)</option>
                  <option value="+84">Viêt Nam (+84)</option>
                  <option value="+1284">Îles Vierges britanniques (+1284)</option>
                  <option value="+1340">Îles Vierges américaines (+1340)</option>
                  <option value="+681">Wallis-et-Futuna (+681)</option>
                  <option value="+967">Yémen (+967)</option>
                  <option value="+260">Zambie (+260)</option>
                  <option value="+263">Zimbabwe (+263)</option>
                </select>
                <input type="text" name="contact" placeholder="Numéro" required>
              </div>
              <div class="error-message" id="contact-error">
                @error('contact') {{ $message }} @enderror
              </div>
            </div>
            
            <div class="input-group">
              <label for="commune">Commune de naissance</label>
              <i class="fas fa-city input-icon"></i>
              <select id="commune" name="commune" required>
                <option value="">Sélectionnez votre commune</option>
                <option value="abobo">Abobo</option>
                <option value="adjame">Adjamé</option>
                <option value="anyama">Anyama</option>
                <option value="attiecoube">Attécoubé</option>
                <option value="cocody">Cocody</option>
                <option value="koumassi">Koumassi</option>
                <option value="marcory">Marcory</option>
                <option value="plateau">Plateau</option>
                <option value="port-bouet">Port-Bouët</option>
                <option value="treichville">Treichville</option>
                <option value="yopougon">Yopougon</option>
                <option value="abengourou">Abengourou</option>
                <option value="aboisso">Aboisso</option>
                <option value="adzope">Adzopé</option>
                <option value="agboville">Agboville</option>
                <option value="agnibilekrou">Agnibilékrou</option>
                <option value="alepe">Alépé</option>
                <option value="bocanda">Bocanda</option>
                <option value="bangolo">Bangolo</option>
                <option value="beoumi">Béoumi</option>
                <option value="biankouma">Biankouma</option>
                <option value="bondoukou">Bondoukou</option>
                <option value="bongouanou">Bongouanou</option>
                <option value="bouafle">Bouaflé</option>
                <option value="bouake">Bouaké</option>
                <option value="bouna">Bouna</option>
                <option value="boundiali">Boundiali</option>
                <option value="dabakala">Dabakala</option>
                <option value="dabou">Dabou</option>
                <option value="daloa">Daloa</option>
                <option value="danane">Danané</option>
                <option value="daoukro">Daoukro</option>
                <option value="dimbokro">Dimbokro</option>
                <option value="divo">Divo</option>
                <option value="duékoué">Duékoué</option>
                <option value="ferkessedougou">Ferkessédougou</option>
                <option value="gagnoa">Gagnoa</option>
                <option value="grand-bassam">Grand-Bassam</option>
                <option value="grand-lahou">Grand-Lahou</option>
                <option value="guiglo">Guiglo</option>
                <option value="issia">Issia</option>
                <option value="jacqueville">Jacqueville</option>
                <option value="katiola">Katiola</option>
                <option value="korhogo">Korhogo</option>
                <option value="lakota">Lakota</option>
                <option value="man">Man</option>
                <option value="mankono">Mankono</option>
                <option value="mbahiakro">M'Bahiakro</option>
                <option value="odienne">Odienné</option>
                <option value="oume">Oumé</option>
                <option value="sakassou">Sakassou</option>
                <option value="san-pedro">San-Pédro</option>
                <option value="sassandra">Sassandra</option>
                <option value="seguela">Séguéla</option>
                <option value="sinfra">Sinfra</option>
                <option value="soubre">Soubré</option>
                <option value="tabou">Tabou</option>
                <option value="tanda">Tanda</option>
                <option value="tiassale">Tiassalé</option>
                <option value="tiebissou">Tiébissou</option>
                <option value="tingrela">Tingréla</option>
                <option value="touba">Touba</option>
                <option value="toulepleu">Toulépleu</option>
                <option value="toumodi">Toumodi</option>
                <option value="vavoua">Vavoua</option>
                <option value="yamoussoukro">Yamoussoukro</option>
                <option value="zuénoula">Zuénoula</option>
              </select>
              <div class="error-message" id="commune-error">
                @error('commune') {{ $message }} @enderror
              </div>
            </div>
            
            <div class="input-group">
              <label for="CMU">Numéro CMU</label>
              <i class="fas fa-id-card input-icon"></i>
              <input type="text" id="CMU" name="CMU" placeholder="Votre numéro CMU" required>
              <div class="error-message" id="cmu-error">
                @error('CMU') {{ $message }} @enderror
              </div>
            </div>
            
            <div class="input-group">
              <label for="password_confirmation">Confirmer le mot de passe</label>
              <i class="fas fa-lock input-icon"></i>
              <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
              <i class="fas fa-eye password-toggle" id="togglePasswordConfirmation"></i>
            </div>
          </div>
        </div>
        <div class="input-group">
              <label>Photo de profil</label>
              <input type="file" id="profile_picture" name="profile_picture" class="file-input" accept="image/*">
              <div class="error-message" id="profile-error">
                @error('profile_picture') {{ $message }} @enderror
              </div>
            </div>
        <button type="submit" class="register-btn">S'inscrire</button>
      </form>
      
      <div class="footer">
        Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
      </div>
    </div>
  </div>

  <script>
    // Afficher les messages d'erreur s'ils existent
    document.addEventListener('DOMContentLoaded', function() {
      // Afficher les erreurs pour chaque champ
      document.querySelectorAll('.error-message').forEach(el => {
        if(el.textContent.trim() !== '') {
          el.style.display = 'block';
        }
      });
      
      // Masquer les erreurs quand on modifie le champ
      document.querySelectorAll('input, select').forEach(input => {
        input.addEventListener('input', function() {
          const errorId = this.name + '-error';
          const errorElement = document.getElementById(errorId);
          if(errorElement) {
            errorElement.style.display = 'none';
          }
        });
      });

      // Fonctionnalité d'affichage/masquage du mot de passe
      const togglePassword = document.getElementById('togglePassword');
      const password = document.getElementById('password');
      
      togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });

      // Fonctionnalité d'affichage/masquage de la confirmation du mot de passe
      const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
      const passwordConfirmation = document.getElementById('password_confirmation');
      
      togglePasswordConfirmation.addEventListener('click', function() {
        const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmation.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });

      // Prévisualisation de l'image sélectionnée
      const fileInput = document.getElementById('profile_picture');
      fileInput.addEventListener('change', function(e) {
        if(e.target.files.length > 0) {
          const fileName = e.target.files[0].name;
          this.nextElementSibling.textContent = fileName;
        }
      });
    });
  </script>
</body>
</html>