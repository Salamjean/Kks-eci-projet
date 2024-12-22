@extends('vendor.agent.layouts.template')

@section('content')

<!-- Section Principale : Les Demandes de Naissances Récentes -->
<div class="row mb-4">
    <!-- Carte : Naissances Récentes et Existantes -->
    <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card">
            <!-- En-tête de la carte -->
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white text-center">Naissances Récentes et Existantes</h6>
            </div>
            <!-- Corps de la carte -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Type</th>
                                <th>Hôpital</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ([$recentNaissances, $recentNaissancesd] as $naissancesGroup)
                                @forelse ($naissancesGroup as $naissance)
                                    <tr>
                                        <td>{{ $loop->parent->index === 0 ? 'Nouveau né' : $naissance->type }}</td>
                                        <td>{{ $loop->parent->index === 0 ? ($naissance->nomHopital ?: 'Extrait Simple/Integral') : 'N/A' }}</td>
                                        <td>{{ $naissance->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $naissance->created_at->format('H:i:s') }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-primary">Récuperer</a>
                                        </td>
                                    </tr>
                                @empty
                                    @if ($loop->first)
                                        <tr><td colspan="5" class="text-center">Aucune naissance récente</td></tr>
                                    @endif
                                    @if ($loop->last)
                                        <tr><td colspan="5" class="text-center">Aucune naissance existante</td></tr>
                                    @endif
                                @endforelse
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section : Décès Récents -->
<div class="row mb-4">
    <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white text-center">Décès Récents</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Type</th>
                                <th>Hôpital</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentDeces as $deces)
                                <tr>
                                    <td>Décès</td>
                                    <td>{{ $deces->nomHopital }}</td>
                                    <td>{{ $deces->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $deces->created_at->format('H:i:s') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Récuperer</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Aucun décès récent</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section : Mariages Récents -->
<div class="row mb-4">
    <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white text-center">Mariages Récents</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Type</th>
                                <th>Demandeur</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentMariages as $mariage)
                                <tr>
                                    <td>Mariage</td>
                                    <td>{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}
                                    <td>{{ $mariage->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $mariage->created_at->format('H:i:s') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Récuperer</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Aucun mariage récent</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<h3 class="text-center uppercase">Les déclarations</h3>

<!-- Section : Les Déclarations Récentes -->
<div class="row mb-4">
    <!-- Carte : Naissances Récentes -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card">
            <!-- En-tête de la carte -->
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white text-center">Naissances Récentes</h6>
            </div>
            <!-- Corps de la carte -->
            <div class="card-body">
                <div class="table-responsive">
                    <h5 class="font-weight-bold text-primary text-center mb-3">Naissances Récentes</h5>
                    <table class="table table-striped table-hover align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Type</th>
                                <th>Hôpital</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentNaisshops as $naisshop)
                                <tr>
                                    <td>Naisshop</td>
                                    <td>{{ $naisshop->NomEnf }}</td>
                                    <td>{{ $naisshop->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $naisshop->created_at->format('H:i:s') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Détails</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucune déclaration de naissance</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Carte : Décès Récentes -->
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card">
            <!-- En-tête de la carte -->
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white text-center">Décès Récent</h6>
            </div>
            <!-- Corps de la carte -->
            <div class="card-body">
                <div class="table-responsive">
                    <h5 class="font-weight-bold text-primary text-center mb-3">Décès Récents</h5>
                    <table class="table table-striped table-hover align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Type</th>
                                <th>Hôpital</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentDeceshops as $deceshop)
                                <tr>
                                    <td>Deceshop</td>
                                    <td>{{ $deceshop->nomHop }}</td>
                                    <td>{{ $deceshop->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $deceshop->created_at->format('H:i:s') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">Détails</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucune déclaration de décès récente</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
