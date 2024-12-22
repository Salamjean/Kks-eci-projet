@extends('doctor.layouts.template')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="ms-content-wrapper">
    <div class="row w-full">
        <!-- Notifications Widgets -->
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

    <!-- Progress bars -->
    <div class="progress">
        <div class="progress-bar bg-primary" role="progressbar" style="width: 45.07%" aria-valuenow="45.07" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar bg-danger" role="progressbar" style="width: 29.05%" aria-valuenow="29.05" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar bg-warning" role="progressbar" style="width: 25.48%" aria-valuenow="25.48" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <!-- Graphiques -->
    <div class="row mb-3">
        <div class="col-md-6 mb-4">
            <div class="card">
                <h6 class="m-4 font-weight-bold text-primary">Graphique des Naissances</h6>
                <canvas id="lineChart1"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <h6 class="m-4 font-weight-bold text-primary">Graphique des Décès</h6>
                <canvas id="lineChart2"></canvas>
            </div>
        </div>
    </div>

    <script>
        const naissData = @json(array_values($naissData));
        const decesData = @json(array_values($decesData));

        const allLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jui', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];

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
                            stepSize: 1
                        }
                    }
                }
            }
        });

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
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>

@endsection
