@extends('superadmin.layouts.template')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container-fluid" id="container-wrapper">

        <!-- Total des caisses -->
        <div class="text-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800">
                Total des caisses <br>
                <small>Nombres de mairies enrégistrées ({{ $mairie }})</small>
            </h2>
        </div>
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Solde Fourni</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $soldeActuel }} FCFA</div>
                        <i class="fas fa-money-bill fa-2x text-success"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Solde Débité</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $soldeDebite }} FCFA</div>
                        <i class="fas fa-money-bill fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Solde Restant</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $soldeRestant }} FCFA</div>
                        <i class="fas fa-money-bill-wave fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Nombre de demande</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $total }}</div>
                        <i class="fas fa-list fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total de demandes d'extraits -->
        <div class="text-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800">
                Total de demande d'extrait effectuée
            </h2>
        </div>
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Naissances</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $naissance + $naissanceD }}</div>
                        <i class="fas fa-user fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Décès</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $deces + $decesdeja }}</div>
                        <i class="fas fa-church fa-2x text-success"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Mariages</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $mariage }}</div>
                        <i class="fas fa-ring fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Total Demandes</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $naissance + $naissanceD + $deces + $decesdeja + $mariage }}</div>
                        <i class="fas fa-list fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total de Docteurs et Déclarations -->
        <div class="text-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800">
                Total de Docteurs et de Déclarations <br>
                <small>Nombre d'hôpitaux enregistrés ({{ $doctors }})</small>
            </h2>
        </div>
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Docteurs</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $sousadmin }}</div>
                        <i class="fas fa-user-md fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Naissances (Hôpital)</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $naisshop }}</div>
                        <i class="fas fa-baby fa-2x text-success"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Décès (Hôpital)</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $deceshop }}</div>
                        <i class="fas fa-heartbeat fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Total Déclarations</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $naisshop + $deceshop }}</div>
                        <i class="fas fa-file-medical fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total des Personnels Inscrits dans les Mairies -->
        <div class="text-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800">
                Total des personnels inscrits dans toutes les mairies
            </h2>
        </div>
        <div class="row mb-4">
            <div class="col-xl-4 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Agents</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $agents }}</div>
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Caissiers</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $caisses }}</div>
                        <i class="fas fa-cash-register fa-2x text-success"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4">Adjoints au Maire</h5>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $ajoints }}</div>
                        <i class="fas fa-user-tie fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations sur la CNPS, CGRAE et LE MINISTERE DE LA SANTE -->
        <div class="text-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800">
                Informations sur les institutions
            </h2>
        </div>

        <div class="row mb-4">
            <!-- CNPS -->
            <div class="col-xl-4 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4 text-center">CNPS</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="text-md font-weight-bold text-uppercase mb-2">Agences</h5>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $agencescnps }}</div>
                                        <i class="fas fa-home fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="text-md font-weight-bold text-uppercase mb-2">Agents</h5>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $cnpsagents }}</div>
                                        <i class="fas fa-users fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="text-xs font-weight-bold text-uppercase mb-2">Recherche effectuée</h5>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $totalcnpsrecherche }}</div>
                                        <i class="fas fa-search fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CGRAE -->
            <div class="col-xl-4 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4 text-center">CGRAE</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="text-md font-weight-bold text-uppercase mb-2">Agences</h5>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $agencescgrae }}</div>
                                        <i class="fas fa-home fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="text-md font-weight-bold text-uppercase mb-2">Agents</h5>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $cgraeagents }}</div>
                                        <i class="fas fa-users fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="text-xs font-weight-bold text-uppercase mb-2">Total de recherche</h5>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $totalcgraesrecherche }}</div>
                                        <i class="fas fa-search fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MINISTERE DE LA SANTE -->
            <div class="col-xl-4 col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="text-xl font-weight-bold text-uppercase mb-4 text-center">MINISTERE DE LA SANTE</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="text-md font-weight-bold text-uppercase mb-2">Agents</h5>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $ministereagents }}</div>
                                        <i class="fas fa-users fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="text-xs font-weight-bold text-uppercase mb-2">Recherche-Naissance</h5>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $totalministererechercheNaissances }}</div>
                                        <i class="fas fa-baby fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="text-xs font-weight-bold text-uppercase mb-2">Recherche-Décès</h5>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $totalministererechercheDeces }}</div>
                                        <i class="fas fa-church fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection