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
                                        <li><a href="{{ route('recherche.demande') }}" style="color:white">Recherche</a></li>
                                        <li class="show-on-mobile"><a href="{{ route('login') }}"  style="color: white; background-color: green; width:100%; margin-top:10px; font-weight:bold; border-radius:100px; text-align:center">Se connecter</a></li>
                                        <li class="show-on-mobile"><a href="{{ route('register') }}" style="color: white; background-color: green; width:100%; margin-top:10px; font-weight:bold; border-radius:100px; text-align:center">S'inscrire</a></li>
                                        
                                    </ul>
                                </nav>
                            </div>
                        <!--/ End Main Menu -->
                    </div>
                    <div class="col-lg-2 col-12 d-flex gap-4 ">
                        <div class="get-quote bouton dropdown ">
                            <a href="{{ route('login') }}" class="btn hide-on-mobile"  >Se connecter</a>
                        </div> 
                        <div class="get-quote bouton dropdown ">
                            <a href="{{ route('register') }}" class="btn hide-on-mobile" style="background-color: green">S'inscrire</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>