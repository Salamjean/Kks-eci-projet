@extends('pages.layouts.template')

@section('content')
<style>
    /* Styles généraux */
    .slider .single-slider {
        min-height: 100vh;
        background-size: cover;
        background-position: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
        text-align: center;
    }

    .slider .text {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }

    .slider h1 {
        font-size: 2em;
        margin-bottom: 0.5em;
        line-height: 1.2;
    }

    .slider p {
        font-size: 1.1em;
        margin-bottom: 1em;
        line-height: 1.4;
    }

    .slider .button {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        gap: 10px;
    }

    .slider .btn {
        padding: 12px 25px;
        margin: 5px 0;
        font-size: 1em;
        text-decoration: none;
        border-radius: 5px;
        color: white;
        width: 100%;
        max-width: 280px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .slider .btn.primary {
        background-color: #007bff;
    }

    .slider .btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .schedule {
        padding: 20px 0;
    }

    .schedule .single-schedule {
        margin-bottom: 20px;
        border-radius: 5px;
        overflow: hidden;
    }

    .schedule .inner {
        padding: 20px;
        text-align: center;
        height: 100%;
    }

    .schedule .icon i {
        font-size: 2em;
        margin-bottom: 15px;
    }

    .schedule h4 {
        font-size: 1.3em;
        margin-bottom: 0.5em;
    }

    .schedule .single-content span {
        font-size: 0.9em;
        display: block;
        margin-bottom: 10px;
    }

    .schedule .single-content p {
        font-size: 0.95em;
        line-height: 1.5;
        margin-bottom: 15px;
    }

    .schedule .single-content a {
        color: #fff;
        text-decoration: underline;
        font-weight: bold;
    }

    /* Media queries pour les petits téléphones */
    @media (max-width: 375px) {
        .slider h1 {
            font-size: 1.7em;
        }
        
        .slider p {
            font-size: 1em;
        }
        
        .slider .btn {
            padding: 10px 20px;
            font-size: 0.9em;
        }
    }

    /* Media queries pour tablettes en mode portrait */
    @media (min-width: 576px) {
        .slider .button {
            flex-direction: row;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .slider .btn {
            width: auto;
            margin: 0 10px;
        }
    }

    /* Media queries pour tablettes */
    @media (min-width: 768px) {
        .slider .text {
            text-align: left;
        }

        .slider h1 {
            font-size: 2.5em;
        }

        .slider p {
            font-size: 1.2em;
        }

        .slider .button {
            flex-direction: row;
            justify-content: flex-start;
        }

        .slider .btn {
            width: auto;
            max-width: none;
            margin: 0 10px 0 0;
        }
        
        .schedule-inner .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .schedule .col-lg-4 {
            flex: 0 0 calc(50% - 30px);
            max-width: calc(50% - 30px);
            margin: 15px;
        }
    }

    /* Media queries pour écrans moyens */
    @media (min-width: 992px) {
        .slider h1 {
            font-size: 3em;
        }

        .slider p {
            font-size: 1.3em;
        }
        
        .schedule .col-lg-4 {
            flex: 0 0 calc(33.33% - 30px);
            max-width: calc(33.33% - 30px);
        }
        
        .schedule .single-content span {
            font-size: 1em;
        }

        .schedule .single-content p {
            font-size: 1em;
        }
    }

    /* Media queries pour grands écrans */
    @media (min-width: 1200px) {
        .slider .text {
            max-width: 900px;
        }
        
        .slider h1 {
            font-size: 3.5em;
        }
        
        .slider p {
            font-size: 1.4em;
        }
        
        .schedule {
            padding: 60px 0;
        }
        
        .schedule .inner {
            padding: 30px;
        }
    }

    /* Media queries pour très grands écrans */
    @media (min-width: 1400px) {
        .container {
            max-width: 1320px;
        }
    }

    /* Ajustements pour l'accessibilité */
    @media (prefers-reduced-motion: reduce) {
        .slider .btn {
            transition: none;
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
                                <p>Vous pouvez désormais faire une demande d'acte à SOCOCE rapidement et facilement sur les bornes administratives tactiles.
                                </p>
                                <a href="#"> N'attendez plus !</a>
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
                                <p>Vous pouvez désormais faire une demande d'acte à CAP NORD rapidement et facilement sur les bornes administratives tactiles.
                                </p>
                                <a href="#"> N'attendez plus !</a>
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
                                <p>Vous pouvez désormais faire une demande d'acte à CAP SUD rapidement et facilement sur les bornes administratives tactiles.
                                </p>
                                <a href="#"> N'attendez plus !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br><br>
@endsection