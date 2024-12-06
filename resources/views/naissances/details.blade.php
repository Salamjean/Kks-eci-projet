@extends('vendor.layouts.template')

@section('content')
<!-- Fichiers CSS de Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Fichiers JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <a href="{{ route('vendor.dashboard') }}" class="btn btn-primary" style="margin-left:90%">Retour</a><br>
    <h1 class="text-center text-primary" style="font-size: 27px">Détails de la Naissance</h1>
    <table class="table table-bordered bg-white" style="border-block: 3px">
        <tr>
            <th>Nom de l'Hôpital</th>
            <td>{{ $naissance->nomHopital }}</td>
        </tr>
        <tr>
            <th>Nom du Défunt</th>
            <td>{{ $naissance->nomDefunt }}</td>
        </tr>
        <tr>
            <th>Lieu de Naissance</th>
            <td>{{ $naissance->lieuNaiss }}</td>
        </tr>
        <tr>
            <th>Date de Demande</th>
            <td>{{ $naissance->created_at->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Identité Du Déclarant</th>
            <td>
                <div style="position: relative; width: 100px; height: 100px;">
                    <img src="{{ asset('storage/' . $naissance->identiteDeclarant) }}" 
                         alt="Identité Déclarant" 
                         width="100" 
                         height="100" 
                         data-bs-toggle="modal" 
                         data-bs-target="#imagePreviewModal" 
                         onclick="showImagePreview(this.src)" 
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                        Aucun fichier
                    </span>
                </div>
            </td>
        </tr>
        <tr>
            <th>Certificat De Déclaration De Naissance</th>
            <td>
                <div style="position: relative; width: 100px; height: 100px;">
                    <img src="{{ asset('storage/' . $naissance->cdnaiss) }}" 
                         alt="CDNaiss" 
                         width="100" 
                         height="100" 
                         data-bs-toggle="modal" 
                         data-bs-target="#imagePreviewModal" 
                         onclick="showImagePreview(this.src)" 
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                        Aucun fichier
                    </span>
                </div>
            </td>
        </tr>
        <tr>
            <th>Acte de Mariage</th>
            <td>
                <div style="position: relative; width: 100px; height: 100px;">
                    @if ($naissance->acteMariage)
                        <img src="{{ asset('storage/' . $naissance->acteMariage) }}" 
                             alt="Acte de Mariage" 
                             width="100" 
                             height="100" 
                             data-bs-toggle="modal" 
                             data-bs-target="#imagePreviewModal" 
                             onclick="showImagePreview(this.src)" 
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <span style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 14px; color: gray;">
                            Aucun fichier
                        </span>
                    @else
                        Aucun fichier
                    @endif
                </div>
            </td>
        </tr>
    </table>
    
</div>

<!-- Modal pour l'aperçu des images -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagePreviewModalLabel">Aperçu de l'image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body text-center">
                <img id="imagePreview" src="" alt="Aperçu de l'image" class="img-fluid" style="max-height: 500px; max-width: 100%;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<script>
    function showImagePreview(imageUrl) {
    const img = document.getElementById('imagePreview');
    img.src = imageUrl; // Met à jour la source de l'image
}
</script>

@endsection


