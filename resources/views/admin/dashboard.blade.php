@extends('admin.layouts.template')

@section('content')

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <div class="font-semibold text-xl text-gray-800 text-center leading-tight" style="display: flex; text-align:center; font-weight:bold; font-size:20px  ">
        Bienvenue sur la page de la mairie de {{ Auth::user()->name }}
     </div><br>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./dashboard">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </div>

  <div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase text-center mb-4">Total-Demande-Extrait-Naissance</div>
              <div class="h2 mb-0 font-weight-bold text-gray-800 text-center">
                {{ $naissancedash }}</div>
                  <i class="fas fa-user fa-2x text-primary text-center"></i>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase text-center mb-4">Total-Demande-Extrait-Décès</div>
              <div class="h2 mb-0 font-weight-bold text-gray-800 text-center">
                {{ $decesdash }}</div>
                  <i class="fas fa-school fa-2x text-success text-center"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase text-center mb-4">Total-Demande-Acte-Mariage</div>
              <div class="h2 mb-0 font-weight-bold text-gray-800 text-center">
                {{ $mariagedash }}</div>
                  <i class="fab fa-fw fa-wpforms fa-2x text-warning text-center"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase text-center mb-4">Total-Demande-Acte</div>
              <div class="h2 mb-0 font-weight-bold text-gray-800 text-center">
                {{ $totalData }}</div>
                  <i class="fas fa-plus fa-2x text-danger text-center"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Area Chart -->
   
    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Taux Des Demandes</h6>
          <div class="dropdown no-arrow">
            
            
          </div>
        </div>
        <div class="card-body">
          
          <div class="mb-3">
            <div class="small text-gray-500">Naissances
              <div class="small float-right"><b>{{ \App\Models\Naissance::count() }} sur {{ $totalData }} Elements</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $naissancePercentage }}%" aria-valuenow="{{ $naissancePercentage }}"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="small text-gray-500">Décès
              <div class="small float-right"><b>{{ \App\Models\Deces::count() }} sur {{ $totalData }} Elements</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-success" role="progressbar" style="width: {{ $decesPercentage }}%;" aria-valuenow="{{ $decesPercentage }}"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="small text-gray-500">Mariages
              <div class="small float-right"><b>{{ \App\Models\Mariage::count() }} sur {{ $totalData }} Elements</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $mariagePercentage }}%" aria-valuenow="{{ $mariagePercentage }}"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          
          
        </div>
        
      </div>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-8 col-lg-7 mb-4">
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
          <h6 class="m-0 font-weight-bold text-white text-center ">Les demandes les plus recentes</h6>
          
        </div>
        <div class="table-responsive" style="display: flex">
          <div>
          <h3 class="font-weight-bold text-primary text-center" style="font-size: 20px">Naissances recentes</h3>
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th>Type</th>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Détail</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Naissances -->
                
                @forelse ($recentNaissances as $naissance)
                <tr>
                    <td>Naissance</td>
                    <td>{{ $naissance->nomHopital }}</td>
                    <td>{{ $naissance->nomDefunt }}</td>
                    <td>{{ $naissance->lieuNaiss }}</td>
                    <td>{{ $naissance->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Détails</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune naissance récente</td>
                </tr>
                @endforelse
            </tbody>

          </table>
        </div>
        <div style="margin-left: 20px">
          <h3 class="font-weight-bold text-primary text-center" style="font-size: 20px">Décès recentes</h3>
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                  <tr>
                      <th>Type</th>
                      <th>ID</th>
                      <th>Nom</th>
                      <th>Détail</th>
                      <th>Date</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <!-- Décès -->
                @forelse ($recentDeces as $deces)
                <tr>
                    <td>Décès</td>
                    <td>{{ $deces->identiteDeclarant }}</td>
                    <td>{{ $deces->identiteDefunt }}</td>
                    <td>{{ $deces->acteMariage }}</td>
                    <td>{{ $deces->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Détails</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Aucun décès récent</td>
                </tr>
                @endforelse
              </tbody>

            </table>
        </div>
        
                <!-- Mariages -->
                <div style="margin-left: 20px">
                  <h3 class="font-weight-bold text-primary text-center" style="font-size: 20px">Mariages recentes</h3>
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Type</th>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Détail</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                @forelse ($recentMariages as $mariage)
                <tr>
                    <td>Mariage</td>
                    <td>{{ $mariage->name }}</td>
                    <td>{{ $mariage->email }}</td>
                    <td>{{ $mariage->password }}</td>
                    <td>{{ $mariage->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">Détails</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Aucun mariage récent</td>
                </tr>
                @endforelse
            </tbody>
        </table>
                </div>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
    <!-- Message From Customer-->
    
  </div>
  <!--Row-->


  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to logout?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          <a href="login.html" class="btn btn-primary">Logout</a>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection