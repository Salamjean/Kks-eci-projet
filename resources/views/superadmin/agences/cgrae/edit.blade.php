@extends('superadmin.cgrae.layouts.template')

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
    background-color: green;
    border: none;
    width: 50%;
    border-radius: 8px;
    padding: 10px;
    margin-left: 25%;
    font-size: 1.1rem;
    color: white;
    font-weight: bold;
    transition: background-color 0.3s;
  }

  .btn-primary:hover {
    background-color: rgb(5, 96, 5);
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
  <h6 style="color: green">Modifier les informations de l'agence {{ $agence->agence_name}}</h6>
  <div class="ms-panel-body">
    <form class="needs-validation" method="POST"  action="{{ route('cgraeagences.update', $agence->id) }}" novalidate>
        @csrf
        @method('PUT')

        <div class="row">
            @if (Session::get('success1'))
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

            @if (Session::get('success'))
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

            @if (Session::get('error'))
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
                <!-- Formulaire principal -->
                <div class="form-row mb-3">
                  <div class="col-md-6">
                      <label for="validationCustom001" class="form-label">Nom et prénoms de l'administrateur de l'agence</label>
                      <input type="text" class="form-control" name="name" id="validationCustom001" value="{{ $agence->name }}" >
                      @error('name')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="validationCustom003" class="form-label">Email de l'agence</label> 
                    <input type="email" class="form-control" name="email" id="validationCustom003"  value="{{ $agence->email }}" >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
              </div>
      
              <div class="form-row mb-3">
                    <div class="col-md-6">
                      <label for="validationCustom004" class="form-label">Contact de l'agence</label>
                      <input type="text" class="form-control" name="contact" id="validationCustom004"  value="{{ $agence->contact }}" >
                      @error('contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="validationCustom005" class="form-label">Siège</label>
                      <input type="text" class="form-control" name="siege" id="validationCustom005" value="{{ Auth::guard('cgrae')->user()->siege }}" readonly>
                      @error('siege')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
      
              </div>
      
              <div class="form-row mb-3">
                  <div class="col-md-12">
                      <label for="validationCustom005" class="form-label">Nom de l'agence</label>
                      <input type="text" class="form-control" name="agence_name" id="validationCustom005" value="{{ $agence->agence_name }}">
                      @error('agence_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>
              </div>
        <button class="btn btn-primary" type="submit">Mèttre à jour</button>
    </form>
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

    // Validation du formulaire
    document.querySelector('form').addEventListener('submit', function(event) {
        let form = event.target;
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
</script>
@endsection
