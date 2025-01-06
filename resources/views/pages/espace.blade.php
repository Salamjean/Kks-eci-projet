
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
        <title>E-ci. demande en ligne.</title>
		
		<!-- Favicon -->
        <link rel="icon" href="{{ asset('assets4/img/favicon.png') }}">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('assets4/css/bootstrap.min.css') }}">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="{{ asset('assets4/css/nice-select.css') }}">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="{{ asset('assets4/css/font-awesome.min.css') }}">
		<!-- icofont CSS -->
        <link rel="stylesheet" href="{{ asset('assets4/css/icofont.css') }}">
		<!-- Slicknav -->
		<link rel="stylesheet" href="{{ asset('assets4/css/slicknav.min.css') }}">
		<!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="{{ asset('assets4/css/owl-carousel.css') }}">
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="{{ asset('assets4/css/datepicker.css') }}">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="{{ asset('assets4/css/animate.min.css') }}">
		<!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="{{ asset('assets4/css/magnific-popup.css') }}">
		
		<!-- Medipro CSS -->
        <link rel="stylesheet" href="{{ asset('assets4/css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('assets4/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets4/css/responsive.css') }}">
		<style>
			html, body {
			    height: 100%;
			    margin: 0;
			    display: flex;
			    flex-direction: column;
			}

			.main-wrapper {
			    flex: 1; /* Permet au contenu de prendre tout l'espace disponible */
			}

			footer {
			    margin-top: auto; /* Place le footer en bas si l'espace est vide */
			}
					html, body {
		    height: 100%;
		    margin: 0;
		    display: flex;
		    flex-direction: column;
			}

			.main-wrapper {
			    flex: 1; /* Permet au contenu de prendre tout l'espace disponible */
			}

			footer {
			    margin-top: auto; /* Place le footer en bas si l'espace est vide */
			}

						html, body {
			    height: 100%;
			    margin: 0;
			    display: flex;
			    flex-direction: column;
			}

			.main-wrapper {
			    flex: 1; /* Permet au contenu de prendre tout l'espace disponible */
			}

			footer {
			    margin-top: auto; /* Place le footer en bas si l'espace est vide */
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
		<header class="header" >
			<!-- Header Inner -->
			<div class="header-inner" style="background-color:orange; position:fixed; width:100%; z-index:1000">
				<div class="container">
					<div class="inner">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-12">
								<!-- Start Logo -->
								<div class="logo">
									<a href="{{ route('general') }}"><img src="{{ asset('assets4/img/logoo.png') }}" style="width:90px; height:70px" alt="#"></a>
								</div>
								<!-- End Logo -->
								<!-- Mobile Nav -->
								<div class="mobile-nav"></div>
								<!-- End Mobile Nav -->
							</div>
							<div class="col-lg-7 col-md-9 col-12">
								<!-- Main Menu -->
									<div class="main-menu">
										<nav class="navigation" >
											<ul class="nav menu">
												<li class="active"><a href="{{ route('general') }}" style="color:white">Accueil</a>
												</li>
												<li><a href="#" style="color:white">Naissance <i class="icofont-rounded-down"></i></a>
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
								<!--/ End Main Menu -->
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
			<!--/ End Header Inner -->
		</header>
		<!-- End Header Area -->
		
		<!-- Slider Area -->
		<section class="slider">
			<div class="hero-slider">
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url({{ asset('assets4/img/bebeslide.jpeg') }})">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1 ><span style="color:black">Demande d'acte de Naissance</span></h1>
									<p>Un acte de naissance peut donner lieu à la délivrance de 2 documents différents : Faire la demande avec le certificat ou une demande simple/intégrale</p>
									<div class="button" >
										<a href="{{ route('naissanceavec') }}" class="btn" style="background-color:green" >Voir plus <br>Avec certificat</a>
										<a href="{{ route('naissancesans') }}" id="prim" class="btn primary">Voir plus <br>Simple/integrale</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single Slider -->
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url({{ asset('assets4/img/mariageeee.jpeg') }})">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1><span style="color: black">Demande d'acte de mariage</span></h1>
									<p>Un acte de mariage peut donner lieu à la délivrance de 2 documents différents : la copie intégrale, l'extrait simple . </p>
									<div class="button">
										<a href="{{ route('mariagesans') }}" class="btn" style="background-color:green">Voir plus <br>Simple/integrale</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Start End Slider -->
				<!-- Start Single Slider -->
				<div class="single-slider" style="background-image:url({{ asset('assets4/img/decesff.jpeg') }})">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1><span style="color:black">Demande d'acte de Décès</span></h1>
									<p>Un acte de naissance peut donner lieu à la délivrance de 2 documents différents : Faire la demande avec le certificat ou une demande simple/intégrale</p>
									<div class="button">
										<a href="{{ route('decesavec') }}" class="btn" style="background-color:green">Voir plus <br>Avec certificat</a>
										<a href="{{ route('decessans') }}" class="btn primary">Voir plus <br>Simple/integrale</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Single Slider -->
			</div>
		</section>
		<!--/ End Slider Area -->
		
		<!-- Start Schedule Area -->
		<section class="schedule">
			<div class="container">
				<div class="schedule-inner">
					<div class="row">
						<div class="col-lg-4 col-md-6 col-12 " >
							<!-- single-schedule -->
							<div class="single-schedule first" style="background-color:green">
								<div class="inner" style="background-color:green">
									<div class="icon">
										<i class="fa fa-ambulance"></i>
									</div>
									<div class="single-content" >
										<span>Vous pouvez faire votre demande :</span>
										<h4>Emergency Cases</h4>
										<p>Lorem ipsum sit amet consectetur adipiscing elit. Vivamus et erat in lacus convallis sodales.</p>
										<a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-12">
							<!-- single-schedule -->
							<div class="single-schedule middle" style="background-color:green">
								<div class="inner" style="background-color:green">
									<div class="icon">
										<i class="icofont-prescription"></i>
									</div>
									<div class="single-content">
										<span>Fusce Porttitor</span>
										<h4>Doctors Timetable</h4>
										<p>Lorem ipsum sit amet consectetur adipiscing elit. Vivamus et erat in lacus convallis sodales.</p>
										<a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-12">
							<!-- single-schedule -->
							<div class="single-schedule last" style="background-color:green">
								<div class="inner" style="background-color:green">
									<div class="icon">
										<i class="icofont-ui-clock"></i>
									</div>
									<div class="single-content">
										<span>Donec luctus</span>
										<h4>Opening Hours</h4>
										<ul class="time-sidual">
											<li class="day">Monday - Fridayp <span>8.00-20.00</span></li>
											<li class="day">Saturday <span>9.00-18.30</span></li>
											<li class="day">Monday - Thusday <span>9.00-15.00</span></li>
										</ul>
										<a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/End Start schedule Area -->

		
		<!-- Footer Area -->
		<footer id="footer" class="footer mb-0">
			<!-- Copyright -->
			<div class="copyright" style="background-color: green">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="copyright-content">
								<p class="mb-0">© Copyright 2024  |  All Rights Reserved by <a href="https://kks-technologies.com/" target="_blank">kks-technologies</a> </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!--/ End Footer Area -->
		
		<!-- jquery Min JS -->
        <script src="{{ asset('assets4/js/jquery.min.js') }}"></script>
		<!-- jquery Migrate JS -->
		<script src="{{ asset('assets4/js/jquery-migrate-3.0.0.js') }}"></script>
		<!-- jquery Ui JS -->
		<script src="{{ asset('assets4/js/jquery-ui.min.js') }}"></script>
		<!-- Easing JS -->
        <script src="{{ asset('assets4/js/easing.js') }}"></script>
		<!-- Color JS -->
		<script src="{{ asset('assets4/js/colors.js') }}"></script>
		<!-- Popper JS -->
		<script src="{{ asset('assets4/js/popper.min.js') }}"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="{{ asset('assets4/js/bootstrap-datepicker.js') }}"></script>
		<!-- Jquery Nav JS -->
        <script src="{{ asset('assets4/js/jquery.nav.js') }}"></script>
		<!-- Slicknav JS -->
		<script src="{{ asset('assets4/js/slicknav.min.js') }}"></script>
		<!-- ScrollUp JS -->
        <script src="{{ asset('assets4/js/jquery.scrollUp.min.js') }}"></script>
		<!-- Niceselect JS -->
		<script src="{{ asset('assets4/js/niceselect.js') }}"></script>
		<!-- Tilt Jquery JS -->
		<script src="{{ asset('assets4/js/tilt.jquery.min.js') }}"></script>
		<!-- Owl Carousel JS -->
        <script src="{{ asset('assets4/js/owl-carousel.js') }}"></script>
		<!-- counterup JS -->
		<script src="{{ asset('assets4/js/jquery.counterup.min.js') }}"></script>
		<!-- Steller JS -->
		<script src="{{ asset('assets4/js/steller.js') }}"></script>
		<!-- Wow JS -->
		<script src="{{ asset('assets4/js/wow.min.js') }}"></script>
		<!-- Magnific Popup JS -->
		<script src="{{ asset('assets4/js/jquery.magnific-popup.min.js') }}"></script>
		<!-- Counter Up CDN JS -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<!-- Google Map API Key JS -->
		<script src="https://maps.google.com/maps/api/js?key=AIzaSyDGqTyqoPIvYxhn_Sa7ZrK5bENUWhpCo0w"></script>
		<!-- Gmaps JS -->
		<script src="{{ asset('assets4/js/gmaps.min.js') }}"></script>
		<!-- Map Active JS -->
		<script src="{{ asset('assets4/js/map-active.js') }}"></script>
		<!-- Bootstrap JS -->
		<script src="{{ asset('assets4/js/bootstrap.min.js') }}"></script>
		<!-- Main JS -->
		<script src="{{ asset('assets4/js/main.js') }}"></script>
    </body>
</html>