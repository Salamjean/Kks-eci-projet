@extends('sous_admin.layouts.template')

@section('content')
<!-- CSS de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <a href="{{ route('naissHop.index') }}" class="btn btn-primary" style="margin-left:90%">Retour</a><br>
    <h1 class="text-center text-primary" style="font-size: 27px">Détails de la déclaration</h1>
    <table class="table table-bordered bg-white" style="border-block: 3px">
        <tr>
            <th>Numéro du Certificat Médical de Naissance</th>
            <td>{{ $naisshop->codeCMN }}</td>
        </tr>
        <tr>
            <th>Nom de la Mère</th>
            <td>{{ $naisshop->NomM }}</td>
        </tr>
        <tr>
            <th>Prénom de la Mère</th>
            <td>{{ $naisshop->PrM }}</td>
        </tr>
        <tr>
            <th>Contact de la Mère</th>
            <td>{{ $naisshop->contM }}</td>
        </tr>
        <tr>
            <th>Identité de la Mère (CNI)</th>
            <td>
                @if ($naisshop->CNI_mere)
                    <img src="{{ asset('storage/' . $naisshop->CNI_mere) }}" 
                         alt="CNI Mère" 
                         width="100" 
                         height="100" 
                         class="rounded">
                @else
                    Aucun fichier disponible
                @endif
            </td>
        </tr>
        <tr>
            <th>Nom de l'accompagnateur</th>
            <td>{{ $naisshop->NomP }}</td>
        </tr>
        <tr>
            <th>Prénom de l'accompagnateur</th>
            <td>{{ $naisshop->PrP }}</td>
        </tr>
        <tr>
            <th>Contact de l'accompagnateur</th>
            <td>{{ $naisshop->contP }}</td>
        </tr>
        <tr>
            <th>Identité de l'accompagnateur (CNI)</th>
            <td>
                @if ($naisshop->CNI_Pere)
                    <img src="{{ asset('storage/' . $naisshop->CNI_Pere) }}" 
                         alt="CNI Père" 
                         width="100" 
                         height="100" 
                         class="rounded">
                @else
                    Aucun fichier disponible
                @endif
            </td>
        </tr>
        <tr>
            <th>Hôpital de Naissance</th>
            <td>{{ $naisshop->NomEnf }}</td>
        </tr>
        <tr>
            <th>Commune de Naissance</th>
            <td>{{ $naisshop->commune }}</td>
        </tr>
        <tr>
            <th>Date de Naissance</th>
            <td>{{ $naisshop->DateNaissance }}</td>
        </tr>
    </table>
</div>
@endsection
