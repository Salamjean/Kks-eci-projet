@extends('pages.layouts.template')

@section('content')
<section class="slider">
	<div class="hero-slider">
		<!-- Start Single Slider -->
		<div class="single-slider " style="background-image:url({{ asset('assets4/img/bebebe.jpeg') }}); height: 90vh; background-size:cover; background-position:center">
			<div class="container">
				<div class="row">
					<div class="col-lg-7" style="margin-top: 110px ">
						<div class="text" >
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
		<div class="single-slider" style="background-image:url({{ asset('assets4/img/mariageeee.jpeg') }}); height: 90vh; background-size:cover; background-position:center">
			<div class="container">
				<div class="row">
					<div class="col-lg-7" style="margin-top: 110px ">
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
		<div class="single-slider" style="background-image:url({{ asset('assets4/img/decesff.jpeg') }}); height: 90vh; background-size:cover; background-position:center">
			<div class="container">
				<div class="row">
					<div class="col-lg-7" style="margin-top: 110px ">
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
								<span>Vous pouvez faire votre demande à :</span>
								<h4>SOCOCE</h4>
								<p>Vous pouvez désormais faire une demande d’acte à SOCOCE rapidement et facilement sur les bornes administratives tactiles.
								</p>
								<a href="#"> N’attendez plus !<i class="fa fa-long-arrow-right"></i></a>
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
								<span>Vous pouvez faire votre demande à :</span>
								<h4>CAP NORD</h4>
								<p>Vous pouvez désormais faire une demande d’acte à CAP NORD rapidement et facilement sur les bornes administratives tactiles.
								</p>
								<a href="#"> N’attendez plus !<i class="fa fa-long-arrow-right"></i></a>
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
								<span>Vous pouvez faire votre demande à :</span>
								<h4>CAP SUD</h4>
								<p>Vous pouvez désormais faire une demande d’acte à CAP SUD rapidement et facilement sur les bornes administratives tactiles.
								</p>
								<a href="#"> N’attendez plus !<i class="fa fa-long-arrow-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection