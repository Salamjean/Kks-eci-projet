@extends('superadmin.ministere.layouts.template')

@section('content')

    <style>

.row {
     background-image: url("{{ asset('assets/images/profiles/sante.jpg') }}"); 
     background-size: cover; 
     background-position: center; 
     background-repeat: no-repeat; 
     background-attachment: fixed;
     min-height: 100vh;
     padding: 20px 20px 20px 40px;
     border-radius: 10px;
 }
        .center-card {
            margin: 0 auto;
            float: none;
        }

        /* Styles pour la pagination */
        .pagination {
            display: flex;
            justify-content: flex-end; /* Aligne à droite */
            align-items: center;
            padding: 10px;
        }

        .pagination a {
            color: #333;
            padding: 8px 12px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin: 0 4px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .pagination a.active {
            background-color: #1b80bb; /* Vert */
            color: white;
            border: 1px solid #2272a0;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }

        .pagination a.disabled {
            color: #ccc;
            pointer-events: none;
        }

        .pagination a.arrow {
            font-weight: bold;
        }

        .pagination a.arrow.disabled {
            font-weight: normal;
        }

        .pagination ul {
            list-style: none; /* Supprime les puces par défaut */
            padding: 0;
            margin: 0;
            display: flex; /* Flexbox pour aligner les éléments de la liste */
        }

        .pagination li {
            margin: 0;
        }
    </style>

    <h1 class="text-center" style="margin: 70px 0">Historiques de toute les recherches effectuées par les agents de {{ Auth::guard('ministere')->user()->siege }}</h1>

    <div class="container col-12">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow mb-4 center-card">
                    <div class="card-header py-3" style="background-color: #2797d6; display: flex; justify-content: space-between; align-items: center;">
                        <h6 class="font-weight-bold text-white text-center" style="font-size: 30px">Les recherches effectuées récemment</h6>
                        <nav aria-label="Page navigation">
                            <div class="pagination">
                                {{ $rechercheInfo->links('partials.custom_pagination') }}
                            </div>
                        </nav>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <input type="text" id="search" class="form-control" placeholder="Rechercher dans ce cadre...">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="searchHistoryTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Agent</th>
                                        <th>Type de recherche</th>
                                        <th>Recherche sur </th>
                                        <th>Code CMD</th>
                                        <th>Recherche par</th>
                                        <th>Période</th>
                                        <th>Date et Heure</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($rechercheInfo as $history)
                                        <tr class="text-center">
                                            <td>{{ $history->agent_name }} {{ $history->agent_prenom }}</td>
                                            <td>{{ $history->recherche_type }}</td>
                                            <td>
                                                @if($history->recherche_type === 'naissance' && $history->naissance_nom && $history->naissance_prenom)
                                                      {{ $history->naissance_nom }} {{ $history->naissance_prenom }}
                                                @elseif ($history->recherche_type === 'deces' && $history->defunt_nom && $history->defunt_prenom)
                                                      {{ $history->defunt_nom }} {{ $history->defunt_prenom }}
                                                @else
                                                      Pas trouvé 
                                                @endif
                                              </td>
                                              <td>
                                                @if ($history->recherche_type === 'deces')
                                                    {{ $history->codeCMD ?? 'Code CMD non trouvé' }}
                                                @elseif ($history->recherche_type === 'naissance')
                                                    {{ $history->codeCMN ?? 'Code CMN non trouvé' }}
                                                @else
                                                    Type de recherche inconnu
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $translations = [
                                                        'month' => 'Mois',
                                                        'year' => 'Année',
                                                        'week' => 'Semaine',
                                                    ];
                                                @endphp
                                                {{ $translations[$history->search_term] ?? $history->search_term }}
                                            </td>
                                            <td>{{ $history->cnpsagent_id }}</td>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var searchTerm = $(this).val().toLowerCase();

                $('#tableBody tr').each(function() {
                    var rowText = $(this).text().toLowerCase();

                    if (rowText.indexOf(searchTerm) > -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>

@endsection