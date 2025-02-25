@extends('pages.layouts.template')
@section('content')

<div class="container">
    <br><br><br><br><br><br><br><br><br>
    <h1 style="text-align: center; margin-bottom:40px">Recherche de l'état de votre demande</h1>

    <form method="POST" action="{{ route('recherche.demande') }}">
        @csrf {{-- Ajout du jeton CSRF pour la sécurité --}}

        <div class="mb-3" style="display: flex; justify-content:center; flex-direction:column">
            <label for="reference_naissance" class="form-label" style="font-size:25px; text-align:center; color:black; font-weight:bold" >Reférence</label>
            <input type="text" class="form-control" id="reference_naissance" style="padding: 20px" name="reference_naissance" placeholder="Entrez la reférence de votre demande ici">
        </div>

        <button type="submit" class="btn btn-primary w-100" >Rechercher</button>
    </form>

    <div id="resultat-recherche" class="mt-4">
        @if(isset($etatDemande))
            <h3>Résultat de la recherche:</h3>
            @if($etatDemande)
                <div class="alert alert-success" role="alert">
                    État de votre demande pour la référence "{{ request('reference_naissance') }}":
                    <strong>{{ $etatDemande }}</strong>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    Aucune demande trouvée pour la référence "{{ request('reference_naissance') }}".
                    Veuillez vérifier votre référence.
                </div>
            @endif
        @endif
    </div>
</div>

@endsection