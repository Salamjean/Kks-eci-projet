<x-guest-layout>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
        {{ __('Admin Register') }}
    </h2>

    <form method="POST" action="{{ route('admin.register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Mairie')" />
            <select id="name" name="name" class="block mt-1 w-full" required>
                <option value="">Sélectionnez une commune</option>
                <option value="aboisso">Aboisso</option>
                <option value="abengourou">Abengourou</option>
                <option value="Abobo">Abobo</option>
                <option value="abobo-baoule">Abobo-Baoulé</option>
                <option value="agboville">Agboville</option>
                <option value="agni-bouaké">Agni-Bouaké</option>
                <option value="allankoua">Allankoua</option>
                <option value="anono">Anono</option>
                <option value="ankoum">Ankoum</option>
                <option value="anyama">Anyama</option>
                <option value="Attécoubé">Attécoubé</option>
                <option value="Adjamé">Adjamé</option>
                <option value="alepe">Alépé</option>
                <option value="ayama">Ayama</option>
                <option value="bagohouo">Bagohouo</option>
                <option value="banga">Banga</option>
                <option value="bamboué">Bamboué</option>
                <option value="bocanda">Bocanda</option>
                <option value="borotou">Borotou</option>
                <option value="bouna">Bouna</option>
                <option value="bounkani">Bounkani</option>
                <option value="bouafle">Bouaflé</option>
                <option value="bouaké">Bouaké</option>
                <option value="bounoua">Bounoua</option>
                <option value="dabakala">Dabakala</option>
                <option value="dabou">Dabou</option>
                <option value="daloa">Daloa</option>
                <option value="dimbokro">Dimbokro</option>
                <option value="débine">Débine</option>
                <option value="djangokro">Djangokro</option>
                <option value="dini">Dini</option>
                <option value="ferkesedougou">Ferkessédougou</option>
                <option value="gagnoa">Gagnoa</option>
                <option value="genegbe">Génégbé</option>
                <option value="grand-bassam">Grand-Bassam</option>
                <option value="grand-lahou">Grand-Lahou</option>
                <option value="guiberoua">Guiberoua</option>
                <option value="ikessou">Ikessou</option>
                <option value="jacqueville">Jacqueville</option>
                <option value="kong">Kong</option>
                <option value="korhogo">Korhogo</option>
                <option value="Koumassi">Koumassi</option>
                <option value="marako">Marako</option>
                <option value="man">Man</option>
                <option value="marcory">Marcory</option>
                <option value="mondougou">Mondougou</option>
                <option value="nzi">Nzi</option>
                <option value="odienne">Odienné</option>
                <option value="plateau">Plateau</option>
                <option value="Port-Bouët">Port-Bouët</option>
                <option value="san-pedro">San-Pédro</option>
                <option value="sassandra">Sassandra</option>
                <option value="seguelon">Séguéla</option>
                <option value="senoufo">Sénoufo</option>
                <option value="sikensi">Sikensi</option>
                <option value="Songon">Songon</option>
                <option value="solia">Solia</option>
                <option value="soubre">Soubré</option>
                <option value="tabou">Tabou</option>
                <option value="tiago">Tiago</option>
                <option value="tiassale">Tiassalé</option>
                <option value="toumodi">Toumodi</option>
                <option value="treichville">Treichville</option>
                <option value="yamoussoukro">Yamoussoukro</option>
                <option value="yopougon">Yopougon</option>
                <option value="yopourou">Yopourou</option>
                <option value="zuenoula">Zuénoula</option>
                <option value="chiré">Chiré</option>
                <option value="decoudougou">Déboudougou</option>
                <option value="diboké">Diboké</option>
                <option value="doungou">Doungou</option>
                <option value="boura">Boura</option>
                <option value="bofora">Borotou</option>
                <option value="zagoua">Zagoua</option>                
                <option value="Cocody">Cocody</option>                
                               
            </select>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        
        <!-- Script d'initialisation de Select2 -->
        <script>
            $(document).ready(function() {
                $('#name').select2({
                    placeholder: "Sélectionnez une mairie",
                    allowClear: true,
                    width: '100%'
                });
            });
        </script>
 

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('admin.login') }}">
                Connectez-vous si vous avez déjà un compte
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
