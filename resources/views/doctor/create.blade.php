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
                        <a href="">Liste Docteur</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ajout Docteur</li>
                </ol>
            </nav>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header ms-panel-custome">
                    <h6>Ajout D'un Docteur</h6>
                    <a href="{{ route('doctor.index') }}" class="add-patient"><i class="fas fa-bars"></i>&emsp; Liste docteur</a>
                </div>
                <div class="ms-panel-body">
                    <form class="needs-validation" method="POST" enctype="multipart/form-data" action="{{ route('doctor.store') }}" novalidate>
                        @csrf
                        @method('POST')

                        <!-- Nom et Prénom -->
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom001">Nom</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name" id="validationCustom001" placeholder="Entre son nom" required>
                                    <div class="valid-feedback">Correct</div>
                                </div>
                                @error('name')
                                    <div class="text-danger text-center">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom002">Prénom</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="prenom" id="validationCustom002" placeholder="Entre son prénom" required>
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
                                    <input type="email" class="form-control" name="email" id="validationCustom003" placeholder="Entre son email" required>
                                    <div class="valid-feedback">Correct</div>
                                </div>
                                @error('email')
                                    <div class="text-danger text-center">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom009">Contact</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="contact" id="validationCustom009" placeholder="Son Numéro" required>
                                    <div class="valid-feedback">Correct</div>
                                </div>
                                @error('contact')
                                    <div class="text-danger text-center">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom005">Description</label>
                                <div class="input-group">
                                    <textarea class="form-control" name="description" id="validationCustom005" placeholder="Décrivez le docteur" required style="height: 150px;"></textarea>
                                    <div class="valid-feedback">Correct</div>
                                </div>
                                @error('description')
                                    <div class="text-danger text-center">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="text-center mt-4">
                            <button class="btn btn-primary w-25" type="submit">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .add-patient {
        background-color: #009efb;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 25px;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .add-patient:hover {
        background-color: #007acd;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .ms-panel-body form .form-row {
        margin-bottom: 15px;
    }

    .ms-panel-body form .col-md-6 {
        padding-right: 15px;
        padding-left: 15px;
    }

    .ms-panel-body form .col-md-12 textarea {
        margin-bottom: 10px;
    }

    /* For better button alignment */
    .ms-panel-body .text-center {
        margin-top: 20px;
    }

    .ms-panel-body form button {
        display: inline-block;
        width: 30%;
    }
</style>

@endsection
