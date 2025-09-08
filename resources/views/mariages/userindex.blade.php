@extends('utilisateur.layouts.template')

@section('content')

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    :root {
        --orange: #ffa500;
        --green: #008000;
        --white: #ffffff;
        --light-green: #e8f5e9;
        --light-orange: #fff3e0;
        --dark-green: #006400;
        --dark-orange: #cc8400;
        --gray: #f5f5f5;
        --border-radius: 12px;
        --box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    .form-background {
        background-image: url("{{ asset('assets/images/profiles/arriereP.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 20px;
        border-radius: var(--border-radius);
    }

    .modal-image {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .btn-danger {
        color: white;
        background-color: #dc3545;
        border: none;
        padding: 8px 15px;
        border-radius: 6px;
        transition: var(--transition);
    }

    .btn-danger:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }

    .disabled-btn {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: all;
    }

    .card-rounded {
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        border: none;
    }

    .card-title {
        color: var(--green);
        font-weight: 700;
        position: relative;
        padding-bottom: 15px;
    }

    .card-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--orange);
        border-radius: 2px;
    }

    .nav-tabs {
        border-bottom: 2px solid var(--green);
        margin-bottom: 25px;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #555;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
        margin-right: 5px;
        transition: var(--transition);
    }

    .nav-tabs .nav-link:hover {
        background-color: var(--light-green);
        border-color: transparent;
    }

    .nav-tabs .nav-link.active {
        background-color: var(--green);
        color: var(--white);
        border: none;
        position: relative;
    }

    .nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--white);
    }

    .table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--box-shadow);
    }

    .table th {
        background: linear-gradient(to right, var(--green), var(--dark-green));
        color: var(--white);
        padding: 15px 10px;
        font-weight: 600;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .table td {
        padding: 12px 10px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #e0e0e0;
    }

    .table tr:nth-child(even) {
        background-color: var(--light-green);
    }

    .table tr:hover {
        background-color: var(--light-orange);
        transition: var(--transition);
    }

    .badge {
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 600;
    }

    .badge-opacity-warning {
        background-color: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }

    .badge-opacity-success {
        background-color: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }

    .badge-opacity-danger {
        background-color: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }

    .btn-primary {
        background: linear-gradient(to right, var(--green), var(--dark-green));
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        transition: var(--transition);
    }

    .btn-primary:hover {
        background: linear-gradient(to right, var(--dark-green), var(--green));
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 100, 0, 0.2);
    }

    .btn-sm {
        padding: 6px 12px;
        border-radius: 6px;
    }

    .bg-danger {
        background: linear-gradient(to right, var(--orange), var(--dark-orange)) !important;
        padding: 10px;
        border-radius: 8px;
        font-weight: bold;
    }

    /* Styles pour les modals */
    .modal-content {
        border-radius: var(--border-radius);
        border: none;
        box-shadow: var(--box-shadow);
    }

    .modal-header {
        background: linear-gradient(to right, var(--green), var(--dark-green));
        color: var(--white);
        border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    .modal-title {
        font-weight: 600;
    }

    .close {
        color: var(--white);
        opacity: 0.8;
    }

    .close:hover {
        color: var(--white);
        opacity: 1;
    }

    /* Styles pour les petits écrans (mobile) */
    @media (max-width: 767.98px) {
        .table-responsive {
            overflow-x: auto;
            border-radius: var(--border-radius);
        }
        .table td, .table th {
            white-space: nowrap;
        }
        .table thead {
            display: none;
        }
        .table tbody tr {
            display: block;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            background: var(--white);
            box-shadow: var(--box-shadow);
        }
        .table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            text-align: right;
            border-bottom: 1px solid #e0e0e0;
        }
        .table tbody td::before {
            content: attr(data-label);
            font-weight: bold;
            margin-right: 10px;
            text-align: left;
            color: var(--green);
        }
        
        .card-title {
            font-size: 1.4rem;
        }
        
        .btn-primary {
            padding: 12px 20px;
            font-size: 14px;
        }
        
        .nav-tabs .nav-link {
            padding: 10px 15px;
            font-size: 14px;
        }
    }

    /* Styles pour les tablettes (768px à 1024px) */
    @media (min-width: 768px) and (max-width: 1024px) {
        .table-responsive {
            overflow-x: auto;
        }
        .table td, .table th {
            white-space: nowrap;
        }
        .table thead {
            display: table-header-group;
        }
        .table tbody tr {
            display: table-row;
        }
        .table tbody td {
            display: table-cell;
            text-align: center;
            padding: 10px;
        }
        .table tbody td::before {
            display: none;
        }
        
        .d-none-tablet {
            display: none !important;
        }
        
        .nav-tabs .nav-link {
            padding: 10px 15px;
            font-size: 14px;
        }
    }

    /* Styles pour les écrans d'ordinateurs plus petits (1024px à 1280px) */
    @media (min-width: 1024px) and (max-width: 1280px) {
        .table-responsive {
            overflow-x: auto;
        }
        .table td, .table th {
            white-space: nowrap;
        }
        .table thead {
            display: table-header-group;
        }
        .table tbody tr {
            display: table-row;
        }
        .table tbody td {
            display: table-cell;
            text-align: center;
            padding: 10px;
        }
        .table tbody td::before {
            display: none;
        }
        
        .d-none-small-pc {
            display: none !important;
        }
    }
</style>

<div class="row flex-grow form-background">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="card-title card-title-dash">Listes des demandes d'extrait de mariage effectuées</h4>
                        <p class="text-muted">Gérez vos demandes d'extrait de mariage</p>
                    </div>
                    <a href="{{ route('mariage.create') }}">
                        <button class="btn btn-primary btn-lg text-white" type="button">
                            <i class="fas fa-plus-circle me-2"></i>Faire une nouvelle demande
                        </button>
                    </a>
                </div>

                <!-- Onglets -->
                <ul class="nav nav-tabs mt-4" id="mariageTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="en-cours-tab" data-bs-toggle="tab" data-bs-target="#en-cours" type="button" role="tab" aria-controls="en-cours" aria-selected="true">
                            <i class="fas fa-clock me-2"></i>En cours
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="termine-tab" data-bs-toggle="tab" data-bs-target="#termine" type="button" role="tab" aria-controls="termine" aria-selected="false">
                            <i class="fas fa-check-circle me-2"></i>Terminées
                        </button>
                    </li>
                </ul>

                <!-- Contenu des onglets -->
                <div class="tab-content" id="mariageTabsContent">
                    <!-- Onglet 1 : Demandes en cours -->
                    <div class="tab-pane fade show active" id="en-cours" role="tabpanel" aria-labelledby="en-cours-tab">
                        <div class="table-responsive mt-4">
                            <table class="table select-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nom du demandeur</th>
                                        <th class="text-center">Référence</th>
                                        <th class="text-center d-none-tablet d-none-small-pc">Nom du conjoint(e)</th>
                                        <th class="text-center d-none-tablet d-none-small-pc">Prénoms du conjoint(e)</th>
                                        <th class="text-center d-none-tablet d-none-small-pc">Date de Naissance</th>
                                        <th class="text-center d-none-tablet d-none-small-pc">Lieu de Naissance</th>
                                        <th class="text-center">Pièce d'Identité</th>
                                        <th class="text-center">Extrait de Mariage</th>
                                        <th class="text-center">État</th>
                                        <th class="text-center">Agent</th>
                                        <th class="text-center">Actions</th>
                                        <th class="text-center">Mode retrait</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($allMariages->where('etat', '!=', 'terminé') as $mariage)
                                    <tr class="text-center">
                                        <td data-label="Demandeur">{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
                                        <td data-label="Référence">{{ $mariage->reference}}</td>
                                        <td data-label="Nom de l'Époux" class="d-none-tablet d-none-small-pc">{{ $mariage->nomEpoux ? : 'copie-simple' }}</td>
                                        <td data-label="Prénom de l'Époux" class="d-none-tablet d-none-small-pc">{{ $mariage->prenomEpoux ? : 'copie-simple' }}</td>
                                        <td data-label="Date de Naissance" class="d-none-tablet d-none-small-pc">{{ $mariage->dateNaissanceEpoux ? : 'copie-simple' }}</td>
                                        <td data-label="Lieu de Naissance" class="d-none-tablet d-none-small-pc">{{ $mariage->lieuNaissanceEpoux ? : 'copie-simple' }}</td>
                                        <td>
                                            @if (pathinfo($mariage->pieceIdentite, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $mariage->pieceIdentite) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="50" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $mariage->pieceIdentite) }}" 
                                                     alt="Pièce d'identité" 
                                                     width="50" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        <td> 
                                            @if (pathinfo($mariage->extraitMariage, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $mariage->extraitMariage) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="50" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $mariage->extraitMariage) }}" 
                                                     alt="Extrait de mariage" 
                                                     width="50" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $mariage->etat == 'en attente' ? 'badge-opacity-warning' : ($mariage->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}">
                                                {{ $mariage->etat }}
                                            </span>
                                        </td>
                                        <td data-label="Agent">{{ $mariage->agent ? $mariage->agent->name . ' ' . $mariage->agent->prenom : 'Non attribué' }}</td>
                                        <td data-label="Actions">
                                            @if ($mariage->etat !== 'réçu' && $mariage->etat !== 'terminé')
                                            <button onclick="confirmDelete('{{ route('mariage.delete', $mariage->id) }}')" class="btn btn-sm text-center"><i class="fas fa-trash"></i></button>
                                            @else
                                                 <button class="btn btn-danger btn-sm disabled-btn" onclick="showDisabledMessage()">
                                                     <i class="fas fa-trash"></i>
                                                 </button>
                                            @endif
                                        </td>
                                        <td><div class="bg-danger text-white">{{ $mariage->choix_option == 'retrait_sur_place' ? 'Retrait sur place' : 'Livraison'}}</div></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="12" class="text-center">Aucune demande en cours</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Onglet 2 : Demandes terminées -->
                    <div class="tab-pane fade" id="termine" role="tabpanel" aria-labelledby="termine-tab">
                        <div class="table-responsive mt-4">
                            <table class="table select-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nom du demandeur</th>
                                        <th class="text-center">Référence</th>
                                        <th class="text-center d-none-tablet d-none-small-pc">Nom du conjoint(e)</th>
                                        <th class="text-center d-none-tablet d-none-small-pc">Prénoms du conjoint(e)</th>
                                        <th class="text-center">Pièce d'Identité</th>
                                        <th class="text-center">Extrait de Mariage</th>
                                        <th class="text-center">Date de complétion</th>
                                        <th class="text-center">Agent</th>
                                        <th class="text-center">Mode retrait</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($allMariages->where('etat', 'terminé') as $mariage)
                                    <tr class="text-center">
                                        <td data-label="Demandeur">{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
                                        <td data-label="Référence">{{ $mariage->reference}}</td>
                                        <td data-label="Nom de l'Époux" class="d-none-tablet d-none-small-pc">{{ $mariage->nomEpoux ? : 'copie-simple' }}</td>
                                        <td data-label="Prénom de l'Époux" class="d-none-tablet d-none-small-pc">{{ $mariage->prenomEpoux ? : 'copie-simple' }}</td>
                                        <td>
                                            @if (pathinfo($mariage->pieceIdentite, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $mariage->pieceIdentite) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="50" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $mariage->pieceIdentite) }}" 
                                                     alt="Pièce d'identité" 
                                                     width="50" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        <td> 
                                            @if (pathinfo($mariage->extraitMariage, PATHINFO_EXTENSION) === 'pdf')
                                                <a href="{{ asset('storage/' . $mariage->extraitMariage) }}" target="_blank">
                                                    <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="50" height="auto">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/' . $mariage->extraitMariage) }}" 
                                                     alt="Extrait de mariage" 
                                                     width="50" 
                                                     height="auto" 
                                                     onclick="showImage(this)" 
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                            @endif
                                        </td>
                                        <td data-label="Date de complétion">{{ $mariage->updated_at->format('d/m/Y H:i') }}</td>
                                        <td data-label="Agent">{{ $mariage->agent ? $mariage->agent->name . ' ' . $mariage->agent->prenom : 'Non attribué' }}</td>
                                        <td><div class="bg-danger text-white">{{ $mariage->choix_option == 'retrait_sur_place' ? 'Retrait sur place' : 'Livraison' }}</div></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Aucune demande terminée</td>
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
</div>

<!-- Modale -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="modalImage" class="modal-image" src="" alt="Image en grand">
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS et SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showImage(imageElement) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageElement.src;
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }

    function confirmDelete(url) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous ne pourrez pas revenir en arrière !",
            icon: 'warning',
            showCancelButton: true;
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function showDisabledMessage() {
        Swal.fire({
            title: 'Action impossible',
            text: 'Vous ne pouvez pas supprimer cette demande car elle est en cours de traitement ou déjà terminée.',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }

    // Afficher un pop-up de succès après la suppression
    @if(session('success'))
        Swal.fire({
            title: 'Succès !',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    @endif

    // Afficher un pop-up d'erreur en cas d'échec de la suppression
    @if(session('error'))
        Swal.fire({
            title: 'Erreur !',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    @endif
</script>

@endsection