<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="">
    <meta name='copyright' content=''>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Title -->
    <title>E-ci. demande en ligne</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets4/img/favicon.png') }}">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/css/responsive.css') }}">
    
    <style>
         html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
        background-image: url('{{ asset('assets4/img/docu.jpg') }}'); /* Remplacez par le chemin de votre image */
        background-size: cover; 
        background-position: center;
        background-repeat: no-repeat; 
    }
    .main-wrapper {
        flex: 1;
        display: flex;
        align-items: stretch;
    }
    .image-container {
        flex: 0 0 30%; 
        background-size: contain; 
        background-position: center;
        background-repeat: no-repeat;
    }
    .left-image {
        background-image: url('{{ asset('assets4/img/docu.png') }}');
    }
    .right-image {
        background-image: url('{{ asset('assets4/img/docu.png') }}');
    }
    .content {
        flex: 2;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8); /* Ajoutez un fond semi-transparent pour le contenu */
        text-align: center;
    }
    footer {
        margin-top: auto;
    }
    p,h4,li{
     font-size: 20px;
 }
	</style>
</head>
<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>
            <div class="indicator"> 
                <svg width="16px" height="12px">
                    <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                </svg>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header Area -->
    <header class="header">
        <div class="header-inner" style="background-color:orange; position:fixed; width:100%; z-index:1000">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12">
                            <div class="logo">
                                <a href="{{ route('general') }}"><img src="{{ asset('assets4/img/logoo.png') }}" style="width:90px; height:70px" alt="#"></a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-9 col-12">
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu">
                                        <li><a href="{{ route('general') }}" style="color:white">Accueil</a></li>
                                        <li class="active"><a href="#" style="color:white">Naissance <i class="icofont-rounded-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="{{ route('naissanceavec') }}">Demande d'extrait avec Certificat</a></li>
                                                <li><a href="{{ route('naissancesans') }}">Demande d'extrait simple </a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#" style="color:white">Décès <i class="icofont-rounded-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="{{ route('decesavec') }}">Extrait avec certificat</a></li>
                                                <li><a href="{{ route('decessans') }}">Extrait simple</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('mariagesans') }}" style="color:white">Mariage</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12 d-flex gap-4">
                            <div class="get-quote">
                                <a href="{{ route('login') }}" class="btn" style="background-color: green">Se connecter</a>
                            </div>&emsp;
                            <div class="get-quote">
                                <a href="{{ route('register') }}" class="btn" style="background-color: green">S'inscrire</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Area -->
    <br><br>
    <!-- Error Page -->
    <div class="main-wrapper">
       
        <section class="error-page section content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 offset-lg-0 col-12">
                        <div class="error-inner">
                            <br><br><br><br><br><h1 style="font-size: 60px; color:black">Acte de Naissance Simple/integrale</h1>
                            <p>Un acte de naissance peut donner lieu à la délivrance de 2 documents différents : la copie intégrale, l'extrait simple. La copie intégrale comporte des informations sur la personne concernée par l'acte (nom, prénoms, date et lieu de naissance), des informations sur ses parents et les mentions marginales lorsqu'elles existent. Un extrait simple comporte uniquement les informations sur la personne concernée par l'acte de naissance.</p>
                            <p>Pour une demande d'extrait de naissance simple/integrale, <br><br>
                                il faut :
                                <li>Nom et prénoms sur l'extrait</li>
                                <li>Le numéro de registre</li>
                                <li>La date de registre</li>
                                <li>La commune de naissance</li>
                                <li>Joindre la pièce de d'identité</li>
                                <li>Timbre (500 F CFA /Copie)</li>
                            </p>
                            <div class="get-quote">
                                <a href="{{ route('utilisateur.dashboard') }}" class="btn" style="background-color: green; padding:25px; width:300px">Faites votre demande</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!--/ End Error Page -->
    
    <!-- Footer Area -->
    <footer id="footer" class="footer">
        <div class="copyright" style="background-color: green">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mt-0">
                        <div class="copyright-content">
                            <p class="mb-0">© Copyright 2024  |  All Rights Reserved by <a href="https://kks-technologies.com/" target="_blank">kks-technologies</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ End Footer Area -->

    <!-- Scripts -->
    <script src="{{ asset('assets4/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets4/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('assets4/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets4/js/easing.js') }}"></script>
    <script src="{{ asset('assets4/js/colors.js') }}"></script>
    <script src="{{ asset('assets4/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets4/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets4/js/jquery.nav.js') }}"></script>
    <script src="{{ asset('assets4/js/slicknav.min.js') }}"></script>
    <script src="{{ asset('assets4/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('assets4/js/niceselect.js') }}"></script>
    <script src="{{ asset('assets4/js/tilt.jquery.min.js') }}"></script>
    <script src="{{ asset('assets4/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets4/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets4/js/steller.js') }}"></script>
    <script src="{{ asset('assets4/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets4/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDGqTyqoPIvYxhn_Sa7ZrK5bENUWhpCo0w"></script>
    <script src="{{ asset('assets4/js/gmaps.min.js') }}"></script>
    <script src="{{ asset('assets4/js/map-active.js') }}"></script>
    <script src="{{ asset('assets4/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets4/js/main.js') }}"></script>
</body>
</html>