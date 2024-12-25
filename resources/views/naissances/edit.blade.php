@extends('vendor.agent.layouts.template')

@section('content')
<div class="container">
    <h2>Mettre à jour l'état de la demande d'extrait de naissance</h2>

    <form action="{{ route('naissances.updateEtat', $naissance->id) }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="nomDefunt">Nom du demandeur</label>
            <input type="text" class="form-control" id="nomDefunt" value="{{ $naissance->nomDefunt }}" disabled>
        </div>

        <div class="form-group">
            <label for="etat">État</label>
            <select name="etat" id="etat" class="form-control">
                @foreach($etats as $etat)
                    <option value="{{ $etat }}" {{ $naissance->etat == $etat ? 'selected' : '' }}>
                        {{ ucfirst($etat) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
