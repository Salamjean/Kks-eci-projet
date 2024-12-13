@extends('sous_admin.layouts.template')

@section('content')
<style>
    .card-gradient-custom {
        background: linear-gradient(to right, #4facfe, #00f2fe);
        border-radius: 10px;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .ms-icon-mr {
        font-size: 2rem;
    }

    .ms-content-wrapper {
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .ms-panel {
        border: 1px solid #ddd;
        border-radius: 10px;
        background: #fff;
        margin: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .ms-panel-header {
        padding: 10px;
        background: #f7f7f7;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
    }

    .ms-panel-body {
        padding: 20px;
    }
</style>

<div class="ms-content-wrapper">
    <div class="row" style="justify-content: center">
        <!-- Cartes Statistiques -->
        <div class="col-xl-3 col-md-6 col-sm-6">
            <a href="#">
                <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                    <div class="ms-card-body media">
                        <div class="media-body">
                            <h6>Total Naissance</h6>
                            <p class="ms-card-change text-center">{{ $naisshop }}</p>
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
                            <h6>Total Décès</h6>
                            <p class="ms-card-change">4567</p>
                        </div>
                    </div>
                    <i class="fa fa-school ms-icon-mr"></i>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-6">
            <a href="#">
                <div class="ms-card card-gradient-custom ms-widget ms-infographics-widget ms-p-relative">
                    <div class="ms-card-body media">
                        <div class="media-body">
                            <h6>Total Déclaration</h6>
                            <p class="ms-card-change">4567</p>
                        </div>
                    </div>
                    <i class="fas fa-briefcase-medical ms-icon-mr"></i>
                </div>
            </a>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="d-flex">
        <div class="col-xl-6 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Patient Total</h6>
                </div>
                <div class="ms-panel-body">
                    <canvas id="line-chart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12">
            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Patient In</h6>
                </div>
                <div class="ms-panel-body">
                    <canvas id="bar-chart-grouped"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
