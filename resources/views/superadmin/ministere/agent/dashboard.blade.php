@extends('superadmin.ministere.agent.layouts.template')

@section('content')
<style>
    .background-container {
        background-image: url("{{ asset('assets/images/profiles/arriereP.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh; /* Prend toute la hauteur de l'écran */
        padding: 20px; /* Ajoute un peu d'espace autour du contenu */
        border-radius: 10px;
        overflow-y: auto; /* Permet le défilement interne si nécessaire */
    }

    .card {
        height: 100%; /* Les cartes prennent toute la hauteur disponible */
    }

    .table-container {
        max-height: 300px; /* Limite la hauteur des tableaux */
        overflow-y: auto; /* Permet le défilement interne des tableaux */
    }
</style>

<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid" id="container-wrapper">
    <!-- Conteneur pour l'arrière-plan -->
    <div class="background-container">
        <!-- En-tête -->
        <div class="text-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800" style="font-weight:bold">
                Caisse N° {{ Auth::guard('ministereagent')->user()->id }}, Visualisé par : {{ Auth::guard('ministereagent')->user()->name .' '.Auth::guard('ministereagent')->user()->prenom }}
            </h2>
        </div>

        <!-- Cartes de statistiques -->
        <div class="row mb-4 justify-content-center">
            <!-- Total Demande Extrait Naissance -->
            <div class="col-xl-3 col-md-6 mb-2">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="text-xs font-weight-bold text-uppercase mb-4">Total Déclaration-Naissance</div>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $naissancesCount }}</div>
                        <i class="fas fa-user fa-2x text-primary"></i>
                    </div>
                </div>
            </div>

            <!-- Total Demande Extrait Décès -->
            <div class="col-xl-3 col-md-6 mb-2">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="text-xs font-weight-bold text-uppercase mb-4">Total Déclaration-Décès</div>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $decesCount }}</div>
                        <i class="fas fa-school fa-2x text-success"></i>
                    </div>
                </div>
            </div>

            <!-- Total Demande Acte Mariage -->
            <div class="col-xl-3 col-md-6 mb-2">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="text-xs font-weight-bold text-uppercase mb-4">Total Déclaration</div>
                        <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $total }}</div>
                        <i class="fas fa-ring fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire de recherche -->
        <form action="{{ route('ministereagent.dashboard') }}" class="d-flex flex-column align-items-center mb-4" method="GET">
            <!-- Boutons radio pour choisir le type de recherche -->
            <div class="form-group col-6 mb-3">
                <h4 style="text-align: center; color:black">Recherche sur :</h4>
                <div class="d-flex justify-content-center gap-4">
                    <label class="radio-inline">
                        <input type="radio" name="search_type" value="deces" {{ $searchType === 'deces' ? 'checked' : '' }} checked> Décès
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="radio-inline">
                        <input type="radio" name="search_type" value="naissance" {{ $searchType === 'naissance' ? 'checked' : '' }}> Naissance
                    </label>
                </div>
            </div>

            <!-- Sélection de la période -->
            <div class="form-group col-6 mb-3">
                <select name="period_type" id="period_type" class="form-control p-2 text-center">
                    <option value="week" {{ $periodType === 'week' ? 'selected' : '' }}>Semaine</option>
                    <option value="month" {{ $periodType === 'month' ? 'selected' : '' }}>Mois</option>
                    <option value="year" {{ $periodType === 'year' ? 'selected' : '' }}>Année</option>
                </select>
            </div>

            <!-- Champ de recherche pour la période -->
            <div class="form-group col-6 mb-3">
                <input type="text" name="period_value" class="form-control p-3 text-center" placeholder="Entrez la semaine, le mois ou l'année" value="{{ $periodValue ?? '' }}">
            </div>

            <!-- Boutons de recherche et d'actualisation -->
            <div class="d-flex justify-content-between col-3 gap-3">
                <button type="submit" class="btn btn-primary p-3 flex-grow-1" style="background-color: #2797d6; color: white;">Rechercher</button>
                <a href="{{ route('ministereagent.dashboard') }}" class="btn btn-primary p-3 flex-grow-1" style="background-color: #2797d6; color: white; text-decoration: none;">Actualiser</a>
            </div>
        </form>

        <!-- Affichage des résultats pour les décès -->
        @if($hasSearchTerm && $searchType === 'deces')
            @if($foundDefunts)
                <h3 class="text-center text-black">Informations concernant le défunt</h3>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>Numéro du CMD</th>
                                <th>Nom</th>
                                <th>Prénoms</th>
                                <th>Date de Naissance</th>
                                <th>Date de décès</th>
                                <th>Lieu de décès</th>
                                <th>Nom de l'hôpital</th>
                                <th>Cause du décès</th>
                                <th>Nom du docteur déclarant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($defunts as $defunt)
                                <tr class="text-center">
                                    <td>{{ $defunt->codeCMD }}</td>
                                    <td>{{ $defunt->NomM }}</td>
                                    <td>{{ $defunt->PrM }}</td>
                                    <td>{{ $defunt->DateNaissance }}</td>
                                    <td>{{ $defunt->DateDeces }}</td>
                                    <td>{{ $defunt->commune }}</td>
                                    <td>{{ $defunt->nomHop }}</td>
                                    <td>{{ $defunt->Remarques }}</td>
                                    <td>Dr. {{ $defunt->sous_admin ? $defunt->sous_admin->name . ' ' . $defunt->sous_admin->prenom : 'Demandeur inconnu' }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-black">Aucun défunt trouvé pour la période sélectionnée.</p>
            @endif
        @endif

        <!-- Affichage des résultats pour les naissances -->
        @if($hasSearchTerm && $searchType === 'naissance')
            @if($foundNaissances)
                <h3 class="text-center text-black">Informations concernant la naissance</h3>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>Numéro du CMN</th>
                                <th>Nom-Mère</th>
                                <th>Contact-Mère</th>
                                <th>Date-Naissance-Mère</th>
                                <th>CMU-Mère</th>
                                <th>Nom-Accompagnateur</th>
                                <th>Contact-Accompagnateur</th>
                                <th>Lien-Mère-Accompagnateur</th>
                                <th>Nom-Hôpital</th>
                                <th>Commune-Naissance</th>
                                <th>Date-Naissance</th>
                                <th>Sexe-Enfant</th>
                                <th>Nom du docteur déclarant</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($naissances as $naissance)
                                <tr class="text-center">
                                    <td>{{ $naissance->codeCMN }}</td>
                                    <td>{{ $naissance->NomM . ' ' . $naissance->PrM }}</td>
                                    <td>{{ $naissance->contM }}</td>
                                    <td>{{ $naissance->dateM }}</td>
                                    <td>{{ $naissance->codeCMU }}</td>
                                    <td>{{ $naissance->NomP . ' ' . $naissance->PrP }}</td>
                                    <td>{{ $naissance->contP }}</td>
                                    <td>{{ $naissance->lien }}</td>
                                    <td>{{ $naissance->NomEnf }}</td>
                                    <td>{{ $naissance->commune }}</td>
                                    <td>{{ $naissance->DateNaissance }}</td>
                                    <td>{{ $naissance->sexe }}</td>
                                    <td>Dr. {{ $naissance->sous_admin ? $naissance->sous_admin->name . ' ' . $naissance->sous_admin->prenom : 'Demandeur inconnu' }}</td>
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-black">Aucune naissance trouvée pour la période sélectionnée.</p>
            @endif
        @endif
    </div>
</div>

<!-- Script pour afficher les pop-ups -->
<script>
    @if(isset($hasSearchTerm) && $hasSearchTerm)
        @if($searchType === 'deces')
            @if($foundDefunts)
                Swal.fire({
                    icon: 'success',
                    title: 'Défunt trouvé',
                    text: 'Le défunt a été trouvé.',
                    confirmButtonText: 'OK'
                });
            @else
                Swal.fire({
                    icon: 'error',
                    title: 'Défunt non trouvé',
                    text: 'Aucun défunt correspondant n\'a été trouvé.',
                    confirmButtonText: 'OK'
                });
            @endif
        @elseif($searchType === 'naissance')
            @if($foundNaissances)
                Swal.fire({
                    icon: 'success',
                    title: 'Naissance trouvée',
                    text: 'La naissance a été trouvée.',
                    confirmButtonText: 'OK'
                });
            @else
                Swal.fire({
                    icon: 'error',
                    title: 'Naissance non trouvée',
                    text: 'Aucune naissance correspondante n\'a été trouvée.',
                    confirmButtonText: 'OK'
                });
            @endif
        @endif
    @endif
</script>

<!-- Script pour dynamiser le formulaire -->
<script>
    document.getElementById('period_type').addEventListener('change', function() {
        var periodValueInput = document.querySelector('input[name="period_value"]');
        if (this.value === 'week') {
            periodValueInput.placeholder = 'Entrez le numéro de la semaine (1-52)';
        } else if (this.value === 'month') {
            periodValueInput.placeholder = 'Entrez le numéro du mois (1-12)';
        } else if (this.value === 'year') {
            periodValueInput.placeholder = 'Entrez l\'année (ex: 2023)';
        }
    });
</script>
@endsection