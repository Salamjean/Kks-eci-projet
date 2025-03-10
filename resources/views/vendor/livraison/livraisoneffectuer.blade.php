@extends('vendor.livraison.layouts.template')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6 class="text-center p-4" style="background-color:#f97316; color:white">Les informations de la livraison</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Type de demande</th>
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
                   @forelse ($livraisons as $livraison)
                      @php
                          // Mapper les noms de classe aux libellés souhaités
                          $typeDemande = class_basename($livraison);
                          $libelleDemande = [
                              'NaissanceD' => 'Naissance',
                              'Decesdeja' => 'Décès',
                              'Naissance' => 'Naissance',
                              'Deces' => 'Décès',
                              'Mariage' => 'Mariage',
                          ][$typeDemande] ?? $typeDemande;
                      @endphp
                      <tr>
                        <td class="text-center">
                          <p class="text-xs text-secondary mb-0">{{ $libelleDemande }}</p>
                        </td>
                        <td class="text-center">
                          <p class="text-xs text-secondary mb-0">{{ $livraison->nom_destinataire ?? $livraison->nom }} {{ $livraison->prenom_destinataire ?? $livraison->prenom }}</p>
                        </td>
                        <td class="text-center">
                          <p class="text-xs text-secondary mb-0">{{ $livraison->email_destinataire ?? $livraison->email }}</p>
                        </td>
                        <td class="text-center">
                          <p class="text-xs text-secondary mb-0">{{ $livraison->contact_destinataire ?? $livraison->contact }}</p>
                        </td>
                        <td class="text-center">
                          <p class="text-xs text-secondary mb-0">{{ $livraison->adresse_livraison ?? $livraison->adresse }}</p>
                        </td>
                        <td class="text-center">
                          <p class="text-xs text-secondary mb-0">{{ $livraison->code_postal ?? 'N/A' }}</p>
                        </td>
                        <td class="text-center">
                          <p class="text-xs text-secondary mb-0">{{ $livraison->ville ?? 'N/A' }}</p>
                        </td>
                        <td class="text-center">
                          <p class="text-xs text-secondary mb-0">{{ $livraison->commune_livraison ?? $livraison->commune }}</p>
                        </td>
                        <td class="text-center">
                          <p class="text-xs text-secondary mb-0">{{ $livraison->quartier ?? 'N/A' }}</p>
                        </td>
                      </tr>
                   @empty
                      <tr>
                        <td colspan="9" class="text-center">Aucune demande de livraison trouvée.</td>
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