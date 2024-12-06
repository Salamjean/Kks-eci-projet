<section>
    <x-slot name="header">
    <header class="font-semibold text-xl text-gray-800 text-center leading-tight" style="display: flex; justify-content:center; ">
        <div>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Information sur le profil') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Mettez à jour les informations de profil et l'adresse électronique de votre compte.") }}
                <a href="{{ route('dashboard') }}" class="btn btn-primary" style="margin-left:150%">Retour</a>
            </p>
            
              
        </div>
    </header>
    </x-slot>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" style="">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nom et Prénoms')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="commune" :value="__('Commune')" />
        
            <select id="commune" name="commune" class="mt-1 block w-full" required autofocus>
                <option value="" disabled>-- Sélectionnez une commune --</option>
<option value="Abobo" {{ old('commune', $user->commune) === 'Abobo' ? 'selected' : '' }}>Abobo</option>
<option value="Adjamé" {{ old('commune', $user->commune) === 'Adjamé' ? 'selected' : '' }}>Adjamé</option>
<option value="Attécoubé" {{ old('commune', $user->commune) === 'Attécoubé' ? 'selected' : '' }}>Attécoubé</option>
<option value="Cocody" {{ old('commune', $user->commune) === 'Cocody' ? 'selected' : '' }}>Cocody</option>
<option value="Koumassi" {{ old('commune', $user->commune) === 'Koumassi' ? 'selected' : '' }}>Koumassi</option>
<option value="Marcory" {{ old('commune', $user->commune) === 'Marcory' ? 'selected' : '' }}>Marcory</option>
<option value="Plateau" {{ old('commune', $user->commune) === 'Plateau' ? 'selected' : '' }}>Plateau</option>
<option value="Port-Bouët" {{ old('commune', $user->commune) === 'Port-Bouët' ? 'selected' : '' }}>Port-Bouët</option>
<option value="Treichville" {{ old('commune', $user->commune) === 'Treichville' ? 'selected' : '' }}>Treichville</option>
<option value="Yopougon" {{ old('commune', $user->commune) === 'Yopougon' ? 'selected' : '' }}>Yopougon</option>
<option value="Aboisso" {{ old('commune', $user->commune) === 'Aboisso' ? 'selected' : '' }}>Aboisso</option>
<option value="Abengourou" {{ old('commune', $user->commune) === 'Abengourou' ? 'selected' : '' }}>Abengourou</option>
<option value="Abobo-Baoulé" {{ old('commune', $user->commune) === 'Abobo-Baoulé' ? 'selected' : '' }}>Abobo-Baoulé</option>
<option value="Agboville" {{ old('commune', $user->commune) === 'Agboville' ? 'selected' : '' }}>Agboville</option>
<option value="Agni-Bouaké" {{ old('commune', $user->commune) === 'Agni-Bouaké' ? 'selected' : '' }}>Agni-Bouaké</option>
<option value="Allankoua" {{ old('commune', $user->commune) === 'Allankoua' ? 'selected' : '' }}>Allankoua</option>
<option value="Anono" {{ old('commune', $user->commune) === 'Anono' ? 'selected' : '' }}>Anono</option>
<option value="Ankoum" {{ old('commune', $user->commune) === 'Ankoum' ? 'selected' : '' }}>Ankoum</option>
<option value="Anyama" {{ old('commune', $user->commune) === 'Anyama' ? 'selected' : '' }}>Anyama</option>
<option value="Alépé" {{ old('commune', $user->commune) === 'Alépé' ? 'selected' : '' }}>Alépé</option>
<option value="Ayama" {{ old('commune', $user->commune) === 'Ayama' ? 'selected' : '' }}>Ayama</option>
<option value="Bagohouo" {{ old('commune', $user->commune) === 'Bagohouo' ? 'selected' : '' }}>Bagohouo</option>
<option value="Banga" {{ old('commune', $user->commune) === 'Banga' ? 'selected' : '' }}>Banga</option>
<option value="Bamboué" {{ old('commune', $user->commune) === 'Bamboué' ? 'selected' : '' }}>Bamboué</option>
<option value="Bocanda" {{ old('commune', $user->commune) === 'Bocanda' ? 'selected' : '' }}>Bocanda</option>
<option value="Borotou" {{ old('commune', $user->commune) === 'Borotou' ? 'selected' : '' }}>Borotou</option>
<option value="Bouna" {{ old('commune', $user->commune) === 'Bouna' ? 'selected' : '' }}>Bouna</option>
<option value="Bounkani" {{ old('commune', $user->commune) === 'Bounkani' ? 'selected' : '' }}>Bounkani</option>
<option value="Bouaflé" {{ old('commune', $user->commune) === 'Bouaflé' ? 'selected' : '' }}>Bouaflé</option>
<option value="Bouaké" {{ old('commune', $user->commune) === 'Bouaké' ? 'selected' : '' }}>Bouaké</option>
<option value="Bounoua" {{ old('commune', $user->commune) === 'Bounoua' ? 'selected' : '' }}>Bounoua</option>
<option value="Dabakala" {{ old('commune', $user->commune) === 'Dabakala' ? 'selected' : '' }}>Dabakala</option>
<option value="Dabou" {{ old('commune', $user->commune) === 'Dabou' ? 'selected' : '' }}>Dabou</option>
<option value="Daloa" {{ old('commune', $user->commune) === 'Daloa' ? 'selected' : '' }}>Daloa</option>
<option value="Dimbokro" {{ old('commune', $user->commune) === 'Dimbokro' ? 'selected' : '' }}>Dimbokro</option>
<option value="Débine" {{ old('commune', $user->commune) === 'Débine' ? 'selected' : '' }}>Débine</option>
<option value="Djangokro" {{ old('commune', $user->commune) === 'Djangokro' ? 'selected' : '' }}>Djangokro</option>
<option value="Dini" {{ old('commune', $user->commune) === 'Dini' ? 'selected' : '' }}>Dini</option>
<option value="Ferkessédougou" {{ old('commune', $user->commune) === 'Ferkessédougou' ? 'selected' : '' }}>Ferkessédougou</option>
<option value="Gagnoa" {{ old('commune', $user->commune) === 'Gagnoa' ? 'selected' : '' }}>Gagnoa</option>
<option value="Génégbé" {{ old('commune', $user->commune) === 'Génégbé' ? 'selected' : '' }}>Génégbé</option>
<option value="Grand-Bassam" {{ old('commune', $user->commune) === 'Grand-Bassam' ? 'selected' : '' }}>Grand-Bassam</option>
<option value="Grand-Lahou" {{ old('commune', $user->commune) === 'Grand-Lahou' ? 'selected' : '' }}>Grand-Lahou</option>
<option value="Guiberoua" {{ old('commune', $user->commune) === 'Guiberoua' ? 'selected' : '' }}>Guiberoua</option>
<option value="Ikessou" {{ old('commune', $user->commune) === 'Ikessou' ? 'selected' : '' }}>Ikessou</option>
<option value="Jacqueville" {{ old('commune', $user->commune) === 'Jacqueville' ? 'selected' : '' }}>Jacqueville</option>
<option value="Kong" {{ old('commune', $user->commune) === 'Kong' ? 'selected' : '' }}>Kong</option>
<option value="Korhogo" {{ old('commune', $user->commune) === 'Korhogo' ? 'selected' : '' }}>Korhogo</option>
<option value="Marako" {{ old('commune', $user->commune) === 'Marako' ? 'selected' : '' }}>Marako</option>
<option value="Man" {{ old('commune', $user->commune) === 'Man' ? 'selected' : '' }}>Man</option>
<option value="Mondougou" {{ old('commune', $user->commune) === 'Mondougou' ? 'selected' : '' }}>Mondougou</option>
<option value="Nzi" {{ old('commune', $user->commune) === 'Nzi' ? 'selected' : '' }}>Nzi</option>
<option value="Odienné" {{ old('commune', $user->commune) === 'Odienné' ? 'selected' : '' }}>Odienné</option>
<option value="San-Pédro" {{ old('commune', $user->commune) === 'San-Pédro' ? 'selected' : '' }}>San-Pédro</option>
<option value="Sassandra" {{ old('commune', $user->commune) === 'Sassandra' ? 'selected' : '' }}>Sassandra</option>
<option value="Séguéla" {{ old('commune', $user->commune) === 'Séguéla' ? 'selected' : '' }}>Séguéla</option>
<option value="Sénoufo" {{ old('commune', $user->commune) === 'Sénoufo' ? 'selected' : '' }}>Sénoufo</option>
<option value="Sikensi" {{ old('commune', $user->commune) === 'Sikensi' ? 'selected' : '' }}>Sikensi</option>
<option value="Songon" {{ old('commune', $user->commune) === 'Songon' ? 'selected' : '' }}>Songon</option>
<option value="Solia" {{ old('commune', $user->commune) === 'Solia' ? 'selected' : '' }}>Solia</option>
<option value="Soubré" {{ old('commune', $user->commune) === 'Soubré' ? 'selected' : '' }}>Soubré</option>
<option value="Tabou" {{ old('commune', $user->commune) === 'Tabou' ? 'selected' : '' }}>Tabou</option>
<option value="Tiago" {{ old('commune', $user->commune) === 'Tiago' ? 'selected' : '' }}>Tiago</option>
<option value="Tiassalé" {{ old('commune', $user->commune) === 'Tiassalé' ? 'selected' : '' }}>Tiassalé</option>
<option value="Toumodi" {{ old('commune', $user->commune) === 'Toumodi' ? 'selected' : '' }}>Toumodi</option>
<option value="Zuénoula" {{ old('commune', $user->commune) === 'Zuénoula' ? 'selected' : '' }}>Zuénoula</option>
<option value="Chiré" {{ old('commune', $user->commune) === 'Chiré' ? 'selected' : '' }}>Chiré</option>
<option value="Déboudougou" {{ old('commune', $user->commune) === 'Déboudougou' ? 'selected' : '' }}>Déboudougou</option>
<option value="Diboké" {{ old('commune', $user->commune) === 'Diboké' ? 'selected' : '' }}>Diboké</option>
<option value="Doungou" {{ old('commune', $user->commune) === 'Doungou' ? 'selected' : '' }}>Doungou</option>
<option value="Boura" {{ old('commune', $user->commune) === 'Boura' ? 'selected' : '' }}>Boura</option>
<option value="Bofora" {{ old('commune', $user->commune) === 'Borotou' ? 'selected' : '' }}>Borotou</option>
<option value="Zagoua" {{ old('commune', $user->commune) === 'Zagoua' ? 'selected' : '' }}>Zagoua</option>

            </select>
        
            <x-input-error class="mt-2" :messages="$errors->get('commune')" />
        </div>
        <!-- Inclure jQuery, Select2 CSS et JS dans le <body> -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            
            <!-- Script d'initialisation de Select2 -->
            <script>
                $(document).ready(function() {
                    $('#commune').select2({
                        placeholder: "Sélectionnez une commune",
                        allowClear: true,
                        width: '100%'
                    });
                });
            </script>
        

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button style="background-color: blue">{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >{{ __('Enregistrement affectué.') }}</p>
            @endif
        </div>
    </form>
</section>
