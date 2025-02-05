@extends('utilisateur.layouts.template')

@section('content')

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .form-background {
        background-image: url("{{ asset('assets/images/profiles/arriereP.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 20px;
        border-radius: 8px;
    }

    .modal-image {
        max-width: 100%;
        height: auto;
    }

    button {
        border: none;
        background: none;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-danger {
        color: white;
        background-color: #dc3545;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .disabled-btn {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: all; /* Permet au bouton de recevoir des événements de clic */
    }

    /* Styles pour les petits écrans (mobile) */
    @media (max-width: 767.98px) {
        .table-responsive {
            overflow-x: auto;
        }
        .table td, .table th {
            white-space: nowrap; /* Empêche le texte de se casser sur plusieurs lignes */
        }
        .table thead {
            display: none; /* Masque l'en-tête du tableau sur les petits écrans */
        }
        .table tbody tr {
            display: block;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px;
            text-align: right;
            border-bottom: 1px solid #ddd;
        }
        .table tbody td::before {
            content: attr(data-label); /* Affiche le libellé de la colonne */
            font-weight: bold;
            margin-right: 10px;
            text-align: left;
        }
    }

    /* Styles pour les tablettes (768px à 1024px) */
    @media (min-width: 768px) and (max-width: 1024px) {
        .table-responsive {
            overflow-x: auto;
        }
        .table td, .table th {
            white-space: nowrap; /* Empêche le texte de se casser sur plusieurs lignes */
        }
        .table thead {
            display: table-header-group; /* Affiche l'en-tête du tableau sur les tablettes */
        }
        .table tbody tr {
            display: table-row;
        }
        .table tbody td {
            display: table-cell;
            text-align: center;
            padding: 8px;
        }
        .table tbody td::before {
            display: none; /* Masque les libellés sur les tablettes */
        }
        /* Masquer certaines colonnes sur les tablettes */
        .table th.d-none-tablet,
        .table td.d-none-tablet {
            display: none;
        }
    }

    /* Styles pour les écrans d'ordinateurs plus petits (1024px à 1280px) */
    @media (min-width: 1024px) and (max-width: 1280px) {
        .table-responsive {
            overflow-x: auto;
        }
        .table td, .table th {
            white-space: nowrap; /* Empêche le texte de se casser sur plusieurs lignes */
        }
        .table thead {
            display: table-header-group; /* Affiche l'en-tête du tableau */
        }
        .table tbody tr {
            display: table-row;
        }
        .table tbody td {
            display: table-cell;
            text-align: center;
            padding: 8px;
        }
        .table tbody td::before {
            display: none; /* Masque les libellés sur les écrans plus petits */
        }
        /* Masquer certaines colonnes sur les écrans plus petits */
        .table th.d-none-small-pc,
        .table td.d-none-small-pc {
            display: none;
        }
    }
</style>

<div class="row flex-grow form-background">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-start mb-4">
                    <h4 class="card-title card-title-dash">Listes des demandes d'extrait effectuée</h4>
                    <a href="{{ route('mariage.create') }}">
                        <button class="btn btn-primary btn-lg text-white" type="button">Faire une nouvelle demande</button>
                    </a>
                </div>

                <!-- Tableau unique avec responsive -->
                <div class="table-responsive">
                    <table class="table select-table">
                        <thead class="bg-navbar text-white">
                            <tr style="font-size: 12px">
                                <th class="text-center">Nom du demandeur</th>
                                <th class="text-center d-none-tablet d-none-small-pc">Nom du conjoint(e)</th>
                                <th class="text-center d-none-tablet d-none-small-pc">Prénoms du conjoint(e)</th>
                                <th class="text-center d-none-tablet d-none-small-pc">Date de Naissance du conjoint(e)</th>
                                <th class="text-center d-none-tablet d-none-small-pc">Lieu de Naissance du conjoint(e)</th>
                                <th class="text-center">Pièce d'Identité du conjoint(e)</th>
                                <th class="text-center">Extrait de Mariage</th>
                                <th class="text-center">Etat Actuel</th>
                                <th class="text-center">Agent</th>
                                <th class="text-center">Supprimer</th>
                                <th class="text-center">Rétrait</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allMariages as $mariage)
                            <tr class="text-center" style="font-size: 12px">
                                <td data-label="Demandeur">{{ $mariage->user ? $mariage->user->name : 'Demandeur inconnu' }}</td>
                                <td data-label="Nom de l'Époux" class="d-none-tablet d-none-small-pc">{{ $mariage->nomEpoux ? : 'copie-simple' }}</td>
                                <td data-label="Prénom de l'Époux" class="d-none-tablet d-none-small-pc">{{ $mariage->prenomEpoux ? : 'copie-simple' }}</td>
                                <td data-label="Date de Naissance" class="d-none-tablet d-none-small-pc">{{ $mariage->dateNaissanceEpoux ? : 'copie-simple' }}</td>
                                <td data-label="Lieu de Naissance" class="d-none-tablet d-none-small-pc">{{ $mariage->lieuNaissanceEpoux ? : 'copie-simple' }}</td>
                                <td>
                                    @if (pathinfo($mariage->pieceIdentite, PATHINFO_EXTENSION) === 'pdf')
                                        <a href="{{ asset('storage/' . $mariage->pieceIdentite) }}" target="_blank">
                                            <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                        </a>
                                    @else
                                        <img src="{{ asset('storage/' . $mariage->pieceIdentite) }}" 
                                             alt="Pièce du parent" 
                                             width="100" 
                                             height="auto" 
                                             onclick="showImage(this)" 
                                             onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                    @endif
                                </td>
                                <td>
                                    @if (pathinfo($mariage->extraitMariage, PATHINFO_EXTENSION) === 'pdf')
                                        <a href="{{ asset('storage/' . $mariage->extraitMariage) }}" target="_blank">
                                            <img src="{{ asset('assets/images/profiles/pdf.jpg') }}" alt="PDF" width="100" height="auto">
                                        </a>
                                    @else
                                        <img src="{{ asset('storage/' . $mariage->extraitMariage) }}" 
                                             alt="Pièce du parent" 
                                             width="100" 
                                             height="auto" 
                                             onclick="showImage(this)" 
                                             onerror="this.onerror=null; this.src='{{ asset('assets/images/profiles/bébé.jpg') }}'">
                                    @endif
                                </td>
                                <td data-label="Etat Actuel">
                                    <span class="badge {{ $mariage->etat == 'en attente' ? 'badge-opacity-warning' : ($mariage->etat == 'réçu' ? 'badge-opacity-success' : 'badge-opacity-danger') }}">
                                        {{ $mariage->etat }}
                                    </span>
                                </td>
                                <td data-label="Agent">{{ $mariage->agent ? $mariage->agent->name . ' ' . $mariage->agent->prenom : 'Non attribué' }}</td>
                                <td data-label="Supprimer">
                                    @if ($mariage->etat !== 'réçu' && $mariage->etat !== 'terminé')
                                    <button onclick="confirmDelete('{{ route('mariage.delete', $mariage->id) }}')" class="btn btn-sm text-center"><i class="fas fa-trash"></i></button>
                                    @else
                                         <button  class="btn btn-danger btn-sm disabled-btn" onclick="showDisabledMessage()">
                                             <i class="fas fa-trash"></i>
                                         </button>
                                    @endif

                                </td>
                                <td ><div class="bg-danger text-white" style="padding: 10px; font-weight:bold">{{ $mariage->choix_option }}</div></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">Aucune déclaration trouvée</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modale -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <img id="modalImage" class="modal-image" src="" alt="Image en grand">
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 JS -->
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
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url; // Rediriger vers l'URL de suppression
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