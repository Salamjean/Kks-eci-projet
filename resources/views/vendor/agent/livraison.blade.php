@extends('vendor.agent.layouts.template')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .etat-en-attente {
            background-color: orange;
            color: black;
            display: flex;
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
     <!-- Insertion de SweetAlert2 -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <div class="row" style="width:100%; justify-content:center">
  <div class="row" style="width:100%; justify-content:center">
      @if (Session::get('success1')) <!-- Pour la suppression -->
          <script>
              Swal.fire({
                  icon: 'success',
                  title: 'Suppression réussie',
                  text: '{{ Session::get('success1') }}',
                  showConfirmButton: true,  // Afficher le bouton OK
                  confirmButtonText: 'OK',  // Texte du bouton
                  background: '#ffcccc',   // Couleur de fond personnalisée
                  color: '#b30000'          // Texte rouge foncé
              });
          </script>
      @endif
  
      @if (Session::get('success')) <!-- Pour la modification -->
          <script>
              Swal.fire({
                  icon: 'success',
                  title: 'Action réussie',
                  text: '{{ Session::get('success') }}',
                  showConfirmButton: true,  // Afficher le bouton OK
                  confirmButtonText: 'OK',  // Texte du bouton
                  background: '#ccffcc',   // Couleur de fond personnalisée
                  color: '#006600'          // Texte vert foncé
              });
          </script>
      @endif
  
      @if (Session::get('error')) <!-- Pour une erreur générale -->
          <script>
              Swal.fire({
                  icon: 'error',
                  title: 'Erreur',
                  text: '{{ Session::get('error') }}',
                  showConfirmButton: true,  // Afficher le bouton OK
                  confirmButtonText: 'OK',  // Texte du bouton
                  background: '#f86750',    // Couleur de fond rouge vif
                  color: '#ffffff'          // Texte blanc
              });
          </script>
      @endif
  </div>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Listes des livreurs</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Accueil</a></li>
                <li class="breadcrumb-item">Tables</li>
            </ol>
        </div>

        <!--  Tableau de mariages combiné -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Informations des livreurs</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <!-- Champ de recherche -->
                        <div class="input-group mb-3">
                            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                        </div>
                        
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="bg-navbar text-white">
                                <tr style="font-size: 12px">
                                    <th class="text-center">Nom et prénoms du </th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Contact</th>
                                    <th class="text-center">Lieu de résidence</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($livraisons as $livraison)
                                    <tr class="text-center" style="font-size: 12px">
                                        <td>{{ $livraison->name.' '.$livraison->prenom }}</td>
                                        <td>{{ $livraison->email}}</td>
                                        <td>{{ $livraison->contact}}</td>
                                        <td>{{ $livraison->commune}}</td>
                                        
                                    <tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Aucun livreur inscrire</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour afficher les images -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Aperçu de l'image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="{{ asset('assets/images/profiles/default.jpg') }}" alt="Image prévisualisée" class="img-fluid">
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
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="userDetails"></div>
            </div>
          </div>
        </div>
      </div>
    <script>
        function showImage(imageElement) {
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageElement.src;
        }
        document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase(); // Récupérer la valeur de recherche en minuscules
    const rows = document.querySelectorAll('#dataTable tbody tr'); // Sélectionner toutes les lignes du tableau

    rows.forEach(row => {
        let match = false;
        const cells = row.querySelectorAll('td'); // Sélectionner toutes les cellules de la ligne

        // Vérifier chaque cellule pertinente pour la recherche
        const nomPrenom = cells[0].textContent.toLowerCase(); // Colonne 0 : Nom et prénoms
        const email = cells[1].textContent.toLowerCase(); // Colonne 1 : Email
        const contact = cells[2].textContent.toLowerCase(); // Colonne 2 : Contact
        const commune = cells[3].textContent.toLowerCase(); // Colonne 3 : Lieu de résidence

        // Vérifier si la valeur de recherche correspond à l'une des colonnes
        if (nomPrenom.includes(filter) || email.includes(filter) || contact.includes(filter) || commune.includes(filter)) {
            match = true;
        }

        // Afficher ou masquer la ligne en fonction de la correspondance
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
    </script>
@endsection