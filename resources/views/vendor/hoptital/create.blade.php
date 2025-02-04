@extends('vendor.layouts.template')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<style>
  .signup-container {
    max-width: 70%;
    margin: 50px auto;
    background-color: #f8f9fa;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
  }

  .signup-container h6 {
    font-size: 1.75rem;
    font-weight: bold;
    color: #6777ef;
    text-align: center;
    margin-bottom: 30px;
  }

  .form-label {
    font-weight: 500;
  }

  .form-control {
    border-radius: 8px;
  }

  .btn-primary {
    background-color: #6777ef;
    border: none;
    width: 50%;
    border-radius: 8px;
    padding: 10px;
    margin-left: 25%;
    font-size: 1.1rem;
    transition: background-color 0.3s;
  }

  .btn-primary:hover {
    background-color: #4b5bd6;
  }

  .form-check-label {
    font-weight: 400;
    margin-left: 10px;
  }

  .table-responsive input {
    width: 100%;
    max-width: 400px;
    margin-bottom: 15px;
  }

  /* Style pour les alertes */
  .swal2-popup {
    font-size: 1.1rem;
  }

  /* Style pour les erreurs de validation */
  .was-validated .form-control:invalid {
    border-color: #dc3545;
  }

  .was-validated .form-control:valid {
    border-color: #28a745;
  }

  .invalid-feedback {
    display: block;
    font-size: 0.875rem;
  }
</style>

<div class="signup-container">
  <h6>Enregistrer un hôpital</h6>
  <div class="ms-panel-body">
    <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{ route('doctor.hoptitalstore') }}" novalidate id="hospitalForm">
        @csrf
        @method('POST')

        <div class="row">
            @if (Session::has('success1'))
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
           
            @if (Session::has('error'))
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

        <!-- Formulaire principal -->
        <div class="form-row mb-3">
            <div class="col-md-6">
                <label for="validationCustom001" class="form-label">Nom et prénoms de l'administrateur</label>
                <input type="text" class="form-control" name="name" id="validationCustom001" placeholder="Entrez le nom de l'administrateur" required>
               
            </div>

            <div class="col-md-6">
                <label for="validationCustom002" class="form-label">Email de l'hôpital</label>
                <input type="email" class="form-control" name="email" id="validationCustom002" placeholder="Entrez l'email de l'hôpital" required>
                
            </div>
        </div>

        <div class="form-row mb-3">
            <div class="col-md-6">
                <label for="validationCustom003" class="form-label">Contact de l'hôpital</label>
                <input type="text" class="form-control" name="contact" id="validationCustom003" placeholder="Entrez le contact de l'hôpital" required>
               
            </div>

            <div class="col-md-6">
                <label for="validationCustom004" class="form-label">Commune</label>
                <input type="text" class="form-control" name="commune" id="validationCustom004" value="{{ Auth::guard('vendor')->user()->name }}" readonly>
            </div>
        </div>

        <div class="form-row mb-3">
            <div class="col-md-6">
                <label for="validationCustom005" class="form-label">Type</label>
                <select class="form-control" name="type" id="validationCustom005" required>
                    <option value="" disabled selected>Choisissez le type d'hôpital...</option>
                    <option value="hôpital-general">Hôpital Général</option>
                    <option value="clinique">Clinique</option>
                    <option value="pmi">PMI</option>
                    <option value="chu">CHU</option>
                    <option value="fsu">FSU</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="validationCustom005" class="form-label">Nom de l'hôpital</label>
                <input type="text" class="form-control" name="nomHop" id="validationCustom005" placeholder="Entrez le nom de l'hôpital" required>
               
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Créer le compte</button>
    </form>
  </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Liste des hôpitaux</h6>
            </div>
            <div class="table-responsive p-3">
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Rechercher...">
                
                <table class="table table-striped" id="dataTable">
                    <thead class="bg-navbar text-white">
                        <tr style="font-size: 12px">
                            <th>Hôpital</th>
                            <th>Nom et prénoms de l'administrateur</th>
                            <th>Email de l'hôpital</th>
                            <th>Contact de l'hôpital</th>
                            <th>Commune</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($doctors as $doctor)
                        <tr style="font-size: 12px">
                            <td>{{ $doctor->nomHop }}</td>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->email }}</td>
                            <td>{{ $doctor->contact }}</td>
                            <td>{{ $doctor->commune }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Aucune déclaration trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Fonction de recherche
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

    // Validation du formulaire et pop-up de succès
    document.getElementById('hospitalForm').addEventListener('submit', function(event) {
       let form = event.target;
        if (!form.checkValidity()) {
           event.preventDefault();
           event.stopPropagation();
       }
        form.classList.add('was-validated');
        @if(Session::has('success'))
            Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: 'Hôpital enregistré avec succès.',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            background: '#ccffcc',
            color: '#006600'
            });
            @php
               Session::forget('success');
           @endphp
        @endif
   });
</script>
@endsection