@extends('directeur.layouts.template')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Shops</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-decoration: none;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px 0;
            text-decoration: none;
        }
        h6 {
            margin-bottom: 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>
<br><br>
     <!-- Filtre de Mois -->
<h4 class="text-center">Les statistiques par mois</h4>
 <form method="GET" action="{{ route('stats.directeurindex') }}" class="form-inline mb-3 justify-content-center">
    <div class="form-group mr-2">
        <select name="month" class="form-control">
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->locale('fr')->translatedFormat('F') }}
                </option>
            @endfor
        </select>
    </div>
    <div class="form-group mr-2">
        <select name="year" class="form-control">
            @for ($y = date('Y'); $y >= date('Y') - 4; $y--)
                <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-0">Filtrer</button>
</form>
{{-- Les cartes de statistiques --}}
<div class="row w-full mt-4">
    <div class="col-xl-3 col-md-6 col-sm-6">
        <a href="#">
            <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Total Docteur</h6>
                        <p class="ms-card-change">{{ $docteur }}</p>
                    </div>
                </div>
                <i class="fas fa-stethoscope ms-icon-mr"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 col-sm-6">
        <a href="#">
            <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6>Total Naissance</h6>
                        <p class="ms-card-change">{{ $naisshop }}</p>
                    </div>
                </div>
                <i class="fas fa-user ms-icon-mr"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 col-sm-6">
        <a href="#">
            <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6 class="bold">Total Décès</h6>
                        <p class="ms-card-change">{{ $deceshop }}</p>
                    </div>
                </div>
                <i class="fa fa-skull ms-icon-mr"></i>
            </div>
        </a>
    </div>

    <div class="col-xl-3 col-md-6 col-sm-6">
        <a href="#">
            <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                <div class="ms-card-body media">
                    <div class="media-body">
                        <h6 class="bold">Total Déclaration</h6>
                        <p class="ms-card-change">{{ $total }}</p>
                    </div>
                </div>
                <i class="fas fa-briefcase-medical ms-icon-mr"></i>
            </div>
        </a>
    </div>
</div>
  <!-- Boutons de téléchargement -->
  <h6 class="text-center mb-0">Télécharger les statistiques</h6>
  <div class="form-inline mb-3 justify-content-center text-center">
    <a href="{{ route('stats.directeurdownload') }}" class="btn btn-danger mx-2"><i class="fas fa-download"></i> PDF</a>
</div>
<div class="row mb-3">
    <!-- Statistiques des Shops -->
    <div class="col-12">
        <div class="card mb-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">La progression des déclarations</h6>
            </div>
            <div class="card-body">

                <div class="mb-2">
                    <div class="text-gray-500">
                        <h5 class="text-left mb-0">Naissance</h5> 
                    </div>
                    <div class="small text-right"><b>{{ $naisshop }} éléments sur {{ $total }}</b></div> 
                    <div class="progress" style="height: 12px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $total > 0 ? ($naisshop / $total) * 100 : 0 }}%;" 
                            aria-valuenow="{{ $naisshop }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="text-gray-500">
                        <h5 class="text-left mb-0">Décès</h5> 
                    </div>
                    <div class="small text-right"><b>{{ $deceshop }} éléments sur {{ $total }}</b></div>
                    <div class="progress" style="height: 12px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $total > 0 ? ($deceshop / $total) * 100 : 0 }}%;"
                            aria-valuenow="{{ $deceshop }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Les graphiques --}}
<div class="row mb-3">
    <div class="col-md-6">
        <div class="card">
            <h6 class="m-0 font-weight-bold text-primary">Graphique des Naissances</h6>
            <canvas id="lineChart1"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <h6 class="m-0 font-weight-bold text-primary">Graphique des Décès</h6>
            <canvas id="lineChart2"></canvas>
        </div>
    </div>
</div>

<script>
    const naissData = @json(array_values($naissData));
    const decesData = @json(array_values($decesData));

    // Labels pour les mois de l'année en français
    const allLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jui', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];

    // Configurer le graphique des naissances
    const ctx1 = document.getElementById('lineChart1').getContext('2d');
    const lineChart1 = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: allLabels,
            datasets: [{
                label: 'Naissances',
                data: naissData,
                backgroundColor: 'rgba(173, 216, 230, 0.2)',
                borderColor: 'rgba(70, 130, 180, 1)',
                borderWidth: 2,
                pointRadius: 5,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1 // Définit l'intervalle entre les ticks
                    }
                }
            }
        }
    });

    // Configurer le graphique des décès
    const ctx2 = document.getElementById('lineChart2').getContext('2d');
    const lineChart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: allLabels,
            datasets: [{
                label: 'Décès',
                data: decesData,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                pointRadius: 5,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1 // Définit l'intervalle entre les ticks
                    }
                }
            }
        }
    });
</script>

</body>
</html>
@endsection