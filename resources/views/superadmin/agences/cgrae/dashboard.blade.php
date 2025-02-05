@extends('superadmin.agences.cgrae.layouts.template')

@section('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .dashboard-background {
            background-image: url("{{ asset('assets/images/profiles/cgrae.jpg') }}");
            background-size: 30%;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            padding: 20px 20px 20px 40px;
            border-radius: 10px;
        }

        .card-header-custom {
            background-color: #f8f9fa; /* Light gray or your preferred color */
            border-bottom: 1px solid #dee2e6; /* Optional: Add a border for separation */
        }
    </style>

    <div class="dashboard-background">
        <h1 class="text-center text-black mb-4">Bienvenue sur le tableau de bord</h1>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row mt-4">
                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header card-header-custom">
                                    <h3 class="card-title text-center" style="font-size: 20px;">Nombre total d'agents</h3>
                                    <div class="text-center mt-2">
                                        <i class="fa fa-user d-block" style="font-size: 30px; color:green"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h1 class="display-4 text-center">{{ $agents }}</h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header card-header-custom">
                                    <h3 class="card-title text-center" style="font-size: 20px;">Nombre total de déclarations</h3>
                                    <div class="text-center mt-2">
                                        <i class="fa fa-church d-block" style="font-size: 30px; color:green"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h1 class="display-4 text-center">{{ $deceshops }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container col-12">
            <div class="row justify-content-center col-12">
                <div class="col-xl-11 col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: green;">
                            <h6 class="m-0 font-weight-bold text-white text-center" style="font-size: 24px;">Les recherches effectuées récemment</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="searchHistoryTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr class="text-center">
                                        <th>Agent</th>
                                        <th>Défunt trouvé</th>
                                        <th>Code CMD</th>
                                        <th>Terme de recherche</th>
                                        <th>Date et Heure</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rechercheInfo as $history)
                                        <tr class="text-center">
                                            <td>{{ $history->agent_name }} {{ $history->agent_prenom }}</td>
                                            <td>{{ $history->defunt_nom ? $history->defunt_nom : 'Défunt non trouvé' }} {{ $history->defunt_prenom }}</td>
                                            <td>{{ $history->codeCMD ? $history->codeCMD : 'Défunt non trouvé' }}</td>
                                            <td>{{ $history->search_term }}</td>
                                            <td>{{ $history->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection