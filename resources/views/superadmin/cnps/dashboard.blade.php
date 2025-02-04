@extends('superadmin.cnps.layouts.template')

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
    <h1 class="text-center text-black mb-4">Bienvenue sur le tableau de bord</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-4">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-center" style="font-size: 20px;">Nombre total d'agence</h3>
                                        <div class="text-center">
                                            <i class="fa fa-home d-block" style="font-size: 30px; color:orange"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="display-4  text-center">{{ $agences }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-center" style="font-size: 20px;">Nombre total d'agent</h3>
                                        <div class="text-center">
                                            <i class="fa fa-user d-block" style="font-size: 30px; color:orange"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="display-4  text-center">{{ $cnpsagent }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-center" style="font-size: 20px;">Nombre total de déclaration</h3>
                                        <div class="text-center">
                                            <i class="fa fa-church d-block" style="font-size: 30px; color:orange"></i>
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
        </div>
    </div><br><br>
    <div class="container col-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                          <!-- Afficher les informations de la dernière recherche dans un tableau avec ombre -->
                          @if(!empty($searchHistory))
                          <h3 class="text-center text-black mb-3">Les recherches récentes</h3>
                          <div class="shadow-table">
                              <table class="table table-bordered mb-0">
                                  <thead style="background-color: orange !important; color: white;">
                                      <tr>
                                          <th class="text-center">Agent</th>
                                          <th class="text-center">Défunt recherché</th>
                                          <th class="text-center">N° CMD du défunt</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($searchHistory as $search)
                                          <tr>
                                              <td class="text-center">{{ $search['agent_name'] }} {{ $search['agent_prenom'] }}</td>
                                              <td class="text-center">
                                                  @if($search['defunt_nom'])
                                                      {{ $search['defunt_nom'] }} {{ $search['defunt_prenom'] }}
                                                  @else
                                                      Aucun défunt trouvé
                                                  @endif
                                              </td>
                                              <td class="text-center">{{ $search['codeCMD'] ?? 'N/A' }}</td>
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