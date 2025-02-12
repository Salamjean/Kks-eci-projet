@extends('pages.layouts.template')

@section('content')
<style>
    /* Styles généraux */
    .slider .single-slider {
        min-height: 100vh; /* S'assure d'occuper au moins toute la hauteur de l'écran */
        background-size: cover;
        background-position: center;
        display: flex;
        flex-direction: column; /* Organiser le contenu en colonne */
        justify-content: center; /* Centrer verticalement */
        align-items: center; /* Centrer horizontalement */
        padding: 20px; /* Espacement général */
        text-align: center; /* Centrer le texte */
    }

    .slider .text {
        width: 100%; /* Occuper toute la largeur */
        max-width: 800px; /* Limiter la largeur du texte */
        margin: 0 auto; /* Centrer horizontalement */
    }

    .slider h1 {
        font-size: 2.5em; /* Taille de police plus grande */
        margin-bottom: 0.5em;
    }

    .slider p {
        font-size: 1.3em; /* Taille de police plus grande */
        margin-bottom: 1em;
    }

    .slider .button {
        display: flex;
        flex-direction: column; /* Afficher les boutons en colonne sur les petits écrans */
        align-items: center; /* Centrer les boutons */
        width: 100%; /* Occuper toute la largeur */
    }

    .slider .btn {
        padding: 15px 30px;
        margin: 5px;
        font-size: 1.1em; /* Taille de police plus grande */
        text-decoration: none;
        border-radius: 5px;
        color: white;
        width: 80%; /* Limiter la largeur des boutons */
        max-width: 300px; /* Limiter la largeur maximale des boutons */
    }

    .slider .btn.primary {
        background-color: #007bff;
    }

    .schedule {
        padding: 30px;
    }

    .schedule .single-schedule {
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .schedule .inner {
        padding: 15px;
        text-align: center;
    }

    .schedule .icon i {
        font-size: 2em;
    }

    .schedule h4 {
        font-size: 1.3em;
        margin-bottom: 0.5em;
    }

    .schedule .single-content span {
        font-size: 0.9em; /* Taille de police plus petite pour le span */
    }

    .schedule .single-content p {
        font-size: 1em; /* Taille de police plus petite pour le paragraphe */
    }

    /* Media queries pour tablettes */
    @media (min-width: 768px) {
        .slider .text {
            text-align: left; /* Aligner le texte à gauche sur les tablettes */
        }

        .slider h1 {
            font-size: 3em;
        }

        .slider p {
            font-size: 1.4em;
        }

        .slider .button {
            flex-direction: row; /* Afficher les boutons horizontalement */
            justify-content: center; /* Centrer les boutons horizontalement */
        }

        .slider .btn {
            width: auto; /* Supprimer la largeur fixe des boutons */
            max-width: none; /* Supprimer la largeur maximale des boutons */
            margin: 5px 10px; /* Ajuster les marges des boutons */
        }

        .schedule {
            padding: 40px;
        }

        .schedule .single-content span {
            font-size: 1em; /* Taille de police légèrement plus grande pour le span */
        }

        .schedule .single-content p {
            font-size: 1.1em; /* Taille de police légèrement plus grande pour le paragraphe */
        }
    }

    /* Media queries pour écrans plus larges (ordinateurs) */
    @media (min-width: 992px) {
        .slider h1 span {
            font-size: 60px;
        }

        .slider p {
            font-size: 1.4em;
        }

        .schedule-inner .col-lg-4 {
            width: 33.33%; /* Rétablir la largeur des colonnes */
        }

        .schedule {
            padding: 40px;
        }

        .schedule .single-content span {
            font-size: 1.1em; /* Taille de police encore plus grande pour le span */
        }

        .schedule .single-content p {
            font-size: 1.2em; /* Taille de police encore plus grande pour le paragraphe */
        }
    }
</style>

<section class="slider">
    <div class="hero-slider">
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url({{ asset('assets4/img/bebebe.jpeg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1><span>Demande d'acte de Naissance</span></h1>
                            <p>Un acte de naissance peut donner lieu à la délivrance de 2 documents différents : Faire la demande avec le certificat ou une demande simple/intégrale</p>
                            <div class="button">
                                <a href="{{ route('naissanceavec') }}" class="btn" style="background-color:green">Voir plus <br>Avec certificat</a>
                                <a href="{{ route('naissancesans') }}" id="prim" class="btn primary">Voir plus <br>Simple/integrale</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slider -->
        <!-- Start Single Slider -->
        <div class="single-slider" style="background-image:url({{ asset('assets4/img/mariageeee.jpeg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1><span>Demande d'acte de mariage</span></h1>
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
        <div class="single-slider" style="background-image:url({{ asset('assets4/img/decesff.jpeg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="text">
                            <h1><span>Demande d'acte de Décès</span></h1>
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
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- single-schedule -->
                    <div class="single-schedule first" style="background-color:green">
                        <div class="inner" style="background-color:green">
                            <div class="icon">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="single-content">
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
                                <i class="icofont-home"></i>
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
                                <i class="icofont-ui-home"></i>
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