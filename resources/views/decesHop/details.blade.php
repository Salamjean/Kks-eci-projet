@extends('sous_admin.layouts.template')

@section('content')
<!-- CSS de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <a href="{{ route('decesHop.index') }}" class="btn btn-primary" style="margin-left:90%">Retour</a><br>
    <h1 class="text-center text-primary" style="font-size: 27px">Détails de la déclaration</h1>
    <table class="table table-bordered bg-white" style="border-block: 3px">
        <tr>
            <th>Numéro du Certicat Médical de Décès</th>
            <td>{{ $deceshop->codeCMD }}</td>
        </tr>
        <tr>
            <th>Nom du défunt</th>
            <td>{{ $deceshop->NomM }}</td>
        </tr>
        <tr>
            <th>Prénom du défunt</th>
            <td>{{ $deceshop->PrM }}</td>
        </tr>
        <tr>
            <th>Date de Naissancé du défunt</th>
            <td>{{ $deceshop->DateNaissance }}</td>
        </tr>
        <tr>
            <th>Date de décès</th>
            <td>
               {{ $deceshop->DateDeces }}
            </td>
        </tr>
        <tr>
            <th>Cause de décès</th>
            <td>{{ $deceshop->Remarques }}</td>
        </tr>
        <tr>
            <th>Décès subvenu à</th>
            <td>{{ $deceshop->commune }}</td>
        </tr>
        <tr>
            <th>A l'hôpital</th>
            <td>{{ $deceshop->nomHop }}</td>
        </tr>
       
    </table>
</div>
@endsection
