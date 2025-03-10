@extends('vendor.agent.layouts.template')

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

        <!-- Premier tableau -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Demande d'extrait avec certificat</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <!-- Champ de recherche pour le premier tableau -->
                        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Rechercher...">
                    
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="bg-navbar text-white">
                                <tr style="font-size: 12px" class="text-center">
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
                                    <th>Action</th>
                                    <th>Mode de rétrait</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($deces as $decesItem)
                                    <tr style="font-size: 12px" class="text-center">
                                         <td>
                                           @if($decesItem->user)
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#userModal" onclick="showUserModal({{ json_encode($decesItem->user) }})">
                                                {{ $decesItem->user->name.' '.$decesItem->user->prenom }}
                                            </a>
                                         @else
                                             Demandeur inconnu
                                         @endif
                                        </td>
                                        <td>{{ $decesItem->nomHopital }}</td>
                                        <td>{{ $decesItem->dateDces }}</td>
                                        <td>{{ $decesItem->nomDefunt }}</td>
                                        <td>{{ $decesItem->dateNaiss }}</td>
                                        <td>{{ $decesItem->lieuNaiss }}</td>
                                        <td>
                                            @if($decesItem->identiteDeclarant)
                                                @php
                                                    $identiteDeclarantPath = asset('storage/' . $decesItem->identiteDeclarant);
                                                    $isIdentiteDeclarantPdf = strtolower(pathinfo($identiteDeclarantPath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isIdentiteDeclarantPdf)
                                                      <a href="{{ $identiteDeclarantPath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <div style="position: relative; width: 100px; height: 100px;">
                                                        <img src="{{ $identiteDeclarantPath }}" 
                                                            alt="Pièce du déclarant" 
                                                            width="50" height="50" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#imageModal" 
                                                            onclick="showImage(this)" 
                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                            Aucun fichier
                                                        </span>
                                                    </div>
                                                @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                         <td>
                                            @if($decesItem->acteMariage)
                                                @php
                                                    $acteMariagePath = asset('storage/' . $decesItem->acteMariage);
                                                    $isActeMariagePdf = strtolower(pathinfo($acteMariagePath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isActeMariagePdf)
                                                      <a href="{{ $acteMariagePath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <div style="position: relative; width: 100px; height: 100px;">
                                                        <img src="{{  $acteMariagePath }}" 
                                                            alt="Acte de mariage" 
                                                            width="50" height="50" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#imageModal" 
                                                            onclick="showImage(this)" 
                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                            Aucun fichier
                                                        </span>
                                                    </div>
                                                @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($decesItem->deParLaLoi)
                                                @php
                                                    $deParLaLoiPath = asset('storage/' . $decesItem->deParLaLoi);
                                                    $isDeParLaLoiPdf = strtolower(pathinfo($deParLaLoiPath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isDeParLaLoiPdf)
                                                      <a href="{{ $deParLaLoiPath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <div style="position: relative; width: 100px; height: 100px;">
                                                        <img src="{{ $deParLaLoiPath }}" 
                                                            alt="Déclaration par la loi" 
                                                            width="50" height="50" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#imageModal" 
                                                            onclick="showImage(this)" 
                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                            Aucun fichier
                                                        </span>
                                                    </div>
                                                 @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                        <td class="{{ $decesItem->etat == 'en attente' ? 'bg-warning' : ($decesItem->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm" style="margin-top: 8px">
                                            {{ $decesItem->etat }}
                                        </td>
                                        <td>
                                            <a href="{{ route('deces.edit', $decesItem->id) }}" class="btn btn-sm" style="size: 0.6rem">Mettre à jour l'état</a>
                                        </td>
                                        <td>
                                            @if($decesItem->choix_option == 'livraison')
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#livraisonModal" onclick="showLivraison1Modal({{ json_encode($decesItem) }})">
                                                    <div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $decesItem->choix_option }}</div>
                                                </a>
                                            @else
                                                <div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $decesItem->choix_option }}</div>
                                            @endif
                                        </td>        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center">Aucune demande effectuée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deuxième tableau -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Les Décès pour moi/personne tierce</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <!-- Champ de recherche pour le deuxième tableau -->
                         <input type="text" id="searchInputTierce" class="form-control mb-3" placeholder="Rechercher...">

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
                                    <th>Action</th>
                                    <th>Mode de rétrait</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($decesdeja as $dece)
                                    <tr class="text-center" style="font-size: 12px">
                                       <td>
                                         @if($dece->user)
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#userModal" onclick="showUserModal({{ json_encode($dece->user) }})">
                                                {{ $dece->user->name.' '.$dece->user->prenom }}
                                            </a>
                                          @else
                                              Demandeur inconnu
                                           @endif
                                        </td>
                                        <td>{{ $dece->name }}</td>
                                        <td>{{ $dece->numberR }}</td>
                                        <td>{{ \Carbon\Carbon::parse($dece->dateR)->format('d/m/Y') }}</td>
                                        <td>{{ $dece->CMU }}</td>
                                       <td>
                                            @if($dece->pActe)
                                                @php
                                                    $pActePath = asset('storage/' . $dece->pActe);
                                                    $isPActePdf = strtolower(pathinfo($pActePath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isPActePdf)
                                                      <a href="{{ $pActePath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <img src="{{  $pActePath }}" alt="Certificat de déclaration" 
                                                         width="50" height="50" 
                                                         data-bs-toggle="modal" 
                                                         data-bs-target="#imageModal" 
                                                         onclick="showImage(this)" 
                                                         onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                                @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($dece->CNIdfnt)
                                                @php
                                                    $CNIdfntPath = asset('storage/' . $dece->CNIdfnt);
                                                    $isCNIdfntPdf = strtolower(pathinfo($CNIdfntPath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isCNIdfntPdf)
                                                      <a href="{{ $CNIdfntPath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                      <img src="{{ $CNIdfntPath }}" alt="CNIdfnt" 
                                                           width="50" height="50" 
                                                           data-bs-toggle="modal" 
                                                           data-bs-target="#imageModal" 
                                                           onclick="showImage(this)" 
                                                          onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                                @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if($dece->CNIdcl)
                                                @php
                                                    $CNIdclPath = asset('storage/' . $dece->CNIdcl);
                                                    $isCNIdclPdf = strtolower(pathinfo($CNIdclPath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isCNIdclPdf)
                                                      <a href="{{ $CNIdclPath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <img src="{{  $CNIdclPath }}" alt="CNIdcl" 
                                                         width="50" height="50" 
                                                         data-bs-toggle="modal" 
                                                         data-bs-target="#imageModal" 
                                                         onclick="showImage(this)" 
                                                          onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                                @endif
                                            @else
                                                <p>Non disponible</p>
                                            @endif
                                        </td>
                                         <td>
                                            @if($dece->documentMariage)
                                                @php
                                                    $documentMariagePath = asset('storage/' . $dece->documentMariage);
                                                    $isDocumentMariagePdf = strtolower(pathinfo($documentMariagePath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isDocumentMariagePdf)
                                                      <a href="{{ $documentMariagePath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <div style="position: relative; width: 100px; height: 100px;">
                                                        <img src="{{  $documentMariagePath }}" alt="Document de Mariage" 
                                                             width="50" height="50" 
                                                             data-bs-toggle="modal" 
                                                             data-bs-target="#imageModal" 
                                                             onclick="showImage(this)" 
                                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                            Aucun fichier
                                                        </span>
                                                    </div>
                                                 @endif
                                             @else
                                                <span>Le défunt(e) n'est pas marié(e)</span>
                                            @endif
                                        </td>
                                         <td>
                                           @if($dece->RequisPolice)
                                                @php
                                                    $RequisPolicePath = asset('storage/' . $dece->RequisPolice);
                                                    $isRequisPolicePdf = strtolower(pathinfo($RequisPolicePath, PATHINFO_EXTENSION)) === 'pdf';
                                                @endphp
                                                 @if ($isRequisPolicePdf)
                                                      <a href="{{  $RequisPolicePath }}" target="_blank">
                                                        <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="30" height="30">
                                                      </a>
                                                 @else
                                                    <div style="position: relative; width: 100px; height: 100px;">
                                                        <img src="{{  $RequisPolicePath }}" alt="Requis de Police" 
                                                             width="50" height="50" 
                                                             data-bs-toggle="modal" 
                                                             data-bs-target="#imageModal" 
                                                             onclick="showImage(this)" 
                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                                                            Document non disponible
                                                        </span>
                                                    </div>
                                                 @endif
                                            @else
                                                <span>Document non disponible</span>
                                            @endif
                                        </td>
                                        <td class="{{ $dece->etat == 'en attente' ? 'bg-warning' : ($dece->etat == 'réçu' ? 'bg-success' : 'bg-danger') }} text-white btn btn-sm" style="margin-top: 8px">
                                            {{ $dece->etat }}
                                        </td>
                                        <td>
                                            <a href="{{ route('decesdeja.edit', $dece->id) }}" class="btn btn-sm" style="size: 0.6rem">Mettre à jour l'état</a>
                                        </td>
                                        <td>
                                            @if($dece->choix_option == 'livraison')
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#livraisonModal" onclick="showLivraisonModal({{ json_encode($dece) }})">
                                                    <div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $dece->choix_option }}</div>
                                                </a>
                                            @else
                                                <div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $dece->choix_option }}</div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="13" class="text-center">Aucune demande effectuée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="livraisonModal" tabindex="-1" aria-labelledby="livraisonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #6777ef; color:white; text-align:center">
                <h5 class="modal-title" style="text-align: center" id="livraisonModalLabel">Informations de livraison</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="livraisonDetails"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour l'aperçu des images -->
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

 <!-- Modal pour les informations de l'utilisateur -->
 <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
         <div class="modal-header" style="background-color: #6777ef; color:white; text-align:center">
           <h5 class="modal-title" id="userModalLabel">Informations du demandeur</h5>
           <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <div id="userDetails"></div>
         </div>
       </div>
     </div>
   </div>

<!-- Scripts JavaScript -->
<script>
    // Fonction pour afficher l'image dans le modal
    function showImage(imageElement) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageElement.src;
    }

     // Script pour filtrer les résultats du premier tableau
     document.getElementById('searchInput').addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#dataTable tbody tr');
    
            rows.forEach(row => {
                let match = false;
                const cells = row.querySelectorAll('td');
    
                const nomDemandeur = cells[0].textContent.toLowerCase();
                const nomHopital = cells[1].textContent.toLowerCase();
                const nomDefunt = cells[3].textContent.toLowerCase();
    
                if (nomDemandeur.includes(filter) || nomHopital.includes(filter) || nomDefunt.includes(filter)) {
                     match = true;
                }
                row.style.display = match ? '' : 'none';
            });
        });

    // Script pour filtrer les résultats du deuxième tableau
     document.getElementById('searchInputTierce').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('.select-table tbody tr');

        rows.forEach(row => {
            let match = false;
            const cells = row.querySelectorAll('td');
            const nomDemandeur = cells[0].textContent.toLowerCase();
            const nomDefunt = cells[1].textContent.toLowerCase();


            if(nomDemandeur.includes(filter) || nomDefunt.includes(filter)){
                match = true;
            }

            row.style.display = match ? '' : 'none';
        });
    });
     function showUserModal(user) {
        const userDetailsDiv = document.getElementById('userDetails');
         userDetailsDiv.innerHTML = `
          <p style="text-align:center"><strong>Nom:</strong> ${user.name}</p>
            <p style="text-align:center"><strong>Prénom(s):</strong> ${user.prenom}</p>
            <p style="text-align:center"><strong>Email:</strong> ${user.email}</p>
            <p style="text-align:center"><strong>Commune:</strong> ${user.commune}</p>
            <p style="text-align:center"><strong>N°CMU:</strong> ${user.CMU}</p>
           `;
      }

      function showLivraisonModal(dece) {
    const livraisonDetailsDiv = document.getElementById('livraisonDetails');
    livraisonDetailsDiv.innerHTML = `
        <p style="text-align:center"><strong>Nom et prénoms du destinataire:</strong> ${dece.nom_destinataire} ${dece.prenom_destinataire}</p>
        <p style="text-align:center"><strong>Email du destinataire:</strong> ${dece.email_destinataire}</p>
        <p style="text-align:center"><strong>Contact du destinataire:</strong> ${dece.contact_destinataire}</p>
        <p style="text-align:center"><strong>Adresse de livraison:</strong> ${dece.adresse_livraison}</p>
        <p style="text-align:center"><strong>Ville:</strong> ${dece.ville}</p>
        <p style="text-align:center"><strong>Commune:</strong> ${dece.commune}</p>
        <p style="text-align:center"><strong>Quartier:</strong> ${dece.quartier}</p>
        <p style="text-align:center"><strong>Code postal:</strong> ${dece.code_postal}</p>
        <p style="text-align:center"><strong>Choisissez un livreur </strong> <a href="{{ route('agent.livraison') }}">maintenant</a> </p>
    `;
  }

  function showLivraison1Modal(decesItem) {
    const livraisonDetailsDiv = document.getElementById('livraisonDetails');
    livraisonDetailsDiv.innerHTML = `
        <p style="text-align:center"><strong>Nom et prénoms du destinataire:</strong> ${decesItem.nom_destinataire} ${decesItem.prenom_destinataire}</p>
        <p style="text-align:center"><strong>Email du destinataire:</strong> ${decesItem.email_destinataire}</p>
        <p style="text-align:center"><strong>Contact du destinataire:</strong> ${decesItem.contact_destinataire}</p>
        <p style="text-align:center"><strong>Adresse de livraison:</strong> ${decesItem.adresse_livraison}</p>
        <p style="text-align:center"><strong>Ville:</strong> ${decesItem.ville}</p>
        <p style="text-align:center"><strong>Commune:</strong> ${decesItem.commune}</p>
        <p style="text-align:center"><strong>Quartier:</strong> ${decesItem.quartier}</p>
        <p style="text-align:center"><strong>Code postal:</strong> ${decesItem.code_postal}</p>
        <p style="text-align:center"><strong>Choisissez un livreur </strong> <a href="{{ route('agent.livraison') }}">maintenant</a> </p>
    `;
  }
</script>

@endsection