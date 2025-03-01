<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion / Inscription</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="icon" href="{{ asset('assets/images/profiles/E-ci-logo.png') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

    * { box-sizing: border-box; }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      font-family: 'Montserrat', sans-serif;
      height: 100vh;
      margin: -20px 0 50px;
      background-image: url({{ asset('assets/images/profiles/userbg.jpg') }});
      background-size: cover;
    }
    h1 { font-weight: bold; margin: 0; }
    h2 { text-align: center; }
    p { font-size: 14px; font-weight: 100; line-height: 20px; letter-spacing: 0.5px; margin: 20px 0 30px; }
    span { font-size: 12px; }
    a { color: #333; font-size: 14px; text-decoration: none; margin: 15px 0; }
    button {
      border-radius: 20px;
      border: 1px solid #FF4B2B;
      background-color: #FF4B2B;
      color: #FFFFFF;
      font-size: 12px;
      font-weight: bold;
      padding: 12px 45px;
      letter-spacing: 1px;
      text-transform: uppercase;
      transition: transform 80ms ease-in;
    }
    button:active { transform: scale(0.95); }
    button:focus { outline: none; }
    button.ghost { background-color: transparent; border-color: #FFFFFF; }
    form {
      background-color: #FFFFFF;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 0 50px;
      height: 100%;
      text-align: center;
    }
    input, select { background-color: #eee; border: none; padding: 12px 15px; margin: 8px 0; width: 100%; }

    .container {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
      position: relative;
      overflow: hidden;
      width: 768px;
      max-width: 100%;
      min-height: 600px;
    }

    @media (max-width: 768px) {
      .container {
        transform: scale(0.8);
        min-height: 500px;
        width: 90%;
        margin: 0 auto;
        box-shadow: none;
      }
      input, select {
        padding: 8px 12px;
        font-size: 0.9em;
        width: 200px;
      }
      h1, p { font-size: 15px; }
      .creer { font-size: 15px; }
      button { padding: 10px 30px; }
      .accueil {
        margin-bottom: 0 !important;
        margin-top: 10px;
      }
      a {
        font-size: 8px;
        padding: 2px 10px;
      }
    }

    @media (max-width: 480px) {
      .container {
        transform: scale(1.0);
        min-height: 400px;
        width: 90%;
        margin: 0 auto;
        box-shadow: none;
      }
      input, select {
        padding: 4px 10px;
        font-size: 10px;
        width: 160px;
      }
      h1, p { font-size: 15px; }
      .creer { font-size: 12px; }
      button { padding: 6px 30px; }
      .accueil {
        margin-bottom: 10px !important;
        margin-top: 10px;
      }
      a {
        font-size: 8px;
        padding: 6px 10px;
      }
    }

    .form-container {
      position: absolute;
      top: 0;
      height: 100%;
      transition: all 0.6s ease-in-out;
    }
    .sign-in-container { left: 0; width: 50%; z-index: 2; }
    .container.right-panel-active .sign-in-container { transform: translateX(100%); }
    .sign-up-container { left: 0; width: 50%; opacity: 0; z-index: 1; }
    .container.right-panel-active .sign-up-container {
      transform: translateX(100%);
      opacity: 1;
      z-index: 5;
      animation: show 0.6s;
    }
    @keyframes show {
      0%, 49.99% { opacity: 0; z-index: 1; }
      50%, 100% { opacity: 1; z-index: 5; }
    }
    .overlay-container {
      position: absolute;
      top: 0;
      left: 50%;
      width: 50%;
      height: 100%;
      overflow: hidden;
      transition: transform 0.6s ease-in-out;
      z-index: 100;
    }
    .container.right-panel-active .overlay-container { transform: translateX(-100%); }
    .overlay {
      background: linear-gradient(to right, #059652, #52f3a8);
      color: #FFFFFF;
      position: relative;
      left: -100%;
      height: 100%;
      width: 200%;
      transform: translateX(0);
      transition: transform 0.6s ease-in-out;
    }
    .container.right-panel-active .overlay { transform: translateX(50%); }
    .overlay-panel {
      position: absolute;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 0 40px;
      text-align: center;
      top: 0;
      height: 100%;
      width: 50%;
      transform: translateX(0);
      transition: transform 0.6s ease-in-out;
    }
    .overlay-left { transform: translateX(-20%); }
    .container.right-panel-active .overlay-left { transform: translateX(0); }
    .overlay-right { right: 0; transform: translateX(0); }
    .container.right-panel-active .overlay-right { transform: translateX(20%); }
  </style>
</head>
<body>
  <button class="accueil" style="margin-bottom:20px">
    <a href="{{ route('general') }}" class="text-accuei" style="color: white;">Accueil</a>
  </button>
  <div class="container" id="container">
    <!-- Formulaire d'inscription -->
    <div class="form-container sign-up-container">
      <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <h1 class="creer" style="font-size: 20px">Créez votre compte</h1>
        <input type="text" name="name" placeholder="Votre nom" required />
        <input type="text" name="prenom" placeholder="Votre prénom" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Mot de passe" required />
        <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required />
        <div style="display: flex; gap: 10px;">
            <select name="indicatif" style="flex: 1;" required>
            <option value="+225">Côte d'Ivoire (+225)</option>
            <option value="+33">France (+33)</option>
            <option value="+1">États-Unis (+1)</option>
            <option value="+44">Royaume-Uni (+44)</option>
            <option value="+49">Allemagne (+49)</option>
            <option value="+237">Cameroun (+237)</option>
            <option value="+229">Bénin (+229)</option>
            <option value="+221">Sénégal (+221)</option>
            <option value="+234">Nigeria (+234)</option>
            <option value="+233">Ghana (+233)</option>
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
            <option value="+975">Bhoutan (+975)</option>
            <option value="+591">Bolivie (+591)</option>
            <option value="+387">Bosnie-Herzégovine (+387)</option>
            <option value="+267">Botswana (+267)</option>
            <option value="+55">Brésil (+55)</option>
            <option value="+673">Brunei (+673)</option>
            <option value="+359">Bulgarie (+359)</option>
            <option value="+226">Burkina Faso (+226)</option>
            <option value="+257">Burundi (+257)</option>
            <option value="+855">Cambodge (+855)</option>
            <option value="+1">Canada (+1)</option>
            <option value="+238">Cap-Vert (+238)</option>
            <option value="+1345">Îles Caïmans (+1345)</option>
            <option value="+236">République centrafricaine (+236)</option>
            <option value="+235">Tchad (+235)</option>
            <option value="+56">Chili (+56)</option>
            <option value="+86">Chine (+86)</option>
            <option value="+57">Colombie (+57)</option>
            <option value="+269">Comores (+269)</option>
            <option value="+242">République du Congo (+242)</option>
            <option value="+243">République démocratique du Congo (+243)</option>
            <option value="+682">Îles Cook (+682)</option>
            <option value="+506">Costa Rica (+506)</option>
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
            <option value="+503">Salvador (+503)</option>
            <option value="+240">Guinée équatoriale (+240)</option>
            <option value="+291">Érythrée (+291)</option>
            <option value="+372">Estonie (+372)</option>
            <option value="+251">Éthiopie (+251)</option>
            <option value="+500">Îles Falkland (Malouines) (+500)</option>
            <option value="+298">Îles Féroé (+298)</option>
            <option value="+679">Fidji (+679)</option>
            <option value="+358">Finlande (+358)</option>
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
            <option value="+1671">Guam (+1671)</option>
            <option value="+502">Guatemala (+502)</option>
            <option value="+224">Guinée (+224)</option>
            <option value="+245">Guinée-Bissau (+245)</option>
            <option value="+592">Guyana (+592)</option>
            <option value="+509">Haïti (+509)</option>
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
            <option value="+262">Réunion (+262)</option>
            <option value="+40">Roumanie (+40)</option>
            <option value="+7">Russie (+7)</option>
            <option value="+250">Rwanda (+250)</option>
            <option value="+685">Samoa (+685)</option>
            <option value="+378">Saint-Marin (+378)</option>
            <option value="+239">Sao Tomé-et-Principe (+239)</option>
            <option value="+966">Arabie saoudite (+966)</option>
            <option value="+221">Sénégal (+221)</option>
            <option value="+381">Serbie (+381)</option>
            <option value="+248">Seychelles (+248)</option>
            <option value="+232">Sierra Leone (+232)</option>
            <option value="+65">Singapour (+65)</option>
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
            <option value="+39">Vatican (+39)</option>
            <option value="+58">Venezuela (+58)</option>
            <option value="+84">Viêt Nam (+84)</option>
            <option value="+1284">Îles Vierges britanniques (+1284)</option>
            <option value="+1340">Îles Vierges américaines (+1340)</option>
            <option value="+681">Wallis-et-Futuna (+681)</option>
            <option value="+967">Yémen (+967)</option>
            <option value="+260">Zambie (+260)</option>
            <option value="+263">Zimbabwe (+263)</option>
          </select>
          <input type="text" name="contact" placeholder="Numéro de contact" style="flex: 2;" required />
        </div>
        <select id="commune" name="commune" class="block mt-1 w-full" required>
            <option value="">Sélectionnez votre commune de naisance</option>
            <option value="abobo">Abobo</option>
            <option value="adjame">Adjamé</option>
            <option value="attiecoube">Attécoubé</option>
            <option value="cocody">Cocody</option>
            <option value="koumassi">Koumassi</option>
            <option value="marcory">Marcory</option>
            <option value="plateau">Plateau</option>
            <option value="port-bouet">Port-Bouët</option>
            <option value="treichville">Treichville</option>
            <option value="yopougon">Yopougon</option>
            <option value="aboisso">Aboisso</option>
            <option value="abengourou">Abengourou</option>
            <option value="abobo-baoule">Abobo-Baoulé</option>
            <option value="agboville">Agboville</option>
            <option value="agni-bouake">Agni-Bouaké</option>
            <option value="allankoua">Allankoua</option>
            <option value="anono">Anono</option>
            <option value="ankoum">Ankoum</option>
            <option value="anyama">Anyama</option>
            <option value="alepe">Alépé</option>
            <option value="ayama">Ayama</option>
            <option value="bagohouo">Bagohouo</option>
            <option value="banga">Banga</option>
            <option value="bamboue">Bamboué</option>
            <option value="bocanda">Bocanda</option>
            <option value="borotou">Borotou</option>
            <option value="bouna">Bouna</option>
            <option value="bounkani">Bounkani</option>
            <option value="bouafle">Bouaflé</option>
            <option value="bouake">Bouaké</option>
            <option value="bounoua">Bounoua</option>
            <option value="dabakala">Dabakala</option>
            <option value="dabou">Dabou</option>
            <option value="daloa">Daloa</option>
            <option value="dimbokro">Dimbokro</option>
            <option value="debine">Débine</option>
            <option value="djangokro">Djangokro</option>
            <option value="dini">Dini</option>
            <option value="ferkessedougou">Ferkessedougou</option>
            <option value="gagnoa">Gagnoa</option>
            <option value="genegbe">Génégbé</option>
            <option value="grand-bassam">Grand-Bassam</option>
            <option value="grand-lahou">Grand-Lahou</option>
            <option value="guiberoua">Guiberoua</option>
            <option value="ikessou">Ikessou</option>
            <option value="jacqueville">Jacqueville</option>
            <option value="kong">Kong</option>
            <option value="korhogo">Korhogo</option>
            <option value="marako">Marako</option>
            <option value="man">Man</option>
            <option value="mondougou">Mondougou</option>
            <option value="nzi">Nzi</option>
            <option value="odienne">Odienné</option>
            <option value="san-pedro">San-Pédro</option>
            <option value="sassandra">Sassandra</option>
            <option value="segueila">Séguéla</option>
            <option value="sénoufo">Sénoufo</option>
            <option value="sikensi">Sikensi</option>
            <option value="songon">Songon</option>
            <option value="solia">Solia</option>
            <option value="soubre">Soubré</option>
            <option value="tabou">Tabou</option>
            <option value="tiago">Tiago</option>
            <option value="tiassale">Tiassalé</option>
            <option value="toumodi">Toumodi</option>
            <option value="zuénoula">Zuénoula</option>
            <option value="chire">Chiré</option>
            <option value="deboudougou">Déboudougou</option>
            <option value="diboke">Diboké</option>
            <option value="doungou">Doungou</option>
            <option value="boura">Boura</option>
            <option value="bofora">Bofora</option>
            <option value="zagoua">Zagoua</option>
        </select>
        <input type="text" name="CMU" placeholder="Entrez votre numéro CMU" required />
        <div class="flex-column">
          <label>Photo de Profil</label>
          <div class="inputForm mb-3">
            <input type="file" name="profile_picture" class="input" />
            @error('profile_picture')
              <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <button style="margin-top: 1px" type="submit" id="registerButton">S'inscrire</button>
      </form>
    </div>

    <!-- Formulaire de connexion -->
    <div class="form-container sign-in-container">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1>Se connecter</h1>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" />
        @error('email')
        <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
        @enderror
        <input type="password" name="password" placeholder="Mot de passe" />
        @error('password')
        <div class="text-danger" style="color: red; text-align:center">{{ $message }}</div>
      @enderror
        <a href="{{ route('password.request') }}" style="text-align: flex">Mot de passe oublié?</a>
        <button type="submit">Connexion</button>
      </form>
    </div>

    <!-- Overlay -->
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Content de vous revoir !</h1>
          <p>Entrez vos informations pour vous connecter</p>
          <button class="ghost" id="signIn">Se connecter</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Bienvenue !</h1>
          <p>Créez un compte et rejoignez-nous !</p>
          <button class="ghost" id="signUp">S'inscrire</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
 const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const registerButton = document.getElementById('registerButton');
const signUpForm = document.querySelector('.sign-up-container form');
const signUpInputs = signUpForm.querySelectorAll('input:not([type="file"]), select');
const passwordInput = signUpForm.querySelector('input[name="password"]');
const passwordConfirmationInput = signUpForm.querySelector('input[name="password_confirmation"]');
const emailInput = signUpForm.querySelector('input[name="email"]');

// Gestion des événements pour les boutons
signUpButton.addEventListener('click', () => container.classList.add("right-panel-active"));
signInButton.addEventListener('click', () => container.classList.remove("right-panel-active"));

// Initialisation de Select2
$(document).ready(function() {
    $('#commune').select2({
        placeholder: "Entrez votre commune de naissance",
        allowClear: true,
        width: '100%'
    });
});

// Fonction pour vérifier les erreurs de formulaire
function getFormErrors() {
    let errorMessages = [];
    
    // Vérification des champs vides
    signUpInputs.forEach(input => {
        if (input.required && !input.value.trim()) {
            let fieldName = input.placeholder || input.name;
            errorMessages.push(`Le champ "${fieldName}" est requis`);
        }
    });

    // Validation de l'email si rempli
    if (emailInput.value.trim()) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value)) {
            errorMessages.push("Le format de l'email est invalide");
        }
    }

    // Validation du mot de passe si rempli
    if (passwordInput.value.trim()) {
        if (passwordInput.value.length < 8) {
            errorMessages.push("Le mot de passe doit avoir au moins 8 caractères");
        }
        if (!/[a-z]/.test(passwordInput.value)) {
            errorMessages.push("Le mot de passe doit contenir au moins une minuscule");
        }
        if (!/[A-Z]/.test(passwordInput.value)) {
            errorMessages.push("Le mot de passe doit contenir au moins : Une majuscule");
        }
        if (!/[0-9]/.test(passwordInput.value)) {
            errorMessages.push("Un chiffre");
        }
        if (!/[@$!%*#?&.]/.test(passwordInput.value)) {
            errorMessages.push("Un caractère spécial (@$!%*#?&.)");
        }
    }

    // Validation de la confirmation du mot de passe
    if (passwordInput.value !== passwordConfirmationInput.value) {
        errorMessages.push("Les mots de passe ne correspondent pas");
    }

    return errorMessages;
}

// Gestion du clic sur le bouton d'inscription
registerButton.addEventListener('click', function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire par défaut
    
    const errors = getFormErrors();
    
    if (errors.length > 0) {
        // Afficher le popup avec les erreurs
        Swal.fire({
            icon: 'error',
            title: 'Erreurs dans le formulaire',
            html: errors.join('<br>'),
            confirmButtonColor: '#FF4B2B'
        });
    } else {
        // Si pas d'erreurs, soumettre le formulaire
        signUpForm.submit();
    }
});

// Initialisation au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Inscription réussie',
            text: '{{ session('success') }}',
            confirmButtonColor: '#FF4B2B'
        });
    @endif
});
  </script>
</body>
</html>