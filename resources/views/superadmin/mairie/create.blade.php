@extends('superadmin.layouts.template')

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
  <h6>Inscrire une mairie</h6>
  <div class="ms-panel-body">
    <form class="needs-validation" method="POST" action="{{ route('super_admin.store') }}" novalidate>
        @csrf
        @method('POST')

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
        <div class="form-row mb-3">
            <div class="col-md-6">
              <label for="validationCustom002" class="form-label">Sélectionnez une commune</label>
              <select id="validationCustom002" name="name" class="form-control" required>
                <option value="">Sélectionnez une commune</option>
                <option value="abobo">Abobo</option>
                <option value="adjame">Adjamé</option>
                <option value="attiecoube">Attécoubé</option>
                <option value="cocody">Cocody</option>
                <option value="koumassi">Koumassi</option>
                <option value="marcory">Marcory</option>
                <option value="plateau">Plateau</option>
                <option value="port-bouet">Port-Bouët</option>
                <option value="treichville">Treichville</option>
                <option value="yopougon">Yopougon</option>
                <option value="aboisso">Aboisso</option>
                <option value="abengourou">Abengourou</option>
                <option value="abobo-baoule">Abobo-Baoulé</option>
                <option value="agboville">Agboville</option>
                <option value="agni-bouake">Agni-Bouaké</option>
                <option value="allankoua">Allankoua</option>
                <option value="anono">Anono</option>
                <option value="ankoum">Ankoum</option>
                <option value="anyama">Anyama</option>
                <option value="alepe">Alépé</option>
                <option value="ayama">Ayama</option>
                <option value="bagohouo">Bagohouo</option>
                <option value="banga">Banga</option>
                <option value="bamboue">Bamboué</option>
                <option value="bocanda">Bocanda</option>
                <option value="borotou">Borotou</option>
                <option value="bouna">Bouna</option>
                <option value="bounkani">Bounkani</option>
                <option value="bouafle">Bouaflé</option>
                <option value="bouake">Bouaké</option>
                <option value="bounoua">Bounoua</option>
                <option value="dabakala">Dabakala</option>
                <option value="dabou">Dabou</option>
                <option value="daloa">Daloa</option>
                <option value="dimbokro">Dimbokro</option>
                <option value="debine">Débine</option>
                <option value="djangokro">Djangokro</option>
                <option value="dini">Dini</option>
                <option value="ferkessedougou">Ferkessédougou</option>
                <option value="gagnoa">Gagnoa</option>
                <option value="genegbe">Génégbé</option>
                <option value="grand-bassam">Grand-Bassam</option>
                <option value="grand-lahou">Grand-Lahou</option>
                <option value="guiberoua">Guiberoua</option>
                <option value="ikessou">Ikessou</option>
                <option value="jacqueville">Jacqueville</option>
                <option value="kong">Kong</option>
                <option value="korhogo">Korhogo</option>
                <option value="marako">Marako</option>
                <option value="man">Man</option>
                <option value="mondougou">Mondougou</option>
                <option value="nzi">Nzi</option>
                <option value="odienne">Odienné</option>
                <option value="san-pedro">San-Pédro</option>
                <option value="sassandra">Sassandra</option>
                <option value="segueila">Séguéla</option>
                <option value="sénoufo">Sénoufo</option>
                <option value="sikensi">Sikensi</option>
                <option value="songon">Songon</option>
                <option value="solia">Solia</option>
                <option value="soubre">Soubré</option>
                <option value="tabou">Tabou</option>
                <option value="tiago">Tiago</option>
                <option value="tiassale">Tiassalé</option>
                <option value="toumodi">Toumodi</option>
                <option value="zuénoula">Zuénoula</option>
                <option value="chire">Chiré</option>
                <option value="deboudougou">Déboudougou</option>
                <option value="diboke">Diboké</option>
                <option value="doungou">Doungou</option>
                <option value="boura">Boura</option>
                <option value="bofora">Bofora</option>
                <option value="zagoua">Zagoua</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="validationCustom004" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="validationCustom004" placeholder="Entrez son email" required>
          </div>
        </div>

        <button class="btn btn-primary" type="submit">Créer le compte</button>
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