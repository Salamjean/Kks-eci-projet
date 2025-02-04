@extends('superadmin.agences.cgrae.layouts.template')

@section('content')
<style>
    .dashboard-background {
        background-image: url("{{ asset('assets/images/profiles/arriereP.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 300px;
        padding: 0 0 32% 0;
        border-radius: 10px;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="dashboard-background">
    <h1 class="text-center text-black mb-4">Bienvenue sur le tableau de bord</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-center" style="font-size: 20px;">Nombre total d'agent</h3>
                                        <div class="text-center">
                                            <i class="fa fa-user d-block" style="font-size: 30px; color:green"></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="display-4  text-center">{{ $agents }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title text-center" style="font-size: 20px;">Nombre total de déclaration</h3>
                                        <div class="text-center">
                                            <i class="fa fa-church d-block" style="font-size: 30px; color:green "></i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="display-4 text-center">{{ $deceshops }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br>
@endsection