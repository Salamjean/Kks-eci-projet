@extends('directeur.layouts.template')

@section('content')

<div class="ms-content-wrapper">
  @php
  $profileImage = Auth::guard('directeur')->user()->profile_picture
      ? asset('storage/' . Auth::guard('directeur')->user()->profile_picture)
      : (Auth::guard('directeur')->user()->sexe == 'Homme'
          ? asset('assets/images/profiles/user_homme.png')
          : (Auth::guard('directeur')->user()->sexe == 'Femme'
              ? asset('assets/images/profiles/user_femme.jpeg')
              : asset('assets/images/profiles/neutre.png')));
@endphp
    <div class="ms-profile-overview">
      <div class="ms-profile-cover" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), 
      url('{{ $profileImage }}');
    background-size: cover;
    background-position: center;
    height: 87%;
    padding: 1.5rem;">>
        <img class="ms-profile-img" src=" {{ $profileImage }}" alt="people">
        <div class="ms-profile-user-info">
          <h3 class="ms-profile-username text-white">{{ Auth::guard('directeur')->user()->name }} {{ Auth::guard('directeur')->user()->prenom }}</h3>
          <h6 class="ms-profile-role text-white text-center">{{ Auth::guard('directeur')->user()->fonction }}</h6>
        </div>
      </div>
      <ul class="ms-profile-navigation nav nav-tabs tabs-bordered" role="tablist">
        <li role="presentation"><a href="#tab1" aria-controls="tab1" class="active show text-center" role="tab" data-toggle="tab"> Modifier le profil </a></li>
      </ul>
    </div>

    <div class="col-xl-12 col-md-12">
      <div class="ms-panel">
        <div class="ms-panel-header ms-panel-custome">
          <h6>Modifier vos informations</h6>
          <p class="mb-0">Vous pouvez modifier vos informations personnelles à tout moment.</p>
        </div>
        <div class="ms-panel-body">
          <form method="POST" action="{{ route('directeur.profilupdate') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom010">Nom</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustom010" placeholder="Modifiez votre nom..." name="name" value="{{ $director->name }}">
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

                <div class="col-md-6 mb-3">
                  <label for="validationCustom020">Prénoms</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="validationCustom020" placeholder="Modifiez votre prénom..." name="prenom" value="{{ $director->prenom }} ">
                    @error('prenom')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                    <div class="valid-feedback">
                      Correctement rempli!
                    </div>
                  </div>
                </div>
              </div>

            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom050">Email</label>
                <div class="input-group">
                  <input type="email" class="form-control" id="validationCustom050" placeholder="Modifiez votre email..."  name="email" value="{{ $director->email }}" >
                  @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="col-md-6 mb-2 ">
                <label for="validationCustom030">Contact</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="validationCustom030" placeholder="Modifiez votre numéro de téléphone..." name="contact" value="{{ $director->contact }}">
                  @error('contact')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-center align-items-center";>
              <div class="col-md-6 mb-3 text-center">
                  <label>Photo de profil</label>
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="validatedCustomFile" name="profile_picture">
                      <label class="custom-file-label" for="validatedCustomFile">Choisir votre photo...</label>
                  </div>
                  <div class="mt-4">
                      @if ($director->profile_picture)
                          {{-- Afficher l'image de profil actuelle si elle existe --}}
                          <p>Photo de profil actuelle :</p>
                          <img src="{{ asset('storage/' . $director->profile_picture) }}" alt="Profile Image" class="mt-2" style="width: 100px; height: 100px; border-radius: 50%;">
                      @else
                          <p>Vous avez pas encore enregistré une photo de profil</p>
                      @endif
                  </div>
              </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <button class="btn btn-primary mt-4 w-100" type="submit">Mêttre à jour vos informations</button>
            </div>
        </div>
          </form>
        </div>
      </div>
    </div>
@endsection