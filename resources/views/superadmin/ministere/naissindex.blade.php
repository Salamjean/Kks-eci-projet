@extends('superadmin.ministere.layouts.template')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Listes de toutes les déclarations de décès</h1>
    </div>

    <!-- Row -->
    <div class="row">
      <!-- Datatables -->
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold " style="color: #2797d6">Les déclarations de décès</h6>
          </div>
          <div class="table-responsive p-3">
            <!-- Champ de recherche -->
            <input type="text" id="searchInput" class="form-control mb-3" placeholder="Rechercher...">
        
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="bg-navbar text-white" style="background-color: #2797d6">
                    <tr style="font-size: 12px">
                        <th class="text-center">N° CMN</th>
                        <th class="text-center">Hôpital</th>
                        <th class="text-center">Commune</th>
                        <th class="text-center">Nom de la mère</th>
                        <th class="text-center">Nom de l'accompagnateur</th>
                        <th class="text-center">Date de naissance et sexe du né</th>
                        <th class="text-center">Date et Heure de déclaration</th>
                        <th class="text-center">Nom du Docteur</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($naisshops as $naisshop)
                    <tr style="font-size: 12px" class="text-center">
                        <td>{{ $naisshop->codeCMN }}</td>
                        <td>{{ $naisshop->NomEnf }}</td>
                        <td>{{ strtoupper($naisshop->commune) }}</td>
                        <td>{{ $naisshop->NomM .' '.$naisshop->PrM }}</td>
                        <td>{{ $naisshop->NomP. ' '.$naisshop->PrP }}</td>
                        <td class="text-center">
                            @if ($naisshop->enfants->isNotEmpty())
                                    @foreach ($naisshop->enfants as $enfant)
                                       
                                            <strong> Enfant {{ $loop->iteration }} </strong> <br>
                                            Date Naissance: {{ \Carbon\Carbon::parse($enfant->date_naissance)->format('d/m/Y') }} <br>
                                            Sexe: {{ $enfant->sexe }}
                                        
                                    @endforeach
                            @else
                                Aucun enfant enregistré
                            @endif
                        </td>
                        <td>{{ $naisshop->created_at }}</td>
                        <td>Dr. {{ $naisshop->sous_admin ? $naisshop->sous_admin->name . ' ' . $naisshop->sous_admin->prenom : 'Demandeur inconnu' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Aucune déclaration effectuée</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <script>
            document.getElementById('searchInput').addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('#dataTable tbody tr');
        
                rows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const match = Array.from(cells).some(cell => 
                        cell.textContent.toLowerCase().includes(filter)
                    );
                    row.style.display = match ? '' : 'none';
                });
            });
        </script>
        </div>
      </div>
@endsection

<script>
  function showImage(imageElement) {
    const modalImage = document.getElementById('modalImage');

    // Vérifier si l'image utilise déjà la valeur de remplacement (image par défaut)
    if (imageElement.src.includes('assets/images/profiles/bébé.jpg')) {
        modalImage.src = imageElement.src; // Utiliser l'image par défaut
    } else {
        modalImage.src = imageElement.src; // Utiliser l'image actuelle (valide)
    }
}

</script>
