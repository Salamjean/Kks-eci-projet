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
        <link rel="icon" href="{{ asset('assets/images/profiles/E-ci-logo.png') }}">

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
		@stack('styles')

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
			    flex: 1;
			}

			footer {
			    margin-top: auto;
				
			}
			html, body {
		    height: 100%;
		    margin: 0;
		    display: flex;
		    flex-direction: column;
			}

			/* Style personnalisé pour cacher/afficher les liens */
			.show-on-mobile {
				display: none !important; /* Cache par défaut */
			}

			@media (max-width: 991.98px) { /* Ecran tablette et mobile */
				.show-on-mobile {
					display: list-item !important; /* Affiche comme un élément de liste sur mobile et tablette */
				}
				.hide-on-mobile {
					display: none !important; /* Cache sur mobile et tablette */
				}
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
		@include('pages.layouts.navbar')
		<!-- End Header Area -->
		<!-- Slider Area -->
		@yield('content')
		<!--/ End Slider Area -->

		<!-- Start Schedule Area -->
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