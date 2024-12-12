<h1>Demande d'Extrait de Naissance</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<p><strong>Nom de l'Hôpital:</strong> {{ $naissance->nomHopital }}</p>
<p><strong>Nom du Défunt:</strong> {{ $naissance->nomDefunt }}</p>
<p><strong>Date de Naissance:</strong> {{ $naissance->dateNaiss }}</p>
<p><strong>Lieu de Naissance:</strong> {{ $naissance->lieuNaiss }}</p>
<p><strong>Statut de votre demande:</strong> {{ ucfirst($naissance->etat) }}</p>

<!-- Si l'état de la demande est "En attente", permettre la mise à jour -->
@if($naissance->etat == 'En attente')
    <form action="{{ route('naissance.updateStatus', ['id' => $naissance->id, 'status' => 'approuvée']) }}" method="POST">
        @csrf
        <button type="submit">Approuver</button>
    </form>

    <form action="{{ route('naissance.updateStatus', ['id' => $naissance->id, 'status' => 'rejetée']) }}" method="POST">
        @csrf
        <button type="submit">Rejeter</button>
    </form>
@endif
