@extends('pages.layouts.template')
@section('content')

<div class="container py-5" style="margin-top: 150px">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header  text-white text-center py-4" style="background-color: #ffa500">
                    <h1 class="h3 mb-0">Suivi de votre demande</h1>
                    <p class="mb-0 text-black">Vérifiez l'état d'avancement en temps réel</p>
                </div>
                
                <div class="card-body px-5 py-4">
                    <form method="POST" action="{{ route('recherche.demande') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-4 text-center">
                            <label for="reference_naissance" class="form-label h5 text-muted">
                                <i class="bi bi-search me-2"></i>Numéro de référence
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg border-2 py-3" 
                                   id="reference_naissance" 
                                   name="reference_naissance" 
                                   placeholder="Ex: REF12345678"
                                   required
                                   style="border-color: #dee2e6; border-radius: 12px;">
                            <div class="invalid-feedback">
                                Veuillez saisir votre référence.
                            </div>
                            <small class="text-muted mt-2 d-block">
                                Cette référence vous a été communiquée lors du dépôt de votre demande.
                            </small>
                        </div>

                        <button type="submit" class="btn btn-lg w-100 py-3 rounded-pill shadow-sm" style="background-color: #008000">
                            <i class="bi bi-search me-2"></i>Vérifier l'état
                        </button>
                    </form>

                    <div id="resultat-recherche" class="mt-4">
                        @if(isset($etatDemande))
                            <div class="text-center">
                                <h4 class="mb-4">Résultat de votre recherche</h4>
                                @if($etatDemande)
                                    <div class="alert alert-success border-0 rounded-3 p-4 shadow-sm" role="alert">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <i class="bi bi-check-circle-fill fs-1 me-3"></i>
                                            <h5 class="mb-0">Référence: {{ request('reference_naissance') }}</h5>
                                        </div>
                                        <hr>
                                        <p class="fs-5 mb-1">État actuel:</p>
                                        <p class="display-6 fw-bold">{{ $etatDemande }}</p>
                                        <div class="progress mt-3" style="height: 8px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning border-0 rounded-3 p-4 shadow-sm" role="alert">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <i class="bi bi-exclamation-triangle-fill fs-1 me-3"></i>
                                            <h5 class="mb-0">Référence non trouvée</h5>
                                        </div>
                                        <hr>
                                        <p class="fs-5">
                                            Aucune demande trouvée pour <strong>"{{ request('reference_naissance') }}"</strong>.
                                            <br>Veuillez vérifier votre référence ou contacter notre support.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="card-footer bg-light text-center py-3">
                    <p class="mb-0 text-muted">
                        Besoin d'aide ? <a href="#" class="text-decoration-none">Consultez notre centre d'aide</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        border: none;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .progress {
        border-radius: 10px;
    }
    .invalid-feedback {
        font-size: 0.9rem;
    }
</style>

<script>
    // Validation du formulaire côté client
    (function() {
        'use strict'
        
        const forms = document.querySelectorAll('.needs-validation')
        
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

@endsection