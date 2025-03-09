@extends('vendor.livraison.layouts.template')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6 class="text-center p-4" style="background-color:#f97316; color:white">Les informations de la livraison</h6>
            <form action="{{ route('livraison.rechercher') }}" method="GET">
              <label for="" class="text-center" style="text-align: center; font-size:20px">Entrez la réference de la demande</label>
              <div class="input-group mb-3 d-flex justify-content-center align-items-center">
                <input type="text" name="reference" class="form-control form-control-sm p-4 w-50" placeholder="Rechercher par référence" aria-label="Rechercher par référence">
              </div>
              <button class="btn btn-outline-secondary ms-2 w-100" type="submit" id="button-addon2" style="background-color: black; color: white;">Rechercher</button>
            </form>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nom</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Email</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Contact</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Adresse</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Code postal</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Ville</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Commune</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Quartier</th>
                  </tr>
                </thead>
                <tbody>
                  @if(session('results'))
                    @foreach (session('results') as $result)
                      <tr>
                        <td>
                          <p class="text-xs text-secondary mb-0 text-center">{{ $result->nom_destinataire ?? $result->nom }} {{ $result->prenom_destinataire ?? $result->prenom }}</p>
                        </td>
                        <td>
                          <p class="text-xs text-secondary mb-0 text-center">{{ $result->email_destinataire ?? $result->email }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <p class="text-xs text-secondary mb-0 text-center">{{ $result->contact_destinataire ?? $result->contact }}</p>
                        </td>
                        <td class="align-middle">
                          <p class="text-xs text-secondary mb-0 text-center">{{ $result->adresse_livraison ?? $result->adresse }}</p>
                        </td>
                        <td class="align-middle">
                          <p class="text-xs text-secondary mb-0 text-center">{{ $result->code_postal ?? 'N/A' }}</p>
                        </td>
                        <td class="align-middle">
                          <p class="text-xs text-secondary mb-0 text-center">{{ $result->ville ?? 'N/A' }}</p>
                        </td>
                        <td class="align-middle">
                          <p class="text-xs text-secondary mb-0 text-center">{{ $result->commune_livraison ?? $result->commune }}</p>
                        </td>
                        <td class="align-middle">
                          <p class="text-xs text-secondary mb-0 text-center">{{ $result->quartier ?? 'N/A' }}</p>
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="8" class="text-center">Aucune demande de livraison trouvée.</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script>
    // Afficher un pop-up d'erreur si la session 'error' existe
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    @endif

    // Afficher un pop-up de succès si la session 'success' existe
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    @endif
</script>

@endsection