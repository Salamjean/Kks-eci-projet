@extends('superadmin.ministere.layouts.template')

@section('content')
<style>
    .dashboard-background {
        background-image: url("{{ asset('assets/images/profiles/cnps.jpg') }}"); 
        background-size: 30%; 
        background-position: center; 
        background-repeat: no-repeat; 
        background-attachment: fixed;
        min-height: 100vh;
        padding: 20px 20px 20px 40px;
        border-radius: 10px;
    }

    /* Style pour ajouter une ombre au tableau */
    .shadow-table {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre légère */
        border-radius: 8px; /* Coins arrondis */
        overflow: hidden; /* Pour que l'ombre s'applique correctement */
    }
</style>
<div class="dashboard-background">
    <h1 class="text-center text-black mb-4">Historiques de recherches effectués par les agents</h1>
    <div class="container col-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                          <!-- Afficher les informations de la dernière recherche dans un tableau avec ombre -->
                          @if(!empty($searchHistory))
                          <h3 class="text-center text-black mb-3">Historique des recherches</h3>
                          <div class="shadow-table">
                              <table class="table table-bordered mb-0">
                                  <thead style="background-color: orange !important; color: white;">
                                    <tr>
                                        <th class="text-center">Agent</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Nom</th>
                                        <th class="text-center">Prénom</th>
                                        <th class="text-center">Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($searchHistory as $search)
                                        <tr>
                                            <td class="text-center">{{ $search['agent_name'] }} {{ $search['agent_prenom'] }}</td>
                                            <td class="text-center">{{ ucfirst($search['search_type']) }}</td>
                                            <td class="text-center">
                                                @if($search['search_type'] === 'deces')
                                                    {{ $search['defunt_nom'] ?? 'N/A' }}
                                                @else
                                                    {{ $search['naissance_nom'] ?? 'N/A' }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($search['search_type'] === 'deces')
                                                    {{ $search['defunt_prenom'] ?? 'N/A' }}
                                                @else
                                                    {{ $search['naissance_prenom'] ?? 'N/A' }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($search['search_type'] === 'deces')
                                                    {{ $search['codeCMD'] ?? 'N/A' }}
                                                @else
                                                    {{ $search['codeCMN'] ?? 'N/A' }}
                                                @endif
                                            </td>
                                        </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                            </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection