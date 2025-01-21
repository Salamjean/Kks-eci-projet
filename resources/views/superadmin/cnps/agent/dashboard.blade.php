@extends('superadmin.cnps.agent.layouts.template')

@section('content')
<style>
    .background-container {
        background-image: url("{{ asset('assets/images/profiles/arriereP.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 300px;
        padding: 0 0 32% 0;
        border-radius: 10px;
    }
</style>

<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container-fluid" id="container-wrapper">
    <!-- Conteneur pour l'arrière-plan -->
    <div class="background-container">
        <!-- En-tête -->
        <div class="text-center mb-0">
            <h2 class="font-semibold text-xl text-gray-800" style="font-weight:bold">
                Caisse N° {{ Auth::guard('cnpsagent')->user()->id }}, Visualisé par : {{ Auth::guard('cnpsagent')->user()->name .' '.Auth::guard('cnpsagent')->user()->prenom }}
            </h2>
        </div>

        <!-- Formulaire de recherche -->
        <form action="{{ route('cnpsagent.dashboard') }}" class="d-flex flex-column align-items-center" method="GET">
            <!-- Champ de recherche -->
            <div class="form-group col-6 mb-3">
                <input type="text" name="search" class="form-control p-3 text-center" placeholder="Rechercher par nom, prénom ou code CMD" value="{{ $searchTerm ?? '' }}">
            </div>

            <!-- Boutons de recherche et d'actualisation -->
            <div class="d-flex justify-content-between col-3 gap-3">
                <button type="submit" class="btn btn-primary p-3 flex-grow-1" style="background-color: orange; color: black;">Rechercher</button>
                <a href="{{ route('cnpsagent.dashboard') }}" class="btn btn-primary p-3 flex-grow-1" style="background-color: orange; color: black; text-decoration: none;">Actualiser</a>
            </div>
        </form>

        <br>

        <!-- Affichage des résultats -->
        <h3 class="text-center text-black">Informations concernant le défunt</h3>
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
</div>

<!-- Script pour afficher les pop-ups -->
<script>
    @if(isset($hasSearchTerm) && $hasSearchTerm)
        @if($found)
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
    @endif
</script>
@endsection