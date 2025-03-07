@extends('vendor.agent.layouts.template')

@section('content')

<!-- Section Principale : Les Demandes de Naissances Récentes -->
<div class="row mb-4">
    <div class="col-xl-12 col-lg-12 mb-4">
        <div class="card">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white text-center">Naissances Récentes</h6>
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
                            @foreach ([$recentNaissances, $recentNaissancesd] as $naissancesGroup)
                                @forelse ($naissancesGroup as $naissance)
                                    <tr>
                                        <td>{{ $loop->parent->index === 0 ? 'Nouveau né' : $naissance->type }}</td>
                                        <td>{{ $loop->parent->index === 0 ? ($naissance->nomHopital ?: 'Extrait Simple/Integral') : 'N/A' }}</td>
                                        <td>{{ $naissance->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $naissance->created_at->format('H:i:s') }}</td>
                                        <td>
                                            <form action="{{ route('naissance.traiter', $naissance->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-sm btn-primary">Récuperer</button>
                                            </form>
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
                                        <form action="{{ route('deces.traiter', $deces->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-sm btn-primary">Récuperer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Aucun décès récent</td></tr>
                            @endforelse

                            @forelse ($recentDecesdeja as $decesdeja)
                                <tr>
                                    <td>Décès</td>
                                    <td>{{ $decesdeja->nomHopital }}</td>
                                    <td>{{ $decesdeja->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $decesdeja->created_at->format('H:i:s') }}</td>
                                    <td>
                                        <form action="{{ route('deces.traiter', $decesdeja->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-sm btn-primary">Récuperer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Aucun décès existant</td></tr>
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
                                    <td>{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
                                    <td>{{ $mariage->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $mariage->created_at->format('H:i:s') }}</td>
                                    <td>
                                        <form action="{{ route('mariage.traiter', $mariage->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-sm btn-primary">Récuperer</button>
                                        </form>
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

@endsection