@extends('vendor.layouts.template')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .etat-en-attente {
      background-color: orange;
      color: black;
    }
  
    .etat-validee {
      background-color: green;
      color: white;
    }
  
    .etat-refusee {
      background-color: red;
      color: white;
    }
  
    .btn {
      background-color: rgb(199, 195, 195);
    }
</style>

<div class="container-fluid" id="container-wrapper">
    <div class="row" style="width:100%; justify-content:center">
        <div class="row" style="width:100%; justify-content:center">
            @if (Session::get('success1')) <!-- Pour la suppression -->
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Suppression réussie',
                        text: '{{ Session::get('success1') }}',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        background: '#ffcccc',
                        color: '#b30000'
                    });
                </script>
            @endif
        
            @if (Session::get('success')) <!-- Pour la modification -->
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Action réussie',
                        text: '{{ Session::get('success') }}',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        background: '#ccffcc',
                        color: '#006600'
                    });
                </script>
            @endif
        
            @if (Session::get('error')) <!-- Pour une erreur générale -->
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: '{{ Session::get('error') }}',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        background: '#f86750',
                        color: '#ffffff'
                    });
                </script>
            @endif
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Liste des extraits de Décès</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Décès</li>
            </ol>
        </div>

        <!-- Row -->
        <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Les Décès Déclarés</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <!-- Champ de recherche -->
                        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Rechercher...">
                    
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="bg-navbar text-white">
                                <tr style="font-size: 12px">
                                    <th>Demandeur</th>
                                    <th>Hôpital</th>
                                    <th>Date de Décès</th>
                                    <th>Nom du Défunt</th>
                                    <th>Date de Naissance</th>
                                    <th>Lieu de Naissance</th>
                                    <th>Pièce du Déclarant</th>
                                    <th>Acte de Mariage</th>
                                    <th>Déclaration par la Loi</th>
                                    <th>Etat Actuel</th>
                                    <th>Agent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($deces as $deces)
                                <tr style="font-size: 12px">
                                    <td>{{ $deces->user ? $deces->user->name : 'Demandeur inconnu' }}</td>
                                    <td>{{ $deces->nomHopital }}</td>
                                    <td>{{ $deces->dateDces }}</td>
                                    <td>{{ $deces->nomDefunt }}</td>
                                    <td>{{ $deces->dateNaiss }}</td>
                                    <td>{{ $deces->lieuNaiss }}</td>
                                    <td>
                                        <div style="position: relative; width: 100px; height: 100px;">
                                            <img src="{{ asset('storage/' . $deces->identiteDeclarant) }}" 
                                                alt="Pièce du déclarant" 
                                                width="100" height="100" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#imageModal" 
                                                onclick="showImage(this)" 
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                Aucun fichier
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="position: relative; width: 100px; height: 100px;">
                                            <img src="{{ asset('storage/' . $deces->acteMariage) }}" 
                                                alt="Acte de mariage" 
                                                width="100" height="100" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#imageModal" 
                                                onclick="showImage(this)" 
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                Aucun fichier
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="position: relative; width: 100px; height: 100px;">
                                            <img src="{{ asset('storage/' . $deces->deParLaLoi) }}" 
                                                alt="Déclaration par la loi" 
                                                width="100" height="100" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#imageModal" 
                                                onclick="showImage(this)" 
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                Aucun fichier
                                            </span>
                                        </div>
                                    </td>
                                    <td class="{{ $deces->etat == 'en attente' ? 'bg-warning' : ($deces->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm" style="margin-top: 8px">
                                        {{ $deces->etat }}
                                    </td>
                                    <td>{{ $deces->agent ? $deces->agent->name . ' ' . $deces->agent->prenom : 'Non attribué' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">Aucune déclaration trouvée</td>
                                </tr>
                                @endforelse
                        
                                <!-- Modal -->
                                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalLabel">Aperçu de l'image</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img id="modalImage" src="{{ asset('assets/images/profiles/bébé.jpg') }}" alt="Image prévisualisée" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        </div>
    </div>

    <!-- Deuxième tableau -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Les Décès Déclarés</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table select-table">
                        <thead class="bg-navbar text-white">
                            <tr class="text-center" style="font-size: 12px">
                                <th>Demandeur</th>
                                <th>Nom et prénoms du défunt</th>
                                <th>Numéro du registre</th>
                                <th>Date du registre</th>
                                <th>Numéro du CMU</th>
                                <th>Certificat Médical de Décès</th>
                                <th>CNI-défunt</th>
                                <th>CNI-déclarant</th>
                                <th>Document de Mariage</th>
                                <th>Requisition de Police</th>
                                <th>État Actuel</th>
                                <th>Agent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($decesdeja as $dece)
                            <tr class="text-center" style="font-size: 12px">
                                <td>{{ $dece->user ? $dece->user->name : 'Demandeur inconnu' }}</td>
                                <td>{{ $dece->name }}</td>
                                <td>{{ $dece->numberR }}</td>
                                <td>{{ \Carbon\Carbon::parse($dece->dateR)->format('d/m/Y') }}</td>
                                <td>{{ $dece->CMU }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $dece->pActe) }}" alt="Certificat de déclaration" 
                                         width="100" height="auto" 
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal" 
                                         onclick="showImage(this)" 
                                         onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $dece->CNIdfnt) }}" alt="CNIdfnt" 
                                         width="100" height="auto" 
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal" 
                                         onclick="showImage(this)" 
                                         onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $dece->CNIdcl) }}" alt="CNIdcl" 
                                         width="100" height="auto" 
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal" 
                                         onclick="showImage(this)" 
                                         onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                </td>
                                <td>
                                    @if($dece->documentMariage)
                                        <img src="{{ asset('storage/' . $dece->documentMariage) }}" alt="Document de Mariage" 
                                             width="100" height="auto" 
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal" 
                                             onclick="showImage(this)" 
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                    @else
                                        <span>Le défunt(e) n'est pas marié(e)</span>
                                    @endif
                                </td>
                                <td>
                                    @if($dece->RequisPolice)
                                        <img src="{{ asset('storage/' . $dece->RequisPolice) }}" alt="Requis de Police" 
                                             width="100" height="auto" 
                                             data-bs-toggle="modal" 
                                             data-bs-target="#imageModal" 
                                             onclick="showImage(this)" 
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                    @else
                                        <span>Document non disponible</span>
                                    @endif
                                </td>
                                <td class="{{ $dece->etat == 'en attente' ? 'bg-warning' : ($dece->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm" style="margin-top: 8px">
                                    {{ $dece->etat }}
                                </td>
                                <td>{{ $dece->agent ? $dece->agent->name . ' ' . $dece->agent->prenom : 'Non attribué' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center">Aucune déclaration trouvée</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showImage(imageElement) {
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageElement.src; // Définit l'image source pour le modal
}
</script>

@endsection