@extends('doctor.layouts.template')

@section('content')

<div class="ms-content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('doctor.dashboard') }}">
                            <i class="material-icons">home</i> Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('doctor.index') }}">Liste docteur</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier le docteur</li>
                </ol>
            </nav>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header ms-panel-custome">
                    <h6>Modifier cet docteur</h6>
                    <a href="{{ route('doctor.index') }}" class="ms-text-primary">Liste Docteur</a>
                </div>
                <div class="ms-panel-body">
                    <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{ route('doctor.update', $sousadmin->id) }}" novalidate>
                        @csrf
                        @method('PUT')

                        <!-- Nom et Prénom -->
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom001">Nom</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" value="{{ $sousadmin->name }}" id="validationCustom001" placeholder="Entre son nom" required>
                                    <div class="valid-feedback">Correct</div>
                                </div>
                                @error('name')
                                    <div class="text-danger text-center">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom002">Prénom</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="prenom" value="{{ $sousadmin->prenom }}" id="validationCustom002" placeholder="Entre son prénom" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                @error('prenom')
                                    <div class="text-danger text-center">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email et Contact -->
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <label for="validationCustom003">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" value="{{ $sousadmin->email }}" id="validationCustom003" placeholder="Entre son email" required>
                                    <div class="valid-feedback">Correct</div>
                                </div>
                                @error('email')
                                    <div class="text-danger text-center">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom009">Contact</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="contact" value="{{ $sousadmin->contact }}" id="validationCustom009" placeholder="Son Numéro" required>
                                    <div class="valid-feedback">Correct</div>
                                </div>
                                @error('contact')
                                    <div class="text-danger text-center">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                       <!-- Fonction et Sexe -->
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="fonctionSelect">Fonction</label>
                                <div class="input-group">
                                    <select class="form-control" name="fonction" id="fonctionSelect" required>
                                        <option value="" disabled {{ !isset($sousadmin->fonction) ? 'selected' : '' }}>Sélectionnez une fonction</option>
                                        <option value="Médecin" {{ (isset($sousadmin->fonction) && $sousadmin->fonction == 'Médecin') ? 'selected' : '' }}>Médecin(e)</option>
                                        <option value="Sage-femme" {{ (isset($sousadmin->fonction) && $sousadmin->fonction == 'Sage-femme') ? 'selected' : '' }}>Sage-femme</option>
                                        <option value="Infirmier" {{ (isset($sousadmin->fonction) && $sousadmin->fonction == 'Infirmier') ? 'selected' : '' }}>Infirmier(e)</option>
                                    </select>
                                    <div class="valid-feedback">Correct</div>
                                </div>
                                @error('fonction')
                                    <div class="text-danger text-center">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sexeSelect">Sexe</label>
                                <div class="input-group">
                                    <select class="form-control" name="sexe" id="sexeSelect" required>
                                        <option value="" disabled {{ !isset($sousadmin->sexe) ? 'selected' : '' }}>Sélectionnez le sexe</option>
                                        <option value="Homme" {{ (isset($sousadmin->sexe) && $sousadmin->sexe == 'Homme') ? 'selected' : '' }}>Homme</option>
                                        <option value="Femme" {{ (isset($sousadmin->sexe) && $sousadmin->sexe == 'Femme') ? 'selected' : '' }}>Femme</option>
                                    </select>
                                    <div class="valid-feedback">Correct</div>
                                </div>
                                @error('sexe')
                                    <div class="text-danger text-center">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom005">Description</label>
                                <div class="input-group">
                                    <textarea class="form-control" name="description" id="validationCustom005" placeholder="Décrivez le docteur" required style="height: 150px;">{{ $sousadmin->description }}</textarea>
                                    <div class="valid-feedback">Correct</div>
                                </div>
                                @error('description')
                                    <div class="text-danger text-center">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="text-center mt-4">
                            <button class="btn btn-primary w-25" type="submit">Appliquer la modification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
